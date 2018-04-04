<?php

$com = $_GET["com"];
$type = $_GET["type"];
$ite = $_GET["ite"];

$day = date("d");
$month = date("m");
$year = date("Y");
if ($type == "hist") {
	$filename = "../hist_data/$com-hist-$month-$day-$year.csv";
} else {
	$filename = "../real_data/$com-$month-$day-$year.csv";
}
$file = fopen($filename, "rb"); 
Header( "Content-type:  application/octet-stream "); 
Header( "Accept-Ranges:  bytes "); 
Header( "Content-Disposition:  attachment;  filename= 4.doc"); 
$contents = "";
for ($i=0; $i<=$ite; $i++) {
	$contents = fgets($file,8192);	
}
if ($contents == "") {
	echo "0,0,0,0,0,0";
} else {
	echo $contents;
}
?>