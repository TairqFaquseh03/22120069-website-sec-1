<?php

session_start();

if (isset($_SESSION["user"])) {
	header("Location: index.html");
	exit;
}

$Username = null;
$Password = null;

if (isset($_POST['username'])) {
	$Username = $_POST['username'];
}

if (isset($_POST['password'])) {
	$Password = $_POST['password'];
}

if (!$Username || !$Password) {
	exit;
}

$pdo = new PDO("mysql:host=192.168.0.100;dbname=alredwan_redwan", 'alredwan_redwan', 'gBqrDe3EYmtPC68sMV5Y');

$statement = $pdo->query("SELECT id FROM users WHERE username = '$Username' AND password = '$Password'")->fetchAll();

if (!empty($statement)) {
	$_SESSION["user"] = $statement[0]["id"];
	header('Location: index.html');
	exit;
}

header('Location: login.html');
