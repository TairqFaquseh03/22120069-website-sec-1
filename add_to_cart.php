<?php
session_start();

if (!isset($_SESSION["user"])) {
	header("Location: login.html");
	exit;
}

$item = null;

if (isset($_POST['item'])) {
	$item = $_POST['item'];
}

$pdo = new PDO("mysql:host=192.168.0.100;dbname=alredwan_redwan", 'alredwan_redwan', 'gBqrDe3EYmtPC68sMV5Y');

$user_id = $_SESSION["user"];
$statement = $pdo->query("SELECT * FROM cart WHERE user_id = '$user_id' AND product_id = '$item'")->fetchAll();

if (empty($statement)) $pdo->exec("INSERT INTO cart(user_id,product_id,quantity) VALUES($user_id,$item,0)");

$statement = $pdo->query("SELECT quantity FROM cart WHERE user_id = '$user_id' AND product_id = '$item'")->fetchAll();
$count = $statement[0]["quantity"] + 1;

$pdo->exec("UPDATE cart SET quantity = $count WHERE user_id = '$user_id' AND product_id = '$item'");

header('Location: ' . $_SERVER['HTTP_REFERER']);
