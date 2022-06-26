<?php
header("Content-Type: text/html; charset=utf8");

// get username and password from post
$name = $_POST['name'];
$licenseNumber = $_POST['licenseNumber'];

$conn = require('connection.php');
// check if driver licenseNumber was existed in database;
$sqlLicenseNumber = "SELECT * FROM People WHERE People_licence = '$licenseNumber'";
$resultLicenseNumber = mysqli_query($conn, $sqlLicenseNumber);

if(mysqli_num_rows($resultLicenseNumber)){
    displayData($resultLicenseNumber);
}else{
    $sqlName = "SELECT * FROM People WHERE People_name LIKE '%$name%'";
    $resultNames = mysqli_query($conn, $sqlName);
    if(!mysqli_num_rows($resultNames)){
        echo("can not find a person whose name is '$name'，you may want to create a new record in system");
    }else{
        displayData($resultNames);
    }
}
function displayData($resultData){
    echo "<tr><th>ID</th><th>Name</th><th>Date Of Birth</th><th>Address</th><th>License Number</th></tr>";
    while($data=mysqli_fetch_array($resultData)){
        echo "<tr>";
        echo "<td>" . $data[0] . "</td>";
        echo "<td>" . $data[1] . "</td>";
        echo "<td>" . $data[2] . "</td>";
        echo "<td>" . $data[3] . "</td>";
        echo "<td>" . $data[4] . "</td>";
        echo "</tr>";
    }
}
mysqli_close($conn);