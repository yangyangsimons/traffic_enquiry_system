<?php
header("Content-Type: text/html; charset=utf8");

// get the vehicleID from post form
$vehicleID = $_POST['vehicleID'];

$conn = require('connection.php');
// check if driver licenseNumber was existed in database;
$sqlVehicle = "SELECT * FROM Vehicle WHERE Vehicle_ID = '$vehicleID'";
$result = mysqli_query($conn,$sqlVehicle);
if(!(mysqli_num_rows($result))){
    echo("can not find this  car");
}else{
    $resultVehicle = mysqli_fetch_array($result);
    echo"
        <tr>
            <th>VehicleID</th>
            <th>Vehicle Type</th>
            <th>Vehicle Colour</th>
            <th>Vehicle licence</th>
        </tr>
        <tr>
           <td>$resultVehicle[0]</td>
           <td>$resultVehicle[1]</td>
           <td>$resultVehicle[2]</td>
           <td>$resultVehicle[3]</td>
        </tr>";
}

mysqli_close($conn);