# Php-toets
<?php
/*
Hier wordt de config.ini naar voren gehaald.
*/
$database_config = parse_ini_file("config.ini"); 

/*
Hier wordt de debug uitgeprint uit de config.ini
*/
if($database_config['debug']){
	echo "<pre>";
	print_r($database_config);
	echo "</pre>";
}
/*
Hier wordt de try en catch gedaan en wordt de connectie gemaakt
*/
try{
	$conn = new PDO(
		"mysql:host=" . $database_config['host'] . 
		";dbname=". $database_config['database'],
		$database_config['user'], 
		$database_config['password']);

	$conn ->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
}
catch(PDOException $e){
	echo "connection failed: ". $e->getMessage();
}		
?>
