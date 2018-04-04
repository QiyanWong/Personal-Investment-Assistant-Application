<?php
$tmp = $_GET["com"];
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "History_Data";
$year = date("Y");
$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 

// $stocklist = array("YHOO", "GOOG", "MSFT", "FB", "CCF");
// $output=basename(__FILE__, '.php');
// $myfile = fopen("$output.out.txt", "w") or die("Unable to open file!");


// foreach ($stocklist as $tmp) {
	
	$sql="SELECT AVG(Close_Price)
			FROM $tmp				
			";

	$result = $conn->query($sql);
	$row = $result->fetch_row();
	$txt=$tmp.",".$row[0].",".$year;
	echo $txt."<br>";
	// fwrite($myfile, $txt);
// }


$conn->close();
// fclose($myfile);

?>
