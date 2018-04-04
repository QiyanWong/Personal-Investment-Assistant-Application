<?php
$date = $_GET["date"];
$stock = $_GET["stock"];
// $date = (int)122;

$day = date("d");
$month = date("m");
$year = date("Y");
$file = fopen("../hist_data/$stock-hist-$month-$day-$year.csv", "rb"); 
Header( "Content-type:  application/octet-stream "); 
Header( "Accept-Ranges:  bytes "); 
Header( "Content-Disposition:  attachment;  filename= 4.doc"); 
$contents = "";
$contents = fgets($file,8192);
// echo $contents;

for ($i=0; $i<$date-1; $i++) {
	$contents = fgets($file, 8192);
}
// Date	Open	High	Low	Close	Volume	Adj Close
$data1 = explode(",", $contents);
$contents = fgets($file, 8192);
$data2 = explode(",", $contents);

$msg = array();
$msg[0] = str_replace("-","/",$data2[0]); //date
$msg[1] = $data2[1]; //open
$msg[2] = $data2[4]; //close
$msg[5] = $data2[3]; //lowest
$msg[6] = $data2[2]; //highest
$msg[7] = $data2[5]; //volume
$msg[8] = $data2[5]; //volume
$msg[9] = "-";
if ($date == 252) {
	$msg[3] = 0;
	$msg[4] = 0;
} else {
	$msg[3] = (float)$data1[4] - (float)$data2[4];
	$msg[4] = $msg[3]/(float)$msg[2]*100;
}
$msg[3] = (string)$msg[3];
$msg[4] = (string)$msg[4]."%";
echo $msg[0].",".$msg[1].",".$msg[2].",".$msg[3].",".$msg[4].",".$msg[5].",".$msg[6].",".$msg[7].",".$msg[8].",".$msg[9];
?>