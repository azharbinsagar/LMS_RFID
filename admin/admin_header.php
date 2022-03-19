
            <!--header start here-->
				<div class="header-main">
					<div class="header-left">
							<div class="logo-name">
									 <a href="index.php"> <h2>LIBRARY AUTOMATION USING RFID</h2> 
									<!--<img id="logo" src="" alt="Logo"/>--> 
								  </a> 								
							</div>
							<div class="clearfix"> </div>
					</div>
<?php if($_SESSION){ ?>
					<div class="profile_details">
						<a href="../logout.php"><button type="button" class="btn btn-danger">Logout</button></a>
					</div>
<?php } ?>
				</div>
<!--heder end here-->
<!-- script-for sticky-nav -->
		<script>
		$(document).ready(function() {
			 var navoffeset=$(".header-main").offset().top;
			 $(window).scroll(function(){
				var scrollpos=$(window).scrollTop(); 
				if(scrollpos >=navoffeset){
					$(".header-main").addClass("fixed");
				}else{
					$(".header-main").removeClass("fixed");
				}
			 });
			 
		});
		</script>
		<!-- /script-for sticky-nav -->

<!--slider menu-->
    <div class="sidebar-menu">
		  	<div class="logo"> <a href="#" class="sidebar-icon"> <span class="fa fa-bars"></span> </a> <a href="#"> <span id="logo" ></span> 
			      <!--<img id="logo" src="" alt="Logo"/>--> 
			  </a> </div>		  
		    <div class="menu">
		      <ul id="menu" >
		        <li id="" ><a href="index.php"><i class="fa fa-home"></i><span>Home</span></a></li>
		          <li><a href="rfid.php"><i class="fa fa-credit-card">
<?php
		//taking notification data from database
		require_once('../assets/include/config.php');
		$con = connectTo();
		$rs = mysqli_query($con,"SELECT * FROM `user` WHERE `rfid` IS NULL") or die(mysqli_error());
		$nfc = mysqli_num_rows($rs);
if($nfc != 0)
	echo "<span class=\"badge badge-success\">$nfc</span>";
?>
				  </i><span>Assign User RFID</span></a></li>
		          <li><a href="author.php"><i class="fa fa-user"></i><span>Authors</span></a></li>
		          <li><a href="publisher.php"><i class="fa fa-user"></i><span>Publishers</span></a></li>
		          <li><a href="category.php"><i class="fa fa-sitemap"></i><span>Categories</span></a></li>
		          <li><a href="search.php"><i class="fa fa-search"></i><span>Search Books</span></a></li>
		         <li><a href="#"><i class="fa fa-book"></i><span>Books</span><span class="fa fa-angle-right" style="float: right"></span></a>
		         	<ul>
			            <li id="" ><a href="addbook.php">Add new Book</a></li>
			            <li id="" ><a href="book.php">View all Books</a></li>
		             </ul>
		         </li>
		          <li><a href="issuebook.php"><i class="fa fa-shopping-cart"></i><span>Issue Book</span></a></li>
		          <li><a href="returnbook.php"><i class="fa fa-shopping-cart"></i><span>Return Book</span></a></li>
		          <li><a href="user.php"><i class="fa fa-users"></i><span>View Users</span></a></li>
		      </ul>
		    </div>
	 </div><!--slide bar menu end here-->
<script>
var toggle = true;
            
$(".sidebar-icon").click(function() {                
  if (toggle)
  {
    $(".page-container").addClass("sidebar-collapsed").removeClass("sidebar-collapsed-back");
    $("#menu span").css({"position":"absolute"});
  }
  else
  {
    $(".page-container").removeClass("sidebar-collapsed").addClass("sidebar-collapsed-back");
    setTimeout(function() {
      $("#menu span").css({"position":"relative"});
    }, 400);
  }               
                toggle = !toggle;
            });
</script>


