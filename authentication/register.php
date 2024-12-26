<?php 
include '../components/connection.php'; 
session_start(); 

if (isset($_POST['submit'])) { 
    $id = unique_id(); 
    $name = filter_var($_POST['name'], FILTER_SANITIZE_STRING); 
    $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL); 
    $pass = filter_var($_POST['pass'], FILTER_SANITIZE_STRING); 
    $cpass = filter_var($_POST['cpass'], FILTER_SANITIZE_STRING); 

    $select_user = $conn->prepare("SELECT * FROM users WHERE email=?"); 
    $select_user->execute([$email]); 

    if ($select_user->rowCount() > 0) { 
        echo 'Email already exists'; 
    } elseif ($pass != $cpass) { 
        echo 'Passwords do not match'; 
    } else { 
        // $hashed_pass = password_hash($pass, PASSWORD_DEFAULT); 
        $hashed_pass = md5($pass);
        $insert_user = $conn->prepare("INSERT INTO users (`name`, `email`, `password`) VALUES (?, ?, ?)"); 

        if ($insert_user->execute([$name, $email, $hashed_pass])) { 
            $select_user = $conn->prepare("SELECT * FROM users WHERE email=?");
            $select_user->execute([$email]);
            if ($select_user->rowCount() > 0) { 
                $row = $select_user->fetch(PDO::FETCH_ASSOC); 
                $_SESSION['user_id'] = $row['id']; 
                $_SESSION['user_name'] = $row['name']; 
                $_SESSION['user_email'] = $row['email']; 
                header("Location: ../home.php"); 
                exit; 
            } 
        } else { 
            echo 'Registration failed'; 
        } 
    } 
}
?>

<style type="text/css">
</style>
<!DOCTYPE html> 
<html lang="en"> 
    <head> 
        <meta charset="UTF-8"> 
        <meta name="viewport" content="width=device-width, initial-scale=1.0"> 
        <title>slayed register now</title> 
        <link rel="stylesheet" href="../styles/main.css">
    </head> 
    <body> 
        <div class="main-container"> 
            <section class="form-container"> 
                <div class="title"> 
                    <img src="../img/heart.png" class="logo"> 
                    <h1>register now</h1> 
                </div> 
                <form action="register.php" method="post"> 
                    <div class="input-field"> 
                        <p>your name <sup>*</sup></p> 
                        <input type="text" name="name" required placeholder="enter your name" maxlength="50"> 
                    </div> 
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
                    <div class="input-field"> 
                        <p>confirm password <sup>*</sup></p> 
                        <input type="password" name="cpass" required placeholder="enter your name" maxlength="50"
                        oninput="this.value = this.value.replace(/\s/g, '')"> 
                    </div> 
                    <input type="submit" name="submit" value="register now" class="btn"> 
                    <p>already have an account? <a href="login.php">login now</a></p>
                </form> 
            </section> 
        </div> 
    </body> 
    </html>