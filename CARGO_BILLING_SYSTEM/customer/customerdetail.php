<?php
session_start();
if (!$_SESSION) {
	header('location:/project/CARGO_BILLING_SYSTEM');
}else{
	require_once "../includes/header.php";
	require_once "../includes/datagrid.php";
	include_once '../includes/Menu.php';

	if (isset($_GET['Customer_Id'])) {
		$customerid = $_GET['Customer_Id'];
	}else{
		$customerid = "";
	}

?>

<!DOCTYPE html>
<html>
<head>
	<title>Customer Detail</title>
	
	<script type="text/javascript" src="../custom/js/customerdetail.js"></script>
	<script type="text/javascript">
		
		$(document).ready(function(){
			// $("#state" ).combobox();
			// alert("ok");
		});
	</script>
</head>
<body>
<div class="submenu" id="submenu">
		  <a href="../customer" class="unactive" name="Invoice">Search</a>
		  <a href="customerlist.php" class="active" name="Inventory">Customer Detail</a>
		  
		  <a id="sub" class="menu_icon icon" onclick="myFunction2()">
		    <i class="fa fa-bars"></i>
		  </a>
</div>

<div class="container-fluid" style="margin-top: 15px;">
<!-- Serach customer -->
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
						      <input type="text" class="form-control" name="firstname" id="firstname">
						    </div>
						  </div>
						  <div class="row">
						    <label for="middlename" class="col-sm-3 col-form-label-lg">Middle Name :</label>
						   	<div class="col-sm-8">
						      <input type="text" class="form-control" name="middlename" id="middlename">
						    </div>
						  </div>
						  <div class="row">
						    <label for="lastname" class="col-sm-3 col-form-label-lg">Last Name :</label>
						    <div class="col-sm-8">
						      <input type="text" class="form-control" name="lastname" id="lastname">
						    </div>
						  </div>
						  <div class="row">
						    <label for="relation" class="col-sm-3 col-form-label-lg">Relation :</label>
						    <div class="col-sm-8">
						      <select class="custom-select" name="relation" id="relation">
						      	<option value=""></option>
						      	<option value="SO">SO</option>
						      	<option value="DO">DO</option>
						      	
						      </select>
						    </div>
						  </div>
						  <div class="row">
						    <label for="relationname" class="col-sm-3 col-form-label-lg">Relation Name :</label>
						    <div class="col-sm-8">
						      <input type="text" class="form-control" name="relationname" id="relationname" autocomplete="false">
						    </div>
						  </div>
						  <div class="row">
						    <label for="mobilenum" class="col-sm-3 col-form-label-lg">Mobile No.:<span class="required">*</span></label>
						    <div class="col-sm-8">
						      <input type="text" class="form-control" name="mobilenum" id="mobilenum" maxlength="10" oninput="this.value = this.value.replace(/[^0-9]/g, '');">
						    </div>
						  </div>
						  <div class="row">
						    <label for="email" class="col-sm-3 col-form-label-lg">E-mail :</label>
						    <div class="col-sm-8">
						      <input type="email" class="form-control" name="email" id="email">
						    </div>
						  </div>
						  <div class="row">
						    <label for="gender" class="col-sm-3 col-form-label-lg">Gender :<span class="required">*</span></label>
						    <div class="col-sm-8">
						      <select class="custom-select" name="gender" id="gender">
						      	<option value="Male">Male</option>
						      	<option value="Female">Female</option>
						      </select>
						    </div>
						  </div>
						  
						 </div>

						 <!-- Customer Address -col-2 -->
				   		<div class="col-md-6">
						  <div class="row">
						  
						    <label for="address1" class="col-sm-3 col-form-label-lg">Address 1 :<span class="required">*</span></label>
						   
						    <div class="col-sm-8">
						      <input type="text" class="form-control" name="address1" id="address1">
						    </div>
						  </div>
						  <div class="row">
						    <label for="address2" class="col-sm-3  col-form-label-lg">Address 2 :</label>
						    <div class="col-sm-8">
						      <input type="text" class="form-control" name="address2" id="address2">
						    </div>
						  </div>
						  <div class="row">
						    <label for="state" class="col-sm-3 col-form-label-lg">State:<span class="required">*</span></label>
						    <div class="col-sm-8">
						      <select id="state" name="state" class="custom-select">
						      	<option value=""></option>
						      </select>
						    </div>
						  </div>
						  <div class="row">
						    <label for="city" class="col-sm-3 col-form-label-lg">City:<span class="required">*</span></label>
						    <div class="col-sm-8">
						      <select id="city" name="city" class="custom-select">
						      	<option value=""></option>
						      </select>
						    </div>
						  </div>
						  <div class="row">
						    <label for="pincode" class="col-sm-3 col-form-label-lg">PinCode :<span class="required">*</span></label>
						    <div class="col-sm-8">
						      <input type="text" class="form-control" name="pincode" id="pincode" maxlength="6" oninput="this.value = this.value.replace(/[^0-9]/g, '');">
						    </div>
						  </div>

						  <div class="row">
						    <label for="gstin" class="col-sm-3 col-form-label-lg">GSTIN:</label>
						    <div class="col-sm-8">
						      <input type="text" class="form-control" name="gstin" id="gstin" maxlength="15">
						    </div>
						  </div>
						  <div class="row">
						    <label for="CreatedDate" class="col-sm-3 col-form-label-lg">Created Date:</label>
						    <div class="col-sm-8">
						      <input type="date" class="form-control" name="CreatedDate" id="CreatedDate" disabled="true">
						    </div>
						  </div>
						  <div class="row">
						    <label for="customerid" class="col-sm-3 col-form-label-lg">Customer ID :</label>
						    <div class="col-sm-8">
						      <input type="text" class="form-control" name="customerid" id="customerid" value="<?php echo $customerid; ?>" disabled>
						      <input type="hidden" class="form-control" name="customerid2" id="customerid2" value="<?php echo $customerid; ?>">
						    </div>
						  </div>
						</div>
						 </div>
					</form>
					<div class="container d-flex justify-content-center" style="width:110px;">
						<button class="btn btn-success btn-block" type="button" id="saveCustomerDetail" style="font-size: 20px; font-variant: bold;">Save</button>
					</div>
			</div>
		</div>
</div>


<div class="container-fluid" style="margin-top: 15px;">

<!-- acitivites -->
	<div class="nav nav-pills border border-info ">
		<a id="customer_enquiry" href="#mtoc" class="nav-item nav-link active" data-toggle="tab">Enquiry</a>
		<a id="customer_activity" href="#activities" class="nav-item nav-link" data-toggle="tab">Activities</a>


<div class="tab-content container-fluid">

<!-- for Enquiry Button -->
	<div class="tab-pane active" id="mtoc">
		
		<div class="card border-info">
			<div class="text-white" style="background-color: lightblue;">
				<div class="row gridheader-row">
				<select class="custom-select col-sm-2 gridheader" style="margin-left: 20px;">
					<option>A</option>
					<option>B</option>
				</select>
				<input class="form-control col-sm-2 gridheader" type="text" name="" role="button">
				<a id="btngo" href="javascript:void(0);" class="link-non gridheader"><i class="fa fa-arrow-circle-right" style="margin-right: 8px;"></i>Go</a>
				<a href="javascript:void(0);" class="link-non gridheader" data-toggle="modal" data-target="" id="customerEnquiryMenu"><i class="fa fa-cog" aria-hidden="false" style="margin-right: 8px;"></i>Menu</a>
				<a href="javascript:void(0);" class="link-non gridheader" data-toggle="modal" data-target="#newEnquiry"><i class="fa fa-plus" style="margin-right: 8px;"></i>New</a>
				<a href="javascript:void(0);" class="link-non gridheader" data-toggle="modal" data-target="#queryEnquiry"><i class="fa fa-search" style="margin-right: 8px;"></i>Query</a>
				<div id="enquiry_list_pager_info" style="margin: 12px 0px 0px 25px; font-size: 18px;"></div>
				</div>
			</div>
			<div class="card-body padd0">
				<div id="enquiry_table_grid">ere</div>
			</div>
		</div>

	</div>

	<!-- for activities button -->
	<div class="tab-pane" id="activities">
		<div class="card border-info">
			<div class="text-white" style="background-color: lightblue;">
				<div class="row gridheader-row">
				<select class="custom-select col-sm-2 gridheader" style="margin-left: 20px;">
					<option>A</option>
					<option>B</option>
				</select>
				<input class="form-control col-sm-2 gridheader" type="text" name="" role="button">
				<a id="ago" href="javascript:void(0);" class="link-non gridheader"><i class="fa fa-arrow-circle-right" style="margin-right: 8px;"></i>Go</a>
				<a href="javascript:void(0);" class="link-non gridheader"><i class="fa fa-cog" aria-hidden="false" style="margin-right: 8px;"></i>Menu</a>
				<a href="javascript:void(0);" class="link-non gridheader"><i class="fa fa-plus" style="margin-right: 8px;"></i>New</a>
				<a href="javascript:void(0);" class="link-non gridheader"><i class="fa fa-search" style="margin-right: 8px;"></i>Query</a>
				<div id="activity_list_pager_info" style="margin: 12px 0px 0px 25px; font-size: 18px;"></div>
				</div>
			</div>
			<div class="card-body padd0">
				<div id="activity_table_grid"></div>
			</div>
		</div>
	</div>

</div><!-- tab-content -->

</div><!-- nav-tabs -->
</div><!-- container-div -->


<!-- Enquiry Query Modal -->
<div class="modal fade" id="queryEnquiry" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalCenterTitle">Query Enquiry</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        ...
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Save changes</button>
      </div>
    </div>
  </div>
</div><!-- End Enquiry Query Modal -->

<!-- Enquiry Creation Modal -->
<div class="modal fade" id="newEnquiry" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalCenterTitle">Create Enquiry</h5>
        <button id="closeEnquiryModalbtn" name="closeEnquiryModalbtn" type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form id="newEnquiryForm" method="post">
        		<!-- 1st Row -->
			  <div class="form-row">
			  	<div class="form-group col-md-4">
			      <label for="inputEnqType">Enquiry Type</label>
			      <select id="inputEnqType" name="inputEnqType" class="form-control">
			        <option value="" selected></option>
			        <option value="Walk-In">Walk-In</option>
			        <option value="Phone">Phone</option>
			        <option value="Email">Email</option>
			        <option value="Outdoor">Outdoor</option>
			      </select>
			    </div>
			  
			    <div class="form-group col-md-4">
			      <label for="inputEnqSource">Enquiry Source</label>
			      <select id="inputEnqSource" name="inputEnqSource" class="form-control">
			        <option value="" selected></option>
			        <option class="Banner">Banner</option>
			        <option class="Canopy">Canopy</option>
			        <option class="Demo-Van">Demo Van</option>
			        <option class="Facebook">Facebook</option>
			        <option class="Friend">Friend</option>
			        <option class="Hoarding">Hoarding</option>
			        <option class="Leaflet">Leaflet</option>
			        <option class="Mela">Mela</option>
			        <option class="Newspaper">Newspaper</option>
			        <option class="Radio">Radio</option>
			        <option class="Relative">Relative</option>
			        <option class="Roadshow">Roadshow</option>
			        <option class="TV">TV</option>
			        <option class="Tag">Tag</option>
			        <option class="Websites">Websites</option>
			        <option class="Workshop">Workshop</option>
			      </select>
			    </div>
			    <div class="form-group col-md-4">
			      <label for="inputEnqCate">Enquiry Category</label>
			      <select id="inputEnqCate" name="inputEnqCate" class="form-control">
			        <option value="" selected></option>
			        <option value="Individual">Individual</option>
			        <option value="Institutional">Institutional</option>
			        <option value="Best-Deal-Vehicle">Best Deal Vehicle</option>
			      </select>
			    </div>
			  </div>
			  <!-- 2nd Row -->
			  <div class="form-row">
			  			    
			    <div class="form-group col-md-4">
			      <label for="inputPurType">Purchase Type</label>
			    	<!-- <div id="inputPurType" class="form-control">er</div> -->
			      <select id="inputPurType" name="inputPurType" class="form-control" width="500">
			        <option value="" selected></option>
			        <option value="Cash">Cash</option>
			        <option value="Finance">Finance</option>
			      </select>
			    </div>
			    <div class="form-group col-md-4">
			      <label for="inputDSE">Assigned To (DSE)</label>
			      <select id="inputDSE" name="inputDSE" class="form-control">
			        <option value="" selected></option>
			      </select>
			    </div>
			    <div class="form-group col-md-4">
			      <!-- <label for="inputFinancier">Financier</label>
			      <select id="inputFinancier" name="inputFinancier" class="form-control">
			        <option value="" selected></option>
			      </select> -->
			      <input type="hidden" class="form-control" name="customerid" id="customerid" value="<?php echo $customerid; ?>">
			    </div>
			    
			  </div>
			  <!-- 3rd Row -->
			  <div class="form-row">
			  	<div class="form-group col-md-4">
			      <label for="inputModelCate">Model Category</label>
			      <select id="inputModelCate" name="inputModelCate" class="form-control">
			        <option value="" selected></option>
			        <option value="SC">SC</option>
			        <option value="MC">MC</option>
			      </select>
			    </div>
			    <div class="form-group col-md-4">
			      <label for="inputModelName">Model Name</label>
			      <select id="inputModelName" name="inputModelName" class="form-control">
			        <option value="" selected></option>
			      </select>
			      <!-- <input id="inputModelName"> -->
			    </div>
			    <div class="form-group col-md-4">
			      <label for="inputModelVariant">Model Variant</label>
			      <select id="inputModelVariant" name="inputModelVariant" class="form-control">
			        <option value="" selected></option>
			      </select>
			    </div>
			    
			  </div>
			  <!-- 4th Row -->
			  <div class="form-row">
			  	
			  </div>
			  
      </div>
      <div class="modal-footer">
        <button id="cancelEnquiryModalbtn" type="reset" name="cancelEnquiryModalbtn" type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        </form>
        <button id="createEnquiryModalbtn" name="createEnquiryModalbtn" class="btn btn-primary">Create</button>
      </div>
    </div>
  </div>
</div><!-- End Query Enquiry Modal -->

<!-- New Enquiry DSE List -->
<div class="modal fade" id="searchDSE" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalCenterTitle">DSE List</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div id="searchDSEGrid">dselist</div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal" id="canceDSEbtn">Cancel</button>
        <button type="button" class="btn btn-primary" id="selectDSEbtn">Select</button>
      </div>
    </div>
  </div>
</div><!-- End Enquiry DSE List Modal -->

 

</body>
</html>
<?php } ?>