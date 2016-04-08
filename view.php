<?php

	// connect to the database
include('connect-db.php');

	// get results from database
$sql = "SELECT id, name, year FROM cars";
$result = $conn->query($sql); 

	// display data in table
echo "<h1><b>View All</b></h1>";

echo "<table class='dataTable' border='1' cellpadding='10'>";
echo "<tr> <th>ID</th> <th>Name</th> <th>Year</th> <th></th> <th></th></tr>";

	// loop through results of database query, displaying them in the table
while($row = $result->fetch_assoc()) {

		// echo out the contents of each row into a table
	?>
	<tr>
	<td class="id"><?php echo $row['id'] ?></td>
	<td class="name"><?php echo $row['name'] ?></td>
	<td class="year"><?php echo $row['year'] ?></td>
	<td><input type="button" class="btn btn-primary edit" value="Edit"></td>
	<td><input type="button" class="btn btn-danger delete" value="Delete"></td>
	</tr> 
	<?php
} 
	// close table
echo "</table>";

$conn->close();
?>