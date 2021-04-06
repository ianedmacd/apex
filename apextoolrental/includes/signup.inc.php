<?php

if (isset($_POST["submit"])) {
	
	$firstname = $_POST["firstname"];
	$lastname = $_POST["lastname"];
	$email = $_POST["email"];
	$phone = $_POST["phone"];
	$pwd = $_POST["pwd"];
	$pwd2 = $_POST["pwd2"];
	$personType = $_POST["personType"];
	
	require_once 'dbh.inc.php';
	require_once 'functions.inc.php';
	
	if (pwdMatch($pwd, $pwd2) != false) {
		header("location: ../signup.php?error=passwordsdontmatch");
		exit();
	}
	
	if (emailExists($conn, $email) != false) {
		header("location: ../signup.php?error=emailtaken");
		exit();
	}
	
	createUser($conn, $personType, $firstname, $lastname, $email, $phone, $pwd);
	
}
	else {
		header("location: ../signup.php");
	}