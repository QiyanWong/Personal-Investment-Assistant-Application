<?php

$day = date("d");
$month = date("m");
$year = date("Y");
// $stock = "msft";

$index = $_GET["date"];
$stock = $_GET["stock"];
// $index = (int)122;
// downfile($stock, $day, $month, $year);
$file = fopen("../real_data/".$stock."-$month-$day-$year.csv", "rb"); 
Header( "Content-type:  application/octet-stream "); 
Header( "Accept-Ranges:  bytes "); 
Header( "Content-Disposition:  attachment;  filename= 4.doc"); 
$contents = "";
$contents = fgets($file,8192);
// echo $contents;

for ($i=0; $i<$index-1; $i++) {
	$contents = fgets($file, 8192);
}
// index	Open	High	Low	Close	Volume	Adj Close


if ($contents == ""){
	echo " , , , , , , , ,";
} else {
	$data1 = explode(",", $contents);
	$contents = fgets($file, 8192);
	if ($contents != "") {
		$data2 = explode(",", $contents);
		$msg = array();
		$msg[0] = str_replace("-","/",$data2[0]);
		$msg[1] = $data2[4]; //open
		$msg[2] = $data2[1]; //close
		$msg[5] = $data2[3]; //lowest
		$msg[6] = $data2[2]; //highest
		$msg[7] = $data2[5]; //volume
		$msg[8] = $data2[5];
		$msg[9] = "-";
		if ($index == 252) {
			$msg[3] = 0;
			$msg[4] = 0;
		} else {
			$msg[3] = (float)$data1[1] - (float)$data2[1]; //close?
			$msg[4] = $msg[3]/(float)$msg[2]*100;
		}
		$msg[3] = (string)$msg[3];
		$msg[4] = (string)$msg[4]."%";
		echo $msg[0].",".$msg[1].",".$msg[2].",".$msg[3].",".$msg[4].",".$msg[5].",".$msg[6].",".$msg[7].",".$msg[8].",".$msg[9];	

	} else {
		echo " , , , , , , , ,";
	}
}


?>