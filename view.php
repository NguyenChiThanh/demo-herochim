<?php

	// connect to the database
 $dsn = "pgsql:"
    . "host=ec2-23-21-249-224.compute-1.amazonaws.com;"
    . "dbname=d4v2bpe8au03a9;"
    . "user=dflvrvuwmonmrm;"
    . "port=5432;"
    . "sslmode=require;"
    . "password=g4Qv3ojRfVhovEhytps-SiioU7";
$conn = new PDO($dsn);
if ($conn->connect_error) {
	die("Connection failed: " . $conn->connect_error);
}
else {
	echo "Hello World";
}

	// get results from database
$sql = "SELECT id, name, year FROM cars";
$result = $conn->query($sql);
	// display d$result ata in table;
echo "<h1><b>View All</b></h1>";

echo "<table class='dataTable' border='1' cellpadding='10'>";
echo "<tr> <th>ID</th> <th>Name</th> <th>Year</th> <th></th> <th></th></tr>";

	// loop through results of database query, displaying them in the table
while($row = $result->fetch(PDO::FETCH_ASSOC)) {

		// echo out the contents of each row into a table
	echo $row['id'];
	echo $row['name'];
	echo $row['year']
	?>
	<!-- <tr>
	<td class="id"><?php echo $row['id'] ?></td>
	<td class="name"><?php echo $row['name'] ?></td>
	<td class="year"><?php echo $row['year'] ?></td>
	<td><input type="button" class="btn btn-primary edit" value="Edit"></td>
	<td><input type="button" class="btn btn-danger delete" value="Delete"></td>
	</tr>  -->
	<?php
} 
	// close table
echo "</table>";
$result->closeCursor();
$conn->close();
?>