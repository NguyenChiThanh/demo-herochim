<!DOCTYPE html>
<html>
<head>
	<style type="text/css">
		.hide {
			display: none;
		}
		.row div {
			display: inline;
			float: left;
		}
		.clearfix {
			clear: both;
		}
		.error {
			color: red;
		}
		input[type=text] , input[type=password] , input[type=date] {
			width: 100%;
			padding: 7px 10px;
			margin: 8px 0;
			box-sizing: border-box;
		}
		.btn {
			border: 1px solid;
			color: white;
			padding: 10px 15px;
			text-align: center;
			margin: 4px 2px 5px 5px;
			text-decoration: none;
			display: inline-block;
			font-size: 16px;
			-webkit-transition-duration: 0.4s; /* Safari */
			transition-duration: 0.4s;
			margin-bottom: 5px;
			cursor: pointer;
		}
		.btn-success {
			background-color: #4CAF50;
		}
		.btn-danger {
			background-color: #f44336;
		}
		.btn-default {
			background-color: #555555;
		}
		.btn-primary {
			background-color: #008CBA;
		}
		.btn:hover {
			background-color: white;
			box-shadow: 0 12px 16px 0 rgba(0,0,0,0.24), 0 17px 50px 0 rgba(0,0,0,0.19);
		}
		.btn-success:hover {
			border: 1px solid #4CAF50;
			color: #4CAF50;
		}
		.btn-danger:hover {
			border: 1px solid #f44336;
			color: #f44336;
		}
		.btn-default:hover {
			border: 1px solid #555555;
			color: #555555;
		}
		.btn-primary:hover {
			border: 1px solid #008CBA;
			color: #008CBA;
		}
	</style>
	<script language="javascript" type="text/javascript" src="script/jquery-1.9.1.min.js"></script>
</head>
<body>
	<div class="dataTable"></div>
	<p><input type="button" value="Add a new record" class="openFormAdd btn btn-default"></p>
	<p class="status"></p>
	<p class="error"></p>
	<div class="addRecord hide">
		<table>
			<tr>
				<td><label for="id">ID: </label></td>
				<td><input name="id" id="id" type="text" style="color:red"/></td>
			</tr>
			<tr>
				<td><label for="name">Name: </label></td>
				<td><input name="name" id="name" required type="text" style="color:red"/></td>
			</tr>
			<tr>
				<td><label for="year">Year: </label></td>
				<td><input name="year" id="year" required type="text" style="color:red"/></td>
			</tr>
		</table>
		<input type="submit" name="insert" value="Insert" onclick="addRecord()" class="btn btn-success" />
		<input type="button" name="reset" value="Cancel" class="openFormAdd btn btn-danger" />
	</div>
	<div class="editRecord hide">
		<table>
			<tr>
				<td><label for="id">ID: </label></td>
				<td><input name="id" id="eid" type="text" style="color:red"/></td>
			</tr>
			<tr>
				<td><label for="name">Name: </label></td>
				<td><input name="name" id="ename" required type="text" style="color:red"/></td>
			</tr>
			<tr>
				<td><label for="year">Year: </label></td>
				<td><input name="year" id="eyear" required type="text" style="color:red"/></td>
			</tr>
		</table>
		<input type="submit" name="insert" value="Save" class="editSave btn btn-success"/>
		<input type="button" name="reset" value="Cancel" class="openFormEdit btn btn-danger"/>
	</div>

	<script type="text/javascript">
		function clear() {
			$('#id').val('');
			$('#name').val('');
			$('#year').val('');

			$('#eid').val('');
			$('#ename').val('');
			$('#eyear').val('');

			$('p.status').text('');
			$('p.error').text('');
		}
		function loadAllData(callback) {
			$.ajax({
				url : "https://ec2-23-21-249-224.compute-1.amazonaws.com/view.php",
				type: "GET",
				success: function(data,status,xhr) {
					$('.dataTable').html(data);
					console.log(callback);
					callback();
				}
			});
		}
		function addRecord() {
			var id = $('#id').val();
			var name = $('#name').val();
			var year = $('#year').val();

			if(id == "" || name == "" || year == "") {
				$('.error').html("Please fill out all fields.");
			}
			else {
				var myData = {"id":id, "name":name,"year":year};

				$.ajax({
					url : "new.php",
					type: "POST",
					data : myData,
					success: function(data,status,xhr) {
						$('.status').html(data);
						clear();
						loadAllData(init_events);
					}
				});
			}
		}
		function remove(id) {
			$.ajax({
				url : "delete.php",
				data: {"id":id},
				type: "GET",
				success: function(data,status,xhr) {
					$('.status').html(data);
					clear();
					loadAllData(init_events);
				}
			});		
		}
		function edit(id, name, year) {

			if(id == "" || name == "" || year == "") {
				$('.error').html("Please fill out all fields.");
			}
			else {
				var myData = {"id":id, "name":name,"year":year};

				$.ajax({
					url : "edit.php",
					type: "POST",
					data : myData,
					success: function(data,status,xhr) {
						$('.status').html(data);
						clear();
						loadAllData(init_events);
					}
				});
			}
		}
		function init_events(){
			$('.btn.btn-danger.delete').click(function(){
				var id = $(this).parents('tr').find('td:first').text();
				remove(id);
			});
			$('.btn.btn-primary.edit').click(function(){
				var id = $(this).parents('tr').find('td.id').text();
				var name = $(this).parents('tr').find('td.name').text();
				var year = $(this).parents('tr').find('td.year').text();
				$('.editRecord').fadeIn(700);
				$('#eid').val(id);
				$('#ename').val(name);
				$('	#eyear').val(year);
			});
			$('.editSave').click(function(){
				var id = $('#eid').val();
				var name = $('#ename').val();
				var year = $('#eyear').val();

				edit(id,name,year);
			});
		}
		$(document).ready(function(){
			loadAllData(init_events);
			$('.openFormEdit').click(function(){
				$('.editRecord').fadeToggle(700);
				clear();
			});
			$('.openFormAdd').click(function(){
				$('.addRecord').fadeToggle(700);
				clear();
			});
		});
	</script>

</body>
</html>

