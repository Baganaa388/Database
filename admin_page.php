<?php

include 'config.php';

session_start();

$admin_id = $_SESSION['admin_id'];

if(!isset($admin_id)){
   header('location:login.php');
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">

   <title>Админ</title>

   
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

   
   <link rel="stylesheet" href="css/style.css">

</head>
<body>
   <h3>Customers</h3>
   <h3>Dashboard</h3>
   <h3>Products</h3>
   <h3>Ordes</h3>
<h1 class="title"> <span>Админ</span> profile </h1>

<section class="profile-container">

   <?php
      $select_profile = $conn->prepare("SELECT * FROM `users` WHERE id = ?");
      $select_profile->execute([$admin_id]);
      $fetch_profile = $select_profile->fetch(PDO::FETCH_ASSOC);
   ?>

   <div class="profile">
      <img src="uploaded_img/<?= $fetch_profile['image']; ?>" alt="">
      <h3><?= $fetch_profile['name']; ?></h3>
      <a href="admin_profile_update.php" class="btn">шинэчлэх</a>
      <a href="logout.php" class="delete-btn">Гарах</a>
      <div class="flex-btn">
         <a href="login.php" class="option-btn">Нэвтрэх</a>
         <a href="register.php" class="option-btn">Бүртгэл</a>
      </div>
   </div>

</section>

</body>
</html>