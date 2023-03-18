<?php
    include_once("config/conn.php");
?>


<?php

    session_start();
    if(isset($_SESSION['loggedIn'])){
        header("location:home.php");
        exit;
    }
    if(isset($_POST['login'])){
        $email = $_POST['email'];
        $password = $_POST['password'];

        $q0 = "SELECT * from man WHERE email_address='$email'";
        $res0 = mysqli_query($conn,$q0);
        if(mysqli_num_rows($res0)>0){
            $row0 = mysqli_fetch_array($res0);
            $dbPassword = $row0['password'];

            if(password_verify($password,$dbPassword)){
                session_start();
                $_SESSION['loggedIn']=1;
                $_SESSION['email'] = $email;
               header("location:home.php");
               exit;
            }else{
                echo "Incorrect Passwrord";
                exit;
            }
        }else{
            echo "Email Not Registered";
            exit;
        }
    }

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style/register.css">
    <title>Login</title>
</head>
<body>
<div class="pcon">
    <div class="container">
        <h2> Manager Login form </h2>
    <form action="login.php" method="POST">
        <div class="form-group full-width">
            <input type="email" name="email" id="email" placeholder="Enter Email Address">
        </div>
        <div class="form-group full-width">
            <input type="password" name="password" id="password" placeholder="Enter password">
        </div>
        <div class="btnC">
            <button type="submit" id="login" name="login" class="btn_reg"> Log In Now </button>
        <div class="btnC">
    </form>
    </div>
</div>
</body>
</html>