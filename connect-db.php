<?php 
/* 
 CONNECT-DB.PHP
 Allows PHP to connect to your database
*/

$username = "root";
$password = "";
$hostname = "localhost";
$dbname = "examples"; 

// Create connection
$conn = new mysqli($hostname, $username, $password, $dbname);
  // Check connection
if ($conn->connect_error) {
	die("Connection failed: " . $conn->connect_error);
}
?>