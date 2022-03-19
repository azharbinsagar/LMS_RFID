<?php
require('session.php');
require('assets/include/config.php');
// If form submitted, insert values into the database.
if ($_SERVER["REQUEST_METHOD"] == "POST"){
		/*********** VALIDATE ALL VARIABLES ************/
		if($_REQUEST['name'] == "" || $_REQUEST['username'] ==  "" || $_REQUEST['pass'] == "" || $_REQUEST['cpass'] == "" || $_REQUEST['email'] == "" || $_REQUEST['phno'] == ""){
			respond("error","empty");
		}
		$name	= sqlReady($_REQUEST['name']);
		$phno	= sqlReady($_REQUEST['phno']);
		$user	= sqlReady($_REQUEST['username']);
		$email	= strtolower(sqlReady($_REQUEST['email']));
		 if(verify(EMAIL,$email) === false) respond("error","email");
		 if(verify(PHONE,$phno) === false) respond("error","phone");
		  $con = connectTo();
		  $query = $con->query("SELECT `username` from `login` where `username` = '".$user."'");
		  if($query && $con->affected_rows) respond("error","exists");
		$upass	= sqlReady($_REQUEST['pass']);
		 if(strlen($upass) < 7) respond("error","pshort");
		$ucpass	= sqlReady($_REQUEST['cpass']);
		if($upass == $ucpass)
		{
			$pass = hashPass($upass);
		}
		else
		{
			respond("error","mismatch");
		}

	//inserting values to users table
        $q1 = mysqli_query($con,"INSERT INTO `user` (`uid`, `name`, `username`, `email`, `mobile`, `rgon`, `status`) VALUES (NULL, '$name', '$user', '$email', '$phno', CURRENT_DATE(), '1')") or die(mysqli_error($con));
	//inserting values into login table
		$q2= mysqli_query($con,"INSERT INTO `login` (`lid`, `username`, `password`, `type`) VALUES (NULL, '$user', '$pass', '1')") or die(mysqli_error($con));
		if($q1 && $q2){respond("error","none");}
}
?><!--Author: W3layouts
Author URL: http://w3layouts.com
License: Creative Commons Attribution 3.0 Unported
License URL: http://creativecommons.org/licenses/by/3.0/
-->
<!DOCTYPE HTML>
<html>
<head>
<title>Registration :: Library Administration using RFID</title>
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
<!-- Validation -->
<script src="assets/js/validator.js"></script>
<script>
$(document).ready(function () {
	$("#username").keyup(function(){	
		var user = $("#username").val();
		if(user.length > 6){		
			$("#result").html('<img src="assets/images/loading.gif">');
			$.ajax({
				type : 'POST',
				url  : 'username-check.php',
				data : 'username='+$("#username").val(),
				success : function(data)
						  {
					         $("#result").html(data);
					      }
			});
			return false;
		}
		else{
			$("#userfg").addClass('has-error');
			$("#result").html('<span style=\'color:red;\'>username must be of minimum 7 characters</span>');
			$('#submit').prop('disabled',true);
		}
	});
	  $("#adduser").submit(function() {
    var data = {};
    $("#adduser input").each(function(k,v) {
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
          case 'email' : 
            $('.alert span').html('Please Enter a valid email !');
            $('.alert').removeClass('hidden');
            break;
          case 'phone' : 
            $('.alert span').html('Please Enter a valid phone number !');
            $('.alert').removeClass('hidden');
            break;
          case 'exists' : 
            $('.alert span').html('This username is already in use!');
            $('.alert').removeClass('hidden');
            $('.alert').addClass('alert-danger');
            break;
          case 'pshort' : 
            $('.alert span').html('Password is short.!');
            $('.alert').removeClass('hidden');
            $('.alert').addClass('alert-danger');
            break;
          case 'mismatch' : 
            $('.alert span').html('Passwords Don\'t match !');
            $('.alert').removeClass('hidden');
            break;
          case 'none' :
            $('.alert span').html('<img src="assets/images/success.jpg"> <Strong>Success</strong>, Your Registration is successful.Please Login ');
            $('.alert').removeClass('hidden');
            $('.alert').removeClass('alert-warning');
            $('.alert').removeClass('alert-danger');
            $('.alert').addClass('alert-success');
            window.location="login";
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
<link href="assets/css/font-awesome.css" rel="stylesheet"> 
<!--Google Fonts-->
<link href='//fonts.googleapis.com/css?family=Carrois+Gothic' rel='stylesheet' type='text/css'>
<link href='//fonts.googleapis.com/css?family=Work+Sans:400,500,600' rel='stylesheet' type='text/css'>
</head>
<body>	
<div class="page-container">
   <div class="left-content">
	   <div class="mother-grid-inner">
<?php require('header.php'); ?>
<!--inner block start here-->
<div class="inner-block">
<!--main page chart start here-->
<div class="main-page">
    <div class="blank">
    	<h2>User Registration</h2>
    	<div class="blankpage-main">
    		
						<div class="forms">
							<h3 class="title1"></h3>
							<div class="form-three widget-shadow">
    <div class="alert alert-warning hidden">
      <span></span>
      <button type="button" class="close" onclick="$('.alert').addClass('hidden');">&times;</button>
    </div>
								<div class="row">
									<form class="form-horizontal" id="adduser" data-toggle="validator" method="post">
										<div class="form-group">
											<label for="name" class="col-sm-3 control-label">Full Name</label>
											<div class="col-sm-8">
												<div class="input-group">
													<span class="input-group-addon">
														<i class="fa fa-user"></i>
													</span>
													<input type="text" class="form-control1" placeholder="Name" id="name" name="name" required>
												</div>
												<div class="help-block with-errors"></div>
											</div>
										</div>
										<div class="form-group" id="userfg">
											<label for="username" class="col-sm-3 control-label">Username</label>
											<div class="col-sm-8">
												<div class="input-group">
													<span class="input-group-addon">
														<i class="fa fa-user"></i>
													</span>
													<input type="text" class="form-control1" placeholder="Username" id="username" name="username" required>
												</div>
												<span id="result"></span>
												<div class="help-block with-errors"></div>
											</div>
										</div>
										<div class="form-group">
											<label for="pass" class="col-sm-3 control-label">Password</label>
											<div class="col-sm-8">
												<div class="input-group">
													<span class="input-group-addon">
														<i class="fa fa-lock"></i>
													</span>
													<input type="password" class="form-control1" placeholder="Password" id="pass" name="pass" required minlength="7">
												</div>
												<div class="help-block with-errors"></div>
											</div>
										</div>
										<div class="form-group">
											<label for="cpass" class="col-sm-3 control-label">Confirm&nbsp;Password </label>
											<div class="col-sm-8">
												<div class="input-group">
													<span class="input-group-addon">
														<i class="fa fa-lock"></i>
													</span>
													<input type="password" class="form-control1" placeholder="Confirm Password" id="cpass" name="cpass" data-match="#pass" data-match-error="Whoops, these don't match" required>
												</div>
												<div class="help-block with-errors"></div>
											</div>
										</div>
										<div class="form-group">
											<label class="col-sm-3 control-label">Email&nbsp;Address </label>
											<div class="col-sm-8">
												<div class="input-group">
													<span class="input-group-addon">
														<i class="fa fa-envelope"></i>
													</span>
													<input type="email" name="email" class="form-control1" placeholder="Email Address" data-error="Enter a valid Email address" required>
												</div>
												<div class="help-block with-errors"></div>
											</div>
										</div>
										<div class="form-group">
											<label class="col-sm-3 control-label">Phone&nbsp;No.</label>
											<div class="col-sm-8">
												<div class="input-group">
													<span class="input-group-addon">
														<i class="fa fa-phone"></i>
													</span>
													<input type="tel" name="phno" class="form-control1" placeholder="Phone No." data-error="Enter a valid Phone Number" required>
												</div>
												<div class="help-block with-errors"></div>
											</div>
										</div>
										<div class="form-group" style="padding-left: 40%; position: static;">
										<button type="submit" id="submit" class="btn btn-primary">Submit</button>
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
		<script src="assets/js/jquery.nicescroll.js"></script>
		<script src="assets/js/scripts.js"></script>
		<!--//scrolling js-->
<script src="assets/js/bootstrap.js"> </script>
<!-- mother grid end here-->
</body>
</html>                     