<?php
require('admin_session.php');
require_once('../assets/include/config.php');
$con=connectTo();
if ($_SERVER["REQUEST_METHOD"] == "POST"){
$pid = $_REQUEST['pid'];

$rm1 = mysqli_query($con, "DELETE FROM `publisher` WHERE `pid` = '$pid'") or die("database error:". mysqli_error($con));
if($rm1) {
echo "Publisher Removed.";
}
}
?>