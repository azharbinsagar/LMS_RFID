<?php require('admin_session.php');
if(isset($_GET['val']))
{
?>
<!--Author: W3layouts
Author URL: http://w3layouts.com
License: Creative Commons Attribution 3.0 Unported
License URL: http://creativecommons.org/licenses/by/3.0/
-->
<!DOCTYPE HTML>
<html>
<head>
<title>Admin View Barcode :: Library Administration using RFID</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="keywords" content="" />
<script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); } </script>
<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
<link href="../assets/css/bootstrap.css" rel="stylesheet" type="text/css" media="all">
<!-- Custom Theme files -->
<link href="../assets/css/style.css" rel="stylesheet" type="text/css" media="all"/>
 <!-- js-->
<script src="../assets/js/jquery.min.js"></script>
<!--icons-css-->
<link href="../assets/css/font-awesome.css" rel="stylesheet"> 
<!--Google Fonts-->
<link href='//fonts.googleapis.com/css?family=Carrois+Gothic' rel='stylesheet' type='text/css'>
<link href='//fonts.googleapis.com/css?family=Work+Sans:400,500,600' rel='stylesheet' type='text/css'>
<script>
function printImg(url) {
	var win = window.open('');
	for(i=0;i<5;i++){
	win.document.writeln('<br><br>Library Administration Using RFID<br><img src="' + url + '" onload="window.print();window.close();" /><br><br>');
	}
	win.focus();
}
</script>
</head>
<body>	
<div class="page-container">
   <div class="left-content">
	   <div class="mother-grid-inner">
<?php require('admin_header.php'); ?>
<!--inner block start here-->
<div class="inner-block">
<!--main page chart start here-->
<div class="main-page">
    <div class="blank">
    	<h2>View Bar Code</h2>
    	<div class="blankpage-main">
<?php  
$pic = $_GET['val'];
			if(file_exists("barcode/$pic.jpg"))
				{
					echo"<img class=\"profile-user-img img-responsive img-square\" src=\"barcode/$pic.jpg\" alt=\"Barcode\">";
					echo"<br /><button type=\"button\" onClick=\"printImg('barcode/$pic.jpg')\" class=\"btn btn-success\">Print 5 Copies</button>";
				}
			else
				{
					echo"<img class=\"profile-user-img img-responsive img-square\" src=\"barcode/default.jpg\" alt=\"No Barcode Available\">";
				}
?>
    	</div>
    </div>
</div>
</div><!--inner block end here-->
<!--copy rights start here-->
<div class="copyrights">
	 <p>© 2019 Library Administration using RFID. All Rights Reserved | Developed by  <a href="" target="_blank">Anaz</a> </p>
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
<?php
}
else{
	header('Location: book');
}
?>