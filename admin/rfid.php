<?php require('admin_session.php'); 
		require_once('../assets/include/config.php');
		$con = connectTo();
// If form submitted, insert values into the database.
if ($_SERVER["REQUEST_METHOD"] == "POST"){
		/*********** VALIDATE ALL VARIABLES ************/
		if($_REQUEST['name'] == "" || $_REQUEST['rfid'] == "" ){
			respond("error","empty");
		}
		$name = sqlReady($_REQUEST['name']);
		$rfid = sqlReady($_REQUEST['rfid']);
		 if(verify(PHONE,$rfid) === false) respond("error","rfl");
		//rfid check
		 $rfc = mysqli_query($con,"SELECT * FROM `user` WHERE `rfid` = '$rfid'") or die(mysqli_error($con));
		 if(mysqli_num_rows($rfc) != 0){
				respond("error","rfid");
			}
	//inserting values to table
        $query1 = "UPDATE `user` SET `rfid` = '$rfid' WHERE `username` = '$name'";
		mysqli_query($con,$query1) or die(mysqli_error($con));
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
<title>Admin Assign RFID :: Library Administration using RFID</title>
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
	$("#tbluser").dataTable(); //for data table
		
    $('#name').on('change',function(){
        var name = $(this).val();
        if(name){
            $('#user').val(name);
            $('#rfid').prop('disabled',false);
            $('#rfid').focus();
        }else{
            $('#user').val('');
            $('#rfid').prop('disabled',true);
        }
    });
		
	  $("#addrf").submit(function() {
    var data = {};
    $("#addrf input, #addrf select").each(function(k,v) {
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
          case 'rfl' : 
            $('.alert span').html('Rfid data is not valid!');
            $('.alert').removeClass('hidden');
            break;
          case 'rfid' : 
            $('.alert span').html('This RFID is already Assigned to another User!');
            $('.alert').removeClass('hidden');
            $('.alert').removeClass('alert-warning');
            $('.alert').addClass('alert-danger');
            break;
          case 'none' :
            $('.alert span').html('<img src="../assets/images/success.jpg"> <Strong>Success</strong>,RFID detail for new User is added. ');
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
<!-- //Validation -->
    <!-- DATATABLE STYLE  -->
    <link href="../assets/plugins/datatables/dataTables.bootstrap.css" rel="stylesheet" />
    <!-- DATATABLE SCRIPTS  -->
    <script src="../assets/plugins/datatables/jquery.dataTables.js"></script>
    <script src="../assets/plugins/datatables/dataTables.bootstrap.js"></script>
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
						<h4>Assign RFID to new User:</h4><br>
						<div class="alert alert-warning hidden">
							<span></span>
							<button type="button" class="close" onclick="$('.alert').addClass('hidden');">&times;</button>
						</div>		
									<form class="form form-horizontal" id="addrf" data-toggle="validator" method="post">
									<div class="form-group">
											<label class="col-sm-4 control-label" for="name">Name</label>
											<div class="col-sm-8">
												<div class="input-group">
													<select id="name" name="name" data-error="Please select a user from the list." required class="selectpicker select form-control">
														<option value="">Select User</option>
<?php
		//taking data from database
        $query = "SELECT * FROM `user` WHERE `rfid` IS NULL ORDER BY `name`";
		$result = mysqli_query($con,$query) or die(mysqli_error());
		while($obj=mysqli_fetch_object($result))
		{
													echo "<option value=\"$obj->username\">$obj->name</option>";
		}
?>
													</select>
												</div>
												<div class="help-block with-errors"></div>
											</div>
										</div>
										<div class="form-group">
											<label for="user" class="col-sm-4 control-label">Username</label>
											<div class="col-md-8">
												<div class="input-group">
													<input type="text" class="form-control1" placeholder="Username" id="user" name="user" disabled required >
												</div>
												<div class="help-block with-errors"></div>
											</div>
										</div>
										<div class="form-group">
											<label for="rfid" class="col-sm-4 control-label">RFID</label>
											<div class="col-md-8">
												<div class="input-group">
													<input type="text" class="form-control1" placeholder="RFID" id="rfid" name="rfid" autocomplete="off" data-error="Please Read New Card" required disabled>
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
    	<h2>New Users List</h2>
    	<div class="blankpage-main">	
						<div class="table table-responsive">
						<h4>New User Details Table:</h4><br>
							<table class="table table-hover" id="tbluser">
							<thead> <tr> <th>S.No</th> <th>Name</th> <th>Username</th> <th>Email</th> <th>Mobile No.</th><th>Registered On</th></tr> </thead>
							<tbody> 
						

<?php 
//taking data from database
        $query = "SELECT * FROM `user` WHERE `rfid` IS NULL ORDER BY `name`";
		$result = mysqli_query($con,$query) or die(mysqli_error($con));
		$c=1;
		while($obj=mysqli_fetch_object($result))
		{	
			 echo "<tr> <td>$c</td>
                        <td>$obj->name</td>
                        <td>$obj->username</td>
                        <td>$obj->email</td>
                        <td>$obj->mobile</td>
                        <td>$obj->rgon</td>
                   </tr>";
			$c++;
		}
?>
							 </tbody> </table>
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