<?php

session_start();

if (isset($_SESSION["user"])) {
	header("Location: index.html");
	exit;
}

$Username = null;
$Password = null;

if (isset($_POST['signupUsername'])) {
	$Username = $_POST['signupUsername'];
}

if (isset($_POST['signupPassword'])) {
	$Password = $_POST['signupPassword'];
}

if (!$Username || !$Password) {
	exit;
}


$pdo = new PDO("mysql:host=192.168.0.100;dbname=alredwan_redwan", 'alredwan_redwan', 'gBqrDe3EYmtPC68sMV5Y');

$statement = $pdo->query("SELECT * FROM users WHERE username = '$Username'")->fetchAll();

if (empty($statement)) {
	$pdo->exec("INSERT INTO users(username,password) VALUES('$Username','$Password')");
	$_SESSION["user"] = $pdo->lastInsertId();
	header('Location: index.html');
	exit;
}

header('Location: signup.html');
