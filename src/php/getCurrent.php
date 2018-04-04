<?php

$com = $_GET["com"];
$filename = "http://finance.yahoo.com/d/quotes.csv?s=$com&f=sd1l1c";
$file = fopen($filename, "rb");
Header( "Content-type:  application/octet-stream "); 
Header( "Accept-Ranges:  bytes "); 
Header( "Content-Disposition:  attachment;  filename= 4.doc"); 
$contents = "";
$contents = fgets($file, 8192);
$data = explode(",", $contents);
echo $data[2]."\n";
?>