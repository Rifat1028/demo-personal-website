<?php

$insert=false;

if(isset($_POST['name'])){
     define("DB_HOST", "localhost");
     define("DB_USERNAME", "root");
     define("DB_PASSWORD", "");
     define("port", "4000");

      
     
    
 
     $connection = mysqli_connect(DB_HOST.":".port, DB_USERNAME, DB_PASSWORD);

     if(!$connection){
         die("Connection failed due to " . mysqli_connect_error());  
     }
     // echo "Successfully connected to database";  

     $name = $_POST['name'];
     $email = $_POST['email'];
     $opinion = $_POST['opinion'];
     
     // checking name and email validity
    
        if (empty($_POST["name"])) {
          $nameErr = "Name is required";
        } else {
          
          // check if name only contains letters and whitespace
          if (!preg_match("/^[a-zA-Z-' ]*$/",$name)) {
            $nameErr = "Only letters and white space allowed";
          }
        }
      
        if (empty($_POST["email"])) {
          $emailErr = "Email is required";
        } else {
          
          // check if e-mail address is well-formed
          if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $emailErr = "Invalid email format";
          }
        } 

     $sql = "INSERT INTO profile.comment ( `name`, `email`, `opinion`, `date`)
      VALUES ( '$name', '$email', '$opinion', current_timestamp());";

     

     if($connection ->query($sql) == true){
         // echo "Successfully Updated";
         $insert=true;
     }
     else{
         echo "Error: $sql <br> $connection->error";
     }

     $connection->close();
    }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rifat's Websiite</title>
    <link rel="stylesheet" href="index.css">
</head>
<body>
    <img class="background" src="bg.jpg" alt="no identity">
    <div class="container">
        <h1> Welcome to Rifat's Personal website </h1>
        <p> You can tell me your opinion about my demo website.
            Your pointings are highly perfered by me to achieve my goal.
        </p>

        <form action="index.php" method="post">
            <input type="text" name="name" id="name" placeholder="Please enter your name:">
            <input type="email" name="email" id="email" placeholder="Please enter your Email:">
            <textarea name="opinion" id="opinion" cols="30" rows="10" placeholder="Enter your opinion:"></textarea> 
            <button class="button">Submit</button>     
        </form>
        <?php
        if($insert == true){
          echo " <p class='submit_massage'>Thank you for your opinion</p> ";
        }
        ?>
    </div>
    <script src="index.js"></script>
</body>
</html>