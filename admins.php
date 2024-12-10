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

 if(isset($_POST["addadmin"])){

    header("location:addadmin.php");
 }

 if(isset($_POST["removeadmin"])){
    header("location:removeadmin.php");
 }
 
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ADMINS</title>
    <link rel="stylesheet" href="css/dashboard.css">
</head>
<body>
    

    <div id="buttonscont" >
        <form action="admins.php" method="post">
            <button type="submit" name="addadmin" id="addadmin" class="buttons" style="width:135px;">ADD ADMIN</button><br><br><br>
            <button type="submit" name="removeadmin" id="removeadmin" class="buttons">REMOVE ADMIN</button><br><br><br>
        </form>
    </div>
       
    <footer class="footer">
        <p>Copyright&nbsp;&copy; Field Students RAS SINGIDA 2024</p>
    </footer>
</body>
