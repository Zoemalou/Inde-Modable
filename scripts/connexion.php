<?php
	require_once('identifiants.php');

	$pdo = new PDO("mysql:host=$host;dbname=$db", $user, $pass);
	$pdo->exec('SET NAMES utf8;');
?>