<?php
include('connect-db.php');
$id = htmlspecialchars($_POST['id']);
$name = htmlspecialchars($_POST['name']);
$year = htmlspecialchars($_POST['year']);

$sql_insert = "INSERT INTO cars (id, name, year)
VALUES ($id,'$name',$year)";

if ($conn->query($sql_insert) === TRUE) {
	echo "New record created successfully";
} else {
	echo "Error: " . $sql_insert . "<br>" . $conn->error;
}
$conn->close();
?>