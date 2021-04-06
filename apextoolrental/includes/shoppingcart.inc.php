<?php



if (isset($_POST["addcart1"])) {
	
	$cartSku = '1';
	$cartQty = $_POST["qty1"];
	$cartCustomer = $_SESSION["customerID"];
	
	require_once 'dbh.inc.php';
	require_once 'functions.inc.php';
	
	
	if (addCart($conn, $cartSku, $cartQty, $cartCustomer) == !false) {
		header("location: create-order.php");
		unset($_POST["addCart1"]);
		unset($_POST["qty"]);
	}
}

if (isset($_POST["addcart2"])) {
	
	$cartSku = '2';
	$cartQty = $_POST["qty2"];
	$cartCustomer = $_SESSION["customerID"];
	
	require_once 'dbh.inc.php';
	require_once 'functions.inc.php';
	
	
	if (addCart($conn, $cartSku, $cartQty, $cartCustomer) == true) {
		header("location: create-order.php");
		unset($_POST["addCart2"]);
		exit();
	}
}
	
if (isset($_POST["addcart3"])) {
	
	$cartSku = '3';
	$cartQty = $_POST["qty3"];
	$cartCustomer = $_SESSION["customerID"];
	
	require_once 'dbh.inc.php';
	require_once 'functions.inc.php';
	
	
	if (addCart($conn, $cartSku, $cartQty, $cartCustomer) == true) {
		header("location: create-order.php");
		unset($_POST["addCart3"]);
		exit();
	}
}
if (isset($_POST["addcart4"])) {
	
	$cartSku = '4';
	$cartQty = $_POST["qty4"];
	$cartCustomer = $_SESSION["customerID"];
	
	require_once 'dbh.inc.php';
	require_once 'functions.inc.php';
	
	
	if (addCart($conn, $cartSku, $cartQty, $cartCustomer) == true) {
		header("location: create-order.php");
		unset($_POST["addCart4"]);
		exit();
	}
}


if (isset($_POST["addcart5"])) {
	
	$cartSku = '5';
	$cartQty = $_POST["qty5"];
	$cartCustomer = $_SESSION["customerID"];
	
	require_once 'dbh.inc.php';
	require_once 'functions.inc.php';
	
	
	if (addCart($conn, $cartSku, $cartQty, $cartCustomer) == true) {
		header("location: create-order.php");
		unset($_POST["addCart5"]);
		exit();
	}
}

if (isset($_POST["addcart6"])) {
	
	$cartSku = '6';
	$cartQty = $_POST["qty6"];
	$cartCustomer = $_SESSION["customerID"];
	
	require_once 'dbh.inc.php';
	require_once 'functions.inc.php';
	
	
	if (addCart($conn, $cartSku, $cartQty, $cartCustomer) == true) {
		header("location: create-order.php");
		unset($_POST["addCart6"]);
		exit();
	}
}

if (isset($_POST["addcart7"])) {
	
	$cartSku = '7';
	$cartQty = $_POST["qty7"];
	$cartCustomer = $_SESSION["customerID"];
	
	require_once 'dbh.inc.php';
	require_once 'functions.inc.php';
	
	
	if (addCart($conn, $cartSku, $cartQty, $cartCustomer) == true) {
		header("location: create-order.php");
		unset($_POST["addCart7"]);
		exit();
	}
}

if (isset($_POST["addcart8"])) {
	
	$cartSku = '8';
	$cartQty = $_POST["qty8"];
	$cartCustomer = $_SESSION["customerID"];
	
	require_once 'dbh.inc.php';
	require_once 'functions.inc.php';
	
	
	if (addCart($conn, $cartSku, $cartQty, $cartCustomer) == true) {
		header("location: create-order.php");
		unset($_POST["addCart8"]);
		exit();
	}
}

if (isset($_POST["addcart9"])) {
	
	$cartSku = '9';
	$cartQty = $_POST["qty9"];
	$cartCustomer = $_SESSION["customerID"];
	
	require_once 'dbh.inc.php';
	require_once 'functions.inc.php';
	
	
	if (addCart($conn, $cartSku, $cartQty, $cartCustomer) == true) {
		header("location: create-order.php");
		unset($_POST["addCart9"]);
		exit();
	}
}