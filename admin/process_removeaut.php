<?php
require('admin_session.php');
require_once('../assets/include/config.php');
$con=connectTo();
if ($_SERVER["REQUEST_METHOD"] == "POST"){
$aid = $_REQUEST['aid'];

$rm1 = mysqli_query($con, "DELETE FROM `author` WHERE `aid` = '$aid'") or die("database error:". mysqli_error($con));
if($rm1) {
echo "Author Removed.";
}
}
?>