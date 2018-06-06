<?php

	session_start();
	if ($_SESSION['user']==NULL) {
			header("location: connexion.php");
			exit;
	}


	try {
		$bdd=new PDO('mysql:host=185.13.38.55;dbname=ping','grafana','N2RkOTU2MDU3MTg2MDVkOGNmNDBhZjg3');
	} catch (Exception $e) {
		die('Erreur : '.$e->getMessage());
	}
	$id=$_GET['id'];
	$bdd->exec('DELETE FROM fai WHERE id="'.$id.'"');
	echo "coucou";
	header('Location: tableau2.php');
	exit();
?>