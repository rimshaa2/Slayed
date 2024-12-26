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
    <link href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet">
    <title>Slayed</title>
    <link rel="stylesheet" href="styles/main.css">
</head>
<body>
    <?php include 'components/header.php'; ?>
    <div class="main">
    <section class="home-section">
        <div class="slider">
            <div class="slider__slider slide1" style="background-image: url('img/99.jpg')">
                <div class="overlay"></div>
                <div class="slide-detail">
                    <h1>Rings</h1>
                    <p>Discover Timeless Elegance <br>
                    Unlock the beauty of exquisite craftsmanship. Find the perfect ring that tells your story.</p>
                    <a href="view_products.php" class="btn">Shop Now</a>
                </div>
            </div>
            <div class="slider__slider slide2 " style="background-image: url('img/11.jpg')">
                <div class="overlay"></div>
                <div class="slide-detail">
                    <h1>Necklace</h1>
                    <p> The Perfect Statement <br>
                    Discover necklaces that transform your look and express your elegance.</p>
                    <a href="view_products.php" class="btn">Shop Now</a>
                </div>
            </div>
            <div class="slider__slider slide3" style="background-image: url('img/earings.jpg')">
                <div class="overlay"></div>
                <div class="slide-detail">
                    <h1>Earings</h1>
                    <p> Whispers of Elegance <br>
                    Frame your beauty with earrings that dazzle and delight.</p>
                    <a href="view_products.php" class="btn">Shop Now</a>
                </div>
            </div>
            <div class="slider__slider slide4" style="background-image: url('img/sunglasses.jpg')">
                <div class="overlay"></div>
                <div class="slide-detail">
                    <h1>Sunglasses</h1>
                    <p>  Shades of Confidence <br>
                    Step into the sun with bold, stylish sunglasses that define your look.</p>
                    <a href="view_products.php" class="btn">Shop Now</a>
                </div>
            </div>
            <div class="slider__slider slide5" style="background-image: url('img/bracelett.jpg')">
                <div class="overlay"></div>
                <div class="slide-detail">
                    <h1>Bracelet</h1>
                    <p>A Circle of Charm <br>
                    Wrap your wrist in timeless sophistication and unmatched style.</p>
                    <a href="view_products.php" class="btn">Shop Now</a>
                </div>
            </div>
            <div class="left-arrow"><i class="bx bxs-left-arrow"></i></div>
            <div class="right-arrow"><i class="bx bxs-right-arrow"></i></div>
        </div>
    </section>
    <!-- home slider end --> 
    <section class="thumb"> 
        <div class="box-container"> 
            <div class="box"> 
                <img src="img/thumb2.png"> 
                <h3>rings</h3> 
                <p>Stunning rings, timeless designs for every moment.</p> 
                <a href="rings.php">
                    <i class="bx bx-chevron-right"></i>
                </a>
            </div> 
            <div class="box"> 
                <img src="img/thumb1.png"> 
                <h3>earings</h3> 
                <p>Elegant earrings to shine in every moment.</p> 
                <a href="earings.php">
                    <i class="bx bx-chevron-right"></i> 
                </a>
            </div> 
            <div class="box"> 
                <img src="img/thumb0.png"> 
                <h3>bracelet</h3> 
                <p>Chic bracelets that complete your style.</p> 
                <a href="bracelet.php">
                    <i class="bx bx-chevron-right"></i> 
                </a>
            </div> 
            <div class="box"> 
                <img src="img/thumb3.png"> 
                <h3>sunglasses</h3> 
                <p>Trendy sunglasses for a flawless look.</p> 
                <a href="sunglasses.php">
                    <i class="bx bx-chevron-right"></i>
                </a> 
            </div> 
        </div> 
    </section> 
    <section class="container"> 
        <div class="box-container"> 
            <div class="box1"> 
                <img src="img/about-us.png"> 
            </div> 
            <div class="box" > 
                 
                <span>elegent jewelery</span> 
                <h1>save up to 50% off</h1> 
                <p>Get 50% off now on stunning styles—don’t miss this exclusive deal! Offering free delivery as well</p> 
            </div> 
        </div> 
    </section>
    <section class="shop"> 
        <div class="title"> 
            <img src="img/heart.png"> 
            <h1>Trending Products</h1> 
        </div> 
        <div class="row"> 
            <img src="img/canva1.png"> 
            <div class="row-detail"> 
                <img src="img/canva2.png"> 
                <div class="top-footer"> 
                    <h1>A spark of elegance brightens your day.</h1> 
                </div> 
            </div> 
        </div> 
        <div class="box-container"> 
            <div class="box"> 
                <img src="img/card.jpg"> 
                <a href="view_products.php" class="btn">shop now</a> 
            </div>
            <div class="box"> 
                <img src="img/card0.jpg"> 
                <a href="view_products.php" class="btn">shop now</a> 
            </div>
            <div class="box"> 
                <img src="img/card1.jpg"> 
                <a href="view_products.php" class="btn">shop now</a> 
            </div>
            <div class="box"> 
                <img src="img/card2.jpg"> 
                <a href="view_products.php" class="btn">shop now</a> 
            </div>
            <div class="box"> 
                <img src="img/card3.jpg"> 
                <a href="view_products.php" class="btn">shop now</a> 
            </div>
            <div class="box"> 
                <img src="img/card4.jpg"> 
                <a href="view_products.php" class="btn">shop now</a> 
            </div>
        </div> 
    </section> 
    <section class="services"> 
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
    </div>
    <?php include 'components/footer.php'; ?>
    
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>
    <script src="script.js"></script>
    <?php include 'components/alert.php'; ?>
</body>
</html>
