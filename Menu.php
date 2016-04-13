# Php-toets
<!DOCTYPE html>
<?php include 'database.php';?>
<?php include 'header.php';?>
<div class="container">
    <div class="row">
        <?php
        $query = "SELECT * FROM cart_producten";
        $query_result = $conn->query($query);
        $result_array= $query_result->fetchAll(PDO::FETCH_ASSOC);

        if($database_config['debug']){
            echo "<pre>";
            print_r($result_array);
            echo "</pre>";
        }

        foreach ($result_array as $product ) {
        ?>
        <div class = "col-md-4 col-xs-12 productlisting">
            <h2><?php echo $product['name']; ?></h2>
            <?php echo $product['foto'];?>
            <p>€ <?php echo $product['price']; ?></h2>
            <a href = "./cart.php?pid=<?php echo $product['id']; ?>">Add to cart</a>    
        
    </div>
    <?php
}
?>
</div>
</body>
