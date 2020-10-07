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
	 <a href="addfinancier.php" class="unactive" name="financier" target="myfram"><i class="fa fa-plus"> Financier</i></a>
	 <?php 
	 	if ($_SESSION['Role']=="Admin") {
	 	
	  ?>
		 <a href="addDSE.php" class="unactive" name="dse" target="myfram"><i class="fa fa-plus"> DSE</i></a>
		 <a href="model.php" class="unactive" name="model" target="myfram"><i class="fa fa-plus"> Model</i></a>
		 <a href="frame.php" class="unactive" name="frame" target="myfram"><i class="fa fa-plus"> Frame</i></a>
		 <a href="color.php" class="unactive" name="color" target="myfram"><i class="fa fa-plus"> Color</i></a>
		 <a href="price.php" class="unactive" name="price" target="myfram"><i class="fa fa-plus"> Price</i></a>
		 <a href="city.php" class="unactive" name="city" target="myfram"><i class="fa fa-plus"> City</i></a>
		 <a href="newuser.php" class="unactive" name="newuser" target="myfram"><i class="fa fa-user"> User</i></a>
		 <?php } ?>
		 <a id="sub" class="menu_icon icon" onclick="myFunction2()">
		 <i class="fa fa-bars"></i>
		 </a>
</div> <!-- End of SubMenu -->

<div class="border border-info" style="margin-top: 5px;">
<iframe src="" id="myfram" name="myfram" height="85%" width="100%"></iframe>
</div>


</body>
</html>
<?php } ?>