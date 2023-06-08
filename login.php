<?php
include 'config.php';

session_start();

if(isset($_POST['submit'])){
    
    $email = $_POST['email'];
    $email = filter_var($email,FILTER_SANITIZE_STRING);
    $pass = $_POST['pass'];
    $pass = filter_var($pass,FILTER_SANITIZE_STRING);


    $select=$conn->prepare("SELECT * FROM users WHERE email =? AND password = ? ");

    $select->execute([$email, $pass]);
    $row =$select->fetch(PDO::FETCH_ASSOC);

    if($select->rowCount() >0){
        if($row['user_type']== 'admin'){
           $_SESSION['admin_id'] = $row['id'];
           header('location:admin_page.php');

        }elseif($row['user_type']== 'user'){

            $_SESSION['user_id'] = $row['id'];
            header('location:home.php');
        }else{
            $message[] = 'no user found';
         }
        }else{
            $message[] = 'incorrect eamil or password';

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

    <title>Login  </title>
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
            <h3>Login now </h3>
        
            <input type="email" placeholder =" Email" class="box" name="email" required>
            <input type="password" placeholder =" password" class="box" name="pass" required>
        
            <input type="submit"  value ="Login now" class="btn" name="submit">
            <p>Don't have an account? <a href="register.php">Register Now</a></p>
        </form>

</section>
</body>
</html>