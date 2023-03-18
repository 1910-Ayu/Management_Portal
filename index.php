<?php
    include_once("config/conn.php");
?>

<?php
   session_start();
   if(isset($_SESSION['loggedIn'])){
       header("location:home.php");
       exit;
   }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style/index.css">
    <title>Portal</title>
</head>
<body>

<div class="bg-image">
        <div class="box-container">
            <div class="box">
                <h1>Project Management Portal</h1>
                <div class="btt"> <a href="register.php"><button class="btn">Register</button></a></div>
                <div class="btt"> <a href="login.php"><button class="btn">Login</button></a></div>
            </div>
        </div>
</div>
</body>
</html>