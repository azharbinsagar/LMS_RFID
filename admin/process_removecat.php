<?php
require('admin_session.php');
require_once('../assets/include/config.php');
$con=connectTo();
if ($_SERVER["REQUEST_METHOD"] == "POST"){
$cid = $_REQUEST['cid'];

$rm1 = mysqli_query($con, "DELETE FROM `category` WHERE `cid` = '$cid'") or die("database error:". mysqli_error($con));
if($rm1) {
echo "Category Removed.";
}
}
?>