<?php require('user_session.php'); 
	  require_once('../assets/include/config.php');
?>
<!--Author: W3layouts
Author URL: http://w3layouts.com
License: Creative Commons Attribution 3.0 Unported
License URL: http://creativecommons.org/licenses/by/3.0/
-->
<!DOCTYPE HTML>
<html>
<head>
<title>User Home :: LIBRARY AUTOMATION USING RFID</title>
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
    	<h2>Welcome User</h2>
    	<div class="blankpage-main">
    		<p>Radio frequency identification (RFID) is a rapidly
emerging technology which allows productivity and
convenience. This RFID Based
Library Management System that would allow fast
transaction flow and will make it easy to handle the issue and
return of books from the library without much intervention of
manual book keeping which benefits by adding properties of
traceability and security. The proposed system is based on
RFID readers and passive RFID tags that are able to
electronically store information that can be read with the help
of the RFID reader. This system would be able to issue and
return books via RFID tags and also calculates the
corresponding fine associated with the time period of the
absence of the book from the library database.</p>
    	</div>
<!--market updates updates-->
	 <div class="market-update">
			<div class="col-md-4 market-update-gd">
				<div class="market-update-block clr-block-1">
					<div class="col-md-8 market-update-left">
<?php
$con = connectTo();
$q = mysqli_query($con,"SELECT `uid` FROM `user`") or die(mysqli_error($con));
$r = mysqli_num_rows($q) - 1;//total user - admin
				echo "<h3>$r</h3>";
?>
						<h4>Registered User</h4>
					</div>
					<div class="col-md-4 market-update-right">
						<i class="fa fa-users fa-5x"> </i>
					</div>
				  <div class="clearfix"> </div>
				</div>
			</div>
			<div class="col-md-4 market-update-gd">
				<div class="market-update-block clr-block-2">
					<div class="col-md-8 market-update-left">
<?php
$q = mysqli_query($con,"SELECT `bid` FROM `book`") or die(mysqli_error($con));
$r = mysqli_num_rows($q);
				echo "<h3>$r</h3>";
?>
						<h4>Total Books</h4>
					</div>
					<div class="col-md-4 market-update-right">
						<i class="fa fa-book fa-5x"> </i>
					</div>
				  <div class="clearfix"> </div>
				</div>
			</div>
			<div class="col-md-4 market-update-gd">
				<div class="market-update-block clr-block-3">
					<div class="col-md-8 market-update-left">
<?php
$q = mysqli_query($con,"SELECT `aid` FROM `author`") or die(mysqli_error($con));
$r = mysqli_num_rows($q);
				echo "<h3>$r</h3>";
?>
						<h4>Authors Listed</h4>
					</div>
					<div class="col-md-4 market-update-right">
						<i class="fa fa-user fa-5x"> </i>
					</div>
				  <div class="clearfix"> </div>
				</div>
			</div>
			<div class="col-md-4 market-update-gd">
				<div class="market-update-block clr-block-3">
					<div class="col-md-8 market-update-left">
<?php
$q = mysqli_query($con,"SELECT `cid` FROM `category`") or die(mysqli_error($con));
$r = mysqli_num_rows($q);
				echo "<h3>$r</h3>";
?>
						<h4>Listed Categories</h4>
					</div>
					<div class="col-md-4 market-update-right">
						<i class="fa fa-sitemap fa-5x"> </i>
					</div>
				  <div class="clearfix"> </div>
				</div>
			</div>
			<div class="col-md-4 market-update-gd">
				<div class="market-update-block clr-block-1">
					<div class="col-md-8 market-update-left">
<?php
$q = mysqli_query($con,"SELECT `isid` FROM `bookissue` WHERE `returndate` IS NULL") or die(mysqli_error($con));
$r = mysqli_num_rows($q);
				echo "<h3>$r</h3>";
?>
						<h4>Books Currently Issued</h4>
					</div>
					<div class="col-md-4 market-update-right">
						<i class="fa fa-tasks fa-5x"> </i>
					</div>
				  <div class="clearfix"> </div>
				</div>
			</div>
			<div class="col-md-4 market-update-gd">
				<div class="market-update-block clr-block-2">
					<div class="col-md-8 market-update-left">
<?php
$q = mysqli_query($con,"SELECT `isid` FROM `bookissue`") or die(mysqli_error($con));
$r = mysqli_num_rows($q);
				echo "<h3>$r</h3>";
?>
						<h4>Total Books Issued</h4>
					</div>
					<div class="col-md-4 market-update-right">
						<i class="fa fa-file-archive-o fa-5x"> </i>
					</div>
				  <div class="clearfix"> </div>
				</div>
			</div>
		   <div class="clearfix"> </div>
		</div>
<!--market updates end here-->
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