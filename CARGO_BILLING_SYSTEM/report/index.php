<?php 
session_start();
if (!$_SESSION) {
	header('location:/project/CARGO_BILLING_SYSTEM');
}else{
	include_once '../includes/Menu.php';
	include_once '../includes/files.php';
?>
<!DOCTYPE html>
<html>
<head>
	<title></title>
	<!-- <script type="text/javascript" src="../custom/js/invoice/invoice.js"></script> -->
</head>
<body>
<!-- Start of SubMenu -->
<div class="submenu" id="submenu">
	 
		 <a href="dsrReport.php" class="unactive" name="dse" target="myfram"><i class="fa fa-search"> DSR</i></a>
		 <a href="MTDReport.php" class="unactive" name="model" target="myfram"><i class="fa fa-search"> MTD</i></a>
		 <a id="sub" class="menu_icon icon" onclick="myFunction2()">
		 <i class="fa fa-bars"></i>
		 </a>
</div> <!-- End of SubMenu -->

<div class="border border-info" style="margin-top: 5px;">
<iframe src="MTDReport.php" id="myfram" name="myfram" height="85%" width="100%"></iframe>
</div>


</body>
</html>
<?php } ?>