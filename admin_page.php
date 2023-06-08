<?php

@include 'config.php';

session_start();

$admin_id = $_SESSION['admin_id'];
if(!isset($admin_id)){
    header('location:login.php');
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

    <title>Document  </title>
    <link rel="stylesheet" href="css/components.css">
</head>
<body>
<h1>Admin page</h1>
<a href ="logout.php">Logout</a>

</body>
</html>