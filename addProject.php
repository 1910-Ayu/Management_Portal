<?php
    include_once("config/conn.php");
?>

<?php
    session_start();
    if($_SESSION['loggedIn']){
        $email = $_SESSION['email'];
       
    }else{
        echo "Something went wrong";
        exit;
    }

?>

<?php

    $q = "SELECT * from man WHERE email_address='$email'";
    $res = mysqli_query($conn,$q);
    $row = mysqli_fetch_array($res);
    $manId = $row['id'];

?>

<?php
    if(isset($_POST['add'])){
        $title = $_POST['title'];
        $req = $_POST['req'];
        $deadline =$_POST['deadline'];
        $date_now = date("Y-m-d");
        $status_input = $_POST['status'];
        $status = 2;
        if($status_input == "Pending"){
            $status = 0;
        }else if($status_input == "Completed"){
            $status = 1;
        }else if($status_input == "Processing"){
            $status = 2;
        }else if($status_input == "Hold"){
            $status = 3;
        }else{
            $status =4;
        }

        $q1 = "INSERT into project(project_title,requirements,manager_id,deadline_date,created_date,status) 
        VALUES('$title','$req','$manId','$deadline','$date_now','$status')";

        $res1 = mysqli_query($conn,$q1);
        if($res1){
            header("location:home.php");
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
    <title>Add Project</title>
</head>
<body>
    <div class="pcon">
        <div class="container">
          <h2> Create Project </h2>
          <form action="addProject.php" method="POST">
                <div class="form-group full-width">
                        <input type="text" name="title" id="fullname" placeholder="Enter Project title"> 
                </div>
                <div class="form-group full-width">
                        <input type="text" name="req" id="req" placeholder="Enter Requirements" >
                </div>
                <div class="form-group full-width">
                        <label for="deadline"> Enter the deadline</label>
                        <input type="date" name="deadline" id="deadline" class="reg_input" style="width:95%;">
                </div>
                <div class="form-group full-width">
                        <select id="status" name="status" class="reg_input">
                             <option value="Pending"> Pending </option>
                             <option value="Completed"> Completed </option>
                             <option value="Processing"> Processing </option>
                             <option value="Hold"> Hold </option>
                             <option value="Terminate"> Terminate </option>
                        </select>
                </div>
                <div class="btnC">
                     <button type="submit" id="add" name="add" class="btn_reg"> Add Project </button>
                </div>
         </form>
    </div>
</div>
</body>
</html>