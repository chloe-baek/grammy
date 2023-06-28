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
        <h1>Products</h1>
        <form action="product.php" method="get">
            <div id="sortform">
                <label for="sort" class="sort">Sort products by: </label>
                <select name="sort" id="sort" class="sort_select">
                    <option value="" selected>-- please choose one --</option>
                    <option value="lowhigh">Price | Low to High</option>
                    <option value="highlow">Price | High to Low</option>
                    <option value="atoz">Name | A to Z</option>
                    <option value="ztoa">Name | Z to A</option>
                </select>
            </div>
        </form>
        <ul id="allproducts">
            <?php
                $query = "SELECT id,name,price,thumb_img FROM products ORDER BY price ASC";
                $sql = mysqli_query($connection,$query);

                while($row = mysqli_fetch_array($sql)){
                    print '<li data-name='.$row['name'].' data-price='.$row['price'].'><a href ="each.php?id='.$row['id'].'"><img src="thumb/'.$row['thumb_img'].' "alt="'.$row['name'].'">';
                    print "<h2>".$row['name']."</h2></a>";
                    print "<p>$".$row['price']."</p></li>";
                }
            
            ?>
        </ul>
    </main>

    <footer>

        <div class="row">
            <div class="footer_col">
                <h3>about</h3>
                <ul>
                    <li><a href="#" class="footer_li">Our Story</a></li>
                    <li><a href="#" class="footer_li">Contact Us</a></li>
                    <li><a href="#" class="footer_li">Blog</a></li>
                </ul>
            </div>

            <div class="footer_col">
                <h3>grammy's</h3>
                <ul>
                    <li><a href="#" class="footer_li">FAQs</a></li>
                    <li><a href="#" class="footer_li">Join Our Newsletter</a></li>
                    <li><a href="#" class="footer_li">Privacy Policy</a></li>
                </ul>
            </div>

            <div class="footer_col">
                <h3>follow us</h3>
                <div class="social_media">
                    <ul>
                        <a href="#"><i class="fab fa-facebook-f"></i></a>
                        <a href="#"><i class="fab fa-instagram"></i></a>
                        <a href="#"><i class="fab fa-twitter"></i></a>

                    </ul>
                </div>
            </div>

            <div class="footer_col">
                <form action="#" class="search">
                    <input type="search" placeholder="Search here..." required>
                    <button type="submit">Search</button>
                </form>
            </div>
        </div>
    </footer>
</body>
<script>
function sortProducts(sortTerm) {
    var productsArray = Array.prototype.slice.call(allproducts.querySelectorAll("li"), 0);

    if (sortTerm == "lowhigh") {
        productsArray.sort((a, b) => a.dataset.price - b.dataset.price);
    }
    if (sortTerm == "highlow") {
        productsArray.sort((a, b) => b.dataset.price - a.dataset.price);
    }
    if (sortTerm == "atoz") {
        productsArray.sort((a, b) => a.dataset.name.localeCompare(b.dataset.name));
    }
    if (sortTerm == "ztoa") {
        productsArray.sort((a, b) => b.dataset.name.localeCompare(a.dataset.name));
    }

    productsArray.forEach((products) => {
        allproducts.appendChild(products);
    })
}
sort.addEventListener("change", function() {
    sortProducts(sort.value);
})
</script>

</html>