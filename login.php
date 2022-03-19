<?php require('session.php');
		require('assets/include/config.php'); 
/*********** VALIDATE ALL VARIABLES ************/

if ($_SERVER["REQUEST_METHOD"] == "POST"){
foreach($_POST as $p) 
  if(empty($p) || !isset($p))
    respond("error","empty");

$pass = $_POST['password'];
$user = strtolower(sqlReady($_POST['username']));

/*********** SEARCH **********/
$con = connectTo();
$exists = $con->query("SELECT * FROM `login` WHERE `username` = '$user'");
if(!($exists && $con->affected_rows)) {
  $con->close();
  respond("error","not_found");
  }
$s = mysqli_query($con, "SELECT `status` FROM `user` WHERE `username` = '$user'") or die("database error:". mysqli_error($con));
$st = mysqli_fetch_object($s);
if($st->status == 0){ respond("error","suspended"); } //suspended
else{
$exists = $exists->fetch_assoc();
if(verifyPass($pass,$exists['password'])) {
  // START SESSION
  $_SESSION['user'] = $exists['username'];
  $_SESSION['type'] = $exists['type'];
  session_write_close();
  die(json_encode(array("error"=>"none","session"=>$_SESSION)));
  } else {
  $con->close();
  respond("error","incorrect");
  }
} //not suspended
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
<title>Login :: LIBRARY AUTOMATION USING RFID</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="keywords" content="" />
<script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); } </script>
<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
<link href="assets/css/bootstrap.css" rel="stylesheet" type="text/css" media="all">
<!-- Custom Theme files -->
<link href="assets/css/style.css" rel="stylesheet" type="text/css" media="all"/>
<!--js-->
<script src="assets/js/jquery-2.1.1.min.js"></script> 
<script>
$(document).ready(function () {
  $("#login").submit(function() {
    var data = {};
    $("#login input").each(function(k,v) {
      if(!$(v).val().length) {
        $('.alert span').html('Please fill all details !');
        $('.alert').removeClass('hidden');
        return false;
      }
      data[$(v).attr('name')] = $(v).val();
    });
    $.ajax({
      type : 'post',
      data : data,
      dataType : 'json',
      success : function(r) {
        console.log(r);
        switch(r.error) {
          case 'empty' : 
            $('.alert span').html('Please fill all the credentials !');
            $('.alert').removeClass('hidden');
            break;
          case 'not_found' :
            $('.alert span').html('No such user found! Try signing up.');
            $('.alert').removeClass('hidden');
            break;
          case 'incorrect' :
            $('.alert span').html('Incorrect Password!');
            $('.alert').removeClass('hidden');
            $('.alert').removeClass('alert-warning');
            $('.alert').addClass('alert-danger');
            break;
          case 'suspended' :
            $('.alert span').html('You are currently Suspended! Contact Admin');
            $('.alert').removeClass('hidden');
            $('.alert').removeClass('alert-warning');
            $('.alert').addClass('alert-danger');
            break;
          case 'none' :
            $('.alert span').html('<img src="assets/images/loading.gif"> <Strong>Welcome</strong>, you are being logged in ');
            $('.alert').removeClass('hidden');
            $('.alert').removeClass('alert-warning');
            $('.alert').removeClass('alert-danger');
            $('.alert').addClass('alert-success');
            window.location="";
            break;
        }
      }    
    });
    return false;
  });
});
</script> 
<!--icons-css-->
<link href="assets/css/font-awesome.css" rel="stylesheet"> 
<!--Google Fonts-->
<link href='//fonts.googleapis.com/css?family=Carrois+Gothic' rel='stylesheet' type='text/css'>
<link href='//fonts.googleapis.com/css?family=Work+Sans:400,500,600' rel='stylesheet' type='text/css'>
<!--static chart-->
</head>
<body>	
<div class="login-page">
    <div class="login-main">  	
    	 <div class="login-head">
				<h1>Login</h1>
			</div>
			<div class="login-block">
    <div class="alert alert-warning hidden">
      <span></span>
      <button type="button" class="close" onclick="$('.alert').addClass('hidden');">&times;</button>
    </div>
				<form method="post" id="login">
					<div class="form-group">
					<input type="text" name="username" placeholder="Username" required="">
					</div>
					<div class="form-group">
					<input type="password" name="password" class="lock" placeholder="Password" required>
					</div>
					<div class="forgot-top-grids">
						<div class="forgot">
							<a href="#">Forgot password?</a>
						</div>
						<div class="clearfix"> </div>
					</div>
					<input type="submit" name="submit" value="Login">	
					<h3>Not a member?<a href="register.php"> Sign up now</a></h3>
				</form>
				<h5><a href="index.php">Go Back to Home</a></h5>
			</div>
      </div>
</div>
<!--inner block end here-->
<!--copy rights start here-->
<div class="copyrights">
	 <p>© 2019 LIBRARY AUTOMATION USING RFID | Developed by  <a href="" target="_blank">Azhar Bin Sagar</a> </p>
</div>	
<!--COPY rights end here-->

<!--scrolling js-->
		<script src="assets/js/jquery.nicescroll.js"></script>
		<script src="assets/js/scripts.js"></script>
		<!--//scrolling js-->
<script src="assets/js/bootstrap.js"> </script>
<!-- mother grid end here-->
</body>
</html>