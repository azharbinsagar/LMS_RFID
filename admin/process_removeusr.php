<?php
require('admin_session.php');
require_once('../assets/include/config.php');
$con=connectTo();
if ($_SERVER["REQUEST_METHOD"] == "POST"){
$uid = $_REQUEST['uid'];

$rm1 = mysqli_query($con, "DELETE FROM `user` WHERE `uid` = '$uid'") or die("database error:". mysqli_error($con));
if($rm1) {
echo "User Removed.";
}
}
?>