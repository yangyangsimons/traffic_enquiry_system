<?php
header("Content-Type: text/html; charset=utf8");

$nameCreate = $_POST["createName"];
$createDOB = $_POST["createDOB"];
$addressCreate = $_POST["createAddress"];
$createLicence = $_POST["createLicence"];
$conn = require('connection.php');
//check if this people is exist in the database;
$sqlqueryPeople = "SELECT People_ID FROM People WHERE People_Licence = '$createLicence';";
$result = mysqli_query($conn,$sqlqueryPeople);

if(mysqli_num_rows($result)){
    echo "This person already exist in our system";
}else{
    $sqlPeople = "INSERT INTO People (People_name, People_DOB, People_address, People_licence) VALUES('$nameCreate', '$createDOB', '$addressCreate', '$createLicence')";
    $insertResult = mysqli_query($conn,$sqlPeople);
    $sqlquery = "SELECT People_name FROM People WHERE People_Licence = '$createLicence';";
    $createResult = mysqli_query($conn,$sqlquery);
    if(mysqli_num_rows($createResult)){
        echo "Create successful";
    }else{
        echo "Create failed, please try again";
    }
}
mysqli_close($conn);