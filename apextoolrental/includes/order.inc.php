<?php
require_once 'dbh.inc.php';
require_once 'functions.inc.php';

if (isset($_POST["submitOrder"]) == TRUE) {
	
	$devDate = $_POST["orderStart"];
	$retDate = $_POST["orderEnd"];
	
	createOrder($conn, $devDate, $retDate);
	
	
}


		
		
	
	
	
	
	
