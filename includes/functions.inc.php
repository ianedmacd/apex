<?php


function pwdMatch($pwd, $pwd2) {
	$result;
	if ($pwd !== $pwd2) {
	$result = true;
	}
	else {
		$result = false;
	}
	return $result;
}
	
function emailExists($conn, $email) {
	$sql = "SELECT * FROM person WHERE email = ?;";
	$stmt = mysqli_stmt_init($conn);
	if (!mysqli_stmt_prepare($stmt, $sql)) {
		header("location: ../signup.php?error=stmtfailed");
		exit();
	}
	
	mysqli_stmt_bind_param($stmt, "s", $email);
	mysqli_stmt_execute($stmt);
	
	$resultData = mysqli_stmt_get_result($stmt);
	
	if ($row = mysqli_fetch_assoc($resultData)) {
		return $row;
	}
	
	else {
		$result = false;
		return $result;
	}
	
	mysqli_stmt_close($stmt);
}

function createUser($conn, $personType, $firstname, $lastname, $email, $phone, $pwd) {
	$sql = "INSERT INTO person (personID, customerID, storeID, personTypeID, personStatusID, firstName, lastName, email, phone, password) VALUES (DEFAULT, DEFAULT, DEFAULT, ?, DEFAULT, ?, ?, ?, ?, ?);";
	$stmt = mysqli_stmt_init($conn);
	if (!mysqli_stmt_prepare($stmt, $sql)) {
		header("location: ../signup.php?error=stmtfailed");
		exit();
	}
	
	$hashedPwd = password_hash($pwd, PASSWORD_DEFAULT);
	
	mysqli_stmt_bind_param($stmt, "ssssss", $personType, $firstname, $lastname, $email, $phone, $hashedPwd);
	mysqli_stmt_execute($stmt);	
	mysqli_stmt_close($stmt);
	header("location: ../index.php?error=none");
}

function loginUser($conn, $email, $pwd) {
	$emailExists = emailExists($conn, $email);
	
	if ($emailExists === false) {
		header("location: ../index.php?error=wrongemail");
		exit();
	}
	
	$pwdHashed = $emailExists["password"];
	$checkPwd = password_verify($pwd, $pwdHashed);
	
	if ($checkPwd === false) {
		header("location: ../index.php?error=wrongpassword");
		exit();
	}
	else if ($checkPwd === true) {
		session_start();
		$_SESSION["email"] = $emailExists["email"];
		$_SESSION["firstName"] = $emailExists["firstName"];
		$_SESSION["lastName"] = $emailExists["lastName"];
		header("location: ../home.php");
		exit();
	}
}

function accountLink($conn) {
	$sql = "SELECT personID FROM person WHERE email = '".$_SESSION["email"]."';";
	$result = mysqli_query($conn, $sql);
	$personID = $result->fetch_array()[0] ?? '';

	$sql = "SELECT customerID FROM person WHERE email = '".$_SESSION["email"]."';";
	$result = mysqli_query($conn, $sql);
	$customerID = $result->fetch_array()[0] ?? '';
	$noCustomer = empty($customerID);
		
	if ($noCustomer === True) {
		//echo "Suckin my cuckin";
		}
		else {
		exit();
		}
}
