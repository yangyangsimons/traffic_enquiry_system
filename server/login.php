<?PHP
// is no submission print error and exit script;
header("Content-Type: text/html; charset=utf8");
//connect to the database and get the username and password from post.
$conn = require 'connection.php';
if($_POST['change']==1){
    $changeUser = $_POST['changeUser'];
    $changeOldPassword = $_POST['changeOldpassword'];
    $changeNewPassword = $_POST['changeNewpassword'];
    $sqlchangeold = "SELECT * FROM Officer WHERE Username = '$changeUser' and User_password='$changeOldPassword'";
    $resultChangeold = mysqli_query($conn,$sqlchangeold);
    $changeoldrows = mysqli_num_rows($resultChangeold);
    if($changeoldrows){
        $sqlchangenew = "UPDATE Officer SET User_password='$changeNewPassword' WHERE Username = '$changeUser'";
        $resultChangenew = mysqli_query($conn,$sqlchangenew);
        if($resultChangenew){
            echo "change password successful, website refresh in 4 seconds";
        }else{
            echo "fail to change password, try again, website refresh in 4 seconds";
        }
    }else{
        echo "old password is not correct website refresh in 4 seconds";
    }
    exit();
}
if($_POST['change']==0){
    $name = $_POST['username'];
    $password = $_POST['password'];
}
//if name and password are not null then continue the query process;
class BackContent{
    public $backError="";
    public $backTips = "";
    public $backSuccessful = "";
}
$backContent = new BackContent();
if ($name && $password) {
//query the username and password from database;
    $sql = "SELECT * FROM Officer WHERE Username = '$name' and User_password='$password'";
    //query from database, $conn is the connection from connection.php;
    $result = mysqli_query($conn, $sql);
    // get the number of query result;
    $rows = mysqli_num_rows($result);
    //0 false 1 true
    if ($rows) {
        $backContent ->backSuccessful = 1;
        $backContent ->backError = 0;
        $backContent ->backTips = 0;
    } else {
        $backContent ->backSuccessful = 0;
        $backContent ->backError = 1;
        $backContent ->backTips = 0;
    }
} else {
    $backContent ->backSuccessful = 0;
    $backContent ->backError = 0;
    $backContent ->backTips = 1;
}
echo json_encode($backContent);
mysqli_close($conn);