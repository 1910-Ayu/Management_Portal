<?php
    include_once("config/conn.php");

    session_start();
    if($_SESSION['loggedIn']){
        $email = $_SESSION['email'];
       
    }else{
        echo "Something went wrong";
        exit;
    }

    $q = "SELECT * from man WHERE email_address='$email'";
    $res = mysqli_query($conn,$q);
    $row = mysqli_fetch_array($res);
    $manId = $row['id'];

    $q1 = "SELECT * from project WHERE manager_id='$manId'";
    $res1 = mysqli_query($conn,$q1);
   

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <link rel="stylesheet" href="style/home.css">
    <title>Home</title>
</head>
<body>
    <div class="bg-image">
        <div class="container">
            <div class="btnClass">
                <a href="addProject.php">Add Project </a>
                <a href="logout.php">Logout </a>
            </div>

            <div class="gridClass">
                 <h2 class="heading"> List of Projects</h2>
                <div class="wrapper">
        
                     <?php
                      while($row1 = mysqli_fetch_array($res1)){
                     ?>
                     <div class="box">
                        <p> Title:  <span class="data"><?php echo $row1['project_title'];?> </span></p>
                        <p> Requirements:  <span class="data"><?php echo $row1['requirements'];?></span></p>
                        <p> Created on:  <span class="data"><?php echo $row1['created_date'];?></span> </p>
                        <p> Deadline:  <span class="data"><?php echo $row1['deadline_date'];?></span></p>
                     </div>
                    
                     <?php } ?>
                </div>
            </div>
    </div>
 </div>
</body>
</html>