<?php 
session_start();
if (!$_SESSION) {
	header('location:/project/CARGO_BILLING_SYSTEM');
}else{
	include_once '../includes/Menu.php';
?>
<!DOCTYPE html>
<html>
<head>
	<title>Booking</title>
	<script type="text/javascript" src="../custom/js/booking/bookingdetail.js"></script>
</head>
<body>

<div class="submenu" id="submenu">
	 <a href="../booking/" class="active" name="bookinghome">Booking Home</a>
	 <a href="bookinglist.php" class="unactive" name="bookinglist" >Booking List</a>
	 <a id="sub" class="menu_icon icon" onclick="myFunction2()">
	 <i class="fa fa-bars"></i>
	 </a>

</div>

<div class="container-fluid" style="margin-top: 15px;">
	<div class="row">
		<div class="col-md-7">
			<div class="card border-info">
			<div class="card bg-info text-white">
				<div style="margin:5px 0px 0px 10px; "><h5><b>Recently Created Booking</b></h5></div>
			</div>
			<div class="card-body" id="rbody">
				<ul id="recentBooking">
				</ul>		
			</div>
		</div>
		</div>

<!-- Serach customer -->
		<div class="col-md-5">
			<div class="card border-info">
			<div class="card bg-info text-white">
				<div style="margin:5px 0px 0px 10px; "><h5><b>Search Booking</b></h5></div>
			</div>
			<div class="card-body">
				<form action="bookinglist.php" method="POST" id="searchBookingForm">
				  <div class="form-group row">
				    <label for="searchBookingNo" class="col-sm-3 col-form-label">Booking No</label>
				    <div class="col-sm-9">
				      <input type="text" class="form-control" id="searchBookingNo" name="searchBookingNo">
				    </div>
				  </div>
				  <div class="form-group row">
				    <label for="searchBookingDate" class="col-sm-3 col-form-label">Booking Date</label>
				    <div class="col-sm-9">
				      <input type="text" class="form-control" id="searchBookingDate" name="searchBookingDate" maxlength="5">
				    </div>
				  </div>
				  
				   <div class="form-group row">
				    <label for="searchCustomerbtn" class="col-sm-3 col-form-label"></label>
				    <div class="col-sm-9">
				     <button id="searchCustomerbtn" name="searchCustomerbtn" type="submit" class="btn btn-primary btn-larg btn-block"><b>Search</b></button>
				    </div>
				  </div>
				</form>			
			</div>
		</div>

	</div>
	

	</div>
</div>		

</body>
</html>
<?php } ?>