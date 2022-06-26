<?php
header("Content-Type: text/html; charset=utf8");

// get username and password from post
$name = $_POST['username'];
$user_password = $_POST['cnpassword'];

$conn = require('connection.php');
// check if username is existing;
$sql = "SELECT * FROM Officer WHERE Username = '$name' AND User_password = 'user_password'";
$result = mysqli_query($conn, $sql);
$rows = mysqli_num_rows($result);

if($rows){
    echo("User Name exist, try other User name");
}else{
    $sq = "INSERT INTO Officer(Username,User_password) VALUES('$name','$user_password')";
    if(mysqli_query($conn,$sq)){
        echo("Register successful, webpage reloading in 5 seconds.....");
    }else{
        echo("Something wrong, please try again later, webpage reloading in 5 seconds.....");
    }
}
mysqli_close($conn);