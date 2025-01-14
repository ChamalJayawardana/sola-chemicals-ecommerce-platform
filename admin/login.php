<?php

    error_reporting(E_ALL);
    ini_set('display_errors', 1);

    include '../components/connect.php';

    if(isset($_COOKIE['user_id'])){
        $user_id = $_COOKIE['user_id'];
        header('Location:./pages/index.php');
        exit();
    }
    
    if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['submitlogin'])){
        $email = $_POST['email'];
        $email = filter_var($email, FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $pass = $_POST['pass'];
        $pass = filter_var($pass, FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    
        $select_user = $conn->prepare("SELECT * FROM `user` WHERE email = ? LIMIT 1");
        $select_user->execute([$email]);
        $row = $select_user->fetch(PDO::FETCH_ASSOC);
       
        if($select_user->rowCount() > 0 && password_verify($pass, $row['password'])){
            setcookie('user_id', $row['id'], time() + 60*60*24*30, '/');
            header('location:../pages/index.php');
            exit();
        } else {
            $message = "Email or password invalid";
            echo "<script type='text/javascript'>alert('$message');</script>";
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Signin - Admin | Sola Chemicals</title>
        <?php include '../data/meta-admin.php'; ?>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">
       <link rel="stylesheet" href="./assets/css/login.css">
    </head>
    <body>
        <div class="container">
            <div class="header">
                <a href=""><img src="/public/apple-touch-icon.png" alt="sola chemicals logo" width="70px" height="70px"><span></span></a>
                <h1>Sign in to Sola Chemicals</h1>
            </div>
            <form action="" method="post" enctype="multipart/form-data" >
                <div class="form-group">
                    <input type="email" name="email" id="email" required class="inputField" autocomplete="off">
                    <label for="email">Email</label>
                </div>
                <div class="form-group">
                    <input type="password" name="pass" id="password" required class="inputField" autocomplete="off">
                    <label for="password">Password</label>
                </div>
                <button type="submit" class="submitButton" name="submitlogin">Log in</button>
            </form>
        </div>
        <footer class="footer-del">
            <span class="author">
                © 2025 Hash Coders. All rights reserved.
            </span>
        <footer>
        <?php include "../data/bootstrap.php" ?>
    </body>
</html>