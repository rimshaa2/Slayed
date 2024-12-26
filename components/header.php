<header class="header">
    <a href="home.php" class="logo"><img src="img/logo.png" alt="Slayed Logo"></a>
    <nav class="navbar">
        <a href="home.php">Home</a>
        <div class="dropdown">
            <a href="view_products.php" class="dropdown-btn">Products</a>
            <div class="dropdown-menu">
                <a href="./rings.php">Rings</a>
                <a href="./bracelet.php">Bracelets</a>
                <a href="./earings.php">Earrings</a>
                <a href="./necklace.php">Necklaces</a>
                <a href="./sunglasses.php">Sunglasses</a>
            </div>
        </div>
        <a href="order.php">Orders</a>
        <a href="about.php">About Us</a>
        <a href="contact.php">Contact Us</a>
    </nav>
    <div class="icons">
        <i class="bx bxs-user" id="user-btn" ></i>
        <?php 
            $count_wishlist_items = $conn->prepare("SELECT * FROM wishlist WHERE user_id = ?"); 
            $count_wishlist_items->execute([$user_id]); 
            $total_wishlist_items = $count_wishlist_items->rowCount(); 
        ?>
        <a href="wishlist.php" class="cart-btn"><i class="bx bx-heart"></i><sup><?=$total_wishlist_items ?> 
        </sup></a> 
        <?php 
            $count_cart_items = $conn->prepare("SELECT * FROM cart WHERE user_id = ?"); 
            $count_cart_items->execute([$user_id]); 
            $total_cart_items = $count_cart_items->rowCount(); 
        ?>
        <a href="cart.php" class="cart-btn"><i class="bx bx-cart-download"></i><sup><?=$total_cart_items ?> 
        </sup></a>
        <i class="bx bx-list-plus" id="menu-btn"  style="font-size: 2rem;"></i>
    </div>
    <div class="user-box">
        <p>username: <span><?php echo $_SESSION['user_name']; ?></span></p>
        <p>Email: <span><?php echo $_SESSION['user_email']; ?></span></p>

        <a href="./authentication/login.php" class="btn">Login</a>
        
        <a href="./authentication/register.php" class="btn">Register</a>
        <form method="post">
            <button type="submit" name="logout" class="logout-btn">Log Out</button>
        </form>
    </div>
    <link rel="stylesheet" href="../styles/main.css">'
</header>


