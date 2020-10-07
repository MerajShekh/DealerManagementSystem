<?php
session_start();
if (!$_SESSION) {
	header('location:/project/CARGO_BILLING_SYSTEM');
}else{
 require_once "../includes/header.php";
 require_once "../includes/datagrid.php";
 include_once '../includes/Menu.php';

if (isset($_POST["searchCustomerbtn"])) {
	$fname = $_POST['searchFName'];
	$lname = $_POST['searchLName'];
	$mobile = $_POST['searchMobile'];
	$customerid = "";

}else if (isset($_POST["customerId"])) {
	$customerid = $_POST['customerId'];

}else if (isset($_GET["Customer_Id"])) {
	$customerid = $_GET['Customer_Id'];
	
}else{
	$mobile = "";
	$lname = "";
	$fname = "";
	$customerid = "";
}
?>

<!DOCTYPE html>
<html>
<head>
	<title>Customer Detail</title>
	<script type="text/javascript" src="../custom/js/customerlist.js"></script>
	<!-- <script type="text/javascript">
		$(document).ready(function(){


		});
	</script> -->
</head>
<body>
<div class="submenu" id="submenu">
	  <a href="../customer" class="unactive" name="Invoice">Search</a>
	  <a href="customerlist.php" class="active" name="Inventory">Customer Detail</a>
		  
	  <a id="sub" class="menu_icon icon" onclick="myFunction2()">
	   <i class="fa fa-bars"></i></a>
</div>

<input id="fname" type="hidden" name="fname" value="<?php echo $fname; ?>">
<input id="lname" type="hidden" name="lname" value="<?php echo $lname; ?>">
<input id="mobile" type="hidden" name="mobile" value="<?php echo $mobile; ?>">
<input id="customerid" type="hidden" name="customerid" value="<?php echo $customerid; ?>">
<div class="container-fluid" style="margin-top: 15px;">

	<div class="tab-pane" id="mtoc">
		
		<div class="card border-info">
			<div class="card text-white" style="background-color: lightblue;">
				<div class="row gridheader-row">
				<select class="custom-select col-sm-2 gridheader" style="margin-left: 20px;">
					<option value="">--select--</option>
					<option>B</option>
				</select>
				<input id="searchtxt" class="form-control col-sm-2 gridheader" type="text" name="searchtxt">
				<a id="c-l-go" href="javascript:void(0);" class="link-non gridheader"><i class="fa fa-arrow-circle-right" style="margin-right: 8px;"></i>Go</a>
				<a href="javascript:void(0);" class="link-non gridheader"><i class="fa fa-cog" aria-hidden="false" style="margin-right: 8px;"></i>Menu</a>
				<a href="javascript:void(0);" class="link-non gridheader"><i class="fa fa-plus" style="margin-right: 8px;"></i>New</a>
				<a href="javascript:void(0);" class="link-non gridheader"><i class="fa fa-search" style="margin-right: 8px;"></i>Query</a>
				<div id="customer_table_pager" style="margin: 10px 0px 0px 35px; font-size: 20px;"></div>
				</div>
			</div>
			<div class="card-body padd0">
				<div id="customer_table_grid"></div> <!-- customerDataTable -->
			</div>
		</div>
	</div>
</div><!-- container-div -->


<!-- Customer Information -->
<div class="container-fluid">
		<div class="card border-info">
			<div class="card bg-info text-white">
				<div style="margin:5px 0px 0px 10px; "><h5><b>Customer</b></h5></div>
							
			</div>
			<div class="card-body">
					<form id="customerDetailForm">
													
						<div class="row"><hr></div>
						<div class="background-alert"></div>

						<div class="row">

						<!-- Customer detail -col-1 -->
						<div class="col-md-6">
						  <div class="row">
						    <label for="firstname" class="col-sm-3 col-form-label-lg">First Name :<span class="required">*</span></label>
						   	<div class="col-sm-8">
						      <input type="text" class="form-control" name="firstname" id="firstname" disabled="true"><span></span>
						    </div>
						  </div>
						  <div class="row">
						    <label for="middlename" class="col-sm-3 col-form-label-lg">Middle Name :</label>
						   	<div class="col-sm-8">
						      <input type="text" class="form-control" name="middlename" id="middlename" disabled>
						    </div>
						  </div>
						  <div class="row">
						    <label for="lastname" class="col-sm-3 col-form-label-lg">Last Name :</label>
						    <div class="col-sm-8">
						      <input type="text" class="form-control" name="lastname" id="lastname" disabled="true">
						    </div>
						  </div>
						  <div class="row">
						    <label for="relation" class="col-sm-3 col-form-label-lg">Relation :</label>
						    <div class="col-sm-8">
						      <select class="custom-select" id="relation" name="relation" disabled="true">
						      	<option value=""></option>
						      	
						      </select>
						    </div>
						  </div>
						  <div class="row">
						    <label for="relationname" class="col-sm-3 col-form-label-lg">Relation Name :</label>
						    <div class="col-sm-8">
						      <input type="text" class="form-control" name="relationname" id="relationname" disabled="true">
						    </div>
						  </div>
						  <div class="row">
						    <label for="mobilenum" class="col-sm-3 col-form-label-lg">Mobile No.:<span class="required">*</span></label>
						    <div class="col-sm-8">
						      <input type="text" class="form-control" name="mobilenum" id="mobilenum" disabled="true">
						    </div>
						  </div>
						  <div class="row">
						    <label for="email" class="col-sm-3 col-form-label-lg">E-mail :</label>
						    <div class="col-sm-8">
						      <input type="email" class="form-control" name="email" id="email" disabled="true">
						    </div>
						  </div>
						  <div class="row">
						    <label for="gender" class="col-sm-3 col-form-label-lg">Gender :<span class="required">*</span></label>
						    <div class="col-sm-8">
						      <select class="custom-select" id="gender" name="gender" disabled="true">
						      	<option value="	"></option>
						      	
						      	
						      </select>
						    </div>
						  </div>
						  
						 </div>

						 <!-- Customer Address -col-2 -->
				   		<div class="col-md-6">
						  <div class="row">
						  
						    <label for="address1" class="col-sm-3 col-form-label-lg">Address 1 :<span class="required">*</span></label>
						   
						    <div class="col-sm-8">
						      <input type="text" class="form-control" name="address1" id="address1" disabled="true">
						    </div>
						  </div>
						  <div class="row">
						    <label for="address2" class="col-sm-3  col-form-label-lg">Address 2 :</label>
						    <div class="col-sm-8">
						      <input type="text" class="form-control" name="address2" id="address2" disabled="true">
						    </div>
						  </div>
						  <div class="row">
						    <label for="state" class="col-sm-3 col-form-label-lg">State :<span class="required">*</span></label>
						    <div class="col-sm-8">
						      <select class="custom-select" name="state" disabled="true" id="state">
						      	<option value=""></option>
						      </select>
						    </div>
						  </div>
						  <div class="row">
						    <label for="city" class="col-sm-3 col-form-label-lg">City:<span class="required">*</span></label>
						    <div class="col-sm-8">
						      <select id="city" name="city" class="custom-select" disabled="true">
						      	<option value=""></option>
						      </select>
						    </div>
						  </div>
						  <div class="row">
						    <label for="pincode" class="col-sm-3 col-form-label-lg">Pincode :<span class="required">*</span></label>
						    <div class="col-sm-8">
						      <input type="text" class="form-control" name="pincode" id="pincode" disabled="true">
						    </div>
						  </div>

						   

						  <div class="row">
						    <label for="gstin" class="col-sm-3 col-form-label-lg">GSTIN:</label>
						    <div class="col-sm-8">
						      <input type="text" class="form-control" name="gstin" id="gstin" disabled="true">
						    </div>
						  </div>
						  <div class="row">
						    <label for="CreatedDate" class="col-sm-3 col-form-label-lg">Created Date:</label>
						    <div class="col-sm-8">
						      <input type="text" class="form-control" name="CreatedDate" id="CreatedDate" disabled="true">
						    </div>
						  </div>
						  <div class="row">
						    <label for="customerid-2" class="col-sm-3 col-form-label-lg">Customer ID :</label>
						    <div class="col-sm-8">
						      <input type="text" class="form-control" name="customerid-2" id="customerid-2" disabled="true">
						    </div>
						  </div>
						</div>
						 </div>
					</form>
					<!-- <div class="container d-flex justify-content-center" style="width:150px;">
						<button class="btn btn-success btn-block" id="save" style="font-size: 20px; font-variant: bold;">Save</button>
					</div> -->
			</div>
		</div>
</div>


</body>
</html>
<?php } ?>