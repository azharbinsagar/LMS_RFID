<?php
  
require('assets/include/config.php');
 
  if($_POST) 
  {
      $user = sqlReady($_POST['username']);
      $con = connectTo();
	  $query="SELECT `username` FROM `login` WHERE `username` ='$user'";
	  $result = mysqli_query($con,$query) or die(mysqli_error($con));
	  if(mysqli_num_rows($result) > 0)
	  {
			echo "<span style='color:red;'>Sorry username not available!!!</span>";
			echo "<script>$('#userfg').addClass('has-error');</script>";
			echo "<script>$('#submit').prop('disabled',true);</script>";
	  }
	  else
	  {
			echo "<script>$('#userfg').removeClass('has-error');</script>";
			echo "<script>$('#userfg').addClass('has-success');</script>";
			echo "<span style='color:green;'>username available for registration</span>";
			echo "<script>$('#submit').prop('disabled',false);</script>";
	  }
  }
?>