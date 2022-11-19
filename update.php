<!DOCTYPE html>
<html>
<!-- <head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title></title>
</head> -->
<body>
	Update employee by ID
	<form method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>"class="border">
		ID <br> <input type="text" name="id" value="<?php echo $id;?>"> <br>
		Full name <br> <input type="text" name="fullname" value="<?php echo $fullname;?>"> <br>
		Age <br> <input type="text" name="age" value="<?php echo $age?>"> <br>
		Address <br> <input type="text" name="address" value="<?php echo $address?>;"> <br>
		Salary <br> <input type="text" name="salary" value="<?php echo $salary?>;"> <br>
		<input type="submit" name="submit" value="submit">
	</form>

<?php  
		$id = $_POST['id'];
		$fullname = $_POST['fullname'];
		$age = $_POST['age'];
		$address = $_POST['address'];
		$salary = $_POST['salary'];

		function pg_connection_string_from_database_url(){
			extract(parse_str($_ENV['DATABASE_URL']));
			return "user=$user password=$pass host=$host dbname=" .substr($path, 1);
		}
		$db = pg_connect(pg_connection_string_from_database_url());
		if(!$db){
			echo "Error: Unable to open database";
		}else{
			echo "Open database successfully!";
		}
		$sql = "UPDATE COMPANY SET NAME='$fullname', AGE='$age', ADDRESS='$address', SALARY='$salary' WHERE ID='$id'";
		print "<br>$sql<br>";
		$ret = pg_query($db, $sql);
		$cmtuples = pg_affected_rows($ret);
		if(!$ret){
			echo pg_last_error($db);
		}

		echo "$cmtuples employee is Deleted!";
		pg_close($db);
?>
</body>
</html>