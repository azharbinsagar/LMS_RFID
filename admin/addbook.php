<?php require('admin_session.php'); 
	  require_once('../assets/include/config.php');
	  require_once('../assets/plugins/php-barcode-generator/src/BarcodeGenerator.php');
	  require_once('../assets/plugins/php-barcode-generator/src/BarcodeGeneratorJPG.php');
		$con = connectTo();
// If form submitted, insert values into the database.
if ($_SERVER["REQUEST_METHOD"] == "POST"){
		/*********** VALIDATE ALL VARIABLES ************/
		if($_REQUEST['book'] == "" || $_REQUEST['edtn'] == "" || $_REQUEST['cat'] == "" || $_REQUEST['aut'] == "" || $_REQUEST['isbn'] == ""){
			respond("error","empty");
		}

		$book = sqlReady($_REQUEST['book']);
		$edtn = sqlReady($_REQUEST['edtn']);
		$cat = sqlReady($_REQUEST['cat']);
		$pub = sqlReady($_REQUEST['pub']);
		$aut = sqlReady($_REQUEST['aut']);
		$isbn = sqlReady($_REQUEST['isbn']);
		 if(verify(ISBN,$isbn) === false) respond("error","isbn");

	//inserting values to table
        $query1 = "INSERT INTO `book` (`bid`, `name`, `edition`, `authid`, `pubid`, `catid`, `isbn`) VALUES (NULL, '$book', '$edtn', '$aut', '$pub', '$cat', '$isbn')";
		mysqli_query($con,$query1) or die(mysqli_error($con));
		$bid = $con->insert_id;
		$barcode = sprintf("%04d",$bid).sprintf("%04d",$cat).substr($isbn,5,7);//bookid + authid + part of isbn;
		mysqli_query($con,"UPDATE `book` SET `barcode` = '$barcode' WHERE `bid` = '$bid'") or die(mysqli_error($con));
		$generatorJPG = new Picqer\Barcode\BarcodeGeneratorJPG();
		file_put_contents("barcode/$barcode.jpg", $generatorJPG->getBarcode("$barcode", $generatorJPG::TYPE_CODE_128));
		respond("error","none");
}?>
<!--Author: W3layouts
Author URL: http://w3layouts.com
License: Creative Commons Attribution 3.0 Unported
License URL: http://creativecommons.org/licenses/by/3.0/
-->
<!DOCTYPE HTML>
<html>
<head>
<title>Admin Manage Books :: Library Administration using RFID</title>
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
<!-- Validation -->
<script src="../assets/js/validator.min.js"></script>
<script src="../assets/js/bootbox.min.js"></script>
<script>
$(document).ready(function () {
	  $("#addbk").submit(function() {
    var data = {};
    $("#addbk input, #addbk select").each(function(k,v) {
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
          case 'isbn' : 
            $('.alert span').html('Please Enter a valid ISBN.');
            $('.alert').removeClass('hidden');
            break;
          case 'none' :
            $('.alert span').html('<img src="../assets/images/success.jpg"> <Strong>Success</strong>, New Book is added. ');
            $('.alert').removeClass('hidden');
            $('.alert').removeClass('alert-warning');
            $('.alert').removeClass('alert-danger');
            $('.alert').addClass('alert-success');
            window.location="book";
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
<?php require('admin_header.php'); ?>
<!--inner block start here-->
<div class="inner-block">
<!--main page chart start here-->
<div class="main-page">
    <div class="blank">
    	<div class="blankpage-main">
						<h4>Add a new Book:</h4><br>
						<div class="alert alert-warning hidden">
							<span></span>
							<button type="button" class="close" onclick="$('.alert').addClass('hidden');">&times;</button>
						</div>		
									<form class="form form-horizontal" id="addbk" data-toggle="validator" method="post">
										<div class="form-group">
											<label for="book" class="col-sm-4 control-label">Book Name</label>
											<div class="col-md-8">
												<div class="input-group">
													<input type="text" class="form-control1" placeholder="Book Name" id="book" name="book" required >
												</div>
												<div class="help-block with-errors"></div>
											</div>
										</div>
										<div class="form-group">
											<label for="edtn" class="col-sm-4 control-label">Edition</label>
											<div class="col-md-8">
												<div class="input-group">
													<select id="edtn" name="edtn" required class="selectpicker select form-control">
														<option value="">Select Edition</option>
<?php
		for($i=1;$i<=20;$i++)
		{
													echo "<option value=\"$i\">$i</option>";
		}
?>
													</select>
												</div>
												<div class="help-block with-errors"></div>
											</div>
										</div>
									<div class="form-group">
											<label class="col-sm-4 control-label" for="cat">Category</label>
											<div class="col-sm-8">
												<div class="input-group">
													<select id="cat" name="cat" required class="selectpicker select form-control">
														<option value="">Select Category</option>
<?php
		//taking data from database
        $query = "SELECT * FROM `category` ORDER BY `name`";
		$result = mysqli_query($con,$query) or die(mysqli_error());
		while($obj=mysqli_fetch_object($result))
		{
													echo "<option value=\"$obj->cid\">$obj->name</option>";
		}
?>
													</select>
												</div>
												<div class="help-block with-errors"></div>
											</div>
										</div>
									<div class="form-group">
											<label class="col-sm-4 control-label" for="cat">Publisher</label>
											<div class="col-sm-8">
												<div class="input-group">
													<select id="pub" name="pub" required class="selectpicker select form-control">
														<option value="">Select Publisher</option>
<?php
		//taking data from database
        $query = "SELECT * FROM `publisher` ORDER BY `name`";
		$result = mysqli_query($con,$query) or die(mysqli_error());
		while($obj=mysqli_fetch_object($result))
		{
													echo "<option value=\"$obj->pid\">$obj->name</option>";
		}
?>
													</select>
												</div>
												<div class="help-block with-errors"></div>
											</div>
										</div>
									<div class="form-group">
											<label class="col-sm-4 control-label" for="aut">Auhtor</label>
											<div class="col-sm-8">
												<div class="input-group">
													<select id="aut" name="aut" required class="selectpicker select form-control">
														<option value="">Select Author</option>
<?php
		//taking data from database
        $query = "SELECT * FROM `author` ORDER BY `name`";
		$result = mysqli_query($con,$query) or die(mysqli_error());
		while($obj=mysqli_fetch_object($result))
		{
													echo "<option value=\"$obj->aid\">$obj->name</option>";
		}
?>
													</select>
												</div>
												<div class="help-block with-errors"></div>
											</div>
										</div>
										<div class="form-group">
											<label for="isbn" class="col-sm-4 control-label">ISBN</label>
											<div class="col-md-8">
												<div class="input-group">
													<input type="text" class="form-control1" placeholder="ISBN" id="isbn" name="isbn" required autocomplete="off">
												</div>
												<div class="help-block with-errors"></div>
											</div>
										</div>
										<div class="form-group">
										<div class="col-sm-4"></div>
										<div class="col-sm-4">
										<button type="submit" id="addautb" class="btn btn-primary">Add</button>
										</div>
										</div>
									</form>
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