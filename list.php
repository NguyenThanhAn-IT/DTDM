<!DOCTYPE html>
<html>
<!-- <head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title></title>
</head> -->
<body>
	List
	<?php
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

		$sql ="SELECT * FROM COMPANY";
		print "<br> $sql<br>";
		$ret = pg_query($db, $sql);
		if(!$ret){
			echo pg_last_error($db);
			exit();
		}else{
			echo "List successfully\n";
		}
		pg_close($db);
	?>

	<table boder="1" cellpadding="2" cellspacing="2">
		<tr> <td>ID</td><td>Full Name</td> <td>Age</td> <td>Address</td><td>Salary</td></tr>
		<?php
			while ($myrows=pg_fetch_assoc($ret)) {
				// code...
				print("<tr><td>%d</td> <td>%s</td> <td>%d</td> <td>%s</td> <td>%f</td></tr>", $myrows['id'], $myrows['name'], $myrows['age'], $myrows['address'], $myrows['salary']);
			}
			pg_close($db);
		?>
	</table>

</body>
</html>