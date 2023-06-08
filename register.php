<?php

include 'config.php';
if(isset($_POST['submit'])){
    $name = $_POST['name'];
    $name = filter_var($name,FILTER_SANITIZE_STRING);
    $email = $_POST['email'];
    $email = filter_var($email,FILTER_SANITIZE_STRING);
    $pass = md5($_POST['pass']);
    $pass = filter_var($pass,FILTER_SANITIZE_STRING);
    $cpass = md5($_POST['cpass']);
    $cpass = filter_var($cpass,FILTER_SANITIZE_STRING);

    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $select = $conn->prepare("SELECT * FROM `users` WHERE email =?");
    $select->execute([$email]);

    if($select->rowCount() >0){
        $message[] = 'user email already exists!';

    }else{
        if($pass != $cpass){
            $message[] ='confirm password not matched';}
            else{
            $insert = $conn->prepare("INSERT INTO `users`(name, email, password) VALUES(?,?,?)");
         $insert->execute([$name, $email, $pass]);
            header('location:login.php');
        }
    }


    }


?> 
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content ="IE-edge">
    <meta name ="viewpoint" content ="width=device-width, initial-scale = 1.0">
    <link rel= "stylesheet" href="https://fonts.googleapis.com/css?family=Tangerine">
    <link rel= "stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
    <link rel= "stylesheet"  href="https://cdn.jsdelivr.net/npm/swiper@9/swiper-bundle.min.css"/>

    <title>Register </title>
    <link rel="stylesheet" href="css/components.css">
</head>
<body>
<div class= "message">
            <span></span>
            <i class="material-symbols-outlined"  onclick="this.parentElement.remove();"></i>
    <?php
    if(isset($message)){
        foreach($message as $message){
            echo '<div class= "message">
            <span>'.$message.'</span>
            <i class="material-symbols-outlined"  onclick="this.parentElement.remove();"></i>
            </div>';
            
        }
    }
    ?>
<section class="form-container">
<form action=""  enctype="multipart/form-data" method="POST">
            <h3>Register now </h3>
            <input type="text" placeholder =" Name" class="box" name="name" required>
            <input type="email" placeholder =" Email" class="box" name="email" required>
            <input type="password" placeholder =" password" class="box" name="pass" required>
            <input type="password" placeholder="Password" class="box"  name="cpass" required><br>
            
            <input type="submit"  value ="Register now" class="btn" name="submit">
            <p>already have an account? <a href="login.php">Login Now</a></p>
        </form>

</section>
</body>
</html>