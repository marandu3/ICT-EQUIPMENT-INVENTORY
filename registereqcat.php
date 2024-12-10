<?php
session_start();
if(!isset($_SESSION["username"])){
    session_destroy();
    header("location:index.php");
}else{
include("navbarall.php");
include("footer.php");
include("connection.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
        
    if (isset($_POST["equipmentID"]) && isset($_POST["equipmenttype"])) {
        $equipmentid = mysqli_real_escape_string($conn, stripcslashes($_POST["equipmentID"]));
        $equipmenttype = mysqli_real_escape_string($conn, stripcslashes($_POST["equipmenttype"]));

        $stmt = $conn->prepare("INSERT INTO `equipment_category` (`category_id`, `category`) VALUES (?, ?)");
        $stmt->bind_param("ss", $equipmentid, $equipmenttype);

        if ($stmt->execute()) {
            echo '
            <script>
            window.alert("category added");
            document.getElementById("departmentform").reset();
            </script>
            ';
        } else {
            echo "No data added: " . $stmt->error;
        }

        $stmt->close();
    } else {
        echo "Error: Missing form data.";
    }
}

$conn->close();
}


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EQUIPMENT CATEGORY</title>
    <style>
        #formcont {
            background-color: #205A28;
            padding: 20px;
            border-radius: 20px;
            transform: translateY(100px);
        }
        #DID {
            transform: translateX(20px);
        }
        input {
            border-radius: 15px;
            text-align: center;
            padding: 3px;
            width: 210px;
        }
        button {
            border-radius: 10px;
            padding: 7px;
            cursor: pointer;
            background-color: #C72B32;
            color: white;
        }
        button:hover {
            background-color: rgb(41, 25, 26);
        }
    </style>
</head>
<body>
<div id="formcont">
        <form method="post" action="registereqcat.php" id="departmentform">
            <label for="DID">EQUIPMENT ID:</label>
            <input type="text" name="equipmentID" id="DID" placeholder="Equipment ID"><br><br>

            <label for="Dname">EQUIPMENT TYPE:</label>
            <input type="text" name="equipmenttype" id="Dname" placeholder="Equipment type"><br><br><br>

            <center><button type="submit">REGISTER</button></center>
        </form>
    </div>
</body>
</html>