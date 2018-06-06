<?php
    try {
        $bdd=new PDO('mysql:host=185.13.38.55;dbname=ping','grafana','N2RkOTU2MDU3MTg2MDVkOGNmNDBhZjg3');
    } catch (Exception $e) {
        die('Erreur : '.$e->getMessage());
    }

    $rep=$bdd->query('SELECT mdp FROM user WHERE nom ="'.$_POST['user'].'"');
    while ($row=$rep->fetch()) {
        $res[]=$row;
    }
    if ($_POST['mdp']==$res[0]['mdp']) {
        session_start();
        $_SESSION['user']=$_POST['user'];
        $_SESSION['mdp']=$_POST['mdp'];
        header('Location: tableau2.php');
        exit();
    }else{
        header('Location: connexion.php');
        exit();
    }


?>