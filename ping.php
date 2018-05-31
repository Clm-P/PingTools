<?php

chdir(dirname(__FILE__));

$lock_file = "/tmp/".base64_encode(__FILE__);
if(file_exists($lock_file)==false) touch($lock_file);
$fp = fopen($lock_file, 'w');

if (flock($fp,
 LOCK_EX | LOCK_NB) == false)
{
        die("\n\nAlready in use\n\n");
}

$mysqli = new mysqli('localhost', 'ping', 'MYSQL-PASSWORD', 'ping');

if ($mysqli->connect_errno) {

    echo "Sorry, this website is experiencing problems.";
    echo "Error: hostsled to make a MySQL connection, here is why: \n";
    echo "Errno: " . $mysqli->connect_errno . "\n";
    echo "Error: " . $mysqli->connect_error . "\n";
    exit;
}

// SQL query
$sql = "SELECT * FROM hosts";
if (!$result = $mysqli->query($sql)) {
    echo "Error: Our query hostsled to execute and here is why: \n";
    echo "Query: " . $sql . "\n";
    echo "Errno: " . $mysqli->errno . "\n";
    echo "Error: " . $mysqli->error . "\n";
    exit;
}

if ($result->num_rows === 0) {
    echo "We could not find a match for ID $aid, sorry about that. Please try again.";
    exit;
}

while($row=mysqli_fetch_assoc($result)) {

      exec("fping -u -t 250 ".$row['ip']."  ",$output,$tt);
      if($tt)
      {
          $etat=0;
          $message="not responding";
          if($row['ping']==0)
          {
            if ($row['notif']==1 && $row['send_notif']==0)
            {
              $mysqli->query("UPDATE hosts SET send_notif = 1 WHERE ip = '".$row['ip']."' ");
              exec("telegram-send --format html '<pre>".$row['client']."</pre> ".$row['ip']." est <b>DOWN</b> depuis ".$row['last_checked']." '");
            }
          }
          $mysqli->query("UPDATE hosts SET  ping = '0', info = 'not responding' WHERE ip = '".$row['ip']."' ");
          $mysqli->query("UPDATE hosts SET loop_error = loop_error +1  WHERE ip = '".$row['ip']."' ");
          echo $row["last_checked"] . " - " . $row["ip"] . "   - notif:" . $row['notif']  . "  -  not responding\n";
      }
      else
      {
          $etat=1;
          $message="OK";
          if($row['ping']==0)
          {
            if ($row['notif']==1 && $row['send_notif']==0)
            {
              $mysqli->query("UPDATE hosts SET send_notif = 1 WHERE ip = '".$row['ip']."' ");
              exec("telegram-send --format html '<pre>".$row['client']."</pre>est <b>UP</b> depuis ".$row['last_checked']." '");
            }
          }
          $mysqli->query("UPDATE hosts SET last_checked = NOW(), ping = '1', info = 'OK' WHERE ip = '".$row['ip']."' ");
          $mysqli->query("UPDATE hosts SET send_notif = 0 WHERE ip = '".$row['ip']."' ");
          echo $row["last_checked"] ." - "  .   $row["ip"] . "  -  notif:" . $row['notif']  . "   -  responding\n";
      }


// $mysqli->query("INSERT INTO log(hosts,date_log,etat,message) VALUE('".$row['id']."',NOW(),'".$etat."','".$message."')");

    }

$result->free();
$mysqli->close();
?>
