<?php
session_start();
if(!isset($_SESSION["username"])){
    session_destroy();
    header("location:index.php");
} else {

    include("footer.php");
    include "connection.php";

    if(isset($_POST["home"])){
        if($_SESSION["username"] == "MARANDU"){
            header("location:superadmindashboard.php");
        } else {
            header("location:dashboard.php");
        }
    }

    

    
    $sql = "
    SELECT 
        employee.f_name, 
        employee.s_name, 
        department.department_name, 
        designation.designation_name, 
        equipment_category.category, 
        equipments.equipment_name, 
        equipments.model, 
        equipments.serialnumber, 
        equipments.GOV_code, 
        equipments.specification, 
        equipments.`STATUS`, 
        allocation.allocation_date
    FROM 
        employee 
    JOIN 
        department ON employee.department_id = department.department_id
    JOIN 
        designation ON employee.designation_id = designation.designation_id
    JOIN 
        allocation ON employee.employee_id = allocation.employee_id
    JOIN 
        equipments ON allocation.equipment_id = equipments.equipment_id
    JOIN 
        equipment_category ON equipments.category_id = equipment_category.category_id";

$result = mysqli_query($conn, $sql);

if (!$result) {
    die("Error in SQL query: " . mysqli_error($conn));
}
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ALLOCATIONS</title>
    <link rel="stylesheet" href="css/dashboard.css">
    <style>
        #tablecontainer {
            width: 100%;
            border-radius: 15px; 
        }
        table {
            width: 100%;
            border-collapse: separate; 
            border-spacing: 0;
        }
        .thead, th {
            border: 1px solid black;
            padding: 9px;
            background-color: #205A28;
            color: white;
            text-align: center;
            width:fit-content;
        }
        .data {
            border: 1px solid black;
            padding: 5px;
            background-color: #0174b6;
            color: white;
            text-align: center;
            width:fit-content;
        }

       
        table tr:first-child th:first-child {
            border-top-left-radius: 15px;
        }
        table tr:first-child th:last-child {
            border-top-right-radius: 15px;
        }
        table tr:last-child td:first-child {
            border-bottom-left-radius: 15px;
        }
        table tr:last-child td:last-child {
            border-bottom-right-radius: 15px;
        }

        #navbar {
            width: 100%;
        }

        @media (max-width: 650px) {
            #navbar {
                width: 310%;
            }
        }
    </style>
</head>
<body>
    <nav id="navbar" style="background-color:#205A28; padding-left:5px; border-radius:10px;">
        <form style="float:right;" method="post" action="distribution.php">
            <button name="home" id="home" style="transform:translateX(-5px);">home</button>
        </form>
    </nav><br>

    
    <div style="margin-bottom: 0px; float:left;"  >
        <input type="text" id="searchbar" placeholder="Filter Data..." style="width: 100%; padding: 2px; border-radius: 10px; border: 1px solid #205A28; transform:translateY(-10px); float:left;">
    </div>

<div id="tablecontainer">
    <table>
        <thead id="thead">
        <tr>
            <th class="thead">Firstname</th>
            <th class="thead">Surname</th>
            <th class="thead">Department</th>
            <th class="thead">Designation</th>
            <th class="thead">Equipment Type</th>
            <th class="thead">Equipment Name</th>
            <th class="thead">Model</th>
            <th class="thead">Serial Number</th>
            <th class="thead">Government Code</th>
            <th class="thead">Specification</th>
            <th class="thead">Status</th>
            <th class="thead">Issuing Date</th> 
        </tr>
        </thead>
        
        <tbody id="tbody">
<?php
if ($result->num_rows> 0) {
    while ($row = mysqli_fetch_assoc($result)) {
?>
        <tr>
            <td class="data"><?php echo htmlspecialchars($row["f_name"]); ?></td>
            <td class="data"><?php echo htmlspecialchars($row["s_name"]); ?></td>
            <td class="data"><?php echo htmlspecialchars($row["department_name"]); ?></td>
            <td class="data"><?php echo htmlspecialchars($row["designation_name"]); ?></td>
            <td class="data"><?php echo htmlspecialchars($row["category"]); ?></td>
            <td class="data"><?php echo htmlspecialchars($row["equipment_name"]); ?></td>
            <td class="data"><?php echo htmlspecialchars($row["model"]); ?></td>
            <td class="data"><?php echo htmlspecialchars($row["serialnumber"]); ?></td>
            <td class="data"><?php echo htmlspecialchars($row["GOV_code"]); ?></td>
            <td class="data"><?php echo htmlspecialchars($row["specification"]); ?></td>
            <td class="data"><?php echo htmlspecialchars($row["STATUS"]); ?></td>
            <td class="data"><?php echo htmlspecialchars($row["allocation_date"]); ?></td>
        </tr>
<?php
    }
} else {
?>
    <tr>
        <td colspan="12" class="data" style="text-align: center;">NO ALLOCATION HAVE BEEN MADE</td>
    </tr>
<?php
}
?>
</tbody>

    </table>
</div>

<script>
    var searchbar = document.getElementById("searchbar");
    var tbody = document.getElementById("tbody");
    var originalTableData = tbody.innerHTML;

    function search() {
        tbody.innerHTML = originalTableData;
        let rows = tbody.getElementsByTagName('tr');
        let searchtext = searchbar.value.toLowerCase();

        if (searchtext.length == 0) {
            return;
        }

        let filteredRows = '';
        for (let i = 0; i < rows.length; i++) {
            let rowText = rows[i].innerText.toLowerCase();
            if (rowText.includes(searchtext)) {
                filteredRows += rows[i].outerHTML;
            }
        }
        tbody.innerHTML = filteredRows;
    }

    searchbar.addEventListener('input', search);
</script>

</body>
</html>
