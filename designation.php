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
        
        if (isset($_POST["designationID"]) && isset($_POST["designationname"])) {
            $designationid = mysqli_real_escape_string($conn, stripcslashes($_POST["designationID"]));
            $designationname = mysqli_real_escape_string($conn, stripcslashes($_POST["designationname"]));

            $stmt = $conn->prepare("INSERT INTO `designation` (`designation_id`, `designation_name`) VALUES (?, ?)");
            $stmt->bind_param("ss", $designationid, $designationname);

            if ($stmt->execute()) {
                echo '
                <script>
                window.alert("Designation added");
                document.getElementById("designationform").reset();
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
    <title>DESIGNATIONS</title>
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
        <form method="post" action="designation.php" id="designationform">
            <label for="DID">Designation ID:</label>
            <input type="text" name="designationID" id="DID" placeholder="Designation ID"><br><br>

            <label for="Dname">Designation Name:</label>
            <input type="text" name="designationname" id="Dname" placeholder="Designation Name"><br><br><br>

            <center><button type="submit">REGISTER</button></center>
        </form>
    </div>
</body>
</html>
