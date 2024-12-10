<?php
session_start(); 
if(!isset($_SESSION["username"])){
    header("location:index.php");
    exit();
} else {
    include"navbarall.php";
    include "footer.php";
    if(isset($_POST["register"])){
        $password = $_POST["password"];
        $confpassword = $_POST["cpassword"];

        if($password != $confpassword){
            echo "<script>window.alert('The passwords do not match');</script>";
        } else {
            include('connection.php');

            $firstname = mysqli_real_escape_string($conn, stripcslashes($_POST["firstname"]));
            $surname = mysqli_real_escape_string($conn, stripcslashes($_POST["surname"]));
            $username = mysqli_real_escape_string($conn, stripcslashes($_POST["username"]));
            $password = mysqli_real_escape_string($conn, stripcslashes($password));

            $password = password_hash($password, PASSWORD_DEFAULT);

            $sql = "SELECT * FROM admins WHERE username = '$username'";
            $result = mysqli_query($conn, $sql);
            $row = mysqli_fetch_array($result, MYSQLI_ASSOC);

            if($row){
                if($username == $row["username"]){
                    echo "<script>window.alert('Admin already exists');</script>";
                    
                    
                    
                }
            } else {
                $stmt = $conn->prepare("INSERT INTO `admins` (`userID`, `firstname`, `surname`, `username`, `password`) VALUES (NULL, ?, ?, ?, ?)");
                $stmt->bind_param("ssss", $firstname, $surname, $username, $password);

                if($stmt->execute()){
                    echo "<script>window.alert('Admin added successfully');</script>";
                } else {
                    echo "No data added: ".$stmt->error;
                }

                $stmt->close();
                $conn->close();
            }
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ADD NEW ADMIN</title>
    <link rel="stylesheet" href="css/reg.css">
</head>
<body>
    <div id="formcontainer">
        <form action="addadmin.php" method="post">
            <div>
                <label for="firstname">Firstname:</label>
                <input type="text" name="firstname" placeholder="Firstname" required id="username">
            </div><br><br>

            <div>
                <label for="Surname">Surname: </label>
                <input type="text" name="surname" placeholder="Surname" required id="username">
            </div><br><br>


            <div>
                <label for="username">Username: </label>
                <input type="text" name="username" placeholder="username" required id="username">
            </div><br><br>
            
            <div>
                <label for="password">Password: </label>
                <input type="password" name="password" placeholder="password" required id="password"><br>
            </div><br><br>

            <div>
                <label for="password">Confirm Password:</label>
                <input type="password" name="cpassword" placeholder="confirm password" required id="cpassword"><br>
            </div><br><br>

            <div class="button">
                <input type="submit" value="register" name="register" id="login">
            </div>
        </form>
    </div>
    
</body>
</html>
