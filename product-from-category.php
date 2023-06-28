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
    <title>Grammy's bakery | Products</title>
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
        <h1>Filter product by</h1>
        <form action="product-from-category.php" method="get">
            <div class="category">
                <label for="type">Type</label>
                <select name="type" id="type" class="sort_select">
                    <option value="" selected>-- please choose one --</option>
                    <option value="bagel">Bagel</option>
                    <option value="sand">Sandwich</option>
                    <option value="spread">Spread</option>
                </select>
            </div>

            <div class="category">
                <label for="vegan">Vegan</label>
                <input type="radio" id="vegan" name="vegan" value="vegan" checked="checked" required>
                <span class="right"><label for="nonv" class="category">Non-vegan</label>
                    <input type="radio" id="nonv" name="vegan" value="nonv"></span>
            </div>

            <input type="submit" value="Filter Product" name="submit" class="button_filter">
            <a href="category.php" class="button_clear">Clear Filter</a>
        </form>

        <ul>
            <?php
            $query = "SELECT id,name,price,thumb_img FROM products ORDER BY price ASC";
            $sql = mysqli_query($connection,$query);

            //submit from Category.php
            if(isset($_GET['submit'])){
                if($_GET['type'] == "bagel" && $_GET['vegan'] == "vegan"){
                    $query = "SELECT id,name,price,thumb_img,type,vegan FROM products WHERE type = 'bagel' AND vegan = 'vegan'";
                    $sql = mysqli_query($connection,$query);

                
                }else if($_GET['type'] == "sand" && $_GET['vegan'] == "vegan"){
                    $query = "SELECT id,name,price,thumb_img,type,vegan FROM products WHERE type = 'sandwich' AND vegan = 'vegan'";
                    $sql = mysqli_query($connection,$query);
                    
                
                }else if($_GET['type'] == "spread" && $_GET['vegan'] == "vegan"){
                    $query = "SELECT id,name,price,thumb_img,type,vegan FROM products WHERE type = 'spreads' AND vegan = 'vegan'";
                    $sql = mysqli_query($connection,$query);
                    
                
                }else if($_GET['type'] == "bagel" && $_GET['vegan'] == "nonv"){
                    $query = "SELECT id,name,price,thumb_img,type,vegan FROM products WHERE type = 'bagel' AND vegan = 'non-vegan'";
                    $sql = mysqli_query($connection,$query);
                    
                    
                }else if($_GET['type'] == "sand" && $_GET['vegan'] == "nonv"){
                    $query = "SELECT id,name,price,thumb_img,type,vegan FROM products WHERE type = 'sandwich' AND vegan = 'non-vegan'";
                    $sql = mysqli_query($connection,$query);
                    
                    
                }else if($_GET['type'] == "spread" && $_GET['vegan'] == "nonv"){
                    $query = "SELECT id,name,price,thumb_img,type,vegan FROM products WHERE type = 'spreads' AND vegan = 'non-vegan'";
                    $sql = mysqli_query($connection,$query);
                    
                    
                }
            }

            
            while($row = mysqli_fetch_array($sql)){
                print '<li><a href ="each.php?id='.$row['id'].'"><img src="thumb/'.$row['thumb_img'].'"alt="'.$row['name'].'">';
                print "<h2>".$row['name']."</h2></a>";
                print "<p>$".$row['price']."</p></li>";
            }
            

        ?>
        </ul>

        <?php include('footer.php');?>