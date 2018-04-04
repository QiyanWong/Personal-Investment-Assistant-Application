<?php

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "User_DB";

$user=$_GET["usr"];
$company=$_GET["com"];

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
$sql="SELECT *
			FROM Info
			WHERE Username='$user'
			AND Company='$company'	
			";
$result = $conn->query($sql);

$filename = "http://finance.yahoo.com/d/quotes.csv?s=$company&f=sd1l1c";
$file = fopen($filename, "rb");
Header( "Content-type:  application/octet-stream "); 
Header( "Accept-Ranges:  bytes "); 
Header( "Content-Disposition:  attachment;  filename= 4.doc"); 
$contents = "";
$contents = fgets($file, 8192);
$data = explode(",", $contents);

if ($result->num_rows>0){
	while($row = $result->fetch_assoc()) {
		$inf =  $row["Volume"].",".$data[2].",".$row["BuyPrice"];
	}
	echo $inf;
}else{echo "0,".$data[2].",0";}
}
else{
echo "Error User not exist!\n";
}
$conn->close();

?>