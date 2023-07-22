
<?php

$servername = "sql312.byethost22.com";
$username = "b22_34576513";
$password = "0553696274";
$dbname = "b22_34576513_salman";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

?>