<?php
session_start();
if (!$_SESSION) {
	header('location:/project/CARGO_BILLING_SYSTEM');
}else{
	include_once '../includes/Menu.php';
	require_once "../includes/datagrid.php";

		if (isset($_GET['Booking_No'])) {
				$bookingno = $_GET['Booking_No'];
			}else{
				$bookingno = "";
			}
?>
<!DOCTYPE html>
<html>
<head>
	<title>Booking List</title>
	<script type="text/javascript" src="../custom/js/booking/bookingdetail.js"></script>
	<style>
  .ui-autocomplete {
    height: 200px;
    /*overflow-y: auto;*/
    /* prevent horizontal scrollbar */
    overflow-x: hidden;
  }
  .custom-combobox {
    position: relative;
    display: inline-block;
  }
  .custom-combobox-toggle {
    position: absolute;
    top: 0;
    bottom: 0;
    height: 30px;
    margin-left: -1px;
    padding: 0;
  }
  .custom-combobox-input {
    margin: 0;
    padding: 5px 10px;
    height: 30px;
  }
  </style>
</head>
<body>
<!-- Start of SubMenu -->
<div class="submenu" id="submenu">
	 <a href="../booking/" class="unactive" name="bookinghome">Booking Home</a>
	 <a href="bookinglist.php" class="unactive" name="bookinglist" >Booking List</a>
	 <a id="sub" class="menu_icon icon" onclick="myFunction2()">
	 <i class="fa fa-bars"></i>
	 </a>
</div> <!-- End of SubMenu -->

<div class="container-fluid" style="margin-top: 15px;">
<!-- customer detail -->
			<div class="card border-info">
				<!-- Panel header -->
			<div class="card bg-info text-white">
				<div style="margin:5px 0px 0px 10px;"><h5><b>Booking</b></h5>
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
						<b>Booking Details</b>
						<hr>
						<div class="bg-warning"></div>

						<div class="row">
						<!-- Customer detail -col-1 -->
							<div class="col-sm-3">
								<div class="form-group col-sm-12">
									  <label for="title" class="col-form-label">Title:</label>
									  <input type="text" class="form-control" name="title" id="title" disabled>							  
							 	</div>

							 	<div class="form-group col-sm-12">
									  <label for="booking_no" class="col-form-label">Booking #:<span class="required">*</span></label>
									  <input type="text" tabindex="0" class="form-control" name="booking_no" id="booking_no" value="<?php echo $bookingno; ?>" disabled>
									  <input type="hidden" tabindex="0" class="form-control" name="booking_no" id="booking_no" value="<?php echo $bookingno; ?>">							  
							 	</div>

						 		<div class="form-group col-sm-12">
									  <label for="booking_date" class="col-form-label">Booking Date:</label>
									  <input type="date" class="form-control" name="booking_date" id="booking_date" disabled>							  
							 	</div>

							 	<div class="form-group col-sm-12">
									  <label for="sales_stage" class="col-form-label">Status:</label>
									  <input type="text" class="form-control" name="stauts" id="status" disabled>
							 	</div>

							</div>

						 <!-- Customer Address -col-2 -->
				   			
				   			<div class="col-sm-3">
								<div class="form-group">
									  <label for="first_name" class="col-form-label">Firt Name:<span class="required">*</span></label>
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
									  <label for="finance_amount" class="col-form-label">Finance Amount:</label>
									  <input class="form-control" type="text" name="finance_amount" id="finance_amount" maxlength="6">
							 	</div>

							</div>

						 <!-- Customer Address -col-3 -->

						 <div class="col-sm-3">
								<div class="form-group">
									  <label for="middle_name" class="col-form-label">Middle Name:</label>
									  <input type="text" class="form-control" name="middle_name" id="middle_name" disabled="true">							  
							 	</div>

							 	<div class="form-group">
									  <label for="booking_total" class="col-form-label">Booking Total:</label>
									  <input type="text" class="form-control" name="booking_total" id="booking_total" disabled>							  
							 	</div>

							 	<div class="form-group">
									  <label for="total_payment" class="col-form-label">Total Payment:</label>
									  <input type="textarea" class="form-control" name="total_payment" id="total_payment" disabled>							  
							 	</div>
							 	
							 	<div class="form-group">
									  <label for="balance_payment" class="col-form-label">Balance Payment</label>
									  <input type="textarea" class="form-control" name="balance_payment" id="balance_payment" disabled>							  
							 	</div>
							 	
							</div>

						 <!-- Customer Address -col-4 -->
						 <div class="col-sm-3">
								<div class="form-group">
									  <label for="last_name" class="col-form-label">Last Name:</label>
									  <div class="input-group">
									  <input type="text" class="form-control" name="last_name" id="last_name" disabled="true">
									  <div class="input-group-prepend" id="listdialog-parent">
									  	<div class="input-group-text" id="listdialog"><i class="fas fa-address-book"></i></div>
									  </div>
									  </div>
									  
							 	</div>
							 	<div class="form-group">
									  <label for="expected_date" class="col-form-label">Expected Delivery Date:</label>
									  <input type="date" class="form-control" name="expected_date" id="expected_date">
							 	</div>

							 	<div class="form-group">
									  <label for="expected_reason" class="col-form-label">Expected Delivery Reason:</label>
									  <select id="expected_reason" name="expected_reason" class="custom-select">
									  	<option value=""></option>
									  	<option value="Customer_Require">Customer Require</option>
									  	<option value="Vehicle_Unavailable">Vehicle Not Available</option>
									  </select>
							 	</div>

							 	<div class="form-group custom-control custom-checkbox">
									  <input type="checkbox" class="custom-control-input" name="FinanceApprove" id="FinanceApprove">
									  <label for="FinanceApprove" class="custom-control-label">Finance Approved?</label>
							 	</div>

							 	<div class="form-group">
									  <label for="remark" class="col-form-label">Remark:</label>
									  <textarea class="form-control" rows="2" cols="10" name="remark" id="remark"></textarea>							  
							 	</div>

							</div>
						</div>

					</form>
					<div class="container d-flex justify-content-center" style="width:110px;">
						<button class="btn btn-success btn-block" type="button" id="saveBookingDetail" style="font-size: 18px; font-variant: bold;">Save</button>
					</div>
			</div><!-- card-body -->

		</div>
</div>


<div class="container-fluid" style="margin-top: 15px;">

<!-- acitivites -->
	<div class="nav nav-pills border border-info ">
		<a id="customerDetailTab" href="#customerDetailModal" class="nav-item nav-link" data-toggle="tab">Customer Details</a>
		<a id="lineItemTab" href="#lineItemModel" class="nav-item nav-link active" data-toggle="tab">Line Items</a>
		<a id="paymentTab" href="#paymentModal" class="nav-item nav-link" data-toggle="tab">Payment</a>
		<a id="vehicleAllotmentTab" href="#vehicleAllotmentModal" class="nav-item nav-link" data-toggle="tab">Vehicle Allotment</a>
		<a id="invoiceTab" href="#invoiceModal" class="nav-item nav-link" data-toggle="tab">Invoice</a>


<div class="tab-content container-fluid">

<!-- for Enquiry Button -->
	<div class="tab-pane" id="customerDetailModal">
		
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
				<div id="customer_detail_pager_info" style="margin: 10px 0px 0px 25px; font-size: 18px;"></div>
				</div>
			</div>
			<div class="card-body padd0">
				<div id="customer_detail_grid">Customer Data</div>
			</div>
		</div>

	</div>

	<!-- for activities button -->
	<div class="tab-pane active" id="lineItemModel">
		<div class="card border-info">
			<div class="text-white" style="background-color: lightblue;">
				<div class="row gridheader-row">
				<button class="btn btn-success" id="getPrice" name="getPrice" style="margin: 5px 0px 0px 20px; font-size: 18px; height: 40px;">Get Price</button>
				<select class="custom-select col-sm-2 gridheader" style="margin-left: 20px;">
					<option>A</option>
					<option>B</option>
				</select>
				<input class="form-control col-sm-2 gridheader" type="text" name="" role="button">
				<a id="lineItemGobtn" href="javascript:void(0);" class="link-non gridheader"><i class="fa fa-arrow-circle-right" style="margin-right: 8px;"></i>Go</a>
				<a href="javascript:void(0);" class="link-non gridheader"><i class="fa fa-cog" aria-hidden="false" style="margin-right: 8px;"></i>Menu</a>
				<a href="javascript:void(0);" class="link-non gridheader" data-toggle="modal" data-target="#queryLineItem"><i class="fa fa-search" style="margin-right: 8px;"></i>Query</a>
				<a href="javascript:void(0);" id="saveLineItem" class="link-non gridheader"><i class="fa fa-file" style="margin-right: 8px;"></i>Save</a>
				<div id="lineitems_pager_info" style="margin: 10px 0px 0px 25px; font-size: 18px;"></div>
				</div>
			</div>
			<div class="card-body padd0">
				<!-- <div id="lineitems_table_grid"></div> -->
				<div class="table-responsive" id="lineitemtable">
				  <table class="table table-bordered">
				  	<thead>
				  		<tr>
				  			<th>Product</th>
				  			<th style="width: 5%;">Model Category</th>
				  			<th>Model Name</th>
				  			<th>Model Variant</th>
				  			<th style="width: 8%;">Ex-Showroom Price</th>
				  			<th style="width: 5%;">Hypothecation Charge</th>
				  			<th style="width: 5%;">Insurance</th>
				  			<th style="width: 5%;">Road Tax</th>
				  			<th style="width: 5%;">Discount</th>
				  			<th style="width: 7%;">Billing Price</th>
				  			<th style="width: 5%;">Taxable Amount</th>
				  			<th style="width: 4%;">CGST%</th>
				  			<th style="width: 5%;">CGST Amount</th>
				  			<th style="width: 4%;">SGST%</th>
				  			<th style="width: 5%;">SGST Amount</th>
				  		</tr>
				  	</thead>
				  	<tbody>
				  		<form class="form-inline" id="lineItemForm">
					    	<tr>
					    		<td><div class="input-group">
					    			<input type="hidden" name="bookingno" id="bookingno" value="<?php echo $bookingno; ?>">
					    			<input type="text" class="form-control" id="lineItemProduct" name="lineItemProduct">
					    			<div class="input-group-prepend" id="listdialog-parent">
					    				<div class="input-group-text" id="productListDialog"><i class="fas fa-search"></i></div>
					    			</div></div></td>
					    		<td><input type="text" class="form-control" id="lineItemModelCategory" name="lineItemModelCategory" readonly></td>
					    		<td><input type="text" class="form-control" id="lineItemModelName" name="lineItemModelName" readonly></td>
					    		<td><input type="text" class="form-control" id="lineItemModelVariant" name="lineItemModelVariant" readonly></td>
					    		<td><input type="text" class="form-control" id="lineItemExShowroom" name="lineItemExShowroom" readonly></td>
					    		<td><input type="text" class="form-control" id="lineItemHypothecation" name="lineItemHypothecation" maxlength="6"></td>
					    		<td><input type="text" class="form-control" id="lineItemInsurance" name="lineItemInsurance" maxlength="6"></td>
					    		<td><input type="text" class="form-control" id="lineItemTax" name="lineItemTax" maxlength="6"></td>
					    		<td><input type="text" class="form-control" id="lineItemDiscount" name="lineItemDiscount" maxlength="6"></td>
					    		<td><input type="text" class="form-control" id="lineItemBillingPrice" name="lineItemBillingPrice" readonly></td>
					    		<td><input type="text" class="form-control" id="lineItemTaxable" name="lineItemTaxable" readonly></td>
					    		<td><input type="text" class="form-control" id="lineItemCGSTRate" name="lineItemCGSTRate" readonly></td>
					    		<td><input type="text" class="form-control" id="lineItemCGSTValue" name="lineItemCGSTValue" readonly></td>
					    		<td><input type="text" class="form-control" id="lineItemSGSTRate" name="lineItemSGSTRate" readonly></td>
					    		<td><input type="text" class="form-control" id="lineItemSGSTValue" name="lineItemSGSTValue" readonly>
					    			<input type="hidden" name="setPrice" id="setPrice">
					    		</td>
					    	</tr>
				    	</form>
				  	</tbody>
				  </table>
				  <!-- <div class="">r</div> -->
				</div>
			</div>
		</div>
	</div>

	<!-- for Booking button -->
	<div class="tab-pane" id="paymentModal">
		<div class="card border-info">
			<div class="text-white" style="background-color: lightblue;">
				<div class="row gridheader-row">
				<button class="btn btn-success" id="addNewPayment" name="addNewPayment" style="margin: 5px 0px 0px 20px; font-size: 18px; height: 40px;"><i class="fa fa-plus"></i> Payment</button>	
				<select class="custom-select col-sm-2 gridheader" style="margin-left: 20px;">
					<option>A</option>
					<option>B</option>
				</select>
				<input class="form-control col-sm-2 gridheader" type="text" name="">
				<a id="paymentGobtn" href="javascript:void(0);" class="link-non gridheader"><i class="fa fa-arrow-circle-right" style="margin-right: 8px;"></i>Go</a>
				<a href="javascript:void(0);" class="link-non gridheader"><i class="fa fa-cog" aria-hidden="false" style="margin-right: 8px;"></i>Menu</a>
				<a href="javascript:void(0);" class="link-non gridheader" data-toggle="modal" data-target="#queryPayment"><i class="fa fa-search" style="margin-right: 8px;"></i>Query</a>
				<div id="payment_pager_info" style="margin: 10px 0px 0px 25px; font-size: 18px;"></div>
				</div>
			</div>
			<div class="card-body padd0">
				<div id="payment_table_grid">No Data To Show</div>
			</div>
		</div>
	</div>

	<!-- for customer button -->
	<div class="tab-pane" id="vehicleAllotmentModal">
		<div class="card border-info">
			<div class="text-white" style="background-color: lightblue;">
				<div class="row gridheader-row">
				<select class="custom-select col-sm-2 gridheader" style="margin-left: 20px;">
					<option>A</option>
					<option>B</option>
				</select>
				<input class="form-control col-sm-2 gridheader" type="text" name="" role="button">
				<a id="frameGobtn" href="javascript:void(0);" class="link-non gridheader"><i class="fa fa-arrow-circle-right" style="margin-right: 8px;"></i>Go</a>
				<a href="javascript:void(0);" class="link-non gridheader"><i class="fa fa-cog" aria-hidden="false" style="margin-right: 8px;"></i>Menu</a>
				
				<a href="javascript:void(0);" class="link-non gridheader" id="queryFrameAllotment"><i class="fa fa-search" style="margin-right: 8px;"></i>Query</a>
				<a href="javascript:void(0);" id="deAllocateFrame" class="link-non" style="margin: 15px 0px 0px 25px; font-size: 17px; color: red; cursor: pointer;"><i class="fa fa-trash"> Delete Frame</i></a>
				</div>
			</div>
			<!-- <div class="card-body padd0">
				<div id="vehicle_allotment_table_grid">No Data To Show</div>
			</div> -->
			<div class="card-body padd0">
				<!-- <div id="lineitems_table_grid"></div> -->
				<div class="table-responsive" id="vehicleallotmenttable">
				  <table class="table table-bordered">
				  	<thead>
				  		<tr>
				  			<th>Product</th>
				  			<th style="width: 19%;">Frame #</th>
				  			<th>Engine #</th>
				  			<th style="width: 10%;">Model Category</th>
				  			<th>Model Name</th>
				  			<th>Model Variant</th>
				  			<th>Product Description</th>
				  		</tr>
				  	</thead>
				  	<tbody>
				  		<form class="form-inline" id="frameallotForm">
					    	<tr>
					    		<td><input type="text" class="form-control" id="frameallotProduct" name="frameallotProduct" readonly></td>
					    		<td><input type="text" class="form-control custom-combobox-input ui-widget ui-widget-content ui-state-default ui-corner-left" id="frameallotFrame" name="frameallotFrame">
					    		<select id="frameCombobox"></select>
					    		</td>
					    		<td><input type="text" class="form-control" id="frameallotEngine" name="frameallotEngine" readonly></td>
					    		<td><input type="text" class="form-control" id="frameallotModelCategory" name="frameallotModelCategory" readonly></td>
					    		<td><input type="text" class="form-control" id="frameallotModelName" name="frameallotModelName" readonly></td>
					    		<td><input type="text" class="form-control" id="frameallotModelVariant" name="frameallotModelVariant" readonly></td>
					    		<td><input type="text" class="form-control" id="frameallotProductDesc" name="frameallotProductDesc" readonly></td>
					    	</tr>
				    	</form>
				  	</tbody>
				  </table>
				  <!-- <div class="">r</div> -->
				</div>
			</div>
		</div>
	</div>
	<div class="tab-pane" id="invoiceModal">
		<div class="card border-info">
			<div class="text-white" style="background-color: lightblue;">
				<div class="row gridheader-row">
					<button class="btn btn-success" id="createNewInvoice" name="createNewInvoice" style="margin: 5px 0px 0px 20px; font-size: 18px; height: 40px;">Create Invoice</button>
				<select class="custom-select col-sm-2 gridheader" style="margin-left: 20px;">
					<option>A</option>
					<option>B</option>
				</select>
				<input class="form-control col-sm-2 gridheader" type="text" name="">
				<a id="invoiceGobtn" href="javascript:void(0);" class="link-non gridheader"><i class="fa fa-arrow-circle-right" style="margin-right: 8px;"></i>Go</a>
				<a href="javascript:void(0);" class="link-non gridheader"><i class="fa fa-cog" aria-hidden="false" style="margin-right: 8px;"></i>Menu</a>
				<a href="javascript:void(0);" class="link-non gridheader" data-toggle="modal" data-target="#queryInvoice"><i class="fa fa-search" style="margin-right: 8px;"></i>Query</a>
				<div id="invoice_pager_info" style="margin: 10px 0px 0px 25px; font-size: 18px;"></div>
				</div>
			</div>
			<div class="card-body padd0">
				<div id="invoice_table_grid">No Data To Show</div>
			</div>
		</div>
	</div>

</div><!-- tab-content -->

</div><!-- nav-tabs -->
</div><!-- container-div -->


<div class="modal fade" id="addFrameModal" tabindex="-1" role="dialog" aria-labelledby="addFrameModal" aria-hidden="true" >
  <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
    <div class="modal-content" >
      <div class="modal-header">
        <h5 class="modal-title" id="addFrameModal">Customer List</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body" >
      	<div class="card border-info" >
			<div class="card text-white" style="background-color: lightblue;">
			sdaer	
			</div>
			<div class="card-body padd0">
				<div id="mtocproductlistGrid"></div> <!-- customerDataTable -->
				<input type="text" name="selectedmodelcode" id="selectedmodelcode">
				<input type="text" name="selectedmodeltype" id="selectedmodeltype">
				<input type="text" name="selectedcolorid" id="selectedcolorid">
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

<div class="modal fade" id="addPaymentModal" tabindex="-1" role="dialog" aria-labelledby="addPaymentModal" aria-hidden="true" >
  <div class="modal-dialog modal-dialog-centered modal-md" role="document">
    <div class="modal-content" >
      <div class="modal-header">
        <h5 class="modal-title" id="addPaymentModal">Add Payment</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form id="addPaymentForm" method="post">
      <div class="modal-body" >
      	<div class="card border-info" >
			<div class="card text-black" style="background-color: lightblue;">
			
			<div class="card-body" style="padding: 2%;">
			
				 <!-- 1st Row -->
				  <div class="form-row">
				  	<div class="form-group col-md-6">
				      <label for="inputPaymentAmount">Payment Amount</label>
				      <input type="text" class="form-control" id="inputPaymentAmount" name="inputPaymentAmount" maxlength="7">
				    </div>
				  
				    <div class="form-group col-md-6">
				      <label for="inputPaymentType">Payment Type</label>
				      <select id="inputPaymentType" name="inputPaymentType" class="form-control">
				        <option class="Cash">Cash</option>
				        <option class="Cheque">Cheque</option>
				      </select>
				    </div>
				  </div> <!-- //1st Row -->
				  <!-- Row-2 -->
				  <div class="form-row">
				  	<div class="form-group col-md-6">
				      <label for="inputChequeNo">Cheque DD No.</label>
				      <input type="text" class="form-control" id="inputChequeNo" name="inputChequeNo" disabled>
				    </div>
				  
				    <div class="form-group col-md-6">
				      <label for="inputBankName">Bank Name</label>
				      <input class="form-control" type="text" name="inputBankName" id="inputBankName" disabled>
				    </div>
				  </div> <!-- // Row-2 -->
				  <!-- Row-3 -->
				  <div class="form-row">
				    <div class="form-group col-md-6">
				      <label for="inputBranchName">Branch Name</label>
				      <input class="form-control" type="text" name="inputBranchName" id="inputBranchName" disabled>
				    </div>
				    <div class="form-group col-md-6">
				      <input class="form-control" type="hidden" name="inputBookingno" id="inputBookingno" value="<?php echo $bookingno;?>">
				    </div>
				  </div> <!-- // Row-3 -->
				
			</div>
			</div>
		</div>
      </div>
      <div class="modal-footer">
      	<button type="reset" class="btn btn-secondary" id="resetPaymentbtn" name="resetPaymentbtn">Reset</button>
      	</form>
        <button type="button" class="btn btn-danger" data-dismiss="modal" id="cancelPaymentbtn" name="cancelPaymentbtn">Cancel</button>
        <button type="button" class="btn btn-success" id="savePaymentbtn" name="savePaymentbtn">Add Payment</button>
        
      </div>
    </div>
  </div>
</div><!-- End MTOC product List Modal -->


<div class="modal fade" id="createInvoiceModal" tabindex="-1" role="dialog" aria-labelledby="createInvoiceModal" aria-hidden="true" >
  <div class="modal-dialog modal-dialog-centered modal-md" role="document">
    <div class="modal-content" >
      <div class="modal-header">
        <h5 class="modal-title" id="">Create Invoice</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form id="createInvoiceForm" method="post">
      <div class="modal-body" >
      	<div class="card border-info" >
			<div class="card text-black" style="background-color: lightblue;">
			<div class="card-body" style="padding: 2%;">
				 <!-- 1st Row -->
				  <div class="form-row">
				  	<div class="form-group col-md-6">
				      <label for="inputKeyNo">Key No</label>
				      <input type="text" class="form-control" id="inputKeyNo" name="inputKeyNo" maxlength="7">
				    </div>
				    <div class="form-group col-md-6">
				      <label for="inputBatteryNo">Battery No</label>
				      <input type="text" name="inputBatteryNo" id="inputBatteryNo" class="form-control">
				    </div>
				  </div> <!-- //1st Row -->
			</div>
			</div>
		</div>
      </div>
      <div class="modal-footer">
      	<button type="reset" class="btn btn-secondary" id="resetInvoicebtn" name="resetInvoicebtn">Reset</button>
      	</form>
        <button type="button" class="btn btn-danger" data-dismiss="modal" id="canceInvoicebtn" name="canceInvoicebtn">Cancel</button>
        <button type="button" class="btn btn-success" id="createInvoicebtn" name="createInvoicebtn">Add Payment</button>
      </div>
    </div>
  </div>
</div><!-- End MTOC product List Modal -->
</body>
</html>
<?php } ?>