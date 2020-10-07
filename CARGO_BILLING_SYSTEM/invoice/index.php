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
	<title></title>
	<script type="text/javascript" src="../custom/js/invoice/invoice.js"></script>
</head>
<body>
<!-- Start of SubMenu -->
<div class="submenu" id="submenu">
	 <a href="../invoice/" class="active" name="invoicehome">Invoice Home</a>
	 <a href="invoicelist.php" class="unactive" name="invoicelist" >Invoice List</a>
	 <a id="sub" class="menu_icon icon" onclick="myFunction2()">
	 <i class="fa fa-bars"></i>
	 </a>
</div> <!-- End of SubMenu -->

<div class="container-fluid" style="margin-top: 15px;">
	<div class="row">
		<div class="col-md-7">
			<div class="card border-info">
			<div class="card bg-info text-white">
				<div style="margin:5px 0px 0px 10px; "><h5><b>Recently Created Invoice</b></h5></div>
			</div>
			<div class="card-body" id="rbody">
				<ul id="recentInvoice">
					
				</ul>		
			</div>
		</div>
		</div>

<!-- Serach customer -->
		<div class="col-md-5">
			<div class="card border-info">
			<div class="card bg-info text-white">
				<div style="margin:5px 0px 0px 10px; "><h5><b>Search Invoice</b></h5></div>
			</div>
			<div class="card-body">
				<form action="invoicelist.php" method="post" id="searchInvoiceForm">
				  <div class="form-group row">
				    <label for="searchDate" class="col-sm-3 col-form-label">Date</label>
				    <div class="col-sm-9">
				      <input type="text" class="form-control" id="searchDate" name="searchDate">
				    </div>
				  </div>
				  <div class="form-group row">
				    <label for="searchInvoiceNo" class="col-sm-3 col-form-label">Invoice #</label>
				    <div class="col-sm-9">
				      <input type="text" class="form-control" id="searchInvoiceNo" name="searchInvoiceNo">
				    </div>
				  </div>
				   <div class="form-group row">
				    <label for="searchInvoicebtn" class="col-sm-3 col-form-label"></label>
				    <div class="col-sm-9">
				     <button id="searchInvoicebtn" name="searchInvoicebtn" type="submit" class="btn btn-primary btn-larg btn-block"><b>Search</b></button>
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