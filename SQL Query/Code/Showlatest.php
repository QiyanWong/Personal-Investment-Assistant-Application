<?php

$servername = "localhost";
$username = "root";
$password = "root";
$dbname = "Real_Data";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 

$stocklist = array("YHOO", "GOOG", "MSFT", "FB", "CCF");
$output=basename(__FILE__, '.php');
$myfile = fopen("$output.out.txt", "w") or die("Unable to open file!");


foreach ($stocklist as $tmp) {
	
	$sql="SELECT *
			FROM $tmp				
			ORDER BY Rea_Date DESC
			LIMIT 1
			";

	$result = $conn->query($sql);
	$row = $result->fetch_assoc();
	$txt="Company ".$tmp.": Latest Price in Real_Data is ".$row['Close_Price'].PHP_EOL;
	echo $txt."<br>";
	fwrite($myfile, $txt);
}


$conn->close();
fclose($myfile);

?>
