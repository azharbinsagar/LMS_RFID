<?php require('user_session.php'); ?>
<!--Author: W3layouts
Author URL: http://w3layouts.com
License: Creative Commons Attribution 3.0 Unported
License URL: http://creativecommons.org/licenses/by/3.0/
-->
<!DOCTYPE HTML>
<html>
<head>
<title>User Profile :: LIBRARY AUTOMATION USING RFID</title>
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
    	<h2>My Profile</h2>
<?php
$con = connectTo();
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
			<div class="chit-chat-heading">Other Details&nbsp;&nbsp;&nbsp;&nbsp;<a href="editprofile.php"><button class="btn btn-primary">Edit Profile</button></a>&nbsp;&nbsp;&nbsp;&nbsp;<a href="chpass.php"><button class="btn btn-primary">Change Password</button></a></div><br /><br />
				 <h3>Email: <?php echo $q1->email; ?></h3><br />
				 <h3>Mobile No: <?php echo $q1->mobile; ?></h3>
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