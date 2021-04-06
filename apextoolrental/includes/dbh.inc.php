<?php


$serverName = "localhost";
$dbUsername = "root";
$dbName = "tool rental";
$dbPassword = '';

$conn = mysqli_connect($serverName, $dbUsername, $dbPassword, $dbName);

if (!$conn) {
	die("Connection failed: " . mysqli_connect_error());
}