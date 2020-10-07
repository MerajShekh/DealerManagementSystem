<?php 
session_start();
if (!$_SESSION) {
	header('location:/project/CARGO_BILLING_SYSTEM');
}else{
	include_once '../includes/Menu.php';
	require_once "../includes/datagrid.php";
?>
<!DOCTYPE html>
<html>
<head>
	<title>Booking List</title>
	<script type="text/javascript" src="../custom/js/booking/bookingdetail.js"></script>
</head>
<body>
	<!-- Start of SubMenu -->
<div class="submenu" id="submenu">
	 <a href="../booking/" class="unactive" name="bookinghome">Booking Home</a>
	 <a href="bookinglist.php" class="active" name="bookinglist" >Booking List</a>
	 <a id="sub" class="menu_icon icon" onclick="myFunction2()">
	 <i class="fa fa-bars"></i>
	 </a>

</div> <!-- End of SubMenu -->

<div class="container-fluid" style="margin-top: 15px;">

	<div class="tab-pane" id="enquiryList">
		
		<div class="card border-info">
			<div class="card text-white" style="background-color: lightblue;">
				<div class="row gridheader-row">
				<select class="custom-select col-sm-2 gridheader" style="margin-left: 20px;">
					<option>A</option>
					<option>B</option>
				</select>
				<input id="searchEnquiryListfield" class="form-control col-sm-2 gridheader" type="text" name="searchEnquiryListfield">
				<a id="c-l-go" href="javascript:void(0);" class="link-non gridheader"><i class="fa fa-arrow-circle-right" style="margin-right: 8px;"></i>Go</a>
				<a href="javascript:void(0);" class="link-non gridheader"><i class="fa fa-cog" aria-hidden="false" style="margin-right: 8px;"></i>Menu</a>
				<a href="javascript:void(0);" class="link-non gridheader"><i class="fa fa-plus" style="margin-right: 8px;"></i>New</a>
				<a href="javascript:void(0);" class="link-non gridheader"><i class="fa fa-search" style="margin-right: 8px;"></i>Query</a>
				<div id="enquiryListTablePager" style="margin: 10px 0px 0px 35px; font-size: 18px;"></div>
				</div>
			</div>
			<div class="card-body padd0">
				<div id="enquiryListTableGrid"></div> <!-- customerDataTable -->
			</div>
		</div>
	</div>
</div><!-- container-div -->



<div class="container-fluid">
<!-- customer detail -->
			<div class="card border-info">
				<!-- Panel header -->
			<div class="card bg-info text-white">
				<div style="margin:5px 0px 0px 10px; "><h5><b>Customer</b></h5></div>
							
			</div> <!-- //panel header -->

			<div class="card-body">
					<!--  -->
					<form>
						<br>
						<b>Model Selection</b>
						<hr>						
						<div class="row">
							<div class="col-sm-4">
								<div class="form-group col-sm-10">
								    <label for="model_category" class="col-form-label">Model Category :<span class="required">*</span></label>
								      <select class="custom-select" name="model_category">
								      	<option value=""></option>
								      	<option value="sc">SC</option>
								      	<option value="mc">MC</option>
								      </select>
							  	</div>
							</div>

							<div class="col-sm-4">
								<div class="form-group col-sm-10">
								    <label for="model_name" class="col-form-label">Model Name :<span class="required">*</span></label>
								      <select class="custom-select" name="model_name">
								      	<option value=""></option>
								      	<option value="sc">ACTIVA 5G</option>
								      	<option value="mc">CB SHINE</option>
								      </select>
								   
							  </div>
							</div>

							<div class="col-sm-4">
								<div class="form-group col-sm-10">
								    <label for="model_variant" class="col-form-label">First Name :<span class="required">*</span></label>
								      <select class="custom-select" name="model_variant">
								      	<option value=""></option>
								      	<option value="">ACTIVA 5G STD</option>
								      	<option value="mc">CB SHINE DRUM</option>
								      </select>
							  	</div>
							</div>
						</div>

						<br>
						<b>Enquiry</b>
						<hr>
						<div class="bg-warning"></div>

						<div class="row">
						<!-- Customer detail -col-1 -->
							<div class="col-sm-3">
								<div class="form-group col-sm-12">
									  <label for="title" class="col-form-label">Title:<span class="required">*</span></label>
									  <input type="text" class="form-control" name="title" id="title" disabled>							  
							 	</div>

							 	<div class="form-group col-sm-12">
									  <label for="enquiry_id" class="col-form-label">Enquiry Id:<span class="required">*</span></label>
									  <input type="text" tabindex="0" class="form-control" name="enquiry_id" id="enquiry_id" disabled>							  
							 	</div>

						 		<div class="form-group col-sm-12">
									  <label for="enquiry_date" class="col-form-label">Enquiry Date:<span class="required">*</span></label>
									  <input type="text" class="form-control" name="enquiry_date" id="enquiry_date" disabled>							  
							 	</div>

							 	<div class="form-group col-sm-12">
									  <label for="sales_stage" class="col-form-label">Sales Stage:<span class="required">*</span></label>
									  <select class="custom-select" name="customer_category">
								      	<option value=""></option>
								      	<option value="co">New</option>
								      	<option value="so">Booking</option>
								      	<option value="do">Invoice</option>
								      	<option value="do">Cancelled</option>
								      </select>							  
							 	</div>

							 	<div class="form-group col-sm-12">
									  <label for="enquiry_type" class="col-form-label">Enquiry Type:<span class="required">*</span></label>
									  <select class="custom-select" name="customer_category" disabled>
								      	<option value=""></option>
								      	<option value="co">C/O</option>
								      	<option value="so">S/O</option>
								      	<option value="do">D/O</option>
								      </select>							  
							 	</div>

							 	<div class="form-group col-sm-12">
									  <label for="enquiry_source" class="col-form-label">Enquiry Source:<span class="required">*</span></label>
									  <select class="custom-select" name="customer_category" disabled>
								      	<option value=""></option>
								      	<option value="co">C/O</option>
								      	<option value="so">S/O</option>
								      	<option value="do">D/O</option>
								      </select>							  
							 	</div>

							 	

							</div>

						 <!-- Customer Address -col-2 -->
				   			
				   			<div class="col-sm-3">
								<div class="form-group">
									  <label for="first_name" class="col-form-label">Customer Firt Name:<span class="required">*</span></label>
									  <input type="text" class="form-control" name="first_name" id="first_name" disabled>							  
							 	</div>

							 	<div class="form-group">
									  <label for="purchase_type" class="col-form-label">Purchase Type:<span class="required">*</span></label>
									  <select class="custom-select" name="purchase_type">
								      	<option value=""></option>
								      	<option value="co">Cash</option>
								      	<option value="so">Credit</option>
								      	<option value="do">Finance</option>
								      </select>							  
							 	</div>

							 	<div class="form-group">
									  <label for="financeir" class="col-form-label">Financier:</label>
									  <input type="text" class="form-control" name="financeir" id="financeir">							  
							 	</div>

							 	<div class="form-group">
									  <label for="insurance" class="col-form-label">Insurance:</label>
									  <input type="text" class="form-control" name="insurance" id="insurance">							  
							 	</div>

							 	<div class="form-group">
									  <label for="customer_type" class="col-form-label">Customer Type:<span class="required">*</span></label>
									 <select class="custom-select" name="customer_category">
								      	<option value=""></option>
								      	<option value="co">C/O</option>
								      	<option value="so">S/O</option>
								      	<option value="do">D/O</option>
								      </select>							  
							 	</div>

							 	<div class="form-group">
									  <label for="customer_category" class="col-form-label">Customer Category:<span class="required">*</span></label>
									 <select class="custom-select" name="customer_category" readonly="YES">
								      	<option value=""></option>
								      	<option value="co">C/O</option>
								      	<option value="so">S/O</option>
								      	<option value="do">D/O</option>
								      </select>	  
							 	</div>

							</div>

						 <!-- Customer Address -col-3 -->

						 <div class="col-sm-3">
								<div class="form-group">
									  <label for="middle_name" class="col-form-label">Customer Middle Name:<span class="required">*</span></label>
									  <input type="text" class="form-control" name="middle_name" id="middle_name">							  
							 	</div>

							 	<div class="form-group">
									  <label for="credit_note" class="col-form-label">Credit Note #:</label>
									  <input type="text" class="form-control" name="credit_note" id="credit_note">							  
							 	</div>

							 	<div class="form-group">
									  <label for="created_by" class="col-form-label">CreatedBy:</label>
									  <input type="textarea" class="form-control" name="created_by" id="created_by" disabled>							  
							 	</div>
							 	<div class="form-group">
									  <label for="assign_dse" class="col-form-label">Assigned To (DSE):<span class="required">*</span></label>
									  <input type="textarea" class="form-control" name="assign_dse" id="assign_dse">							  
							 	</div>
							 	<div class="form-group">
									  <label for="assign_dse_name" class="col-form-label">Assigned To (DSE) Name:</label>
									  <input type="textarea" class="form-control" name="assign_dse_name" id="assign_dse_name" disabled>							  
							 	</div>
							 	<div class="form-group">
									  <label for="enquiry_category" class="col-form-label">Enquiry Category:<span class="required">*</span></label>
									  <select class="custom-select" name="enquiry_category" disabled>
								      	<option value=""></option>
								      	<option value="co">C/O</option>
								      	<option value="so">S/O</option>
								      	<option value="do">D/O</option>
								      </select>							  
							 	</div>
							</div>

						 <!-- Customer Address -col-4 -->
						 <div class="col-sm-3">
								<div class="form-group">
									  <label for="last_name" class="col-form-label">Customer Last Name:<span class="required">*</span></label>
									  <input type="text" class="form-control" name="last_name" id="last_name">							  
							 	</div>
							 	<div class="form-group">
									  <label for="followup_date" class="col-form-label">FollowUp Date:</label>
									  <input type="text" class="form-control" name="follow_date" id="follow_date">
							 	</div>

							 	<div class="form-group custom-control custom-checkbox">
									  <input type="checkbox" class="custom-control-input" name="folloup_flag" id="folloup_flag">
									  <label for="folloup_flag" class="custom-control-label">FollowUp Flag:</label>			  
							 	</div>

							 	<div class="form-group">
									  <label for="test_ride_date" class="col-form-label">Test Ride Date:</label>
									  <input type="text" class="form-control" name="test_ride_date" id="test_ride_date">							  
							 	</div>

							 	<div class="form-group custom-control custom-checkbox">
									  <input type="checkbox" class="custom-control-input" name="test_ride_flag" id="test_ride_flag">
									  <label for="test_ride_flag" class="custom-control-label">Test Ride Flag:</label>			  
							 	</div>

							 	<div class="form-group">
									  <label for="remark" class="col-form-label">Remark:</label>
									  <textarea class="form-control" rows="2" cols="10" name="remark" id="remark"></textarea>							  
							 	</div>

							</div>
						</div>
						<!-- lost Enquiry information -->
						<br>
						<b>Lost Enquiry Information</b>
						<hr>						
						<div class="row">
							<div class="col-sm-3">
								<div class="form-group col-sm-12">
								    <label for="closure_reason" class="col-form-label">Closure Reason :</label>
								      <select class="custom-select" name="closure_reason">
								      	<option value=""></option>
								      	<option value="sc">SC</option>
								      	<option value="mc">MC</option>
								      </select>
							  	</div>
							</div>

							<div class="col-sm-3">
								<div class="form-group">
								    <label for="make_lost_to" class="col-form-label">Make Lost To:</label>
								      <select class="custom-select" name="make_lost_to">
								      	<option value=""></option>
								      	<option value="sc">ACTIVA 5G</option>
								      	<option value="mc">CB SHINE</option>
								      </select>
							  </div>
							</div>

							<div class="col-sm-3">
								<div class="form-group">
								    <label for="model_lost_to" class="col-form-label">Model Lost To:</label>
								      <select class="custom-select" name="model_lost_to">
								      	<option value=""></option>
								      	<option value="">ACTIVA 5G STD</option>
								      	<option value="mc">CB SHINE DRUM</option>
								      </select>
							  	</div>
							</div>
							<div class="col-sm-3">
								<div class="form-group">
								    <label for="closure_remark" class="col-form-label">Closure Remarks:</label>
								      <select class="custom-select" name="closure_remark">
								      	<option value=""></option>
								      	<option value="">ACTIVA 5G STD</option>
								      	<option value="mc">CB SHINE DRUM</option>
								      </select>
							  	</div>
							</div>

						</div>

					</form>
			</div><!-- card-body -->

		</div>
</div>



</body>
</html>
<?php } ?>