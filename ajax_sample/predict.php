<?php
$usr=$_GET["usr"];
?>
<p>Predicted Price for Company <?=$usr?> after an hour:
<?php
// print date("l M dS, Y, H:i:s");
$filename = "http://chartapi.finance.yahoo.com/instrument/1.0/$usr/chartdata;type=quote;range=1d/csv";
$file = fopen($filename, "rb");
Header( "Content-type:  application/octet-stream "); 
Header( "Accept-Ranges:  bytes "); 
Header( "Content-Disposition:  attachment;  filename= 4.doc"); 
$useless = "";
$contents = "";
$count = 0;
while (!feof($file)) {
	if ($count < 17) {
		$useless .= fgets($file, 8192);
	} else {
		$contents .= fgets($file, 8192);
		// $contents_arr = explode(",", $contents);
	}
	$count ++;
}

$day = date("d");
$month = date("m");
$year = date("Y");
$ofilename = "data.csv";
if (file_exists($ofilename)) {
	unlink($ofilename);
}
$ofile = fopen($ofilename,"w");
fwrite($ofile,"timestamp,close,high,low,open,volume\n");
fwrite($ofile,$contents);
// echo $contents > "hahaha.csv";
fclose($file); 
fclose($ofile);

system("bayes.py");
?>
</p>