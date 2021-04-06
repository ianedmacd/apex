<?php

if (isset($_POST["buscreate"])) {
	
	$busname = $_POST["busname"];
	$buspass = $_POST["buspass"];
	
	require_once 'dbh.inc.php';
	require_once 'functions.inc.php';
	
	createBusiness($conn, $busname, $buspass);
	
}
	else {
		header("location: ../signup-business.php");
	}