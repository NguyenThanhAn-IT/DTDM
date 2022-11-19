
<!DOCTYPE html>
<html>
<!-- <head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title></title>
</head> -->
<body>
Delete Employee
<form method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" class="border">
	ID <br> <input type="text" name="id" value="<?php echo $id;?>"> <br>
	<input type="submit" name="submit" value="submit">
</form>

<?php
	$id = $_POST['id'];
	function pg_connection_string_from_database_url(){
		extract(parse_str($_ENV['DATABASE_URL']));
		return "user=$user password=$pass host=$host dbname=" .substr($path, 1);
	}
	$db = pg_connect(pg_connection_string_from_database_url());
	if(!$db){
		echo "Error: Unable to open database\n";
	}else{
		echo "Open database successfully\n`";
	}
	$sql = "DELETE FROM COMPANY WHERE ID='$id'";
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