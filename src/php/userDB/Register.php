<?php
$pasw=$_GET["pwd"];
$user=$_GET["usr"];


$servername = "localhost";
$username = "root";
$password = "";
$dbname = "User_DB";



$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 

$check="SELECT *
			FROM User
			WHERE Username='$user'
			";
$result = $conn->query($check);
if ($result->num_rows>0){
while($row = $result->fetch_assoc()){
	echo "-1";
}
}

else{
$sql="	INSERT INTO User (Username,Password)
		VALUES('$user','$pasw')	
			";

if ($conn->query($sql) === TRUE) {
    echo "0";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error."\n";
}

}

$conn->close();

?>