<?php
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
    <title>Grammy's bakery | Home</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="styles.css">
    <link rel="stylesheet" type="text/css"
        href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

</head>

<body>
    <header>
        <nav>
            <a href="index.php"><img src="logo.png" alt="logo of grammy's bakery" width="520" height="364"
                    id="top_logo"></a>
            <a href="index.php">Home</a>
            <a href="product.php">Products</a>
            <a href="category.php">Category</a>
            <a href="cart.php">Cart</a>
        </nav>
    </header>
    <main>
        <h1>Newest Products</h1>
        <ul>
            <?php
                $query ="SELECT id,name,price,thumb_img FROM products ORDER BY date_added DESC LIMIT 6";
                $sql = mysqli_query($connection,$query);

                while($row = mysqli_fetch_array($sql)){
                    //print_r($row);
                    print '<li><a href="each.php?id='.$row['id'].'"><img src="thumb/'.$row['thumb_img'].'" alt="'.$row['name'].'">';
                    print "<h2>".$row['name']."</h2></a>";
                    print "<p>$".$row['price']."</p></li>";
                }
            ?>
        </ul>

        <a class="all_product_btn" href="product.php">View all products</a>
        <?php include('footer.php');?>