<?php
session_start(); 
if(!isset($_SESSION["username"])){
    header("location:index.php");
}else{

    include"navbarall.php";
    include"footer.php";
 if(isset($_POST["logout"])){
    session_destroy();
    header("location:index.php");
 }

 if(isset($_POST["issue"])){

    header("location:issuing.php");
 }

 if(isset($_POST["retrieve"])){
    header("location:distribution.php");
 }

 if(isset($_POST["employees"])){
    header("location:employees.php");
   }

   if(isset($_POST["items"])){
    header("location:registereq.php");
   }
 
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>HOME</title>
    <link rel="stylesheet" href="css/dashboard.css">
    <style>
        #em{
            border-radius: 20px;
            padding:10px;
            transform:translateX(-30px);
            background-color: #C72B32;
            color:white;
        }

        #em:hover{
            background-color:  rgb(41, 25, 26);
            cursor: pointer;
        }

        #items{
            border-radius: 20px;
            padding:10px;
            transform:translateX(15px);
            background-color: #C72B32;
            color:white;
        }

        #items:hover{
            background-color:  rgb(41, 25, 26);
            cursor: pointer;
        }

    </style>
</head>
<body>
    

    <div id="buttonscont">
        <form action="superadmindashboard.php" method="post">
            <button type="submit" name="issue" id="issue" class="buttons">EQUIPMENT ISSUING</button><br><br><br>
            <button type="submit" name="retrieve" id="retrieve" class="buttons">VIEW DISTRIBUTION</button><br><br><br>
            <button name="employees" id="em">EMPLOYEES CONFIGURATIONS</button><br><br><br>
            <button name="items" id="items">REGISTER ITEMS</button>
           
        </form>
    </div>
       
   
</body>
