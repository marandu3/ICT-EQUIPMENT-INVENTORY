<?php
session_start(); 
if(!isset($_SESSION["username"])){
    header("location:index.php");
    exit();
}else{
    include"navbarall.php";
    include"footer.php";

    if(isset($_POST["remove"])){
        include"connection.php";
        $username=$_POST["username"];
        
        $username=mysqli_real_escape_string($conn,stripcslashes($username));

        $sql="SELECT * FROM admins WHERE username='$username'";
        $result = mysqli_query($conn,$sql);
        $row=mysqli_fetch_array($result,MYSQLI_ASSOC);

        if(!$row){
            echo'
            <script>
                window.alert("NO ADMIN FOUND WITH SUCH CREDENTIALS");
            </script>
            ';
        }else{

            $stmt=$conn->prepare("DELETE FROM admins WHERE username=?");
            $stmt->bind_param("s",$username);

            if($stmt->execute()){
                    echo'
                     <script>
                window.alert("ADMIN DELETED");
                    </script>
                    ';
            }else{
                echo '
                 <script>
                window.alert("NO ADMIN DELETED");
            </script>
                ';
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
    <title>REMOVE ADMIN</title>
    <style>
        @media (max-width:600px){
            #loginpagenav {
        display: block;
        width: 100%;
        text-align: center;
        padding: 10px 0;
        margin-bottom: 90px;
    }

    #navmsg {
        font-size: 1.2em;
        margin-bottom: 10px;
    }

    #logout, #setting, #home {
        display: block;
        width: 100%;
        margin: 3px 0;
        text-align: center;
    }

    #buttonscont {
        flex-direction: column;
        align-items: center;
    }

    #admin {
        width: 100%;
        max-width: 170px;
        margin: 10px 0;
    }

    #formcontainer{
        height:100px;
        padding:25px;
    }

    form{
        text-align: center;
    }

    #login{
        transform: translateX(-0px);
    }
        }
    </style>
</head>
<body>
<div style="color:white; background-color:#205A28; width:90%; text-align:center; border-radius:15px; height:2em; align-content:center; transform:translateY(-30px)">
    ENTER ADMIN USERNAME TO BE DELETED.
</div>

<div id="formcontainer" style="transform:translateY(-1px)">
        <form action="removeadmin.php" method="post">
            <div>
                <label for="username">Username</label>
                <input type="text" name="username" placeholder="username" required id="username">
            </div><br><br>
            
            <div class="button">
                <input type="submit" value="remove" name="remove" id="login">
            </div>
        </form>
    </div>
</body>
</html>