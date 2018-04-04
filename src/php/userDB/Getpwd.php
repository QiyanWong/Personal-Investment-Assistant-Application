<?php
$user=$_GET["usr"];

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "User_DB";


//echo $user."\n";
// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 

$sql="SELECT *
			FROM User
			WHERE Username='$user'
			LIMIT 1		
			";
$result = $conn->query($sql);
if ($result->num_rows>0){
while($row = $result->fetch_assoc()){
	echo $row["Password"];
}
}else{echo "-1";}

$conn->close();

?>