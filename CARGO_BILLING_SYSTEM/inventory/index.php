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
    <title>Vehicle Detail</title>
    <script type="text/javascript" src="../custom/js/inventory.js"></script>
    
</head>
<body>
<!-- Start of SubMenu -->
<div class="submenu" id="submenu">
     <a href="javascript:void(0);" class="unactive" name="Print">.</a>
     <a id="sub" class="menu_icon icon" onclick="myFunction2()">
     <i class="fa fa-bars"></i>
     </a>
</div> <!-- End of SubMenu -->

<div class="container-fluid" style="margin-top: 15px;">

    <div class="tab-pane" id="enquiryList">
        
        <div class="card border-info">
            <div class="card text-white" style="background-color: lightblue;">
                <div class="row gridheader-row">
                <select class="custom-select col-sm-2 gridheader" style="margin-left: 20px;" id="gridcol">
                    <option value="">--Select--</option>
                    <option value="Vehicle_Status">Vehicle Status</option>
                    <option value="Physical_Status">Physical Status</option>
                    <option value="Frame_No">Frame No</option>
                    <option value="Engine_No">Engine No</option>
                    <option value="SAP_Invoice_No">SAP Invoice No</option>
                    <option value="SAP_Invoice_Date">SAP Invoice Date</option>
                    <option value="Inventory_Location">Location</option>
                    <option value="Model_Category">Catogery</option>
                    <option value="Model_Name">Model</option>
                    <option value="Color_Name">Color</option>


                </select>
                <input id="searchVehicleData" class="form-control col-sm-2 gridheader" type="text" name="searchVehicleData">
                <a id="gobtn" href="javascript:void(0);" class="link-non gridheader"><i class="fa fa-arrow-circle-right" style="margin-right: 8px;"></i>Go</a>
                <a href="javascript:void(0);" id="exportbtn" class="link-non gridheader"><i class="fa fa-file-excel" aria-hidden="false" style="margin-right: 8px;"></i>Export</a>
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
                <div style="margin:5px 0px 0px 10px;"><h5><b>Vehicle Detail</b></h5>
                </div>
            </div> <!-- //panel header -->

            <div class="card-body">
                    <!--  -->
                    <form id="invoiceDetailForm" method="post">
                        <b>Invoice Details</b>
                        <hr>
                        <div class="bg-warning"></div>

                        <div class="row">
                        <!-- Customer detail -col-1 -->
                            <div class="col-sm-3">
                                <div class="form-group col-sm-12">
                                      <label for="frame" class="col-form-label">Frame #:</label>
                                      <input type="text" class="form-control" name="frame" id="frame" readonly>                           
                                </div>

                                <div class="form-group col-sm-12">
                                      <label for="engine" class="col-form-label">Engine #:</label>
                                      <input type="text" tabindex="0" class="form-control" name="engine" id="engine" disabled>                             
                                </div>
                                <div class="form-group col-sm-12">
                                      <label for="registration" class="col-form-label">Registration #:</label>
                                      <input type="text" class="form-control" name="registration" id="registration" maxlength="8">                             
                                </div>
                                <div class="form-group col-sm-12">
                                      <label for="physicalstatus" class="col-form-label">Physical Status:</label>
                                      <input type="text" class="form-control" name="physicalstatus" id="physicalstatus" disabled>
                                </div>
                            </div>
                         <!-- Customer Address -col-2 -->
                            <div class="col-sm-3">
                                <div class="form-group">
                                      <label for="invoiceno" class="col-form-label">Invoice #:</label>
                                      <input type="text" class="form-control" name="invoiceno" id="invoiceno" disabled>
                                </div>
                                <div class="form-group">
                                      <label for="invoicedate" class="col-form-label">Invoice Date:</label>
                                      <input class="form-control" type="date" id="invoicedate" name="invoicedate" disabled>
                                </div>

                                <div class="form-group">
                                      <label for="manufacturedate" class="col-form-label">Manufacture Date:</label>
                                      <input class="form-control" type="date" name="manufacturedate" id="manufacturedate" disabled>
                                </div>
                                <div class="form-group">
                                      <label for="dlrinvoicedate" class="col-form-label">Dealer Invoice Date:</label>
                                      <input class="form-control" type="date" name="dlrinvoicedate" id="dlrinvoicedate" disabled>
                                </div>
                            </div>
                         <!-- Customer Address -col-3 -->
                         <div class="col-sm-3">
                                <div class="form-group">
                                      <label for="modelcategory" class="col-form-label">Model Category:</label>
                                      <input type="text" class="form-control" name="modelcategory" id="modelcategory" disabled="true">                            
                                </div>

                                <div class="form-group">
                                      <label for="modelname" class="col-form-label">Model Name:</label>
                                      <input type="text" class="form-control" name="modelname" id="modelname" disabled>                            
                                </div>

                                <div class="form-group">
                                      <label for="modelvariant" class="col-form-label">Model Variant:</label>
                                      <input type="textarea" class="form-control" name="modelvariant" id="modelvariant" disabled>                            
                                </div>
                                
                                <div class="form-group">
                                      <label for="vehiclestatus" class="col-form-label">Vehicle Status</label>
                                      <input type="textarea" class="form-control" name="vehiclestatus" id="vehiclestatus" disabled>                              
                                </div>
                            </div>

                         <!-- Customer Address -col-4 -->
                         <div class="col-sm-3">
                                <div class="form-group">
                                      <label for="fisrtname" class="col-form-label">Fisrt Name:</label>
                                      <div class="input-group">
                                      <input type="text" class="form-control" name="fisrtname" id="fisrtname" disabled="true">
                                      </div>
                                      
                                </div>
                                <div class="form-group">
                                      <label for="lastname" class="col-form-label">Last Name:</label>
                                      <input type="text" class="form-control" name="lastname" id="lastname" disabled>
                                </div>

                                <div class="form-group">
                                      <label for="sellingdlr" class="col-form-label">Selling Dealer:</label>
                                      <input class="form-control" type="text" name="sellingdlr" id="sellingdlr" disabled>
                                </div>
                                <div class="form-group">
                                      <label for="location" class="col-form-label">Location:</label>
                                      <input class="form-control" type="text" name="location" id="location" disabled>
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