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
 	<title>Enquiry Page</title>
 	<script type="text/javascript" src="../custom/js/enquiry/enquiryhome.js"></script>
 	<script type="text/javascript">
 		
 	</script>
 </head>
 <body>
 
<div class="container-fluid">
	<div class="row">
		<div class="col-md-7">
			<div class="card border-info">
			<div class="card-header bg-info text-white"><h5><b>Recently Created Enquiries</b></h5></div>
			<div class="card-body" id="rbody">
				<ul id="recentEnquiries">
					
				</ul>		
			</div>
		</div>
		</div>

<!-- Serach customer -->
		<div class="col-md-5">
			<div class="card border-info">
			<div class="card-header bg-info text-white"><h5><b>Search Enquiry</b></h5></div>
			<div class="card-body">
				<form action="enquirylist.php" method="POST" id="searchEnquiryForm">
				  <div class="form-group row">
				    <label for="searchFName" class="col-sm-3 col-form-label col-form-label-lg">First Name</label>
				    <div class="col-sm-9">
				      <input type="text" class="form-control form-control-lg" id="searchFName" name="searchFName">
				    </div>
				  </div>
				  <div class="form-group row">
				    <label for="searchLName" class="col-sm-3 col-form-label col-form-label-lg">Last Name</label>
				    <div class="col-sm-9">
				      <input type="text" class="form-control form-control-lg" id="searchLName" name="searchLName">
				    </div>
				  </div>
				  <div class="form-group row">
				    <label for="searchMobile" class="col-sm-3 col-form-label col-form-label-lg">Mobile No.</label>
				    <div class="col-sm-9">
				      <input type="mobile" class="form-control form-control-lg" id="searchMobile" name="searchMobile" oninput="this.value = this.value.replace(/[^0-9]/g, '');" maxlength="10">
				    </div>
				  </div>
				   <div class="form-group row">
				    <label for="searchCustomerbtn" class="col-sm-3 col-form-label col-form-label-lg"></label>
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