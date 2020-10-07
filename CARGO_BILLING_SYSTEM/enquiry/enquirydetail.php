<?php
session_start();
if (!$_SESSION) {
	header('location:/project/CARGO_BILLING_SYSTEM');
}else{
	require_once "../includes/header.php";
	require_once "../includes/datagrid.php";
	include_once '../includes/Menu.php';

		if (isset($_GET['Enquiry_No'])) {
				$enquiryno = $_GET['Enquiry_No'];
			}else{
				$enquiryno = "";
			}
?>
<!DOCTYPE html>
<html>
<head>
	<title>Enquiry List</title>
	<script type="text/javascript" src="../custom/js/enquiry/enquirydetail.js"></script>
</head>
<body>
<div class="submenu" id="submenu">
	  <a href="../enquiry" class="unactive" name="enquiryHome" >Enquiries Home</a>
	  <a href="enquiryList.php" class="unactive" name="enquiryList">Enquiries List</a>
	  <a id="sub" class="menu_icon icon" onclick="myFunction2()">
    <i class="fa fa-bars"></i></a>
</div>

<div class="container-fluid" style="margin-top: 15px;">
<!-- customer detail -->
			<div class="card border-info">
				<!-- Panel header -->
			<div class="card bg-info text-white">
				<div style="margin:5px 0px 0px 10px;"><h5><b>Enquiry</b></h5>
				</div>
			</div> <!-- //panel header -->

			<div class="card-body">
					<!--  -->
					<form id="enquiryDetailForm" method="post">
						<br>
						<b>Model Selection</b>
						<hr>						
						<div class="row">
							<div class="col-sm-4">
								<div class="form-group col-sm-10">
								    <label for="model_category" class="col-form-label">Model Category :<span class="required">*</span></label>
								      <select class="custom-select" name="model_category" id="model_category">
								      	<option value="SC">SC</option>
								      	<option value="MC">MC</option>
								      </select>
							  	</div>
							</div>

							<div class="col-sm-4">
								<div class="form-group col-sm-10">
								    <label for="model_name" class="col-form-label">Model Name :<span class="required">*</span></label>
								      <select class="custom-select" name="model_name" id="model_name">
								      	<option value=""></option>
								      	
								      </select>
							  </div>
							</div>

							<div class="col-sm-4">
								<div class="form-group col-sm-10">
								    <label for="model_variant" class="col-form-label">Model Variant :<span class="required">*</span></label>
								      <select class="custom-select" name="model_variant" id="model_variant">
								      	<option value=""></option>
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
									  <input type="text" tabindex="0" class="form-control" name="enquiry_id" id="enquiry_id" value="<?php echo $enquiryno; ?>" disabled>
									  <input type="hidden" tabindex="0" class="form-control" name="enquiry_id" id="enquiry_id" value="<?php echo $enquiryno; ?>">							  
							 	</div>

						 		<div class="form-group col-sm-12">
									  <label for="enquiry_date" class="col-form-label">Enquiry Date:<span class="required">*</span></label>
									  <input type="date" class="form-control" name="enquiry_date" id="enquiry_date" disabled>							  
							 	</div>

							 	<div class="form-group col-sm-12">
									  <label for="sales_stage" class="col-form-label">Sales Stage:<span class="required">*</span></label>
									  <input class="form-control" type="text" name="stage" id="stage" disabled>
							 	</div>

							 	<div class="form-group col-sm-12">
									  <label for="enquiry_type" class="col-form-label">Enquiry Type:<span class="required">*</span></label>
									  <select class="custom-select" name="enquiry_type" id="enquiry_type" disabled>
								      	<option value=""></option>
								      	
								      </select>							  
							 	</div>

							</div>

						 <!-- Customer Address -col-2 -->
				   			
				   			<div class="col-sm-3">
								<div class="form-group">
									  <label for="first_name" class="col-form-label">Customer Firt Name:<span class="required">*</span></label>
									  <input type="text" class="form-control" name="first_name" id="first_name" disabled>
									  <input type="hidden" class="form-control" name="customerid" id="customerid">					  
							 	</div>

							 	<div class="form-group">
									  <label for="purchase_type" class="col-form-label">Purchase Type:<span class="required">*</span></label>
									  <select class="custom-select" name="purchase_type" id="purchase_type">
								      	<option value="Cash">Cash</option>
								      	<option value="Finance">Finance</option>
								      </select>							  
							 	</div>

							 	<div class="form-group">
									  <label for="financeir" class="col-form-label">Financier:</label>
									  <select class="custom-select" name="financier" id="financier">
									  	<option value=""></option>
								      </select>							  
							 	</div>

							 	<div class="form-group">
									  <label for="assign_dse" class="col-form-label">Assigned To (DSE):<span class="required">*</span></label>
									  <select class="custom-select" name="assign_dse" id="assign_dse">
								      	<option value=""></option>
								      </select>				  
							 	</div>

							 	<div class="form-group">
									  <label for="enquiry_source" class="col-form-label">Enquiry Source:<span class="required">*</span></label>
									  <select class="custom-select" name="enquiry_source" id="enquiry_source" disabled>
								      	<option value=""></option>
								      	
								      </select>							  
							 	</div>

							</div>

						 <!-- Customer Address -col-3 -->

						 <div class="col-sm-3">
								<div class="form-group">
									  <label for="middle_name" class="col-form-label">Customer Middle Name:<span class="required">*</span></label>
									  <input type="text" class="form-control" name="middle_name" id="middle_name" disabled="true">							  
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
									  <label for="assign_dse_name" class="col-form-label">Assigned To (DSE) Name:</label>
									  <input type="textarea" class="form-control" name="assign_dse_name" id="assign_dse_name" disabled>							  
							 	</div>
							 	<div class="form-group">
									  <label for="enquiry_category" class="col-form-label">Enquiry Category:<span class="required">*</span></label>
									  <select class="custom-select" name="enquiry_category" id="enquiry_category" disabled>
								      	<option value=""></option>
								      </select>							  
							 	</div>
							</div>

						 <!-- Customer Address -col-4 -->
						 <div class="col-sm-3">
								<div class="form-group">
									  <label for="last_name" class="col-form-label">Customer Last Name:<span class="required">*</span></label>
									  <div class="input-group">
									  <input type="text" class="form-control" name="last_name" id="last_name" disabled="true">
									  <div class="input-group-prepend" id="listdialog-parent">
									  	<div class="input-group-text" id="listdialog"><i class="fas fa-address-book"></i></div>
									  </div>
									  </div>
									  
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
									  <input type="date" class="form-control" name="test_ride_date" id="test_ride_date">							  
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
								      <select class="custom-select" name="closure_reason" id="closure_reason">
								      	<option value="A">A</option>
								      	<option value="Cash">Cash</option>
								      	<option value="Finance">Finance</option>
								      	<option value="Credit">Credit</option>
								      </select>
							  	</div>
							</div>

							<div class="col-sm-3">
								<div class="form-group">
								    <label for="make_lost_to" class="col-form-label">Make Lost To:</label>
								      <select class="custom-select" name="make_lost_to" id="make_lost_to">
								      	<option value=""></option>
								      	
								      </select>
							  </div>
							</div>

							<div class="col-sm-3">
								<div class="form-group">
								    <label for="model_lost_to" class="col-form-label">Model Lost To:</label>
								      <select class="custom-select" name="model_lost_to" id="model_lost_to">
								      	<option value=""></option>
								      	<option value="">ACTIVA 5G STD</option>
								      	<option value="mc">CB SHINE DRUM</option>
								      </select>
							  	</div>
							</div>
							<div class="col-sm-3">
								<div class="form-group">
								    <label for="closure_remark" class="col-form-label">Closure Remarks:</label>
								      <select class="custom-select" name="closure_remark" id="closure_remark">
								      	<option value=""></option>
								      	<option value="">ACTIVA 5G STD</option>
								      	<option value="mc">CB SHINE DRUM</option>
								      </select>
							  	</div>
							</div>

						</div>

					</form>
					<div class="container d-flex justify-content-center" style="width:110px;">
						<button class="btn btn-success btn-block" type="button" id="saveEnquiryDetail" style="font-size: 18px; font-variant: bold;">Save</button>
					</div>
			</div><!-- card-body -->

		</div>
</div>


<div class="container-fluid" style="margin-top: 15px;">

<!-- acitivites -->
	<div class="nav nav-pills border border-info ">
		<a id="enquiryMTOC" href="#mtoc" class="nav-item nav-link active" data-toggle="tab">MOTC</a>
		<a id="enquiryActivity" href="#activities" class="nav-item nav-link" data-toggle="tab">Activities</a>
		<a id="enquiryBooking" href="#bookingGrid" class="nav-item nav-link" data-toggle="tab">Booking</a>
		<a id="enquiryCustomer" href="#customer" class="nav-item nav-link" data-toggle="tab">Customer</a>


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
				<a href="javascript:void(0);" class="link-non gridheader"><i class="fa fa-cog" aria-hidden="false" style="margin-right: 8px;"></i>Menu</a>
				<div id="mtoc_list_pager_info" style="margin: 10px 0px 0px 25px; font-size: 18px;"></div>
				</div>
			</div>
			<div class="card-body padd0">
				<div id="mtoc_table_grid">dsre</div>
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
				<a href="javascript:void(0);" class="link-non gridheader" data-toggle="modal" data-target="#newEnquiry"><i class="fa fa-plus" style="margin-right: 8px;"></i>New</a>
				<a href="javascript:void(0);" class="link-non gridheader" data-toggle="modal" data-target="#queryEnquiry"><i class="fa fa-search" style="margin-right: 8px;"></i>Query</a>
				<div id="activity_list_pager_info" style="margin: 10px 0px 0px 25px; font-size: 18px;"></div>
				</div>
			</div>
			<div class="card-body padd0">
				<div id="activity_table_grid"></div>
			</div>
		</div>
	</div>

	<!-- for Booking button -->
	<div class="tab-pane" id="bookingGrid">
		<div class="card border-info">
			<div class="text-white" style="background-color: lightblue;">
				<div class="row gridheader-row">
					<button class="btn btn-success" id="createNewBooking" name="createNewBooking" style="margin: 0px 0px 0px 20px; font-size: 20px;">Create Booking</button>
				<select class="custom-select col-sm-2 gridheader" style="margin-left: 20px;">
					<option>A</option>
					<option>B</option>
				</select>
				<input class="form-control col-sm-2 gridheader" type="text" name="">
				<a id="ago" href="javascript:void(0);" class="link-non gridheader"><i class="fa fa-arrow-circle-right" style="margin-right: 8px;"></i>Go</a>
				<a href="javascript:void(0);" class="link-non gridheader"><i class="fa fa-cog" aria-hidden="false" style="margin-right: 8px;"></i>Menu</a>
				<a href="javascript:void(0);" class="link-non gridheader" data-toggle="modal" data-target="#queryEnquiry"><i class="fa fa-search" style="margin-right: 8px;"></i>Query</a>
				<div id="booking_list_pager_info" style="margin: 10px 0px 0px 25px; font-size: 18px;"></div>
				</div>
			</div>
			<div class="card-body padd0">
				<div id="booking_table_grid"></div>
			</div>
		</div>
	</div>

	<!-- for customer button -->
	<div class="tab-pane" id="customer">
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
				<a href="javascript:void(0);" class="link-non gridheader" data-toggle="modal" data-target="#newEnquiry"><i class="fa fa-plus" style="margin-right: 8px;"></i>New</a>
				<a href="javascript:void(0);" class="link-non gridheader" data-toggle="modal" data-target="#queryEnquiry"><i class="fa fa-search" style="margin-right: 8px;"></i>Query</a>
				<div id="customer_list_pager_info" style="margin: 10px 0px 0px 25px; font-size: 18px;"></div>
				</div>
			</div>
			<div class="card-body padd0">
				<div id="customer_table_grid"></div>
			</div>
		</div>
	</div>

</div><!-- tab-content -->

</div><!-- nav-tabs -->
</div><!-- container-div -->

 
<div class="modal fade" id="CustomerListModal" tabindex="-1" role="dialog" aria-labelledby="CustomerListModal" aria-hidden="true" >
  <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
    <div class="modal-content" >
      <div class="modal-header">
        <h5 class="modal-title" id="CustomerListModal">Customer List</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body" >
      	<div class="card border-info" >
			<div class="card text-white" style="background-color: lightblue;">
				<div class="row gridheader-row" style=" margin: 0px;">
				<select class="custom-select col-sm-2 gridheader" style="margin-left: 20px;">
					<option value="">--select--</option>
					<option>B</option>
				</select>
				<input id="searchtxt" class="form-control col-sm-2 gridheader" type="text" name="searchtxt">
				<a id="c-l-go" href="javascript:void(0);" class="link-non" style=" margin-top: 9px; font-size: 22px;"><i class="fa fa-arrow-circle-right" ></i>Go</a>
				<div id="pagelist" style="margin: 10px 0px 0px 35px; font-size: 20px;"></div>
				</div>
			</div>
			<div class="card-body padd0">
				<div id="customerListGrid"></div> <!-- customerDataTable -->
				<input type="hidden" name="selectcustomerid" id="selectcustomerid">
			</div>
		</div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal" id="canceCustomerbtn">Cancel</button>
        <button type="button" class="btn btn-primary" id="selectCustomerbtn">Select</button>
      </div>
    </div>
  </div>
</div><!-- End Enquiry DSE List Modal -->

<div class="modal fade" id="MTOCProductListModal" tabindex="-1" role="dialog" aria-labelledby="CustomerListModal" aria-hidden="true" >
  <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
    <div class="modal-content" >
      <div class="modal-header">
        <h5 class="modal-title" id="CustomerListModal">Product List</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body" >
      	<div class="card border-info" >
			<div class="card text-white" style="background-color: lightblue;">
				<div class="row gridheader-row" style=" margin: 0px;">
				<select class="custom-select col-sm-2 gridheader" style="margin-left: 20px;">
					<option value="">--select--</option>
					<option>B</option>
				</select>
				<input id="searchtxt" class="form-control col-sm-2 gridheader" type="text" name="searchtxt">
				<a id="c-l-go" href="javascript:void(0);" class="link-non" style=" margin-top: 9px; font-size: 22px;"><i class="fa fa-arrow-circle-right" ></i>Go</a>
				<div id="mtocproductlistPager" style="margin: 10px 0px 0px 35px; font-size: 20px;"></div>
				</div>
			</div>
			<div class="card-body padd0">
				<div id="mtocproductlistGrid"></div> <!-- customerDataTable -->
				<input type="hidden" name="selectedmodelcode" id="selectedmodelcode">
				<input type="hidden" name="selectedmodeltype" id="selectedmodeltype">
				<input type="hidden" name="selectedcolorid" id="selectedcolorid">
			</div>
		</div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal" id="canceMTOCbtn" name="canceMTOCbtn">Cancel</button>
        <button type="button" class="btn btn-primary" id="selectMTOCbtn" name="selectMTOCbtn">Select</button>
      </div>
    </div>
  </div>
</div><!-- End MTOC product List Modal -->


</body>
</html>
<?php } ?>