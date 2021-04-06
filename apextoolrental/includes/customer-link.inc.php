<?php

if (isset($_POST["connect"])) {

	$businessCode = $_POST["businessCode"];
	
	require_once 'dbh.inc.php';
	require_once 'functions.inc.php';
	
	if (busMatch($conn, $businessCode) === false) {
		header("location: ../signup-business.php?error=businessdoesntexist");
		exit();
	}
	
	busLink($conn, $businessCode);
	
}
else {
	header("location: ../signup-business.php");
}