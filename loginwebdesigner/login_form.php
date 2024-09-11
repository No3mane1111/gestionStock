<?php

@include 'config.php';

session_start();

if(isset($_POST['submit'])){

   $name = mysqli_real_escape_string($conn, $_POST['name']);
   $email = mysqli_real_escape_string($conn, $_POST['email']);
   $pass = md5($_POST['password']);
   $cpass = md5($_POST['cpassword']);
   $user_type = $_POST['user_type'];

   $select = " SELECT * FROM user_form WHERE email = '$email' && password = '$pass' ";

   $result = mysqli_query($conn, $select);

   if(mysqli_num_rows($result) > 0){

      $row = mysqli_fetch_array($result);

      if($row['user_type'] == 'admin'){

         $_SESSION['admin_name'] = $row['name'];
         header('location: ../vue/dashboard.php');

      }elseif($row['user_type'] == 'user'){

         $_SESSION['user_name'] = $row['name'];
         header('location: ../vue/dashboard.php');

      }
     
   }else{
      $error[] = 'incorrect email or password!';
   }

};
?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>login form</title>

   <!-- custom css file link  -->
   <link rel="stylesheet" href="style.css">
   <style>
     
 body {
   margin: 0;
   font-family: Arial, sans-serif;
   background:white; /* Background color for the whole page */
   color: blueviolet; /* Default text color */
   padding-top: 70px; /* Ensure space for the fixed logo */
}

.logo-container {
   position: fixed;
   top: 0;
   left: 0;
   width: 100%;
   height: 70px; /* Ensure enough space for the animation */
   overflow: hidden; /* Hide overflow to keep the logo within the header */
   text-align: center;
   /* Optional: Add background color or gradient to enhance visibility */
   /* background: rgba(0, 0, 0, 0.5); */
}

.logo-container img {
   width: 250px; /* Adjust the size of the logo */
   animation: moveHorizontal 4s ease-in-out infinite; /* Add horizontal movement animation */
   transition: transform 0.3s ease, opacity 0.3s ease; /* Transition for scaling and fading */
}

@keyframes moveHorizontal {
   0% {
      transform: translateX(-150px); /* Start position */
   }
   50% {
      transform: translateX(calc(50vw - 150px)); /* Move to far right */
   }
   100% {
      transform: translateX(-150px); /* Return to start position */
   }
}

.logo-container img:hover {
   transform: scale(1.1); /* Slightly enlarge the logo on hover */
   opacity:0.8; /* Add a fade effect on hover */
}

.form-container {
   text-align: center;
   margin: 0 auto; /* Center the form container */
}

.form-container form {
  padding: 30px;
  border-radius: 8px;
  box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2);
  background: rgba(255, 255, 255, 0.141);
    background-color: rgba(255, 255, 255, 0.14);
  text-align: center;
  width: 500px;
  transition: box-shadow 0.3s ease, background-color 0.3s ease;
  margin-top: 250px;
}

.form-container form h3 {
   font-size: 30px;
   text-transform: uppercase;
   margin-bottom: 10px;
   color: white;
}

.form-container form p {
   margin-top: 10px;
   font-size: 20px;
   color: white;
}

.error-msg {
   color: red; /* Style for error messages */
   font-size: 18px;
   margin-bottom: 15px;
   display: block;
}
.container, .form-container {
   min-height: 100vh;
   display: flex;
   align-items: center;
   justify-content: center;
   padding: 20px;
   padding-bottom: 60px;
   background-image: url('photo\ sieges.jpg'); /* Remplacez par le chemin de votre image */
   background-size: cover;
   background-position: center;
   background-repeat: no-repeat;
   position: relative;
   overflow: hidden;
}


   </style>
</head>
<body>
   
<div class="logo-container">
   <!-- Add your logo here -->
   <img src="lamalif2.png" alt="Logo">
</div>

<div class="form-container">

   <form action="" method="post">
      <h3>login now</h3>
      <?php
      if(isset($error)){
         foreach($error as $error){
            echo '<span class="error-msg">'.$error.'</span>';
         };
      };
      ?>
      <input type="email" name="email" required placeholder="enter your email">
      <input type="password" name="password" required placeholder="enter your password">
      <input type="submit" name="submit" value="login now" class="form-btn">
      <p>don't have an account? <a href="register_form.php">register now</a></p>
   </form>

</div>

</body>
</html>

