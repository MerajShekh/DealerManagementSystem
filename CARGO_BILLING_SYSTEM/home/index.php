<?php 
session_start();
date_default_timezone_set('Asia/Kolkata');
if (!$_SESSION) {
	header('location:/project/CARGO_BILLING_SYSTEM');
}else{

	include_once '../includes/Menu.php';
	require_once '../php_action/db_connection.php';
	if ($con) {
		$frmdate = date("Y-m-01",strtotime("now"));
		$enddate = date("Y-m-d",strtotime("now"));
		$mtdenq = 0;
		$todayenq = 0;
		$mtdbooking = 0;
		$todaybooking = 0;
		$mtdinvoice = 0;
		$todayinvoice = 0;
		$mtdfinance = 0;
		$todayfinance = 0;
		$scstck = 0;
		$mcstock = 0;

		// MTD enquiries
		$query = "SELECT COUNT(Enquiry_No) as Enquiry FROM enquiry WHERE Enquiry_Date BETWEEN '$frmdate' AND '$enddate'";
		$result = mysqli_query($con,$query);
		$data = mysqli_fetch_assoc($result);
		$mtdenq = $data['Enquiry'];
		// today enquiries
		$query = "SELECT COUNT(Enquiry_No) as Enquiry FROM enquiry WHERE Enquiry_Date = '$enddate'";
		$result = mysqli_query($con,$query);
		$data = mysqli_fetch_assoc($result);
		$todayenq = $data['Enquiry'];

		// MTD bookings
		$query = "SELECT COUNT(Booking_No) as Booking FROM booking WHERE Booking_Date BETWEEN '$frmdate' AND '$enddate'";
		$result = mysqli_query($con,$query);
		$data = mysqli_fetch_assoc($result);
		$mtdbooking = $data['Booking'];
		// today bookings
		$query = "SELECT COUNT(Booking_No) as Booking FROM booking WHERE Booking_Date = '$enddate'";
		$result = mysqli_query($con,$query);
		$data = mysqli_fetch_assoc($result);
		$todaybooking = $data['Booking'];

		// MTD Invoices
		$query = "SELECT COUNT(Invoice_No) as Invoice FROM Invoice WHERE Invoice_Date BETWEEN '$frmdate' AND '$enddate' AND Invoice_Status = 'New'";
		$result = mysqli_query($con,$query);
		$data = mysqli_fetch_assoc($result);
		$mtdinvoice = $data['Invoice'];
		// today Invoices
		$query = "SELECT COUNT(Invoice_No) as Invoice FROM Invoice WHERE Invoice_Date = '$enddate' AND Invoice_Status = 'New'";
		$result = mysqli_query($con,$query);
		$data = mysqli_fetch_assoc($result);
		$todayinvoice = $data['Invoice'];

		// MTD Finances
		$query = "SELECT COUNT(Purchase_Type) as Finance FROM Enquiry e INNER JOIN booking b ON b.Enquiry_No = e.Enquiry_No INNER JOIN Invoice i ON i.Booking_No = b.Booking_No  WHERE e.Purchase_Type = 'Finance' AND i.Invoice_Date BETWEEN '$frmdate' AND '$enddate' AND i.Invoice_Status = 'New'";
		$result = mysqli_query($con,$query);
		$data = mysqli_fetch_assoc($result);
		$mtdfinance = $data['Finance'];
		// today Finances
		$query = "SELECT COUNT(Purchase_Type) as Finance FROM Enquiry e INNER JOIN booking b ON b.Enquiry_No = e.Enquiry_No INNER JOIN Invoice i ON i.Booking_No = b.Booking_No  WHERE e.Purchase_Type = 'Finance' AND i.Invoice_Date = '$enddate' AND i.Invoice_Status = 'New'";;
		$result = mysqli_query($con,$query);
		$data = mysqli_fetch_assoc($result);
		$todayfinance = $data['Finance'];

		// sc stock
		$query = "SELECT COUNT(Model_Category) as SC FROM product p INNER JOIN color ON p.Color_Id = color.Color_Id INNER JOIN vehicle v ON v.Product = CONCAT(p.Model_Code,p.Model_Type,color.Color_Code) WHERE p.Model_Category = 'SC' AND v.Physical_Status != 'Sold'";
		$result = mysqli_query($con,$query);
		$data = mysqli_fetch_assoc($result);
		$scstck = $data['SC'];
		// mc stock
		$query = "SELECT COUNT(Model_Category) as MC FROM product p INNER JOIN color ON p.Color_Id = color.Color_Id INNER JOIN vehicle v ON v.Product = CONCAT(p.Model_Code,p.Model_Type,color.Color_Code) WHERE p.Model_Category = 'MC' AND v.Physical_Status != 'Sold'";;
		$result = mysqli_query($con,$query);
		$data = mysqli_fetch_assoc($result);
		$mcstock = $data['MC'];

	}else{$d = "not set";}
?>
<!DOCTYPE html>
<html>
<head>
  <title></title>
</head>
<body>
<div class="submenu" id="submenu">
	 <div class="row">
	 	<div class="bg-secondary col-2"></div>
	 	<div class="col" style="font-size: 25px;"><marquee>	Welcome <?php echo $_SESSION['Name']; echo " today is : ".date("d / m / Y"); ?></marquee></div>
	 	<div class="bg-secondary col-2"></div>

	 </div>
</div>

<div class="container" style="margin-top:70px;">
	<div class="content">
		<div class="row">
			<div class="col">
				<div class="border border-info" style="padding: 15px;">
				<h3 class="border-bottom border-info text-primary" style="text-align: center; font-weight: bold;">Enquiry</h3>
					<div style="margin-top: 30px; margin-bottom: 32px;"><h4>Today : <span style="font-weight: 600; margin-left: 20px;"><?php echo $todayenq; ?></span></h4></div>
					<div><h4>Month Till Date : <span style="font-weight: 600; margin-left: 20px;"><?php echo $mtdenq; ?></span></h4></div>
				</div>

			</div>
			<div class="col">
				<div class="border border-info" style="padding: 15px;">
				<h3 class="border-bottom border-info text-primary" style="text-align: center; font-weight: bold;">Booking</h3>
					<div style="margin-top: 30px; margin-bottom: 32px;"><h4>Today : <span style="font-weight: 600; margin-left: 20px;"><?php echo $todaybooking; ?></span></h4></div>
					<div><h4>Month Till Date : <span style="font-weight: 600; margin-left: 20px;"><?php echo $mtdbooking; ?></span></h4></div>
				</div>

			</div>
			<div class="col">
				<div class="border border-info" style="padding: 15px;">
				<h3 class="border-bottom border-info text-primary" style="text-align: center; font-weight: bold;">Invoice</h3>
					<div style="margin-top: 30px; margin-bottom: 32px;"><h4>Today : <span style="font-weight: 600; margin-left: 20px;"><?php echo $todayinvoice; ?></span></h4></div>
					<div><h4>Month Till Date : <span style="font-weight: 600; margin-left: 20px;"><?php echo $mtdinvoice; ?></span></h4></div>
				</div>

			</div>
		</div>

		<div class="row" style="margin-top: 60px;">
			<div class="col">
				<div class="border border-info" style="padding: 15px;">
				<h3 class="border-bottom border-info text-primary" style="text-align: center; font-weight: bold;">Finance</h3>
					<div style="margin-top: 30px; margin-bottom: 32px;"><h4>Today : <span style="font-weight: 600; margin-left: 20px;"><?php echo $todayfinance; ?></span></h4></div>
					<div><h4>Month Till Date : <span style="font-weight: 600; margin-left: 20px;"><?php echo $mtdfinance; ?></span></h4></div>
				</div>

			</div>
			<div class="col">
				<div class="border border-info" style="padding: 15px;">
				<h3 class="border-bottom border-info text-primary" style="text-align: center; font-weight: bold;">Stock</h3>
					<div style="margin-top: 30px; margin-bottom: 32px;"><h4>Scooter : <span style="font-weight: 600; margin-left: 20px;"><?php echo $scstck; ?></span></h4></div>
					<div><h4>Motorcycle : <span style="font-weight: 600; margin-left: 20px;"><?php echo $mcstock; ?></span></h4></div>
				</div>

			</div>
			<div class="col">
				
				</div>

			</div>
		</div>
	</div>
</div>

</body>
</html>
<?php 
}
 ?>