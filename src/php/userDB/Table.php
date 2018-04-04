<?php

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "User_DB";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 

	$sql = "CREATE TABLE Info (
		Username VARCHAR(20) NOT NULL,
		Company VARCHAR(10) NOT NULL,
		BuyPrice DECIMAL(10, 6) NOT NULL,
		Volume DECIMAL(20, 0) NOT NULL
	)";

	if ($conn->query($sql) === TRUE) {
    	echo "Table created successfully \n";
	} else {
	    echo "Error creating table: " . $conn->error. "\n";
	}

$sql = "CREATE TABLE User (
		Username VARCHAR(20) NOT NULL,
		Password VARCHAR(20) NOT NULL
	)";

	if ($conn->query($sql) === TRUE) {
    	echo "Table created successfully \n";
	} else {
	    echo "Error creating table: " . $conn->error. "\n";
	}

$conn->close();



?>