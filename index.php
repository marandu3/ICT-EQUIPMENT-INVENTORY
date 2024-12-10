<?php
if(isset($_POST["login"])){ 
    include("connection.php");
    $username=$_POST["username"];
    $password=$_POST["password"];

    $username=stripcslashes($username);
    $password=stripcslashes($password);
    $username=mysqli_real_escape_string($conn, $username);
    $password=mysqli_real_escape_string($conn, $password);

    $sql="select * from admins where username = '$username'";
    $result = mysqli_query($conn, $sql);
    $row=mysqli_fetch_array($result,MYSQLI_ASSOC);

    if($row){
        if(password_verify($password,$row["password"])){
        session_start();
        $_SESSION["username"]=$row["surname"];

        $sessv=$_SESSION["username"];
        if($sessv!="MARANDU"){
        header("location:dashboard.php");
        }else{
            header("location:superadmindashboard.php");
        }
        }else{
            echo'
        <script>
            window.onload = function() {
                document.getElementById("message").style.display = "block";
            };
        </script>
        ';
}
    } else{
        echo'
        <script>
            window.onload = function() {
                document.getElementById("message").textContent="NO ACCOUNT FOUND WITH THE CREDENTIALS";
                document.getElementById("message").style.display = "block";
            };
        </script>
        ';
        header("loacation:index.php");
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LOGIN</title>
    <link rel="icon" type="image/jpg" href="favcon.jpg">
    <link rel="stylesheet" href="css/style.css">
</head>
<style>
    #message{
        background-color: white;
        transform:translateY(99px);
        color:red;
        display:none;
        
    }
</style>
<body>
    <div id="loginpagenav">
        <p>WELCOME TO ICT EQUIPMENT INVENTORY</p>
    </div><br>
    <div id="message">
            INVALID CREDENTIALS.
    </div>
    <div id="formcontainer">
        <form action="index.php" method="post">
            <div>
                <label for="username">Username</label>
                <input type="text" name="username" placeholder="username" required id="username">
            </div><br><br>
            <div>
                <label for="password">Password</label>
                <input type="password" name="password" placeholder="password" required id="password"><br>
            </div><br><br>
            <div class="button">
                <input type="submit" value="Login" name="login" id="login">
            </div>
        </form>
    </div>
    <footer class="footer">
        <p>Copyright&nbsp;&copy; Field Students RAS SINGIDA 2024</p>
    </footer>
</body>
</html>
