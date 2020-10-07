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
 	<title>Customer Page</title>
 	<script type="text/javascript" src="../custom/js/searchCustomer.js"></script>
 	<script type="text/javascript">
 		
		$(document).ready(function(){
			// alert("hoel");

		});
	
 	</script>
 </head>
 <body>
 
<div class="container-fluid">
	<div class="row">
		<div class="col-md-7">
			<div class="card border-info">
			<div class="card-header bg-info text-white"><h5><b>Recently Added Customers</b></h5></div>
			<div class="card-body" id="rbody">
				<ul id="recentCustomer">
					
				</ul>		
			</div>
		</div>
		</div>

<!-- Serach customer -->
		<div class="col-md-5">
			<div class="card border-info">
			<div class="card-header bg-info text-white"><h5><b>Search Customer</b></h5></div>
			<div class="card-body">
				<form action="customerlist.php" method="POST" id="searchCustomerForm">
				  <div class="form-group row">
				    <label for="searchFName" class="col-sm-3 col-form-label">First Name</label>
				    <div class="col-sm-9">
				      <input type="text" class="form-control" id="searchFName" name="searchFName">
				    </div>
				  </div>
				  <div class="form-group row">
				    <label for="searchLName" class="col-sm-3 col-form-label">Last Name</label>
				    <div class="col-sm-9">
				      <input type="text" class="form-control" id="searchLName" name="searchLName">
				    </div>
				  </div>
				  <div class="form-group row">
				    <label for="searchMobile" class="col-sm-3 col-form-label">Mobile No.</label>
				    <div class="col-sm-9">
				      <input type="mobile" class="form-control" id="searchMobile" name="searchMobile" oninput="this.value = this.value.replace(/[^0-9]/g, '');" maxlength="10">
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
			<!-- Add new customer -->
			<div class="card border-info" style="margin-top: 25px;">
			<div class="card-header bg-info text-white"><h5><b>Add Customer</b></h5></div>
			<div class="card-body">
				<form action="customerlist.php" method="POST" id="addCustomerForm">
				  <div class="form-group row">
				    <label for="addFName" class="col-sm-3 col-form-label">First Name:<span class="required">*</span></label>
				    <div class="col-sm-9">
				      <input type="text" class="form-control" name="addFName" id="addFName" oninput="this.value = this.value.toUpperCase();" required='true'>
				    </div>
				  </div>
				  <div class="form-group row">
				    <label for="addMobile" class="col-sm-3 col-form-label">Mobile No.:<span class="required">*</span></label>
				    <div class="col-sm-9">
				      <input type="text" class="form-control" name="addMobile" id="addMobile" oninput="this.value = this.value.replace(/[^0-9]/g, '').replace(/(\..*)\./g, '$1');" autocomplete="true" maxlength="10" minlength="10" required="true">
				    </div>
				  </div>
				  <div class="form-group row">
						    <label for="addGender" class="col-sm-3 col-form-label">Gender :<span class="required">*</span></label>
						    <div class="col-sm-9">
						      <select class="form-control" name="addGender" id="addGender" required="true">
						      	<option value=""></option>
						      	<option value="Male">Male</option>
						      	<option value="Female">Female</option>
						      </select>
						    </div>
						  </div>
					<div class="form-group row">
				    <div class="col-sm-3 col-form-label"></div>
				    <div class="col-sm-9">
				      <input type="hidden" class="form-control" id="customerId" name="customerId">
				    </div>
				  </div>
				   <div class="form-group row">
				    <label for="addCustomerbtn" class="col-sm-3 col-form-label"></label>
				    <div class="col-sm-9">
				     <button type="button" class="btn btn-primary btn-larg btn-block" id="addCustomerbtn" name="addCustomerbtn"><b>Add</b></button>
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