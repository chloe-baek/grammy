<?php
     $server = "localhost";
     $database = "jewogsax_grammy";
     $user = "jewogsax_grammy";
     $pwd = "D3}F_DxZbbbM";

    $connection = mysqli_connect($server,$user,$pwd,$database);

    if(!$connection){
        die(mysqli_connect_error());
    }

    $id = $_GET['id'];
    $query = "SELECT id,name,price,full_img,description FROM products WHERE id=$id";
    $sql = mysqli_query($connection,$query);
    $row = mysqli_fetch_array($sql);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <title>Grammy's bakery | Product: <?php print $row['name'];?></title>
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
        <div>
            <?php
                print "<h1 class=\"product_h\">".$row['name']."</h1>";
                print '<img src ="fullsize/'.$row['full_img'].'" alt = "'.$row['name'].'" width="1000px" height="1000px" id="full_img">';
                print "<span id=\"description\">".$row['description']."<p> $".$row['price']."</p></span>";
            ?>

            <form action="cart.php?delete=add&id=<?php print $row['id']; ?>" method="post" class="each_product">
                <input type="number" name="quantity" value="1" max="10" class="input_btn">
                <input type="submit" value="Add to Cart" name="add" class="input_btn">
                <input type="hidden" name="hidden_name" value="<?php print $row['name']; ?>">
                <input type="hidden" name="hidden_price" value="<?php print $row['price']; ?>">

            </form>
        </div>
        <?php include('footer.php');?>