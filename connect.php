<?php
	/* Database config */
	$db_host= 'test.cxxjcp9ig1hy.us-east-1.rds.amazonaws.com:3306';
	$db_user= 'test123';
	$db_pass= 'test123456';
	$db_database= 'ShapeWaysDB';
	/* End config */
	$link = @mysqli_connect($db_host,$db_user,$db_pass) or die('Unable to establish a DB connection');
	mysqli_select_db($link, $db_database);
	?>