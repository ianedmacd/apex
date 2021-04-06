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
	header("location: ../index.php");
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
		
		$sql = "SELECT customerID FROM person WHERE email = '".$_SESSION["email"]."';";
		$result = mysqli_query($conn, $sql);
		$_SESSION["customerID"] = $result->fetch_array()[0] ?? '';
		
		$sql = "SELECT personID from person WHERE person.email ='".$_SESSION["email"]."';";
		$result = mysqli_query($conn, $sql);
		$_SESSION["personID"] = $result->fetch_array()[0] ?? '';
		
		header("location: ../home.php");
		exit();
	}
}

function accountLink($conn) {
	session_start();
	$sql = "SELECT customerID FROM person WHERE email = '".$_SESSION["email"]."';";
	$result = mysqli_query($conn, $sql);
	$_SESSION["customerID"] = $result->fetch_array()[0] ?? '';
	$noCustomer = empty($_SESSION["customerID"]);
		
	if ($noCustomer === True) {
		$_POST["customerAccount"] = 1;
	}
	else {
		$_POST["customerAccount"] = 0;
	}
}

function busMatch($conn, $businessCode) {
	$sql = "SELECT * FROM customer WHERE businessPassword = ?;";
	$stmt = mysqli_stmt_init($conn);
	if (!mysqli_stmt_prepare($stmt, $sql)) {
		header("location: ../signup-business.php?error=stmtfailed");
		exit();
	}
	
	mysqli_stmt_bind_param($stmt, "s", $businessCode);
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

function busLink($conn, $businessCode) {
	session_start();
	$sql = "SELECT customerID FROM customer WHERE businessPassword = '".$businessCode."';";
	$result = mysqli_query($conn, $sql);
	$customerID = $result->fetch_array()[0] ?? '';
	
	$sql2 = "UPDATE person SET customerID = '".$customerID."' WHERE email = '".$_SESSION["email"]."';";
	if(mysqli_query($conn, $sql2)){
		header("location: ../home.php");
	}
}

function createBusiness($conn, $busname, $buspass) {
	session_start();
	$sql = "INSERT INTO customer (customerID, customerTypeID, addressID, businessName, businessPassword) VALUES (DEFAULT, '2', '1', '".$busname."', '".$buspass."');";
	mysqli_query($conn, $sql);
	
	$sql2 = "SELECT MAX(customerID) FROM customer WHERE businessName = '".$busname."';";
	$result = mysqli_query($conn, $sql2);
	$customerID = $result->fetch_array()[0] ?? '';
	
	$sql3 = "UPDATE person SET customerID = '".$customerID."' WHERE email = '".$_SESSION["email"]."';";
	if(mysqli_query($conn, $sql3)){
		header("location: ../home.php");
	}
}

function addCart($conn, $cartSku, $cartQty, $cartCustomer) {
	$sql = "INSERT INTO cart (cartID, skuID, qty, customerID) VALUES ('DEFAULT','".$cartSku."','".$cartQty."','".$cartCustomer."');";
	if ($conn->query($sql) === TRUE) {
		return TRUE;
	}

	
}
function createOrder($conn, $devDate, $retDate) {
	session_start();
	$sql = "INSERT INTO `order` (`orderID`, `customerID`, `storeID`, `invoiceID`, `acceptedByID`, `orderStatusID`, `quoteExpiryDateTime`, `discountPercent`, `notes`) VALUES (NULL, ". $_SESSION["customerID"] .", ". $_SESSION["store"] .", 10, NULL, 1, NULL, NULL, NULL);";
	if ($conn->query($sql) !== FALSE) {
		
		$sql = "SELECT MIN(cartID) FROM cart";
		$result = mysqli_query($conn, $sql);
		$minCart = $result->fetch_array()[0] ?? '';
		
		$sql = "SELECT MAX(orderID) FROM `order`";
		$result = mysqli_query($conn, $sql);
		$orderID = $result->fetch_array()[0] ?? '';
		
	
		$sql = "SELECT COUNT(skuID) FROM cart";
		$result = mysqli_query($conn, $sql);
		$cartotal = $result->fetch_array()[0] ?? '';
	
	
		$maxCart = (int)$minCart + (int)$cartotal;
		$i = $minCart;
		$_SESSION["i"] = $i;
		$_SESSION["maxcart"] = $maxCart;
		$_SESSION["mincart"] = $minCart;
	
		WHILE ($i < $maxCart) {
			$sql = "SELECT skuID FROM cart WHERE cartID = ".$i;
			$result = mysqli_query($conn, $sql);
			$skuID = $result->fetch_array()[0] ?? '';
			
			
			$sql = "SELECT qty FROM cart WHERE cartID = ".$i;
			$result = mysqli_query($conn, $sql);
			$qty = $result->fetch_array()[0] ?? '';
			
			$sql = "SELECT priceVersionID FROM sku WHERE SKU = ".$skuID;
			$result = mysqli_query($conn, $sql);
			$priceVersionID = $result->fetch_array()[0] ?? '';
			
			$j = 0;
			
			WHILE ($j < $qty) {
			
				$sql = "SELECT MIN(tool.toolID) FROM tool WHERE tool.SKU = ".$skuID;
				$result = mysqli_query($conn, $sql);
				$toolID = $result->fetch_array()[0] ?? '';
				
				$sql = "INSERT INTO `delivery` (`deliveryID`, `deliveryErrorID`, `addressID`, `deliveryFee`, `scheduledDelivery`, `scheduledRetrieval`, `actualDelivery`, `actualRetrieval`) VALUES (NULL, '1', '1', '1', '".$devDate."', '".$retDate."', NULL, NULL);";
				$result = mysqli_query($conn, $sql);
				
				$sql = "SELECT MAX(deliveryID) FROM `delivery`";
				$result = mysqli_query($conn, $sql);
				$deliveryID = $result->fetch_array()[0] ?? '';
				
				$sql = "INSERT INTO `order_tool` (`orderToolID`, `orderID`, `toolID`, `priceVersionID`, `fulfilledByID`, `deliveryID`, `damageFee`, `notes`) VALUES (NULL, '". $orderID ."', '". $toolID ."', '". $priceVersionID ."', NULL, '". $deliveryID ."', NULL, NULL);";
				$result = mysqli_query($conn, $sql);
				
				$j = $j + 1;
			}
			
			$i = $i + 1;
		}
		
		$sql = "DELETE FROM `cart`";
		$conn->query($sql);
	}
	
	header("location: ../home.php?error=none");
}