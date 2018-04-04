<?php

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "History_Data";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 

$stocklist = array("AAPL","AMZN","COKE","INTC","ORCL","YHOO", "GOOG", "MSFT", "FB", "CCF");
$day = date("d");
$month = date("m");
$year = date("Y");

foreach ($stocklist as $tmp) {
	$sql = "CREATE TABLE $tmp (
		His_Date DATE,
		Open_Price DECIMAL(10, 6) NOT NULL,
		High_Price DECIMAL(10, 6) NOT NULL,
		Low_Price DECIMAL(10, 6) NOT NULL,
		Close_Price DECIMAL(10, 6) NOT NULL,
		Volume DECIMAL(20, 0) NOT NULL,
		Adj_Close DECIMAL(10, 6)  NOT NULL
	)";

	$result = $conn->query("SELECT * FROM $tmp");
	if (!$result){
		if ($conn->query($sql) === TRUE) {
	    	echo $tmp."Table created successfully \n";
		} else {
		    echo "Error creating".$tmp." table: " . $conn->error. "\n";
		}
	}

	$csv_path="../hist_data/$tmp-hist-$month-$day-$year.csv";

	$infile = fopen($csv_path, "r");
	
	$data = fgets($infile, 4096);    //Ignore first 
	
	while ($data = fgets($infile, 4096)) {
		$dataArr = explode(",", $data);
		
		$sql = "INSERT INTO $tmp (His_Date, Open_Price, High_Price, Low_Price, Close_Price, Volume, Adj_Close)
			SELECT '$dataArr[0]','$dataArr[1]','$dataArr[2]','$dataArr[3]','$dataArr[4]','$dataArr[5]','$dataArr[6]'
			FROM DUAL
			WHERE NOT EXISTS(
				SELECT *
				FROM $tmp
				WHERE $tmp.His_Date = '$dataArr[0]')";
		if ($conn->query($sql) === TRUE) {
			// echo "Import ".$tmp." history data successfully\n";
		} else {
			echo "Error import ".$tmp.": ".$conn->error."\n";
		}
	}
	//echo "Import ".$tmp." history data complete\n";
}

$conn->close();

$dbname = "Real_Data";
// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 

foreach ($stocklist as $tmp) {
	$sql = "CREATE TABLE $tmp (
		Rea_Date DECIMAL(20,0) NOT NULL,
		Close_Price DECIMAL(10, 6) NOT NULL,
		High_Price DECIMAL(10, 6) NOT NULL,
		Low_Price DECIMAL(10, 6) NOT NULL,
		Open_Price DECIMAL(10, 6) NOT NULL,
		Volume DECIMAL(20, 0) NOT NULL
	)";
	// check if the table exists
	$result = $conn->query("SELECT * FROM $tmp");
	// if exists, delete old table
	if ($result) {
		if(!$conn->query("drop table $tmp")) {
			echo "Delete old ".$tmp." table failed:".$conn->error."\n";
		}
	}
	// create new table
	if ($conn->query($sql) === TRUE) {
    	echo $tmp." real time table created successfully \n";
	} else {
	    echo "Error creating".$tmp." table: " . $conn->error. "\n";
	}
	$csv_path="../real_data/$tmp-$month-$day-$year.csv";
	$sql = <<<eof
LOAD DATA LOCAL INFILE '$csv_path' INTO TABLE $tmp
FIELDS TERMINATED BY ',' 
LINES TERMINATED BY '\n'
IGNORE 1 ROWS
(Rea_Date,Close_Price,High_Price,Low_Price,Open_Price,Volume)
eof;
	if ($conn->query($sql) === TRUE) {
	    echo "Import ".$tmp." realtime data successfully  \n";
	} else {
	    echo "Error import ".$tmp.": \n" . $conn->error;
	}
}
$conn->close();



?>