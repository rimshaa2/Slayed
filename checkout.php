<?php 
include 'components/connection.php'; 
session_start(); 

$user_id = isset($_SESSION['user_id']) ? $_SESSION['user_id'] : '';

if (isset($_POST['logout'])) { 
    session_destroy(); 
    header("location: authentication/login.php");
    exit;
}

if (isset($_POST['place_order'])) { 
    $name = filter_var($_POST['name'], FILTER_SANITIZE_STRING); 
    $number = filter_var($_POST['number'], FILTER_SANITIZE_STRING); 
    $email = filter_var($_POST['email'], FILTER_SANITIZE_STRING);
    $address = filter_var($_POST['flat'] . ', ' . $_POST['street'] . ', ' . $_POST['city'] . ', ' . $_POST['country'] . ', ' . $_POST['pincode'], FILTER_SANITIZE_STRING); 
    $address_type = filter_var($_POST['address_type'], FILTER_SANITIZE_STRING); 
    $method = filter_var($_POST['method'], FILTER_SANITIZE_STRING); 

    if (isset($_GET['get_id'])) { 
        // Process single product order
        $get_product = $conn->prepare("SELECT * FROM products WHERE id = ? LIMIT 1"); 
        $get_product->execute([$_GET['get_id']]);

        if ($get_product->rowCount() > 0) { 
            $fetch_p = $get_product->fetch(PDO::FETCH_ASSOC);
            try {
                $insert_order = $conn->prepare("INSERT INTO orders (id, user_id, name, number, email, address, address_type, method, product_id, price, qty,status) VALUES(?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?,'in progress')");
                $insert_order->execute([unique_id(), $user_id, $name, $number, $email, $address, $address_type, $method, $f_cart['product_id'], $f_cart['price'], $f_cart['qty']]);
                header('location: order.php');
                exit;
            } catch (PDOException $e) {
                echo "Error: " . $e->getMessage();
            }
        } else {
            $warning_msg[] = 'Something went wrong';
        }
    } else {
        // Process cart order
        $varify_cart = $conn->prepare("SELECT * FROM cart WHERE user_id = ?");
        $varify_cart->execute([$user_id]);

        if ($varify_cart->rowCount() > 0) { 
            while ($f_cart = $varify_cart->fetch(PDO::FETCH_ASSOC)) { 
                try {
                    $insert_order = $conn->prepare("INSERT INTO orders (id, user_id, name, number, email, address, address_type, method, product_id, price, qty,status) VALUES(?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?,'in progress')");
                    $insert_order->execute([unique_id(), $user_id, $name, $number, $email, $address, $address_type, $method, $f_cart['product_id'], $f_cart['price'], $f_cart['qty']]);
                } catch (PDOException $e) {
                    echo "Error: " . $e->getMessage();
                }
            }
            // Clear cart after placing order
            $delete_cart_id = $conn->prepare("DELETE FROM cart WHERE user_id = ?");
            $delete_cart_id->execute([$user_id]);
            header('location: order.php');
            exit;
        } else { 
            $warning_msg[] = 'Something went wrong';
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
    <title>Slayed - checkout page</title>
    <style>
        .flex .img {
            width: 150px; /* Set a consistent width */
            height: 150px; /* Set a consistent height */
            object-fit: cover; /* Ensure the image is cropped proportionally to fit */
            border-radius: 5px; /* Optional: add rounded corners */
            display: block; /* Ensure consistent alignment */
        }

    </style>
</head>
<body>
    <?php include 'components/header.php'; ?>
    <div class="main">
        <div class="banner"> 
                <h1>checkout summary</h1> 
        </div>
        <div class="title2">
            <a href="home.php">home /</a>
            <span>checkout</span>
        </div> 
        <section class="checkout"> 
            <div class="title"> 
                <img src="img/heart.png" class="logo"> 
                <h1>checkout summary</h1> 
            </div>
                <div class="row"> 
                    <form method="post"> 
                        <h3>billing details</h3> 
                        <div class="flex"> 
                            <div class="box"> 
                                <div class="input-field"> 
                                    <p>your name <span>*</span></p> 
                                    <input type="text" name="name" required maxlength="50" placeholder="Enter Your name" class="input"> 
                                </div>
                                <div class="input-field"> 
                                    <p>your number <span>*</span></p> 
                                    <input type="number" name="number" required maxlength="10" placeholder="Enter Your number" class="input"> 
                                </div> 
                                <div class="input-field"> 
                                    <p>your email <span>*</span></p> 
                                    <input type="email" name="email" required maxlength="50" placeholder="Enter Your email" class="input"> 
                                </div>  
                                <div class="input-field"> 
                                    <p>payment method <span>*</span></p> 
                                    <select name="method" class="input"> 
                                        <option value="cash on delivery">cash on delivery</option> 
                                        <option value="credit or debit card">credit or debit card</option> 
                                        <option value="easypaisa">easypaisa</option> 
                                        <option value="jazzcash">jazzcash</option> 
                                    </select>
                                </div> 
                                <div class="input-field">
                                    <p>address type<span>*</span></p>
                                    <select name="address_type" class="input">
                                        <option value="home">home</option>
                                        <option value="office">office</option>
                                    </select>
                                </div>
                            </div>
                            <div class="box"> 
                                <div class="input-field"> 
                                    <p>address line 01 <span>*</span></p> 
                                    <input type="text" name="flat" required maxlength="50" placeholder="e.g flat & building number" class="input"> 
                                </div> 
                                <div class="input-field"> 
                                    <p>address line 02 <span>*</span></p> 
                                    <input type="text" name="street" required maxlength="50" placeholder="e.g street name" class="input"> 
                                </div> 
                                <div class="input-field"> 
                                    <p>city name <span>*</span></p> 
                                    <input type="text" name="city" required maxlength="50" placeholder="Enter your city name" class="input"> 
                                </div> 
                                <div class="input-field"> 
                                    <p>country name <span>*</span></p> 
                                    <input type="text" name="country" required maxlength="50" placeholder=" Enter your city name" class="input"> 
                                </div> 
                                <div class="input-field"> 
                                    <p>pincode <span>*</span></p> 
                                    <input type="text" name="pincode" required maxlength="6" placeholder=" 110022" min="0" max="999999" class="input "> 
                                </div> 
                            </div> 
                        </div>
                        <button type="submit" name="place_order" class="btn">place order</button> 
                    </form>
                    <div class="summary"> 
                        <h3>my bag</h3> 
                        <div class="box-container"> 
                            <?php  
                                $grand_total=0; 
                                if (isset($_GET['get_id'])) { 
                                    $select_get = $conn->prepare("SELECT * FROM products WHERE id=?"); 
                                    $select_get->execute([$_GET['get_id']]); 
                                    while($fetch_get = $select_get->fetch(PDO::FETCH_ASSOC)) { 
                                        $sub_total = $fetch_get['price']; 
                                        $grand_total+=$sub_total; 
                            ?>
                            <div class="flex"> 
                                <img src="<?=$fetch_products['image']; ?>" class="img" alt="<?=$fetch_products['name']; ?>">
                                <div>
                                    <h3 class="name"><?=$fetch_get['name']; ?></h3> 
                                    <p class="price"><?=$fetch_get['price']; ?>/-</p> 
                                </div> 
                            </div>
                            <?php
                                    }
                                }else{ 
                                    $select_cart = $conn->prepare("SELECT * FROM cart WHERE user_id=?"); 
                                    $select_cart->execute([$user_id]); 
                                    if ($select_cart->rowCount()>0) { 
                                        while($fetch_cart = $select_cart->fetch(PDO::FETCH_ASSOC)) { 
                                            $select_products=$conn->prepare("SELECT * FROM products WHERE id= ?"); 
                                            $select_products->execute([$fetch_cart['product_id']]); 
                                            $fetch_product = $select_products->fetch(PDO::FETCH_ASSOC); 
                                            $sub_total= ($fetch_cart['qty'] * $fetch_product['price']); 
                                            $grand_total += $sub_total; 
                            ?>
                            <div class="flex"> 
                                <img src="<?=$fetch_product['image']; ?>" class="img" alt="<?=$fetch_product['name']; ?>">
                                <div> 
                                    <h3 class="name"><?=$fetch_product['name']; ?></h3> 
                                    <p class="price"><?=$fetch_product['price']; ?> X <?=$fetch_cart['qty']; ?> 
                                    </p> 
                                </div> 
                            </div> 
                            <?php
                                        }
                                    }else{
                                        echo '<p class="empty"> your cart is empty</p?';
                                    }
                                }
                            ?>
                        </div>
                        <div class="grand-total"><span>total amount payable: </span>Rs.<?= $grand_total ?>/-</div>
                    </div>
        </div>  
        </section>
    <?php include 'components/footer.php'; ?>
    
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>
    <script src="script.js"></script>
    <?php include 'components/alert.php'; ?>
</body>
</html>
