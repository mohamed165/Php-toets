# Php-toets<!DOCTYPE html>
<?php include 'database.php';?>
<?php
// MAKE A NEW CUSTOMER
try{
	$stmt = $conn->prepare("INSERT INTO cart_klant (name, email) VALUES (?, ?)");
	$stmt->bindParam(1, $name);
	$stmt->bindParam(2, $email);

	// insert one row
	$name = $_POST['name'];
	$email = $_POST['email'];
	$stmt->execute();
	$lastId = $conn->lastInsertId();
}

catch(PDOException $ex){
	if($database_config['debug']){
		$error = $ex->getMessage();
		echo $error;
	}
	}
/*

*/
try{
	$stmt = $conn->prepare("INSERT INTO contact (name, email, text) VALUES (?, ?, ?)");
	$stmt->bindParam(1, $name);
	$stmt->bindParam(2, $email);
	$stmt->bindParam(3, $text);

	// insert one row
	$name = $_POST['name'];
	$email = $_POST['email'];
	$text = $_POST['text'];
	$stmt->execute();
	$lastId = $conn->lastInsertId();
	echo "U vraag is verstuurd";
}	
catch(PDOException $ex){
	if($database_config['debug']){
		$error = $ex->getMessage();
		echo $error;
	}
	}

session_start();
$total_order = 0;
if(isset($_SESSION['cart_content'])){
$cart_array = explode( ',', $_SESSION['cart_content']);

foreach($cart_array as $item){
	$query = "SELECT * FROM cart_producten WHERE id ='" . $item . "' ";
	$query_result=$conn->query($query);
	$product = $query_result->fetch(PDO::FETCH_ASSOC);
	$total_order+= $product['price'];
}
}
try{
	$stmt = $conn->prepare("INSERT INTO cart_bestellingen (totaal_prijs, klant_id) VALUES (?, ?)");
	$stmt->bindParam(1, $totaal_prijs);
	$stmt->bindParam(2, $klant_id);

	$totaal_prijs = $total_order;
	$klant_id = $lastId;
	$stmt->execute();
	$lastOrderId = $conn->lastInsertId();

}catch(PDOException $ex){
	if($database_config['debug']){
		$error = $ex->getMessage();
		echo $error;
	}
}

if(isset($_SESSION['cart_content'])){
	$cart_array = explode(',', $_SESSION['cart_content']);

	foreach($cart_array as $item){
		$query = "SELECT * FROM cart_producten WHERE id='" . $item . "' ";
		$query_result = $conn->query($query);
		$product = $query_result->fetch(PDO::FETCH_ASSOC);

		try{
	$stmt = $conn->prepare("INSERT INTO cart_bestelling_line (product_id, bestelling_id, aantal) VALUES (?, ?, ?)");
	$stmt->bindParam(1, $product_id);
	$stmt->bindParam(2, $bestelling_id);
	$stmt->bindParam(3, $aantal);

	$product_id = $item;
	$bestelling_id = $lastOrderId;
	$aantal = 1;

	$stmt->execute();

}catch(PDOException $ex){
	if($database_config['debug']){
		$error = $ex->getMessage();
		echo $error;
	}
	}
	}
}
?>
