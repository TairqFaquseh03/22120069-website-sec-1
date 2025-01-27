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
// $statement = $pdo->query("SELECT * FROM cart WHERE user_id = '$user_id' AND product_id = '$item'")->fetchAll();
$statement = $pdo->query("SELECT quantity FROM cart WHERE user_id = '$user_id' AND product_id = '$item'")->fetchAll();

if (empty($statement)) {
	header("Location: cart.php");
	exit;
}

if ($statement[0]["quantity"] == 0) {
	$pdo->exec("DELETE FROM cart WHERE user_id = '$user_id' AND product_id = '$item'");
	header("Location: cart.php");
	exit;
}

$count = $statement[0]["quantity"] - 1;
$pdo->exec("UPDATE cart SET quantity = $count WHERE user_id = '$user_id' AND product_id = '$item'");

header('Location: cart.php');
