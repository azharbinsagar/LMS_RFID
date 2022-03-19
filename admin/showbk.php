<?php
require('admin_session.php');
require_once('../assets/include/config.php');
$con = connectTo();

if(!empty($_POST["bcode"])){
    //Fetch book data
	$result = mysqli_query($con,"SELECT * FROM `book` WHERE `barcode` = ".$_POST['bcode']."") or die(mysqli_error($con));
	  if($obj = mysqli_fetch_object($result))
	  { 
			echo "<script>$('#bname').html('Book Name: $obj->name');</script>";
			echo "<script>$('#edtn').html('<br>Edition: $obj->edition');</script>";
			echo "<script>$('#submit').prop('disabled',false);</script>";
	  }
	  else
	  {
			echo "<span style='color:red;'>Invalid barcode!! Book not Available.</span>";
			echo "<script>$('#submit').prop('disabled',true);</script>";
	  }
}
?>