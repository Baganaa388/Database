<?php

include 'config.php';

if(isset($_POST['submit'])){

   $name = $_POST['name'];
   $name = filter_var($name, );
   $email = $_POST['email'];
   $email = filter_var($email, );
   $pass = $_POST['pass'];

   $pass = md5($_POST['pass']);
   $pass = filter_var($pass, );
   $cpass = md5($_POST['cpass']);
   $cpass = filter_var($cpass, );

   #$image = $_FILES['image']['name'];
   #$image_tmp_name = $_FILES['image']['tmp_name'];
   #$image_size = $_FILES['image']['size'];
   #$image_folder = 'uploaded_img/'.$image;

   $select = $conn->prepare("SELECT * FROM `users` WHERE email = ?");
   $select->execute([$email]);

   if($select->rowCount() > 0){
      $message[] = 'Хэрэглэгч бүртгэгдсэн байна!';
   }else{
      if($pass != $cpass){
         $message[] = 'Нууц үг таарахгүй байна!';
      }
      #elseif($image_size > 2000000){
       # $message[] = 'image size is too large!';
      #}
      else{
         $insert = $conn->prepare("INSERT INTO `users`(name, email, password) VALUES(?,?,?)");
         $insert->execute([$name, $email, $cpass]);
         if($insert){
            #move_uploaded_file($image_tmp_name, $image_folder);
            $message[] = 'Амжилттай бүртгэгдлээ!';
            header('location:login.php');
         }
      }
   }

}

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Бүртгүүлэх</title>

   
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

   <link rel="stylesheet" href="css/style.css">

</head>
<body>



<?php
   if(isset($message)){
      foreach($message as $message){
         echo '
         <div class="message">
            <span>'.$message.'</span>
            <i class="fas fa-times" onclick="this.parentElement.remove();"></i>
         </div>
         ';
      }
   }
?>
   
<section class="form-container">

   <form action="" method="post" enctype="multipart/form-data">
      <h3>register now</h3>
      <input type="text" required placeholder="Нэрээ оруулана уу" class="box" name="name">
      <input type="email" required placeholder="email оруулана уу" class="box" name="email">
      <input type="password" required placeholder="Нууц үгээ оруулана уу" class="box" name="pass">
      <input type="password" required placeholder="Нууц үгээ баталгаажуулана уу" class="box" name="cpass">
      <p>бүртгэлтэй бол нэвтэр? <a href="login.php">Нэвтрэх</a></p>
      <input type="submit" value="Бүртгүүлэх" class="btn" name="submit">
   </form>

</section>

</body>
</html>