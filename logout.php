<?php
session_start();

if (!isset($_SESSION["user"])) {
	header("Location: login.html");
	exit;
}

session_unset();

header("Location: index.html");
