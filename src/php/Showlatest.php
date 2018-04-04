<?php
$tmp = $_GET["com"];
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "Real_Data";
$date = date("Y-m-d");
$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 

// $stocklist = array("YHOO", "GOOG", "MSFT", "FB", "CCF");
// $output=basename(__FILE__, '.php');
// $myfile = fopen("$output.out.txt", "w") or die("Unable to open file!");


// foreach ($stocklist as $tmp) {
	
	$sql="SELECT *
			FROM $tmp				
			ORDER BY Rea_Date DESC
			LIMIT 1
			";

	$result = $conn->query($sql);
	$row = $result->fetch_assoc();
	$txt=$tmp.",".$row['Close_Price'].",".$date;
	echo $txt."<br>";
	// fwrite($myfile, $txt);
// }


$conn->close();
// fclose($myfile);

?>
