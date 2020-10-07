<?php
session_start();
if (!$_SESSION) {
  header('location:/project/CARGO_BILLING_SYSTEM');
}else{
        include_once '../includes/Menu.php';
        require_once "../includes/datagrid.php";

        if (isset($_GET['Invoice_No'])) {
                $invoiceno = $_GET['Invoice_No'];
            }else{
                $invoiceno = "";
            }
        if (isset($_POST['searchInvoiceNo'])) {
          $searchinvoiceno = $_POST['searchInvoiceNo'];
          $searchinvoicedate = $_POST['searchDate'];
        }else{
          $searchinvoiceno = "";
          $searchinvoicedate = "";
        }

?>
<!DOCTYPE html>
<html>
<head>
    <title>Booking List</title>
    <script type="text/javascript" src="../custom/js/invoice/invoice.js"></script>
    
</head>
<body>
<!-- Start of SubMenu -->
<div class="submenu" id="submenu">
     <a href="../invoice/" class="unactive" name="invoicehome">Invoice Home</a>
     <a href="invoicelist.php" class="active" name="invoicelist" >Invoice List</a>
     <a id="sub" class="menu_icon icon" onclick="myFunction2()">
     <i class="fa fa-bars"></i>
     </a>
</div> <!-- End of SubMenu -->
<input type="hidden" name="searchinvoiceno" id="searchinvoiceno" value="<?php echo $searchinvoiceno; ?>">
<input type="hidden" name="searchinvoicedate" id="searchinvoicedate" value="<?php echo $searchinvoicedate; ?>">

<div class="container-fluid" style="margin-top: 15px;">

    <div class="tab-pane" id="enquiryList">
        
        <div class="card border-info">
            <div class="card text-white" style="background-color: lightblue;">
                <div class="row gridheader-row">
                <select class="custom-select col-sm-2 gridheader" id="searchedcol" style="margin-left: 20px;">
                    <option value="">--Select--</option>
                    <option value="Invoice_No">Invoice No</option>
                    <option value="Invoice_Date">Invoice Date</option>
                    <option value="Model_Name">Model</option>
                    <option value="Model_Category">Category</option>
                    <option value="Purchase_Type">Purchase Type</option>
                    <option value="Frame">Frame</option>
                    <option value="Color_Name">Color</option>

                </select>
                <input id="searchInvoiceListfield" class="form-control col-sm-2 gridheader" type="text" name="searchInvoiceListfield">
                <a id="search-i-btn" href="javascript:void(0);" class="link-non gridheader"><i class="fa fa-arrow-circle-right" style="margin-right: 8px;"></i>Go</a>
                <a href="javascript:void(0);" id="exportbtn" class="link-non gridheader"><i class="fa fa-file-excel" aria-hidden="false" style="margin-right: 8px;"></i>Export</a>
                <a href="javascript:void(0);" class="link-non gridheader"><i class="fa fa-plus" style="margin-right: 8px;"></i>New</a>
                <a href="javascript:void(0);" class="link-non gridheader"><i class="fa fa-search" style="margin-right: 8px;"></i>Query</a>
                <div id="invoiceListTablePager" style="margin: 10px 0px 0px 35px; font-size: 18px;"></div>
                </div>
            </div>
            <div class="card-body padd0">
                <div id="invoiceListTableGrid"></div> <!-- customerDataTable -->
            </div>
        </div>
    </div>
</div><!-- container-div -->

<div class="container-fluid">
<!-- customer detail -->
            <div class="card border-info">
                <!-- Panel header -->
            <div class="card bg-info text-white">
                <div style="margin:5px 0px 0px 10px;"><h5><b>Invoice Detail</b></h5>
                </div>
            </div> <!-- //panel header -->

            <div class="card-body">
                    <!--  -->
                    <form id="invoiceDetailForm" method="post">
                        <br>
                        <b>Model Detail</b>
                        <hr>                        
                        <div class="row">
                            <div class="col-sm-4">
                                <div class="form-group col-sm-10">
                                    <label for="model_category" class="col-form-label">Model Category :<span class="required">*</span></label>
                                    <input class="form-control" type="text" name="model_category" id="model_category" disabled>
                                </div>
                            </div>

                            <div class="col-sm-4">
                                <div class="form-group col-sm-10">
                                    <label for="model_name" class="col-form-label">Model Name :<span class="required">*</span></label>
                                    <input class="form-control" type="text" name="model_name" id="model_name" disabled>
                              </div>
                            </div>

                            <div class="col-sm-4">
                                <div class="form-group col-sm-10">
                                    <label for="model_variant" class="col-form-label">Model Variant :<span class="required">*</span></label>
                                    <input class="form-control" type="text" name="model_variant" id="model_variant" disabled>
                                </div>
                            </div>
                        </div>

                        <br>
                        <b>Invoice Details</b>
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
                                      <label for="invoice_no" class="col-form-label">Invoice #:<span class="required">*</span></label>
                                      <input type="text" tabindex="0" class="form-control" name="invoice_no" id="invoice_no" value="<?php echo $invoiceno; ?>" disabled>
                                      <input type="hidden" tabindex="0" class="form-control" name="invoice_no" id="invoice_no" value="<?php echo $invoiceno; ?>">                             
                                </div>
                                <div class="form-group col-sm-12">
                                      <label for="invoice_date" class="col-form-label">Invoice Date:</label>
                                      <input type="date" class="form-control" name="invoice_date" id="invoice_date" disabled>                             
                                </div>
                                <div class="form-group col-sm-12">
                                      <label for="sales_stage" class="col-form-label">Status:</label>
                                      <input type="text" class="form-control" name="stauts" id="status" disabled>
                                </div>
                                <div class="form-group col-sm-12">
                                      <label for="BookingNo" class="col-form-label">Booking #:</label>
                                      <input type="text" class="form-control" name="BookingNo" id="BookingNo" disabled>
                                </div>
                                <div class="form-group col-sm-12">
                                      <label for="TotalAmount" class="col-form-label">Total Amount:</label>
                                      <input type="text" class="form-control" name="TotalAmount" id="TotalAmount" disabled>
                                </div>
                            </div>
                         <!-- Customer Address -col-2 -->
                            <div class="col-sm-3">
                                <div class="form-group">
                                      <label for="first_name" class="col-form-label">Firt Name:<span class="required">*</span></label>
                                      <input type="text" class="form-control" name="first_name" id="first_name" disabled>
                                </div>
                                <div class="form-group">
                                      <label for="purchase_type" class="col-form-label">Purchase Type:<span class="required">*</span></label>
                                      <input class="form-control" type="text" id="purchase_type" name="purchase_type" disabled>
                                </div>

                                <div class="form-group">
                                      <label for="financeir" class="col-form-label">Financier:</label>
                                      <input class="form-control" type="text" name="financier" id="financier" disabled>
                                </div>
                                <div class="form-group">
                                      <label for="finance_amount" class="col-form-label">Finance Amount:</label>
                                      <input class="form-control" type="text" name="finance_amount" id="finance_amount" disabled>
                                </div>
                                <div class="form-group">
                                      <label for="CancellationDate" class="col-form-label">Cancellation Date:</label>
                                      <input class="form-control" type="text" name="CancellationDate" id="CancellationDate" disabled>
                                </div>
                                <div class="form-group">
                                      <label for="CancellationReason" class="col-form-label">Cancellation Reason:</label>
                                      <input class="form-control" type="text" name="CancellationReason" id="CancellationReason">
                                </div>
                            </div>
                         <!-- Customer Address -col-3 -->
                         <div class="col-sm-3">
                                <div class="form-group">
                                      <label for="middle_name" class="col-form-label">Middle Name:</label>
                                      <input type="text" class="form-control" name="middle_name" id="middle_name" disabled="true">                            
                                </div>

                                <div class="form-group">
                                      <label for="BatteryNo" class="col-form-label">Battery No:</label>
                                      <input type="text" class="form-control" name="BatteryNo" id="BatteryNo">                            
                                </div>

                                <div class="form-group">
                                      <label for="KeyNo" class="col-form-label">Key No:</label>
                                      <input type="textarea" class="form-control" name="KeyNo" id="KeyNo">                            
                                </div>
                                
                                <div class="form-group">
                                      <label for="RegistrationNo" class="col-form-label">Registration Number</label>
                                      <input type="textarea" class="form-control" name="RegistrationNo" id="RegistrationNo">                              
                                </div>
                                <div class="form-group">
                                      <label for="PaymentDate" class="col-form-label">Payment Date</label>
                                      <input type="date" class="form-control" name="PaymentDate" id="PaymentDate" disabled>                           
                                </div>
                                <div class="form-group">
                                      <label for="PaymentAmount" class="col-form-label">Payment Amount</label>
                                      <input type="textarea" class="form-control" name="PaymentAmount" id="PaymentAmount" disabled>                           
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
                                      <label for="Address1" class="col-form-label">Address1:</label>
                                      <input type="text" class="form-control" name="Address1" id="Address1" disabled>
                                </div>

                                <div class="form-group">
                                      <label for="Address2" class="col-form-label">Address2:</label>
                                      <input class="form-control" type="text" name="Address2" id="Address2" disabled>
                                </div>
                                <div class="form-group">
                                      <label for="State" class="col-form-label">State:</label>
                                      <input class="form-control" type="text" name="State" id="State" disabled>
                                </div>

                                <div class="form-group">
                                      <label for="remark" class="col-form-label">City:</label>
                                      <input class="form-control" type="text" name="City" id="City" disabled>
                                </div>
                                <div class="form-group">
                                      <label for="Zip" class="col-form-label">Zip:</label>
                                      <input class="form-control" type="text" name="Zip" id="Zip" disabled>
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