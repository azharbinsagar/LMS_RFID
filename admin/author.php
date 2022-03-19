<?php require('admin_session.php'); 
		require_once('../assets/include/config.php');
		$con = connectTo();
// If form submitted, insert values into the database.
if ($_SERVER["REQUEST_METHOD"] == "POST"){
		/*********** VALIDATE ALL VARIABLES ************/
		if($_REQUEST['aut'] == ""){
			respond("error","empty");
		}

		$aut = sqlReady($_REQUEST['aut']);
		 mysqli_query($con,"SELECT * FROM `author` WHERE `name` = '$aut'") or die(mysqli_error($con));//check for 
				if(mysqli_affected_rows($con) == '1'){
					respond("error","exists");
				}

	//inserting values to table
        $query1 = "INSERT INTO `author` (`aid`, `name`) VALUES (NULL, '$aut')";
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
<title>Admin Manage Authors :: Library Administration using RFID</title>
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
	$("#tblauthor").dataTable(); //for data table
		
	  $("#addaut").submit(function() {
    var data = {};
    $("#addaut input").each(function(k,v) {
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
          case 'exists' : 
            $('.alert span').html('This Author already exists!');
            $('.alert').removeClass('hidden');
            $('.alert').addClass('alert-danger');
            break;
          case 'none' :
            $('.alert span').html('<img src="../assets/images/success.jpg"> <Strong>Success</strong>, New Author is added. ');
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

	$('.remove_aut').click(function(e){
	   e.preventDefault();   
	   var aid = $(this).attr('aid');
	   var parent = $(this).parent("td").parent("tr");   
	   bootbox.dialog({
			backdrop: false,
			message: "Are you sure you want to Remove this Author?",
			title: "<i class='glyphicon glyphicon-remove-sign'></i> Remove Author!",
			buttons: {
				success: {
					  label: "No",
					  className: "btn-success",
					  callback: function() {
					  $('.bootbox').modal('hide');
				  }
				},
				danger: {
				  label: "Remove!",
				  className: "btn-danger",
				  callback: function() {
				   $.ajax({        
						type: 'POST',
						url: 'process_removeaut.php',
						data: 'aid='+aid
				   })
				   .done(function(response){    
						bootbox.alert({message: response, backdrop: false});
						parent.fadeOut('slow');
						//window.location="";
				   })
				   .fail(function(){        
						bootbox.alert({message: "Error...", backdrop: false});               
				   })              
				  }
				}
			}
	   });   
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
						<h4>Add a new Author:</h4><br>
						<div class="alert alert-warning hidden">
							<span></span>
							<button type="button" class="close" onclick="$('.alert').addClass('hidden');">&times;</button>
						</div>		
									<form class="form form-inline" id="addaut" data-toggle="validator" method="post">
										<div class="form-group">
											<label for="aut" class="col-sm-4 control-label">Author Name</label>
											<div class="col-md-8">
												<div class="input-group">
													<input type="text" class="form-control1" placeholder="Author" id="aut" name="aut" required >
												</div>
												<div class="help-block with-errors"></div>
											</div>
										</div>
										<div class="form-group">
										<button type="submit" id="addautb" class="btn btn-primary">Add</button>
										</div>
									</form>
    	</div>
    	<h2>Authors List</h2>
    	<div class="blankpage-main">	
						<div class="table table-responsive">
						<h4>Author Details Table:</h4><br>
							<table class="table table-hover" id="tblauthor">
							<thead> <tr> <th>S.No</th> <th>Author</th> <th>Delete?</th></tr> </thead>
							<tbody> 
						

<?php 
//taking data from database
        $query = "SELECT * FROM `author` ORDER BY `name`";
		$result = mysqli_query($con,$query) or die(mysqli_error($con));
		$c=1;
		while($obj=mysqli_fetch_object($result))
		{	
			echo "<tr> <td>$c</td>";
                    echo"
                        <td>$obj->name</td>
						<td><a class=\"remove_aut\" aid=\"$obj->aid\" href=\"javascript:void(0)\">
						<i class=\"glyphicon glyphicon-trash\"></i></a></td>
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