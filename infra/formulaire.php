<?php
	session_start();
	if (!isset($_SESSION['user'])) {
		header("location: connexion.php");
		exit;
	}
	session_write_close();
?>

<!DOCTYPE html>
<html>
<head>
	<title>form</title>
	<link rel="stylesheet" type="text/css" href="css/style.css"/>
	<link href="bootstrap/css/bootstrap.min.css" rel="stylesheet" />
	<link href="bootstrap/css/bootstrap-theme.min.css" rel="stylesheet" />

	<script src="js/jquery.js"></script>
	<script src="bootstrap/js/bootstrap.min.js"></script>
	<style type="text/css">
		#form{
			width:550px;
			margin: auto;
		}
	</style>
</head>
<body>
<div id="form">
	<form method="post">
		  <div class="form-group">
			    <label>Nom du client</label>
			    <input type="text" class="form-control" placeholder="Nom du client" name="nom">
		  </div>
		  <div class="form-group">
			    <label>IP</label>
			    <input type="text" class="form-control" placeholder="IP" name="ip">
		  </div>
		  <div class="form-group">
			    <label>Email client</label>
			    <input type="Email" class="form-control" placeholder="Email client" name="email">
		  </div>
  		  <div class="form-group">
			    <label>Zone</label>
			    <input type="text" class="form-control" placeholder="Zone" name="zone">
		  </div>
		    <div class="form-check">
			    <input type="checkbox" class="form-check-input" id="exampleCheck1" name="check" value="1">
			    <label class="form-check-label">Notification sms</label>
		  </div>

		  <center><button type="submit" class="btn btn-primary" value="submit" name="btnsubmit">Ajouter client</button></center>
	</form>
</div>
<?php
	try {
		$bdd=new PDO('mysql:host=185.13.38.55;dbname=ping','grafana','N2RkOTU2MDU3MTg2MDVkOGNmNDBhZjg3');
	} catch (Exception $e) {
		die('Erreur : '.$e->getMessage());
	}
	if (isset($_POST['btnsubmit'])) {
		$nom=$_POST['nom'];
		$ip=$_POST['ip'];
		$email=$_POST['email'];
		$zone=$_POST['zone'];
		
		if (isset($_POST['check'])) {
			$sms=$_POST['check'];
		}else{
			$sms=0;
		}
	$bdd->exec('INSERT INTO fai(ip,client,email_client,sms,zone) VALUES("'.$ip.'", "'.$nom.'", "'.$email.'", "'.$sms.'", "'.$zone.'")');
	header("location: tableau2.php");
	exit();
	}
?>
</body>
</html>