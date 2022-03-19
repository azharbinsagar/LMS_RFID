<?php require('user_session.php'); 
		$con = connectTo();
// If form submitted, insert values into the database.
if ($_SERVER["REQUEST_METHOD"] == "POST"){
		/*********** VALIDATE ALL VARIABLES ************/
		if($_REQUEST['curpass'] ==  ""  || $_REQUEST['npass'] ==  ""  || $_REQUEST['cpass'] ==  "" ){
			respond("error","empty");
		}
		$curpass = sqlReady($_REQUEST['curpass']);
		$npass = sqlReady($_REQUEST['npass']);
		$cpass = sqlReady($_REQUEST['cpass']);
		$user = $_SESSION['user'];
$exists = $con->query("SELECT `password` FROM `login` WHERE `username` = '$user'"); 
$exists = $exists->fetch_assoc();
if(!verifyPass($curpass,$exists['password'])) respond("error","perror");
if(strlen($npass) < 7) respond("error","pln");
		if($npass == $cpass)
		{
			$pass = hashPass($npass);
		}
		else
		{
			respond("error","mismatch");
		}

$rp1 = mysqli_query($con, "UPDATE `login` SET `password` = '$pass' WHERE `username` = '$user'") or die("database error:". mysqli_error($con));

if($rp1) {
			respond("error","none");
}
 }
?>
<!--Author: W3layouts
Author URL: http://w3layouts.com
License: Creative Commons Attribution 3.0 Unported
License URL: http://creativecommons.org/licenses/by/3.0/
-->
<!DOCTYPE HTML>
<html>
<head>
<title>User Change Password :: Library Administration using RFID</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="keywords" content="" />
<script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); } </script>
<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
<link href="../assets/css/bootstrap.css" rel="stylesheet" type="text/css" media="all">
<!-- Custom Theme files -->
<link href="../assets/css/style.css" rel="stylesheet" type="text/css" media="all"/>
<!--js-->
<script src="../assets/js/jquery-2.1.1.min.js"></script>
<!-- Validation -->
<script src="../assets/js/validator.min.js"></script>
<script>
$(document).ready(function () {
	  $("#chpass").submit(function() {
    var data = {};
    $("#chpass input").each(function(k,v) {
      if(!$(v).val().length) {
        $('.alert span').html('Please fill all the credentials !!');
        $('.alert').removeClass('hidden');
        return false;
      }
      data[$(v).attr('name')] = $(v).val();
    });
    $.ajax({
      type	: 'post',
      data	: data,
      dataType	: 'json',
      success	: function(r) {
        console.log(r);
        switch(r.error) {
          case 'empty' : 
            $('.alert span').html('Please fill all the credentials !');
            $('.alert').removeClass('hidden');
            break;
          case 'pln' : 
            $('.alert span').html('Password is too short!');
            $('.alert').removeClass('hidden');
            break;
          case 'perror' : 
            $('.alert span').html('Current Password is Wrong!');
            $('.alert').removeClass('hidden');
            break;
          case 'mismatch' : 
            $('.alert span').html('Passwords don\'t match!');
            $('.alert').removeClass('hidden');
            break;
          case 'none' :
            $('.alert span').html('<img src="../assets/images/success.jpg"> <Strong>Success</strong>, Your Password is changed. ');
            $('.alert').removeClass('hidden');
            $('.alert').removeClass('alert-warning');
            $('.alert').removeClass('alert-danger');
            $('.alert').addClass('alert-success');
            window.location="profile";
            break;
        }
      }    
    });
    return false;
  });
});
</script>
<!-- //Validation -->
<!--icons-css-->
<link href="../assets/css/font-awesome.css" rel="stylesheet"> 
<!--Google Fonts-->
<link href='//fonts.googleapis.com/css?family=Carrois+Gothic' rel='stylesheet' type='text/css'>
<link href='//fonts.googleapis.com/css?family=Work+Sans:400,500,600' rel='stylesheet' type='text/css'>
</head>
<body>	
<div class="page-container">
   <div class="left-content">
	   <div class="mother-grid-inner">
<?php require('user_header.php'); ?>
<!--inner block start here-->
<div class="inner-block">
<!--main page chart start here-->
<div class="main-page">
 <div class="blank">
    	<h2>Change Password</h2>
<?php
$uid = $_SESSION['uid'];
$q = mysqli_query($con,"SELECT * FROM `user` WHERE `uid` = '$uid'") or die(mysqli_error($con));
$q1 = mysqli_fetch_object($q);
?>
<div class="main-page-charts">
   <div class="main-page-chart-layer1">
	<div class="col-md-8 chart-layer1-left">
		<div class="work-progres">
			<div class="chit-chat-heading">Edit Details</div><br /><br />
						<h4>Change Password:</h4><br>
						<div class="alert alert-warning hidden">
							<span></span>
							<button type="button" class="close" onclick="$('.alert').addClass('hidden');">&times;</button>
						</div>		
									<form class="form form-horizontal" id="chpass" data-toggle="validator" method="post">
										<div class="form-group">
											<label for="curpass" class="col-sm-4 control-label">Current Password</label>
											<div class="col-md-8">
												<div class="input-group">
													<input type="password" class="form-control1" placeholder="Current Password" id="curpass" name="curpass" autocomplete="off" required >
												</div>
												<div class="help-block with-errors"></div>
											</div>
										</div>
										<div class="form-group">
											<label for="npass" class="col-sm-4 control-label">New Password</label>
											<div class="col-md-8">
												<div class="input-group">
													<input type="password" class="form-control1" minlength="7" placeholder="New Password" id="npass" name="npass" autocomplete="off" required >
												</div>
												<div class="help-block with-errors"></div>
											</div>
										</div>
										<div class="form-group">
											<label for="cpass" class="col-sm-4 control-label">Confirm Password</label>
											<div class="col-md-8">
												<div class="input-group">
													<input type="password" class="form-control1" placeholder="Confirm Password" data-match="#npass" data-match-error="Whoops, these don't match" id="cpass" name="cpass" autocomplete="off" required >
												</div>
												<div class="help-block with-errors"></div>
											</div>
										</div>
										<div class="form-group">
										<div class="col-sm-4"></div>
										<div class="col-sm-4">
										<button type="submit" id="submit" class="btn btn-primary">Change Password</button>
										</div>
										</div>
									</form>
		</div>
	</div>
  </div>
 </div>

 </div>
</div>
</div><!--inner block end here-->
<!--copy rights start here-->
<div class="copyrights">
	 <p>© 2019 LIBRARY AUTOMATION USING RFID | Developed by  <a href="" target="_blank">Azhar Bin Sagar</a> </p>
</div>	
<!--COPY rights end here-->
</div>
</div>
	<div class="clearfix"> </div>
</div>
<!--scrolling js-->
		<script src="../assets/js/jquery.nicescroll.js"></script>
		<script src="../assets/js/scripts.js"></script>
		<!--//scrolling js-->
<script src="../assets/js/bootstrap.js"> </script>
<!-- mother grid end here-->
</body>
</html>                     