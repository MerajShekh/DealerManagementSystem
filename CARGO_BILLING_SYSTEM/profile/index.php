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
		 <a href="viewProfile.php" class="unactive" name="view" target="myfram"><i class="fa fa-user"> View</i></a>
		 <a href="changePassword.php" class="unactive" name="frame" target="myfram"><i class="fa fa-lock"> Change Password</i></a>
		 
		 <a id="sub" class="menu_icon icon" onclick="myFunction2()">
		 <i class="fa fa-bars"></i>
		 </a>
</div> <!-- End of SubMenu -->

<div class="border border-info" style="margin-top: 5px;">
<iframe src="changePassword.php" id="myfram" name="myfram" height="85%" width="100%"></iframe>
</div>


</body>
</html>
<?php } ?>