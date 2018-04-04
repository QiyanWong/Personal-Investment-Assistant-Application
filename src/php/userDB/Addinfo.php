<?php

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "User_DB";

$user=$_GET["usr"];
$company=$_GET["com"];
$vol=$_GET["vol"];
$price=$_GET["price"];

//echo $user.$company."\n";
// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 

$check="SELECT *
			FROM User
			WHERE Username='$user'
			";
$result = $conn->query($check);
if ($result->num_rows>0){
$sql="	INSERT INTO Info (Username, Company, BuyPrice,Volume)
		VALUES('$user','$company','$price','$vol')	
			";
if ($conn->query($sql) === TRUE) {
    echo "New record created successfully\n";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error."\n";
}
}
else{
echo "Error User not exist!\n";
}

$conn->close();

?>





