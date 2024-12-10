<?php
session_start(); 
if(!isset($_SESSION["username"])){
    header("location:index.php");
}else{
    include"navbarall.php";
    
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
 
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>HOME</title>
    <link rel="stylesheet" href="css/dashboard.css">
</head>
<body>

    <div id="buttonscont">
        <form action="dashboard.php" method="post">
            <button type="submit" name="issue" id="issue" class="buttons">EQUIPMENT ISSUING</button><br><br><br>
            <button type="submit" name="retrieve" id="retrieve" class="buttons">VIEW DISTRIBUTION</button><br><br><br>
        </form>
    </div>
       
    <footer class="footer">
        <p>Copyright&nbsp;&copy; Field Students RAS SINGIDA 2024</p>
    </footer>
</body>
