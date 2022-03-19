<?php require('admin_session.php'); 
		require_once('../assets/include/config.php');
		$con = connectTo();
// If form submitted, insert values into the database.
if ($_SERVER["REQUEST_METHOD"] == "POST"){
		/*********** VALIDATE ALL VARIABLES ************/
		if($_REQUEST['rfid'] == "" || $_REQUEST['bcode'] == "" ){
			respond("error","empty");
		}
		$rfid = sqlReady($_REQUEST['rfid']);
		$bcode = sqlReady($_REQUEST['bcode']);
		 if(verify(PHONE,$rfid) === false) respond("error","rfl");
		 if(verify(BCODE,$bcode) === false) respond("error","bcodel");
	//rfid check
		 $rfc = mysqli_query($con,"SELECT * FROM `user` WHERE `rfid` = '$rfid'") or die("database error:". mysqli_error($con));
		 if(mysqli_num_rows($rfc) == 0){respond("error","rfid");}
	//barcode check
		 $bcc = mysqli_query($con,"SELECT * FROM `book` WHERE `barcode` = '$bcode'") or die("database error:". mysqli_error($con));
		 if(mysqli_num_rows($bcc) == 0){respond("error","bcode");}
	//user check
		$usr = mysqli_fetch_object($rfc);
		if($usr->status == 0){ respond("error","suspended"); }
	//book check
		$bk = mysqli_fetch_object($bcc);
		if($bk->issue == 1){ respond("error","issued"); }
	//inserting values to table
		$q1 = mysqli_query($con,"INSERT INTO `bookissue` (`isid`, `uid`, `bid`, `issuedate`) VALUES (NULL,'$usr->uid','$bk->bid',CURRENT_DATE())") or die(mysqli_error($con));
        $q2 = mysqli_query($con,"UPDATE `book` SET `issue` = '1' WHERE `bid` = '$bk->bid'") or die(mysqli_error($con));
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
<title>Admin Issue Book :: Library Administration using RFID</title>
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
	
    $('#rfid').on('change',function(){
        var rfid = $(this).val();
        if(rfid){
            $.ajax({
                type:'POST',
                url:'showusr.php',
                data:'rfid='+$('#rfid').val(),
                success:function(data)
						  {
					         $("#rfidr").html(data);
					         $("#bcode").focus();
					      }
            });
        }
    });
	
    $('#bcode').on('change',function(){
        var bcode = $(this).val();
        if(bcode){
            $.ajax({
                type:'POST',
                url:'showbk.php',
                data:'bcode='+$('#bcode').val(),
                success:function(data)
						  {
					         $("#bcoder").html(data);
					      }
            });
        }
    });
		
	  $("#issbk").submit(function() {
    var data = {};
    $("#issbk input").each(function(k,v) {
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
            $('.alert span').html('Invalid RFID!');
            $('.alert').removeClass('hidden');
            break;
          case 'bcodel' : 
            $('.alert span').html('Invalid BarCode!');
            $('.alert').removeClass('hidden');
            break;
          case 'rfid' : 
            $('.alert span').html('This card is not assigned to any users.!');
            $('.alert').removeClass('hidden');
            $('.alert').removeClass('alert-warning');
            $('.alert').addClass('alert-danger');
            break;
          case 'bcode' : 
            $('.alert span').html('Invalid barcode!! Book not Available.');
            $('.alert').removeClass('hidden');
            $('.alert').removeClass('alert-warning');
            $('.alert').addClass('alert-danger');
            break;
          case 'suspended' :
            $('.alert span').html('This user is currently Suspended!');
            $('.alert').removeClass('hidden');
            $('.alert').removeClass('alert-warning');
            $('.alert').addClass('alert-danger');
            break;
          case 'issued' :
            $('.alert span').html('This book is already issued to another user!');
            $('.alert').removeClass('hidden');
            $('.alert').removeClass('alert-warning');
            $('.alert').addClass('alert-danger');
            break;
          case 'none' :
            $('.alert span').html('<img src="../assets/images/success.jpg"> <Strong>Success</strong>,Book Issued to User. ');
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
						<h4>Issue Book to User:</h4><br>
						<div class="alert alert-warning hidden">
							<span></span>
							<button type="button" class="close" onclick="$('.alert').addClass('hidden');">&times;</button>
						</div>		
									<form class="form form-horizontal" id="issbk" data-toggle="validator" method="post">
										<div class="form-group">
											<label for="rfid" class="col-sm-4 control-label">User RFID</label>
											<div class="col-md-8">
												<div class="input-group">
													<input type="text" class="form-control1" placeholder="RFID" id="rfid" name="rfid" autocomplete="off" autofocus data-error="Please read the RFID card." required >
												</div>
											<span id="rfidr"></span>
											<span id="name"></span>
											<span id="user"></span>
												<div class="help-block with-errors"></div>
											</div>
										</div>
										<div class="form-group">
											<label for="bcode" class="col-sm-4 control-label">Book Barcode</label>
											<div class="col-md-8">
												<div class="input-group">
													<input type="text" class="form-control1" placeholder="Book Barcode" id="bcode" name="bcode" autocomplete="off" data-error="Please read the Barcode." required >
												</div>
											<span id="bcoder"></span>
											<span id="bname"></span>
											<span id="edtn"></span>
												<div class="help-block with-errors"></div>
											</div>
										</div>
										<div class="form-group">
										<div class="col-sm-4"></div>
										<div class="col-sm-4">
										<button type="submit" id="submit" class="btn btn-primary">Issue Book</button>
										</div>
										</div>
									</form>
    	</div>
    	<h2>Books Currently Issued</h2>
    	<div class="blankpage-main">	
						<div class="table table-responsive">
						<h4>Issued books Details Table:</h4><br>
							<table class="table table-hover" id="tbluser">
							<thead> <tr> <th>S.No</th> <th>Book Name</th><th>ISBN</th> <th>User Name</th> <th>Email</th> <th>Mobile No.</th><th>Issued On</th></tr> </thead>
							<tbody> 
						

<?php 
//taking data from database
        $query = "SELECT * FROM `bookissue` WHERE `returndate` IS NULL ORDER BY `issuedate`";
		$result = mysqli_query($con,$query) or die(mysqli_error($con));
		$c=1;
		while($obj=mysqli_fetch_object($result))
		{	$bk = mysqli_query($con,"SELECT * FROM `book` WHERE `bid` = $obj->bid") or die(mysqli_error($con));
			$bk1= mysqli_fetch_object($bk) ;
			$usr = mysqli_query($con,"SELECT * FROM `user` WHERE `uid` = $obj->uid") or die(mysqli_error($con));
			$usr1= mysqli_fetch_object($usr) ;
			 echo "<tr> <td>$c</td>
                        <td>$bk1->name</td>
                        <td>$bk1->isbn</td>
                        <td>$usr1->name</td>
                        <td>$usr1->email</td>
                        <td>$usr1->mobile</td>
                        <td>$obj->issuedate</td>
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