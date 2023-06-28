<?php
    session_start();

    $server = "localhost";
    $database = "jewogsax_grammy";
    $user = "jewogsax_grammy";
    $pwd = "D3}F_DxZbbbM";

    $connection = mysqli_connect($server,$user,$pwd,$database);

    if(!$connection){
        die(mysqli_connect_error());
    }
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <title>Grammy's bakery | Checkout</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="styles.css">
    <link rel="stylesheet" type="text/css"
        href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
</head>

<body>
    <header>
        <nav>
            <a href="index.php"><img src="logo.png" alt="logo of grammy's bakery" id="top_logo"></a>
            <a href="index.php">Home</a>
            <a href="product.php">Products</a>
            <a href="category.php">Category</a>
            <a href="cart.php">Cart</a>
        </nav>
    </header>
    <main>
        <h1>Checkout</h1>

        <?php

            //sanitize
            $products = mysqli_real_escape_string($connection,$_POST['products']);
            $cost = mysqli_real_escape_string($connection,$_POST['cost']);
            $name = mysqli_real_escape_string($connection,$_POST['name']);
            $email = mysqli_real_escape_string($connection,$_POST['email']);


            $query = "INSERT INTO orders (product,total_cost,name,email) VALUE('$products','$cost','$name','$email')";
            $sql = mysqli_query($connection,$query);

            if($sql){ 
                print "<p>Your order has been place. Someone will email you in 1-2 business days with pickup information.</p>";
                session_destroy();
            }else{
                    print mysqli_error($connection);
            }
 
            

            
       ?>
        <?php include('footer.php');?>