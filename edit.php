<?php 
$id = $_POST['id'];
$name = htmlspecialchars($_POST['name']);
$year = htmlspecialchars($_POST['year']);

$sql = "UPDATE cars SET name='$name', year=$year WHERE id=$id";

if ($conn->query($sql) === TRUE) {
	echo "Record updated successfully";

	header("Location: view.php"); 
} else {
	echo "Error updating record: " . $conn->error;
}
?>