<?php
header("Content-Type: text/html; charset=utf8");
$conn = require('connection.php');
if( $_SERVER['REQUEST_METHOD'] === 'GET'){
    $sqlOwner = "SELECT People_ID FROM People;";
    $ownerResult = mysqli_query($conn,$sqlOwner);

    echo "<option>select owner</option>>";
    while($owner = mysqli_fetch_array($ownerResult)){
        echo("<option>$owner[0]</option>");
    }
    echo "<option>create owner</option>>";

    exit();
}
$createMake = $_POST["createMake"];
$createModel = $_POST["createModel"];
$createColour = $_POST["createColour"];
$createLicence = $_POST["createLicence"];
$createOwner = $_POST["createOwner"];

//check if this people is exist in the database;
$sqlqueryLicence = "SELECT Vehicle_ID FROM Vehicle WHERE Vehicle_licence = '$createLicence';";
$result = mysqli_query($conn,$sqlqueryLicence);

if(mysqli_num_rows($result)){
    echo "This Licence already exist in our system, please double check the Licence Number";
}else{
    $sqlVehicle = "INSERT INTO Vehicle (Vehicle_make, Vehicle_model, Vehicle_colour, Vehicle_licence)VALUES('$createMake', '$createModel', '$createColour', '$createLicence')";
//    $insertResult = mysqli_query($conn,$sqlVehicle);

    if(mysqli_query($conn,$sqlVehicle)){
        $sqlquery = "SELECT * FROM Vehicle WHERE Vehicle_licence = '$createLicence'";
        $queryResult = mysqli_query($conn,$sqlquery);
        $vehicle = mysqli_fetch_assoc($queryResult);
        $vehicle_ID = $vehicle["Vehicle_ID"];
        $sqlOwnership = "INSERT INTO Owners(People_ID, Vehicle_ID)VALUES('$createOwner', '$vehicle_ID')";
        echo "Create successful, this car's Vehicle ID is: ".$vehicle_ID." The owner ID is $createOwner";
    }else{
        echo "Create failed, please try again".mysqli_error($conn);
    }
}
mysqli_close($conn);