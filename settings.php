<?php
session_start();
if(!isset($_SESSION["username"])){
    session_destroy();
    header("location:index.php");
}else{
include("navbarall.php");
include("footer.php");

if(isset($_POST["admins"])){
 header("location:admins.php");
}

if(isset($_POST["department"])){
    header("location:department.php");
}

if(isset($_POST["items"])){
    header("location:registereqcat.php") ;
}

if(isset($_POST["designation"])){
    header("location:designation.php") ;
}
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SETTINGS</title>
    <style>
        button{
            background-color:#C72B32;
            padding:10px;
            border-radius:15px;
            color:white;
            
        }
        button:hover{
            background-color: rgb(41, 25, 26);
            cursor: pointer; 
        }

        #items{
            transform:translateX(20px);
        }


    </style>
</head>
<body>
    <form method="post" action="settings.php">
        <center><button name="admins">ADMINS</button><br><br><br></center>
        <button name="department">DEPARTMENT CONFIGURATIONS</button><br><br><br>
        <button id="items" name="items">EQUIPMENT CATEGORY </button><br><br><br>
        <button name="designation">DESIGNATION CONFIGURATIONS</button><br><br><br>
    </form>
</body>
</html>