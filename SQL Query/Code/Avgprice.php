<?php

$servername = "localhost";
$username = "root";
$password = "root";
$dbname = "History_Data";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 

$stocklist = array("YHOO", "GOOG", "MSFT", "FB", "CCF");
$output=basename(__FILE__, '.php');
$myfile = fopen("$output.out.txt", "w") or die("Unable to open file!");


foreach ($stocklist as $tmp) {
	
	$sql="SELECT AVG(Close_Price)
			FROM $tmp				
			";

	$result = $conn->query($sql);
	$row = $result->fetch_row();
	$txt="Company ".$tmp.": Average Price in the latest one year is ".$row[0].PHP_EOL;
	echo $txt."<br>";
	fwrite($myfile, $txt);
}


$conn->close();
fclose($myfile);

?>
