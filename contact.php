# Php-toets<!DOCTYPE html>
<?php include 'database.php';?>
<?php include 'header.php';?>

<?php 
session_start();

if($database_config['debug']){
	echo "<pre>";
	print_r($_SESSION);
	echo "</pre>";
}
?>

	<form action="bestelling.php" method="POST">
		<div class="form-group">
			<input placeholder="name" type="name" name="name"><br>
			<input placeholder="email" type="email" name="email"><br>
			<textarea placeholder="text"  type="text" name="text"></textarea><br>
			<input class="btn btn-default" type="submit" value="Versturen">
		</div>
