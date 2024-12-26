<?php 
    include 'components/connection.php'; 
    session_start(); 
    if (isset($_SESSION['user_id'])) { 
        $user_id=$_SESSION['user_id']; 
    }else{ 
        $user_id=''; 
    }
    if (isset($_POST['logout'])) { 
        session_destroy(); 
        header("location: authentication/login.php");
    }
//adding products in wishlist 
    if (isset($_POST['add_to_wishlist'])) {
        $product_id = $_POST['product_id']; 
        $varify_wishlist = $conn->prepare("SELECT * FROM wishlist WHERE user_id =? AND product_id = ?"); 
        $varify_wishlist->execute([$user_id, $product_id]); 
        $cart_num = $conn->prepare("SELECT * FROM cart WHERE user_id = ? AND product_id = ?"); 
        $cart_num->execute([$user_id, $product_id]); 
        if ($varify_wishlist->rowCount() > 0) { 
            $warning_msg[] = 'product already exist in your wishlist'; 
        }else if ($cart_num->rowCount() > 0) { 
            $warning_msg[] = 'product already exist in your cart'; 
        }else{ 
            $select_price= $conn->prepare("SELECT * FROM products WHERE id=? LIMIT 1"); 
            $select_price->execute([$product_id]); 
            $fetch_price = $select_price->fetch(PDO::FETCH_ASSOC); 
            $insert_wishlist= $conn->prepare("INSERT INTO wishlist(user_id, product_id, price) VALUES(?,?,?)");
            $insert_wishlist->execute([$user_id, $product_id, $fetch_price['price']]); 
            $success_msg[] = 'product added to wishlist successfully';
        }
    }
if (isset($_POST['add_to_cart'])) {
    $product_id = $_POST['product_id'];
    $qty = $_POST['qty'];
    $qty = filter_var($qty, FILTER_SANITIZE_NUMBER_INT);

    if (!is_numeric($qty) || $qty <= 0) {
        $warning_msg[] = 'Invalid quantity';
        return;  // Stop execution if quantity is invalid
    }

    // Check if product already exists in cart
    $varify_cart = $conn->prepare("SELECT COUNT(*) FROM cart WHERE user_id =? AND product_id = ?");
    $varify_cart->execute([$user_id, $product_id]);

    // Limit cart items to 20
    $max_cart_items = $conn->prepare("SELECT COUNT(*) FROM cart WHERE user_id = ?");
    $max_cart_items->execute([$user_id]);

    if ($varify_cart->fetchColumn() > 0) {
        $warning_msg[] = 'Product already exists in your cart';
    } elseif ($max_cart_items->fetchColumn() > 20) {
        $warning_msg[] = 'Cart is full';
    } else {
        // Get product price
        $select_price = $conn->prepare("SELECT price FROM products WHERE id=? LIMIT 1");
        $select_price->execute([$product_id]);
        $fetch_price = $select_price->fetch(PDO::FETCH_ASSOC);

        if ($fetch_price) {
            // Insert product into cart
            $insert_cart = $conn->prepare("INSERT INTO cart(user_id, product_id, price, qty) VALUES(?,?,?,?)");
            $insert_cart->execute([$user_id, $product_id, $fetch_price['price'], $qty]);
            $success_msg[] = 'Product added to cart successfully';
        } else {
            $warning_msg[] = 'Product not found';
        }
    }
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles/main.css">
    <link href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet">
    <title>Slayed - bracelets page</title>
    <style>
        .box-container {
            display: flex;
            flex-wrap: wrap;
            gap: 20px;
            justify-content: center;
        }

        .box {
            border: 1px solid #ddd;
            border-radius: 8px;
            overflow: hidden;
            width: 250px; /* Fixed width for each product box */
            background: #f9f9f9;
            text-align: center;
            padding: 10px;
        }

        .box img {
            width: 100%;
            height: 200px; /* Fixed height */
            object-fit: cover; /* Ensures the image fits nicely within the box */
            border-radius: 4px;
        }
    </style>
</head>
<body>
    <?php include 'components/header.php'; ?>
    <div class="main">
        <div class="banner"> 
                <h1>shop bracelets</h1> 
        </div>
        <div class="title2">
            <a href="home.php">home /</a>
            <span>shop bracelets</span>
        </div> 
        <section class="products"> 
            <div class="box-container"> 
                <?php 
                try{
                    $select_products = $conn->prepare("SELECT * FROM products WHERE product_category='bracelet'"); 
                    $select_products->execute(); 
                }catch(PDOException $e){
                    echo "Error fetching products: " . $e->getMessage();
                }
                if ($select_products->rowCount() > 0) { 
                    while ($fetch_products = $select_products->fetch(PDO::FETCH_ASSOC)) { 
                ?> 
                <form action="" method="post" class="box"> 
                    <img src="<?=$fetch_products['image']; ?>" class="img" alt="<?=$fetch_products['name']; ?>">
                    <div class="button"> 
                        <button type="submit" name="add_to_cart"><i class="bx bx-cart"></i></button> 
                        <button type="submit" name="add_to_wishlist"><i class="bx bx-heart"></i></button> 
                        <!-- <a href="view_page.php?pid=<?php echo $fetch_products['id']; ?>" class="bx bxs-show"></a >  -->
                    
                    </div> 
                    <h3 class="name"><?=$fetch_products['name']; ?></h3>
                    <input type="hidden" name="product_id" value="<?=$fetch_products['id']; ?>"> 
                    <div class="flex"> 
                        <p class="price">price Rs.<?=$fetch_products['price']; ?>/-</p> 
                        <input type="number" name="qty" required min="1" value="1" max="99" maxlength="2" class= "qty"> 
                    </div> 
                    <a href="checkout.php?get_id=<?=$fetch_products ['id']; ?>" class="btn">buy now</a> 
                </form>
                <?php 
                    }
                }else{
                    echo '<p class="empty"> no products added yet</p?';
                }
                ?> 
            </div> 
        </section> 
        </div>
    <?php include 'components/footer.php'; ?>
    

    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>
    <script src="script.js"></script>
    <?php include 'components/alert.php'; ?>
</body>
</html>
