<?php
session_start();
if(!isset($_SESSION["username"])){
    session_destroy();
    header("location:index.php");
}else{
include("navbarall.php");
include("connection.php");
include("footer.php");

    if(isset($_POST["allocate"])){
            $allid=mysqli_real_escape_string($conn,stripcslashes($_POST["allID"]));
            $alldate=mysqli_real_escape_string($conn,stripcslashes($_POST["alldate"]));
            $emid=mysqli_real_escape_string($conn,stripcslashes($_POST["emID"]));
            $eqid=mysqli_real_escape_string($conn,stripcslashes($_POST["eqID"]));
            $comment=mysqli_real_escape_string($conn,stripcslashes($_POST["comment"]));

            $stmt=$conn->prepare("INSERT INTO allocation VALUES (?,?,?,?,?)");
            $stmt->bind_param("sssss",$allid,$alldate,$emid,$eqid,$comment);

            if($stmt->execute()){
                echo'
                                <script>
            window.onload = function() {
                document.getElementById("dvmsg").textContent = "allocation successfully made";
                document.getElementById("dvmsg").style.display = "block";
                document.getElementById("dvmsg").style.color = "white";
            };

             setTimeout(function() {
                    document.getElementById("dvmsg").style.display = "none";
                }, 5000);
           
        </script>
                ';
            }else{
                echo'
                <script>
            window.onload = function() {
                document.getElementById("dvmsg").textContent = "allocation not made";
                document.getElementById("dvmsg").style.display = "block";
                document.getElementById("dvmsg").style.color = "white";
            };

             setTimeout(function() {
                    document.getElementById("dvmsg").style.display = "none";
                }, 5000);
           
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
    <title>EQUIPMENT ALLOCATION</title>
    <style>
        #formcont{
            background-color: #205A28;
            height:fit-content;
            width:50%;
            padding:20px;
            border-radius: 15px;
        }

        #allocate{
            background-color: #C72B32;
            border-radius:10px;
            padding:5px;
            width:6em;
            color:white;
        }

        #allocate:hover{
            background-color:rgb(41, 25, 26);
            cursor:pointer;
            transform: scale(1.15);
        }

        #alldate,#allID,#emID,#eqID,#comment{
            width:350px;
            transform: translateY(-4px);
            float:right;
        }

@media (max-width:800px){
        #alldate,#allID,#emID,#eqID,#comment{
            width:190px;
            transform: translateY(-4px);
            float:right;
        }
    }
        label{
            float:left;
        }

        select{
            width:200px;
            padding:6.2px;
            border-radius: 10px;
            border: 2px solid #363535;
            text-align: center;
            color:gray;
            appearance: none;
        }

        #dvmsg{
            display:none;
            width:200px;
            height:20px;
            padding:10px;
            background-color: #205A28;
            transform: translateY(-8px);
            border-radius: 15px;
        }
    </style>
</head>
<body>
    <div id="dvmsg"></div>
   <div id="formcont">
    <form action="issuing.php" method="post" id="allocationform">
        <label for="allID">Allocation ID:</label>
        <input type="text" name="allID" id="allID" required placeholder="Allocation ID"> <br><br><br>

        <label for="alldate">Allocation date:</label>
        <input type="date" name="alldate" id="alldate" required ><br><br><br>

        <label for="emID">Employee ID:</label>
        <select name="emID" id="emID" class="select">
            <option value="">Employee ID</option>
            <?php
                $sql="SELECT employee_id, f_name, s_name FROM employee";
                $result=mysqli_query($conn,$sql);

                if($result->num_rows>0){
                    while($row=$result->fetch_assoc()){
                        echo'<option value="'.$row["employee_id"].'">'.$row["employee_id"].' - '.$row["f_name"].' '.$row["s_name"].'</option>';
                    }
                }
            ?>
        </select><br><br><br>

        <label for="eqID">Equipment ID:</label>
        <select name="eqID" id="eqID" class="select">
    <option value="">Equipment ID</option>
    <?php
        
        $sql = "SELECT e.equipment_id, e.equipment_name, e.model
                FROM equipments e
                LEFT JOIN allocation i ON e.equipment_id = i.equipment_id
                WHERE i.equipment_id IS NULL";

        $result = mysqli_query($conn, $sql);

        if (!$result) {
            echo '<option value="">Error fetching data</option>';
        } elseif ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo '<option value="'.htmlspecialchars($row["equipment_id"]).'">'
                    .htmlspecialchars($row["equipment_id"]).' - '
                    .htmlspecialchars($row["equipment_name"]).' - '
                    .htmlspecialchars($row["model"]).'</option>';
            }
        } else {
            echo '<option value="">No unissued items available</option>';
        }
    ?>
</select>
<br><br><br>

        <label for="comment">Comment:</label>
        <input type="text" name="comment" id="comment" required placeholder="Comment"><br><br><br>

     <center><button type="submit" name="allocate" id="allocate">ISSUE</button></center>
    </form>
   </div>
    
</body>
</html>