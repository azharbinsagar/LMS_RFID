<?php
require('admin_session.php');
require_once('../assets/include/config.php');
$con=connectTo();
if ($_SERVER["REQUEST_METHOD"] == "POST"){
$bid = $_REQUEST['bid'];
$bcode = $_REQUEST['bcode'];

$rm1 = mysqli_query($con, "DELETE FROM `book` WHERE `bid` = '$bid'") or die("database error:". mysqli_error($con));
if($rm1 && unlink("barcode/$bcode.jpg")) {
echo "Book and Barcode data Removed.";
}
}
?>