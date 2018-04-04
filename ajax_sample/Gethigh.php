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
$myfile = fopen("$output.out.txt", "w") or die("Unable to open file!");

foreach ($stocklist as $tmp) {
	$sql="SELECT * FROM $tmp LIMIT 9,1";
	$result = $conn->query($sql);
	$row=$result->fetch_assoc();
	$cdate=$row["His_Date"];
	
	$sql="SELECT *
			FROM $tmp
			WHERE High_Price=
					(SELECT MAX(High_Price)
					 FROM $tmp 
					 WHERE His_Date>='$cdate'
					 )
			AND His_Date>='$cdate'					
			";

	$result = $conn->query($sql);
	if ($result->num_rows>0) {
		while($row = $result->fetch_assoc()){
			$txt="Company ".$tmp.": Highest Price in the last ten days is ".$row["High_Price"]." on ".$row["His_Date"].PHP_EOL;
			echo $txt."<br>";
			fwrite($myfile, $txt);
		}
		} else {
			echo "Error 0 result \n";
	}
}
$conn->close();
fclose($myfile);

?>
