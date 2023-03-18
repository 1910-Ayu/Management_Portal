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
<?php

    if(isset($_POST['register'])){
        $fullname = $_POST['fullname'];
        $contact1 = $_POST['contact1'];
        $contact2 = $_POST['contact2'];
        $email = $_POST['email'];
        $domain = $_POST['domain'];
        $password = $_POST['password'];
        $cpassword = $_POST['cpassword'];
        $hashed_password = password_hash($password,PASSWORD_DEFAULT);
        $date_now = date("Y-m-d");
        $username = $email;
        $status = 1;

        $q = "SELECT * from man WHERE email_address='$email'";
        $res = mysqli_query($conn,$q);
        if(mysqli_num_rows($res)>0){
           echo "Email Already Registered....";
           exit;
        }
        if(empty($fullname) || empty($email) || empty($contact1) || empty($contact2)||
        empty($password) || empty($cpassword)){
           echo "Some fields are empty";
            exit;
        }
        if($password != $cpassword){
           echo "Password and Confirm Password don't match";
            exit;
        }
        $uppercase = preg_match('@[A-Z]@', $password);
        $lowercase = preg_match('@[a-z]@', $password);
        $number    = preg_match('@[0-9]@', $password);
        $specialChars = preg_match('@[^\w]@', $password);
        
        if(!$uppercase || !$lowercase || !$number || !$specialChars || strlen($password) < 8) {
            echo 'Password should be at least 8 characters in length and should include at least one upper case letter, one number, and one special character.'; 
            exit;
        }

        $q0 = "SELECT * from domain WHERE domain_title='$domain'";
        $res0 = mysqli_query($conn,$q0);
        $row = mysqli_fetch_array($res0);
        $domainId = $row['id'];

        $q1 = "INSERT into man(fullname,primary_contact,secondary_contact,email_address,
        domain_id,username,password,status,created_date) VALUES('$fullname','$contact1',
        '$contact2','$email','$domainId','$username','$hashed_password','$status','$date_now')";

        $res1 = mysqli_query($conn,$q1);
        if($res1){
            header("location:login.php");
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
    <title>Registration</title>
</head>
<body>
    <div class="pcon">
    <div class="container">
        <div class="heading">
        <h2> Manager Registration form </h2>
</div>
        <form action="register.php" method="POST">
        <div class="form-group full-width">
            <input type="text" name="fullname" id="fullname" placeholder="Enter your Full Name">
        </div>
        <div class="form-group full-width">
            <input type="tel" name="contact1" id="contact1" 
            pattern="[0-9]{3}-[0-9]{3}-[0-9]{4}" placeholder="Enter Number in 123-456-7890">
        </div>
        <div class="form-group full-width">
            <input type="tel" name="contact2" id="contact2" 
            pattern="[0-9]{3}-[0-9]{3}-[0-9]{4}" placeholder="Enter Number in 123-456-7890">
        </div>
        <div class="form-group full-width">
            <input type="email" name="email" id="email" placeholder="Enter email Address">
        </div>
        <div class="form-group full-width">
           <label for="domain">Select the domain </label>
            <select name="domain" id="domain" class="reg_input">
                <?php
                $sql = "SELECT * from domain";
                $res = mysqli_query($conn,$sql);
                while($row = mysqli_fetch_array($res)){
                    if($row['status']){?>

                <option value= "<?php echo $row['domain_title']?>"> <?php echo $row['domain_title'] ?> </option>

                <?php }} ?>
            </select>
        </div>
         <div class="form-group full-width">
            <input type="password" id="password" name="password" placeholder="Enter password">
         </div>
         <div class="form-group full-width">
            <input type="password" id="cpassword" name="cpassword" placeholder="Enter password again">
        </div>
        <div class="btnC">
            <button type="submit" id="register" name="register" class="btn_reg">Register</button>
        </div>
       </form>
    </div>
 </div>
</body>
</html>