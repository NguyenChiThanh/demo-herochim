<?php 
/* 
 CONNECT-DB.PHP
 Allows PHP to connect to your database
*/

$username = "xkykkiturabxci";
$password = "t_e7xImfxDqeM9D_W3KKB6Yr3T";
$hostname = "ec2-54-235-85-65.compute-1.amazonaws.com";
$dbname = "dcjfe6jau3gtmf"; 

// Create connection
$conn = new pg_connect($hostname, $username, $password, $dbname);
  // Check connection
if ($conn->connect_error) {
	die("Connection failed: " . $conn->connect_error);
}
?>