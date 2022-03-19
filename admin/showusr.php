<?php
require('admin_session.php');
require_once('../assets/include/config.php');
$con = connectTo();

if(!empty($_POST["rfid"])){
    //Fetch user data
	$result = mysqli_query($con,"SELECT * FROM `user` WHERE `rfid` = ".$_POST['rfid']."") or die(mysqli_error($con));
	  if($obj = mysqli_fetch_object($result))
	  { 
			echo "<script>$('#name').html('Name: $obj->name');</script>";
			echo "<script>$('#user').html('<br>Username: $obj->username');</script>";
			echo "<script>$('#submit').prop('disabled',false);</script>";
	  }
	  else
	  {
			echo "<span style='color:red;'>This card is not assigned to any users.</span>";
			echo "<script>$('#submit').prop('disabled',true);</script>";
	  }
}
?>