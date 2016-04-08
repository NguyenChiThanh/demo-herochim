<?php 
/* 
 CONNECT-DB.PHP
 Allows PHP to connect to your database
*/

$username = "dflvrvuwmonmrm";
$password = "g4Qv3ojRfVhovEhytps-SiioU7";
$hostname = "ec2-23-21-249-224.compute-1.amazonaws.com";
$dbname = "d4v2bpe8au03a9"; 

// Create connection
$conn = new pg_connect($hostname, $username, $password, $dbname);
  // Check connection
if ($conn->connect_error) {
	die("Connection failed: " . $conn->connect_error);
}
?>