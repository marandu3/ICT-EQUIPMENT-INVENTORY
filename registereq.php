<?php
session_start();
if(!isset($_SESSION["username"])){
    session_destroy();
    header("location:index.php");
    exit();
}else{
    include("navbarall.php");
    include("footer.php");
    include("connection.php");

    if(isset($_POST["submit"])){
        $eqID = mysqli_real_escape_string($conn, stripcslashes($_POST["eqID"]));
        $eqname = mysqli_real_escape_string($conn, stripcslashes($_POST["eqname"]));
        $catID = mysqli_real_escape_string($conn, stripcslashes($_POST["eqcat"]));
        $model = mysqli_real_escape_string($conn, stripcslashes($_POST["model"]));
        $snumber = mysqli_real_escape_string($conn, stripcslashes($_POST["snumber"]));
        $specs = mysqli_real_escape_string($conn, stripcslashes($_POST["specs"]));
        $gcode = mysqli_real_escape_string($conn, stripcslashes($_POST["gcode"]));
        $status = mysqli_real_escape_string($conn, stripcslashes($_POST["status"]));

        $stmt = $conn->prepare("INSERT INTO equipments VALUES (?,?,?,?,?,?,?,?)");
        if ($stmt === false) {
            die("Error preparing statement: " . $conn->error);
        }

        $stmt->bind_param("ssssssss", $eqID, $eqname, $model, $snumber, $status, $specs, $gcode, $catID);

        if($stmt->execute()){
            echo '<script>
            window.onload=function(){
                document.getElementById("eqform").reset();
                document.getElementById("divmsg").textContent="Equipment added";
        }
                setTimeout(function() {
                    document.getElementById("divmsg").style.display = "none";
                }, 5000);
        
            </script>';
        }else{
            echo '<script>
            window.onload=function(){    
            document.getElementById("eqform").reset();
                document.getElementById("divmsg").style.color="red";
                document.getElementById("divmsg").textContent="Equipment not added";
        }
                setTimeout(function() {
                    document.getElementById("divmsg").style.display = "none";
                }, 5000);
            </script>';
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EQUIPMENT REGISTRATION</title>
    <style>
      #formcontainer{
        background-color: #205A28;
        width:400px;
        height: fit-content;
        transform: translateY(-34px);
      }

      button{
        background-color: #C72B32;
        border-radius: 15px;
        padding:2;
        color: white;
      }

      button:hover{
        background-color:rgb(41, 25, 26);;
        cursor:pointer;
      }

      #eqform{
        width: 100%;
      }

      input[type="text"]{
        transform: translateX(80px);
        width:fit-content;
        
      }
      
      label{
        float:left;
      }

      #eqID, #snumber{
        transform: translateX(100px);
      }

      #eqcat{
        transform: translateX(60px);
      }

      #model{
        transform: translateX(151px);
      }

      #specs{
        transform: translateX(107px);
      }
      
      #gcode{
        transform: translateX(76px);
      }

      

      

      .status-label {
            text-align: center;
            display: block;
            margin-bottom: 10px;
        }

        
        .radio-group {
            display: flex;
            justify-content: center;
            gap: 20px; 
        }

        
        .radio-group input[type="radio"] {
            
            width: 16px;
            height: 16px;
            border-radius: 50%; 
            
        }
        select{
          padding:5px;
          border-radius: 10px;
          appearance: none;
          width: 180px;
          text-align: center;
          color:grey;
        }
    </style>
</head>
<body>
  <div id="formcontainer">
    
      <form method="post" action="registereq.php" id="eqform">
        <label for="eqID">Equipment ID:</label>
        <input type="text" id="eqID" name="eqID" placeholder="Equipment ID" required><br><br>

        <label for="eqname">Equipmnet Name:</label>
        <input type="text" id="eqname" name="eqname" placeholder="Equipment Name" required><br><br>

        <label for="eqcat">Equipment Category:</label>
        <select id="eqcat" name="eqcat">
          <option value="">Equipment category</option>
            <?php
                $sql="SELECT category_id, category FROM equipment_category";
                $result=mysqli_query($conn,$sql);
                if($result->num_rows>0){
                while($row=$result->fetch_assoc()){
                echo'<option value="'.$row["category_id"].'">'.$row["category_id"].' - '.$row["category"].'</option>';
                }
              }
            ?>
        </select><br><br>

        <label for="model">Model:</label>
        <input type="text" id="model" name="model" placeholder="Model" required><br><br>

        <label for="snumber">Serial Number:</label>
        <input type="text" id="snumber" name="snumber" placeholder="Serial Number" required><br><br>

        <label for="specs">Specifications</label>
        <input type="text" id="specs" name="specs" placeholder="Specifications" required><br><br>

        <label for="gcode">Government Code:</label>
        <input type="text" id="gcode" name="gcode" placeholder="Government code" required><br><br>

        <label class="status-label">Status:</label>
        <div class="radio-group">
            <label>
                <input type="radio" name="status" value="active"> Active
            </label>
            <label>
                <input type="radio" name="status" value="inactive"> Inactive
            </label>
            <label>
                <input type="radio" name="status" value="in-Repaire"> In-Repaire
            </label>
        </div><br>

        <center><button id="submit" type="submit" name="submit">REGISTER</button></center>
        <center><div id="divmsg"></div></center>

      </form>
  </div>

</body>
</html>