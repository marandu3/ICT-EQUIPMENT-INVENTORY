<?php
$db_server="localhost";
$db_user= "root";
$db_pass= "";
$db_name= "ict_equipment_inventory";
$conn="";

$conn=mysqli_connect($db_server,$db_user,$db_pass,$db_name);

if($conn->connect_error) {
die("connection error". $conn->connect_error);
}
else{
    echo"";
}
