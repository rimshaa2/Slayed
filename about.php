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
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles/main.css">
    <link href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet">
    <title>Slayed - about us page</title>
</head>
<body>
    <?php include 'components/header.php'; ?>
    <div class="main"> 
        <div class="banner"> 
            <h1>about us</h1> 
        </div> 
        <div class="title2"> 
            <a href="home.php">home /</a>
            <span>about</span> 
        </div> 
        <div class="about-category"> 
            <div class="box"> 
                <img src="img/earingsbg.png"> 
                <div class="detail"> 
                    <span>jewelery</span> 
                    <h1>lemon green</h1> 
                    <a href="view_products.php" class="btn">shop now</a> 
                </div> 
            </div> 
            <div class="box"> 
                <img src="img/sgbg.png"> 
                <div class="detail"> 
                    <span>jewelery</span> 
                    <h1>lemon </h1> 
                    <a href="view_products.php" class="btn">shop now</a> 
                </div> 
            </div> 
            <div class="box"> 
                <img src="img/necklace4bg.png"> 
                <div class="detail"> 
                    <span>jewelery</span> 
                    <h1>jewelery</h1> 
                    <a href="view_products.php" class="btn">shop now</a> 
                </div> 
            </div> 
        </div> 
        <section class="services"> 
        <div class="title"> 
            <img src="img/heart.png" class="logo"> 
            <h1>why choose us</h1> 
            <p>Unmatched Quality: Every product is crafted with care, ensuring premium materials and flawless designs.<br>
                Wide Selection: From timeless classics to trendy must-haves, find everything you need in one place.<br>
                Fast & Reliable Shipping: Enjoy swift delivery with tracking updates every step of the way.<br>
                Customer-Centric Service: Your satisfaction is our priority—experience top-notch support whenever you need it.<br>
                Affordable Luxury: Luxury doesn’t have to break the bank—discover exceptional value for your money.<br>
                Sustainable Choices: We are committed to eco-friendly practices, making your purchase guilt-free. </p> 
        </div> 
        <div class="box-container"> 
            <div class="box"> 
                <img src="img/icon2.png"> 
                <div class="detail"> 
                    <h3>great savings</h3> 
                    <p>save big every order</p> 
                </div> 
            </div> 
            <div class="box"> 
                <img src="img/icon1.png"> 
                <div class="detail"> 
                    <h3>24*7 support</h3> 
                    <p>one-on-one support</p> 
                </div> 
            </div>
            <div class="box"> 
                <img src="img/icon0.png"> 
                <div class="detail"> 
                    <h3>gift vouchers</h3> 
                    <p>vouchers on every festivals</p> 
                </div> 
            </div>
            <div class="box"> 
                <img src="img/icon.png"> 
                <div class="detail"> 
                    <h3>worldwide delivery</h3> 
                    <p>dropship worldwide</p> 
                </div> 
            </div>
        </div> 
    </section> 
    <div class="about"> 
        <div class="row"> 
            <div class="img-box"> 
                <img src="img/3.png" alt="Showroom Image"> 
            </div>
            <div class="detail"> 
                <h1>Visit our beautiful showroom!</h1> 
                <p>Our showroom is an expression of what we love doing...</p> 
                <a href="view_products.php" class="btn">Shop Now</a> 
            </div>
        </div> 
    </div>
    <div class="testimonial-container"> 
        <div class="title"> 
            <img src="img/heart.png" class="logo"> 
            <h1>what people say about us</h1>
            <p>hear what some of our valuable customers say about our products</p>   
        </div> 
            <div class="container" > 
                <div class="testimonial-item active"> 
                    <img src="img/01.jpg"> 
                    <h1>sara smith</h1> 
                    <p>I absolutely love the products! The quality is outstanding, and the customer service was incredibly helpful. I’ve been a loyal customer for years, and I’ll continue to shop here for all my jewelry needs!</p> 
                </div>
                <div class="testimonial-item active"> 
                    <img src="img/02.jpg"> 
                    <h1>john smith</h1> 
                    <p>This shop never disappoints! I recently purchased a necklace and some earrings, and they’re even more beautiful in person. Fast shipping and great packaging. Highly recommend to anyone looking for unique and high-quality accessories!</p> 
                </div>
                <div class="testimonial-item active"> 
                    <img src="img/03.jpg"> 
                    <h1>selena haider</h1> 
                    <p>Fantastic experience! The variety of designs and the attention to detail in each piece is amazing. I’m thrilled with my bracelet and will definitely be returning for more items in the future</p> 
                </div>
                <div class="left-arrow" onclick="nextSlide()"><i class="bx bxs-left-arrow-alt"></i></div> 
                <div class="right-arrow" onclick="prevSlide()"><i class="bx bxs-right-arrow-alt"></i></div> 
            </div>
    </div>

    </div>
    <?php include 'components/footer.php'; ?>
    

    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>
    <script src="script.js"></script>
    <?php include 'components/alert.php'; ?>
</body>
</html>
