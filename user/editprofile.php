<?php require('user_session.php'); 
		$con = connectTo();
// If form submitted, insert values into the database.
if ($_SERVER["REQUEST_METHOD"] == "POST"){
		/*********** VALIDATE ALL VARIABLES ************/
		if($_REQUEST['name'] == "" || $_REQUEST['email'] == "" || $_REQUEST['mob'] == ""){
			respond("error","empty");
		}
		$uid = $_SESSION['uid'];
		$name = sqlReady($_REQUEST['name']);
		$email = sqlReady($_REQUEST['email']);
		$mob = sqlReady($_REQUEST['mob']);
		 if(verify(NAME,$name) === false) respond("error","name");
		 if(verify(EMAIL,$email) === false) respond("error","email");
		 if(verify(PHONE,$mob) === false) respond("error","mob");
		 
	//updating values in table
		$q1 = mysqli_query($con,"UPDATE `user` SET `name` = '$name', `email` = '$email', `mobile` = '$mob' WHERE `uid` = '$uid'") or die(mysqli_error($con));
		respond("error","none");
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
<title>User Edit Profile :: LIBRARY AUTOMATION USING RFID</title>
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
	  $("#edpro").submit(function() {
    var data = {};
    $("#edpro input").each(function(k,v) {
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
          case 'name' :
            $('.alert span').html('Please provide a valid Name!');
            $('.alert').removeClass('hidden');
            $('.alert').removeClass('alert-warning');
            $('.alert').addClass('alert-danger');
            break;
          case 'email' :
            $('.alert span').html('Please provide a valid email address!');
            $('.alert').removeClass('hidden');
            $('.alert').removeClass('alert-warning');
            $('.alert').addClass('alert-danger');
            break;
          case 'mob' :
            $('.alert span').html('Please provide a valid Phone number!');
            $('.alert').removeClass('hidden');
            $('.alert').removeClass('alert-warning');
            $('.alert').addClass('alert-danger');
            break;
          case 'none' :
            $('.alert span').html('<img src="../assets/images/success.jpg"> <Strong>Success</strong>,Profile details updated. ');
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
    	<h2>Edit My Profile</h2>
<?php
$uid = $_SESSION['uid'];
$q = mysqli_query($con,"SELECT * FROM `user` WHERE `uid` = '$uid'") or die(mysqli_error($con));
$q1 = mysqli_fetch_object($q);
?>
<div class="main-page-charts">
   <div class="main-page-chart-layer1">
		<div class="col-md-4 chart-layer1-left"> 
			<div class="user-marorm">
			<div class="malorm-bottom">
				 <h2><?php echo $q1->name; ?></h2>
				 <h3>Username : <?php echo $q1->username; ?></h3><br />
				 <h3>RFID: <?php echo $q1->rfid; ?></h3><br />
				 <h4>Registered On: <?php echo $q1->rgon; ?></h4>
			</div>
		   </div>
		</div>
	 
	<div class="col-md-8 chart-layer1-right">
		<div class="work-progres">
			<div class="chit-chat-heading">Edit Details&nbsp;&nbsp;&nbsp;&nbsp;<a href="chpass.php"><button class="btn btn-primary">Change Password</button></a></div><br /><br />
						<h4>Edit My Profile Details:</h4><br>
						<div class="alert alert-warning hidden">
							<span></span>
							<button type="button" class="close" onclick="$('.alert').addClass('hidden');">&times;</button>
						</div>		
									<form class="form form-horizontal" id="edpro" data-toggle="validator" method="post">
										<div class="form-group">
											<label for="name" class="col-sm-4 control-label">Full Name</label>
											<div class="col-md-8">
												<div class="input-group">
													<input type="text" class="form-control1" placeholder="Full Name" id="name" name="name" autocomplete="off" value="<?php echo $q1->name; ?>" required >
												</div>
												<div class="help-block with-errors"></div>
											</div>
										</div>
										<div class="form-group">
											<label for="email" class="col-sm-4 control-label">Email</label>
											<div class="col-md-8">
												<div class="input-group">
													<input type="text" class="form-control1" placeholder="Email" id="email" name="email" autocomplete="off" value="<?php echo $q1->email; ?>" required >
												</div>
												<div class="help-block with-errors"></div>
											</div>
										</div>
										<div class="form-group">
											<label for="mob" class="col-sm-4 control-label">Mobile No.</label>
											<div class="col-md-8">
												<div class="input-group">
													<input type="text" class="form-control1" placeholder="Mobile No." id="mob" name="mob" autocomplete="off" value="<?php echo $q1->mobile; ?>" required >
												</div>
												<div class="help-block with-errors"></div>
											</div>
										</div>
										<div class="form-group">
										<div class="col-sm-4"></div>
										<div class="col-sm-4">
										<button type="submit" id="submit" class="btn btn-primary">Update Details</button>
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