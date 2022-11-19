
<!DOCTYPE html>
<html>
<!-- <head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title></title>
</head> -->
<body>
Create table COMPANY

<?php 
	function pg_connection_string_from_database_url(){
		extract(parse_str($_ENV['DATABASE_URL']));
			return "user=$user password=$pass host=$host dbname=" .substr($path, 1);
	}
	$db = pg_connect(pg_connection_string_from_database_url());
	if(!$db){
		echo "Error: Unable to open database";
	}else{
		echo "Opened database successfully\n";
	}

	$sql = <<<EOF
		CREATE TABLE COMPANY (ID INT PRIMAYR KEY	NOT NULL,
		NAME	TEXT	NOT NULL,
		AGE		INT		NOT NULL,
		ADDRESS	CHAR(50),
		SALARY	REAL);
		EOF;

		$ret = pg_query($db, $sql);
		if(!$ret){
			echo pg_last_error();
		}else{
			echo "Table create successfully\n";
		}
		pg_close();

?>
</body>
</html>