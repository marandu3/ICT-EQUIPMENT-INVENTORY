<?php
session_start();
if(!isset($_SESSION["username"])){
    session_destroy();
    header("location:index.php");
}else{
include("navbarall.php");
include("connection.php");
include("footer.php");



if(isset($_POST["submit"])){

        $emplid=mysqli_real_escape_string($conn,stripcslashes($_POST["eID"]));
        $firstname=mysqli_real_escape_string($conn,stripcslashes($_POST["fname"]));
        $surname=mysqli_real_escape_string($conn,stripcslashes($_POST["sname"]));
        $departmentid=mysqli_real_escape_string($conn,stripcslashes($_POST["depID"]));
        $designationid=mysqli_real_escape_string($conn,stripcslashes($_POST["desID"]));

        $stmt=$conn->prepare("INSERT INTO `employee` (`employee_id`,`f_name`,`s_name`,`department_id`,`designation_id`) VALUES (?,?,?,?,?)");
        $stmt->bind_param("sssss",$emplid,$firstname,$surname,$departmentid,$designationid);

        if($stmt->execute()){
                echo'
                <script>
            window.onload = function() {
                document.getElementById("message").textContent = "employee successfully added";
                document.getElementById("message").style.display = "block";
                document.getElementById("message").style.color = "white";
            };

             setTimeout(function() {
                    document.getElementById("message").style.display = "none";
                }, 5000);
           
        </script>
            ';

        }else{
            echo'
            <script>
            window.onload = function() {
                document.getElementById("message").textContent = "Addition failed";
                document.getElementById("message").style.display = "block";
                document.getElementById("message").style.color = "red";

                 setTimeout(function() {
                    document.getElementById("message").style.display = "none";
                }, 5000);
                
            };
        </script>
            ';
        }
        



}

}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EMPLOYEES</title>
    <link rel="stylesheet" href="css/sett.css">
    <style>
        #message{
            background-color: #205A28;
            transform: translateY(-3px);
            display:none;
            padding:5px;
            border-radius: 10px;
            
        }

        select{
            border-radius: 15px;
            padding:9px;
            width:180px;
            text-align: center;
            color:gray;
            appearance: none;
        }

        select:checked{
            color:black;
        }

        select:checked {
    color:black
}

    </style>
</head>
<body>
    <div id="message"></div>
    <div style="background-color:#205A28" id="formcont">
    <form action="" method="POST" class="form1" action="employees.php">
        <label for="EmployeeID" class="labelemp">Employee ID:</label>
        <input type="text" name="eID" id="eID" placeholder="EMPLOYEE ID" required><br><br>

        <label for="fname" class="labelemp">Firstname:</label>
        <input type="text" name="fname" id="fname" placeholder="FIRSTNAME" required><br><br>

        <label for="sname" class="labelemp">Surname:</label>
        <input type="text" name="sname" id="sname" placeholder="SURNAME" required><br><br>

        <label for="depID" class="labelemp">Department ID:</label>
        <select id="depID" name="depID" required>
        <option id="options" value="">DEPARTMENT</option>
        <?php

                $sql = "SELECT department_id, department_name FROM department";
                $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                while($row = $result->fetch_assoc()) {
                    echo '<option value="' . $row['department_id'] . '">' . $row['department_id'] . ' - ' . htmlspecialchars($row['department_name']) . '</option>';
                }
            } else {
                echo '<option value="">No departments available</option>';
            }
        ?>
    </select><br><br>

        <label for="desID" class="labelemp">Designation ID:</label>
        <select id="desID" name="desID" required>
            <option value="">DESIGNATION</option>
            <?php
                $sql="SELECT designation_id, designation_name FROM designation";
                $result=mysqli_query($conn,$sql);

                if($result->num_rows>0){
                    while($row=$result->fetch_assoc()){
                        echo'<option value="'.$row["designation_id"].'">'.$row["designation_id"].' - '.$row["designation_name"].'</option>';
                    }

                }else{
                    echo'<option value="">No designation available</option>';
                }
            ?>
        </select><br><br>
        <center><button type="submit" name="submit" id="btn">REGISTER</button></center>
        
    </form>
    </div>
</body>
</html>