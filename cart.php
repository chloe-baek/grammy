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
    <title>Grammy's bakery | Cart</title>
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
        <h1>Shopping Cart</h1>
        <?php
                //Add to cart
                if(isset($_POST['add'])){
                    print "<p>Your product was added to the shopping cart.</p>";

                    if(isset($_SESSION['cart'])){
                        $product_array_id = array_column($_SESSION['cart'], "product_id");

                        if(!in_array($_GET['id'], $product_array_id)){
                            $count = count($_SESSION['cart']);
                            $product_array = array(
                                'product_id' => $_GET['id'],
                                'product_name' => $_POST['hidden_name'],
                                'product_price' => $_POST['hidden_price'],
                                'product_quantity' => $_POST['quantity']
                            );
                            $_SESSION['cart'][$count] = $product_array;

                        }else{
                            print "<script>alert(\"You've already added '".$_POST['hidden_name']."' to your cart.\")</script>";
                        }
                    }else{
                        $product_array = array(
                            'product_id' => $_GET['id'],
                            'product_name' => $_POST['hidden_name'],
                            'product_price' => $_POST['hidden_price'],
                            'product_quantity' => $_POST['quantity']
                        );
                        $_SESSION['cart'][0] = $product_array;
                    }
                }

                //remove item
                if(isset($_GET['delete'])){
                    if($_GET['delete'] == "delete"){
                        foreach($_SESSION['cart'] as $keys => $values){
                            if($values['product_id'] == $_GET['id']){
                                unset($_SESSION['cart'][$keys]);
                                print "<script>alert(\"'".$values['product_name']."' has been removed.\")</script>";
                            }
                        }
                    }
                }
                
               if(!empty($_SESSION['cart'])){
                    $total = 0;
            ?>
        <div class="table">
            <table>
                <caption>Order Details</caption>
                <thead>
                    <tr>
                        <th>Item name</th>
                        <th>Quantity</th>
                        <th>Price</th>
                        <th>Total</th>
                        <th>Remove</th>
                    </tr>
                </thead>
                <tbody>
                    <?php        
                foreach($_SESSION['cart'] as $keys => $values){
                    $totalPrice = $values['product_quantity'] * $values['product_price'];
                    $totalPrice = number_format($totalPrice, 2);

                    print "<tr>";
                    print "<td>".$values['product_name']."</td>";
                    print "<td>".$values['product_quantity']."</td>";
                    print "<td>$".$values['product_price']."</td>";
                    print "<td>$$totalPrice</td>";
                    print "<td><a href = \"cart.php?delete=delete&id=".$values['product_id']."\">Remove</a></td>";

                    $total = $total + $totalPrice;
                    print "</tr>";

                    }

                    $total = number_format($total, 2);

                    print "<tfoot>";
                    print "<tr id=\"total\">";
                    print "<th colspan=\"2\">Total</th>";
                    print "<td colspan=\"3\">$ $total</td>";
                    print "</tr>";
                    print "</tfoot>";
                    
            ?>
                </tbody>
            </table>

            <?php
                }else{
                     print "<p>You have no item in your shopping cart.</p>";
                }
            ?>

            <form action="checkout.php" method="post" class="checkout_form">
                <fieldset>
                    <legend>Checkout</legend>
                    <div>
                        <label for="name">Your Name</label>
                        <input type="text" id="name" name="name" maxlength="100" class="carttext">
                    </div>

                    <div>
                        <label for="email">Email Address</label>
                        <input type="text" id="email" name="email" maxlength="100" class="carttext">
                    </div>

                    <input type="hidden" name="products"
                        value="<?php print $values['product_name']." ".$values['product_quantity']."pc(s)"; ?>">
                    <input type="hidden" name="cost" value="<?php print $total; ?>">

                    <input type="submit" value="Checkout" name="checkout">
                </fieldset>
            </form>
        </div>
        <?php include('footer.php');?>