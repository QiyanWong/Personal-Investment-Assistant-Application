<?php

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "History_Data";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 

$stocklist = array("YHOO", "GOOG", "MSFT", "FB", "CCF");
$output=basename(__FILE__, '.php');
$myfile = fopen("$output.txt", "w") or die("Unable to open file!");

$avglist=array_fill_keys(
  array("YHOO", "GOOG", "MSFT", "FB", "CCF"), '');
$lowlist=array_fill_keys(
  array("YHOO", "GOOG", "MSFT", "FB", "CCF"), '');

foreach ($stocklist as $tmp) {
	
	$sql="SELECT AVG(Close_Price)
			FROM $tmp				
			";

	$result = $conn->query($sql);
	$row = $result->fetch_row();
	$avglist[$tmp]=$row[0];
	$txt="Company ".$tmp.": Average Price in the latest one year is ".$avglist[$tmp].PHP_EOL;

	echo $txt."<br>";
//	fwrite($myfile, $txt);
	$sql="SELECT *
			FROM $tmp
			WHERE Low_Price=
					(SELECT MIN(Low_Price)
					 FROM $tmp 
					 )					
			";
	$result = $conn->query($sql);
	if ($result->num_rows>0) {
		while($row = $result->fetch_assoc()){
			$txt="Company ".$tmp.": Lowest Price in the latest one year is ".$row["Low_Price"]." on ".$row["His_Date"].PHP_EOL;
			$lowlist[$tmp]=$row["Low_Price"];
			echo $txt."<br>";
		}
		} else {
			echo "Error 0 result \n";
	}
}

//set tmp1 as selected.
function ComSelect($stocklist,$company,$avglist,$lowlist){
	$myfile = fopen("$company.out.txt", "w") or die("Unable to open file!");
	echo "Select ".$company." \nThe lowset price in the latest one year is ".$lowlist[$company]."<br>";
	foreach ($stocklist as $tmp) {
	if($avglist[$tmp]<$lowlist[$company])
	{
		$txt="Company ".$tmp.": Average Price ".$avglist[$tmp]." is less than the lowest price ".$lowlist[$company]." of company ".$company." in the latest one year".PHP_EOL;
		echo $txt."<br>";
		fwrite($myfile, $txt);
	}
	}
	fclose($myfile);
}

ComSelect($stocklist,"FB",$avglist,$lowlist);   //
	
$conn->close();


?>
