<?php
session_start();
if(!isset($_SESSION["username"])){
    session_destroy();
    header("location:index.php");
    exit();
} else {
    include("navbarall.php");
    include ("footer.php");
    include "connection.php";

    
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        
        if (isset($_POST["departmentID"]) && isset($_POST["departmentname"])) {
            $departmentid = mysqli_real_escape_string($conn, stripcslashes($_POST["departmentID"]));
            $departmentname = mysqli_real_escape_string($conn, stripcslashes($_POST["departmentname"]));

            $stmt = $conn->prepare("INSERT INTO `department` (`department_id`, `department_name`) VALUES (?, ?)");
            $stmt->bind_param("ss", $departmentid, $departmentname);

            if ($stmt->execute()) {
                echo '
                <script>
                window.alert("Department added");
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
    <title>DEPARTMENTS</title>
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
        <form method="post" action="department.php" id="departmentform">
            <label for="DID">Department ID:</label>
            <input type="text" name="departmentID" id="DID" placeholder="Department ID"><br><br>

            <label for="Dname">Department Name:</label>
            <input type="text" name="departmentname" id="Dname" placeholder="Department Name"><br><br><br>

            <center><button type="submit">REGISTER</button></center>
        </form>
    </div>
</body>
</html>
