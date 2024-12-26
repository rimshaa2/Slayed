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
        header("location: authentiction/login.php");
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles/main.css">
    <link href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet">
    <title>Slayed - order page</title>
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
            width: 400px; 
            height: 250px;
            background: #f9f9f9;
            text-align: center;
            padding: 10px;
        }

        .box img {
            width: 60%;
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
                <h1>my order</h1> 
        </div>
        <div class="title2">
            <a href="home.php">home /</a>
            <span>my order</span>
        </div> 
        <section class="orders"> 
            <div class="box-container"> 
                <div class="title"> 
                    <img src="img/heart.png" class="logo"> 
                    <h1>my orders</h1> 
                    <p>View, track, and manage all your orders in one convenient place, with real-time updates on your purchases. </p> 
                    </div> 
                    <div class="box-container"> 
                        <?php $select_orders = $conn->prepare("SELECT * FROM orders WHERE user_id = ? ORDER BY date DESC"); 
                        $select_orders->execute([$user_id]); 
                        if ($select_orders->rowCount()>0) { 
                            while($fetch_order = $select_orders->fetch(PDO::FETCH_ASSOC)){
                                $select_products = $conn->prepare("SELECT * FROM products WHERE id=?"); 
                                $select_products->execute([$fetch_order ['product_id']]); 
                                if ($select_products->rowCount()>0) { 
                                    while($fetch_product=$select_products->fetch(PDO::FETCH_ASSOC)) { 
                                        
                        ?>
                        <div class="box" <?php if($fetch_order['status']=='cancle') {echo 'style="border:2px solid red";';} ?>> 
                            <a href="view_order.php?get_id=<?= $fetch_order ['id']; ?>">
                                <p class="date"><i class="bi bi-calender-fill"></i><span><?=$fetch_order ['date']; ?> 
                                </span></p> 
                                <img src="<?=$fetch_product['image']; ?>" class="img" alt="<?=$fetch_product['name']; ?>"> 
                                <div class="row"> 
                                    <h3 class="name"><?= $fetch_product['name']; ?></h3> 
                                    <p class="price">Price: Rs<?= $fetch_order['price']; ?> x <?= $fetch_order['qty']; ?></p> 
                                    <p class="status" style="color: 
                                        <?php 
                                            if ($fetch_order['status'] == 'delivered') {
                                                echo 'green'; 
                                            } elseif ($fetch_order['status'] == 'canceled') {
                                                echo 'red'; 
                                            } elseif ($fetch_order['status'] == 'in progress') {
                                                echo 'orange'; 
                                            } 
                                        ?>">
                                        <?= ucfirst($fetch_order['status']); ?>
                                    </p>
                                </div>
                            </a> 
                        </div> 
                        <?php 
                                    } 
                                } 
                            } 
                        } else{
                            echo '<p class="empty"> no order yet</p?';
                        }
                        ?>
                    </div>
            </div> 
        </section> 
        </div>
    <?php include 'components/footer.php'; ?>
    

    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>
    <script src="script.js"></script>
    <?php include 'components/alert.php'; ?>
</body>
</html>
