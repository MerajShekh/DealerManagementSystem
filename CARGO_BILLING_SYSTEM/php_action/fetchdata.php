<?php
date_default_timezone_set('Asia/Kolkata');
require_once 'db_connection.php';

if ($con) {
	// echo "connected";
	if (isset($_POST['id'])) {
		$column = $_POST['id'];
		$data = $_POST['data'];
		$fetchedData = $_POST['fetcheddata'];
		
		$q = "SELECT DISTINCT ".$fetchedData." FROM product WHERE ".$column." = '".$data."'";
		$result = mysqli_query($con, $q);

		
		// $num = mysqli_num_rows($result);
		if ($result) {
			while($temp = mysqli_fetch_assoc($result)){

				$html[] = $temp[$fetchedData];
				
			}
			echo json_encode($html);
		}

}  //  /.isset function

if (isset($_POST['fetchAllcustomer'])) {

	$q = "SELECT * FROM customer ORDER BY Id DESC";
		$result = mysqli_query($con, $q);
		if ($result) {
			while($temp = mysqli_fetch_assoc($result)){

				$customerData[] = $temp;
			}
			echo json_encode($customerData);
		}
}

if (isset($_POST['fetchAllModels'])) {
	
	$query = "SELECT * FROM product";
	$result = mysqli_query($con, $query);
	if ($result) {
		while ($temp = mysqli_fetch_assoc($result)) {
			$modeList[] = $temp;
		}

		echo json_encode($modeList);
	}
}
if (isset($_POST['changedCustomerid'])) {
	$customerid = $_POST['changedCustomerid'];
	$query = "SELECT * FROM customer WHERE Customer_Id = '".$customerid."'";
	$result = mysqli_query($con, $query);
	if ($result) {
		while($temp = mysqli_fetch_assoc($result))
		{
			$changeCustomerData = $temp;
		}
		echo json_encode($changeCustomerData);
	}
} // End of changedCustomerid method

if (isset($_POST['fetchAllFinancier'])) {
	$query = "SELECT F_Name,F_Id FROM financier WHERE Status = 'Active'";
	$result = mysqli_query($con, $query);
	if ($result) {
		while ($temp = mysqli_fetch_assoc($result)) {
			$financierData[] = $temp;
		}
		echo json_encode($financierData);
	}
}

if (isset($_POST['fetchproducts'])) {
	$fetchColumn = $_POST['fcolumn'];
	$conditionColumn = $_POST['ccolumn'];
	$data = $_POST['data'];
	
	$query = "SELECT DISTINCT ".$fetchColumn." FROM product WHERE ".$conditionColumn." = '".$data."'";
	$result = mysqli_query($con, $query);
	if ($result) {
		while ($temp = mysqli_fetch_assoc($result)) {
			$productData[] = $temp[$fetchColumn];
		}
		echo json_encode($productData);
	}
}

if (isset($_POST['fetchbookinglist'])) {
	$bookingenquiryno = $_POST['fetchbookinglist'];
	$query = "SELECT * FROM booking b INNER JOIN enquiry e ON b.Enquiry_No = e.Enquiry_No INNER JOIN product p ON p.Product_Id = e.Product_Id WHERE b.Enquiry_No = '$bookingenquiryno'";
	$result = mysqli_query($con, $query);
	$row = mysqli_num_rows($result);
	// $bookingData = array();
	if ($row>0) {
		while ($temp = mysqli_fetch_assoc($result)) {
			$bookingData[] = $temp;
		}
		echo json_encode($bookingData);
	}else{
		echo json_encode("Error");
	}
}

if (isset($_POST['fetchFrames'])) {
	$product = $_POST['fetchFrames'];
	$query = "SELECT Frame_No FROM vehicle WHERE Product = '$product' AND Vehicle_Status = 'Available'";
	$result = mysqli_query($con, $query);
	if ($result) {
		while ($temp = mysqli_fetch_assoc($result)) {
			$frames[] = $temp;
		}
		echo json_encode($frames);
	}
}

 if (isset($_POST['fetchinvoicedata'])) {
 $bookingno = $_POST['fetchinvoicedata'];
// $bookingno = "VEHBK-GJ130001-19-00001";
	$query = "SELECT * FROM invoice i INNER JOIN booking b ON b.Booking_No = i.Booking_No INNER JOIN enquiry e ON e.Enquiry_No = b.Enquiry_No INNER JOIN customer c ON c.Customer_Id = e.Customer_Id WHERE i.Booking_No = '$bookingno'";
	$result = mysqli_query($con,$query);
	$row = mysqli_num_rows($result);
	if ($row>0) {
		while ($temp = mysqli_fetch_assoc($result)) {
			$invoiceData[]=$temp;
		}
		echo json_encode($invoiceData);
	}else{ echo $row;}
 }

if (isset($_POST['checkinvoiceiscreated'])) {
	$bookingno = $_POST['checkinvoiceiscreated'];
	$query = "SELECT * FROM invoice WHERE Booking_No = '$bookingno' AND Invoice_Status = 'New'";
	$result = mysqli_query($con,$query);
	$row = mysqli_num_rows($result);
	if ($row>0) {
		echo $row;
	}else{
		echo $row;
	}
}
// recent added Booking
if (isset($_POST['fetchRecentBooking'])) {
	$result = mysqli_query($con, "SELECT Booking_No FROM booking ORDER BY Booking_Id DESC LIMIT 5");
	while ($temp = mysqli_fetch_assoc($result)) {

		echo "<li><a href='bookingdetail.php?Booking_No=".$temp['Booking_No']."'>".$temp['Booking_No']."</a></li>";
	}
}



}else{
echo "connection failed";
	
}


?>