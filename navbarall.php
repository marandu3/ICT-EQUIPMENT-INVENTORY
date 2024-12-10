<?php
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }
     if(isset($_POST["logout"])){
        session_destroy();
        header("location:index.php");
        exit();
        
     }

     if(isset($_POST["setting"])){
        header("location:settings.php");
     }
     if(isset($_POST["home"])){
        if($sessv="MARANDU"){
            header("location:superadmindashboard.php");
        }else{
            header("location:dashboard.php");
        }

     }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/jpg" href="favcon.jpg">
    <link rel="stylesheet" href="css/dashboard.css">
</head>
<body>

<div id="loginpagenav">
    <p id="navmsg">
            <script>
                let currentpage=window.location.pathname.split("/").pop();
                var username="<?php 
                echo $_SESSION["username"];
                ?>";
                if(currentpage!=='superadmindashboard.php'){
                document.getElementById("loginpagenav").textContent="ICT EQUIPMENTS INVENTORY";
                }else{
                    document.getElementById("loginpagenav").textContent="WELCOME ADMIN "+username;
                }
            </script>
    </p> 
        <form action="navbarall.php" method="post">
           
        <button type="submit" name="logout" value="logout" id="logout">LOG OUT</button>
        <button type="submit" name="setting" value="setting" id="logout">SETTINGS</button>
        <button type="submit" name="home" value="home" id="logout">HOME</button>
        </form>
    </div><br><br>
</body>
</html>