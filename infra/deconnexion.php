<?php
	session_start();
	$_SESSION['mdp']=NULL;
	$_SESSION['user']=NULL;
	session_destroy();
	header("location: connexion.php");
?>