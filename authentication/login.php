<?php 
include '../components/connection.php'; 
session_start(); 

if (isset($_POST['submit'])) { 
    $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL); 
    $pass = filter_var($_POST['pass'], FILTER_SANITIZE_STRING); 

    // Check if the user exists in the database
    $select_user = $conn->prepare("SELECT * FROM users WHERE email=?");
    $select_user->execute([$email]);

if ($select_user->rowCount() > 0) { 
    $row = $select_user->fetch(PDO::FETCH_ASSOC);

    // Compare the hashed password with the provided password
    if (md5($pass) == $row['password']) { 
        // Login successful, set session variables
        $_SESSION['user_id'] = $row['id']; 
        $_SESSION['user_name'] = $row['name']; 
        $_SESSION['user_email'] = $row['email']; 

        // Redirect to home page
        header("Location: ../home.php"); 
        exit; 
    } else { 
        echo 'Invalid password. Please try again.';
    } 
} else { 
    echo 'No account found with this email. Please register.';
}

} 
?>



<!DOCTYPE html> 
<html lang="en"> 
    <head> 
        <meta charset="UTF-8"> 
        <meta name="viewport" content="width=device-width, initial-scale=1.0"> 
        <title>slayed login</title> 
        <link rel="stylesheet" href="../styles/main.css">
    </head> 
    <body> 
        <div class="main-container"> 
            <section class="form-container"> 
                <div class="title"> 
                    <img src="../img/heart.png" class="logo"> 
                    <h1>login now</h1> 
                </div> 
                <form action="login.php" method="post"> 
                    <div class="input-field"> 
                        <p>your email <sup>*</sup></p> 
                        <input type="email" name="email" required placeholder="enter your email" maxlength="50"
                        oninput="this.value = this.value.replace(/\s/g, '')"> 
                    </div> 
                    <div class="input-field"> 
                        <p>your password <sup>*</sup></p> 
                        <input type="password" name="pass" required placeholder="enter your name" maxlength="50"
                        oninput="this.value = this.value.replace(/\s/g, '')"> 
                    </div>
                    <input type="submit" name="submit" value="login now" class="btn"> 
                    <p>do not have an account? <a href="register.php">register now</a></p>
                </form> 
            </section> 
        </div> 
    </body> 
</html>