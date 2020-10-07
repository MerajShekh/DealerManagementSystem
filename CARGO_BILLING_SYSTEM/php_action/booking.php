<?php
date_default_timezone_set('Asia/Kolkata');
// require_once 'db_connection.php';
$con = mysqli_connect("localhost","root","","cargo_honda");

if ($con) {

// customer row selection or redirect from enquiry
if (isset($_POST['fetchbookings'])) {
	$bookingno = $_POST['fetchbookings'];
	// $bookingno = 'VEHBK-GJ130001-19-00001';
	$query = "SELECT * FROM booking b LEFT JOIN enquiry e ON b.Enquiry_No = e.Enquiry_No INNER JOIN customer c ON e.Customer_Id = c.Customer_Id INNER JOIN Product p ON p.Product_Id = e.Product_Id LEFT JOIN financier f ON f.F_Id = e.F_Id WHERE b.Booking_No = '".$bookingno."'";
	$result = mysqli_query($con, $query);
	// $arr = mysqli_fetch_assoc($result);
	$num = mysqli_num_rows($result);
	
	if ($num>0) {
	
		while($temp = mysqli_fetch_assoc($result))
			{
			
			$data = $temp;
		 }

}
	echo json_encode($data);
	// echo $model;

} // End of isset function

if (isset($_POST['fetchcustomerdetail'])) {
	 $bookingno = $_POST['fetchcustomerdetail'];
		// $bookingno = "VEHBK-GJ130001-19-00001";
	 $query = "SELECT * FROM booking b INNER JOIN enquiry e ON e.Enquiry_No= b.Enquiry_No INNER JOIN customer c ON c.Customer_Id=e.Customer_Id INNER JOIN city ON city.City_Id = c.City_Id INNER JOIN product p ON p.Product_Id = e.Product_Id INNER JOIN color ON color.Color_Id = p.Color_Id LEFT JOIN vehicle v ON b.Frame = v.Frame_No WHERE b.Booking_No ='$bookingno'";
		// $query = "SELECT * FROM payment";
	 $result = mysqli_query($con, $query);
	 if ($result) {
	 	while ($temp = mysqli_fetch_assoc($result)) {
				$data[] = $temp;	 		
	 	}
	 	echo json_encode($data);
	 }else{ echo json_encode("Wrong ".mysqli_error($con));}
}

if (isset($_POST['getPrice'])) {
	$product = $_POST['getPrice'];
	// $product = 'CBF125K4IDNH1';
	$query = "SELECT * FROM price WHERE Product='$product'";
	$result = mysqli_query($con,$query);
	if ($result) {
		while ($temp = mysqli_fetch_assoc($result)) {
			$priceData[] = $temp;
		}
		echo json_encode($priceData);
	}
}

if (isset($_POST['fetchPayments'])) {
	$bookingno = $_POST['fetchPayments'];
	// $bookingno = "VEHBK-GJ130001-19-00001";
	$query="SELECT * FROM payment WHERE Booking_No = '$bookingno'";
	$result = mysqli_query($con, $query);
	$row = mysqli_num_rows($result);
	if ($row>0) {
		while ($temp = mysqli_fetch_assoc($result)) {
			$paymentData[] = $temp;
		}
		echo json_encode($paymentData);
	}else { 
		echo $row;
	}
}

if (isset($_POST['setPrice'])) {
	$bookingno = $_POST['bookingno'];
	$product = $_POST['lineItemProduct'];
	$exshoroom = $_POST['lineItemExShowroom'];
	$hypothecation = $_POST['lineItemHypothecation'];
	$insurance = $_POST['lineItemInsurance'];
	$tax = $_POST['lineItemTax'];
	$discount = $_POST['lineItemDiscount'];
	$billingprice = $_POST['lineItemBillingPrice'];
	$taxable = $_POST['lineItemTaxable'];
	$sgstrate = $_POST['lineItemSGSTRate'];
	$sgstamt = $_POST['lineItemSGSTValue'];
	$cgstrate = $_POST['lineItemCGSTRate'];
	$cgstamt = $_POST['lineItemCGSTValue'];

	$query = "UPDATE `booking` SET Booking_Ex_Price ='$exshoroom', Booking_SGST_Rate='$sgstrate', Booking_SGST_Value='$sgstamt',`Booking_CGST_Rate`='$cgstrate',`Booking_CGST_Value`='$cgstamt',`Booking_Taxable_Price`='$taxable',`Booking_Discount_Value`='$discount',Booking_Basic_Price='$billingprice',`Hypothecation_Charge`='$hypothecation',`Insurance_Charge`='$insurance',`Road_Tax`='$tax' WHERE Booking_No ='$bookingno'";
	$result = mysqli_query($con, $query);
	if ($result) {
		echo "Updation Done ";
	}else { echo "Updation Fail-> ".mysqli_error($con);}
}

// Add NewPayment
if (isset($_POST['inputPaymentAmount'])) {
	$paymentvalue = $_POST['inputPaymentAmount'];
	$paymenttype = $_POST['inputPaymentType'];
	
	$bookingno = $_POST['inputBookingno'];
	$paymentstatus = "New";
	$query = "SELECT Payment_Id FROM payment ORDER BY Payment_Id DESC LIMIT 1";
	$result = mysqli_query($con, $query);
	$rw =  mysqli_num_rows($result);
	$data = mysqli_fetch_assoc($result);
	$lastid = $data["Payment_Id"];
	$year = date("y",time());
	$month = date("m",time());
		if ($month==1 || $month==2 || $month==3) {
			$year = $year-1;
		}
	$ReceiptNo = "RCPT-GJ130001-$year".($year+1)."-".sprintf("%'05d",$lastid+1);
	$date = date("Y/m/d",time());
	// echo $ReceiptNo;
	if ($paymenttype=="Cash") {
		$stmt = $con->prepare("INSERT INTO payment (Receipt_No,Booking_No,Payment_Type,Payment_Date,Payment_Amount,Payment_Status) VALUES (?,?,?,?,?,?)");
		$stmt->bind_param("ssssis",$ReceiptNo,$bookingno,$paymenttype,$date,$paymentvalue,$paymentstatus);
		if ($stmt->execute()==true) {
			$linsteredid = mysqli_insert_id($con); 
			$addedPayment_id = "RCPT-GJ130001-$year".($year+1)."-".sprintf("%'05d",$linsteredid);
			echo $addedPayment_id;
			
		}else{
			echo "Error".mysqli_error($con);
		}
	}else{
		$cheque = $_POST['inputChequeNo'];
		$bankname = $_POST['inputBankName'];
		$branchname = $_POST['inputBranchName'];
		$stmt = $con->prepare("INSERT INTO payment (Receipt_No,Booking_No,Payment_Type,Payment_Date,Payment_Amount,Cheque_No,Bank_Name,Branch_Name, Payment_Status) VALUES (?,?,?,?,?,?,?,?,?)");
		$stmt->bind_param("ssssissss",$ReceiptNo,$bookingno,$paymenttype,$date,$paymentvalue,$cheque,$bankname,$branchname,$paymentstatus);
		if ($stmt->execute()==true) {
			$linsteredid = mysqli_insert_id($con); 
			$addedPayment_id = "RCPT-GJ130001-$year".($year+1)."-".sprintf("%'05d",$linsteredid);
			echo $addedPayment_id;
			
		}else{
			echo "Error".mysqli_error($con);
		}
	}
}

// Update frame in booking
if (isset($_POST['updateFrame'])) {
	$frameno = $_POST['updateFrame'];
	$bookingno = $_POST['bookingno'];
	$query = "UPDATE booking SET Frame ='$frameno' WHERE Booking_No = '$bookingno'";
	$result = mysqli_query($con,$query);
	if ($result) {
		$query = "UPDATE vehicle SET Vehicle_Status ='Allocated' WHERE Frame_No = '$frameno'";
		$result = mysqli_query($con,$query);
		if ($result) {
			$query = "SELECT Engine_No from vehicle WHERE Frame_No = '$frameno'";
			$result = mysqli_query($con,$query);
			if ($result) {
				while ($temp = mysqli_fetch_assoc($result)) {
					$Engines = $temp;
				}
				echo json_encode($Engines);
			}else{ echo "Engine Fetch Error".mysql_error($con);}
		}
	}else{ echo "Updation Fail!!!";}
}

// Delete Allocated frame in booking
if (isset($_POST['deteleFrame'])) {
	$frameno = $_POST['deteleFrame'];
	$bookingno = $_POST['bookingno'];
	$query = "SELECT * FROM invoice WHERE Booking_No='$bookingno' AND Invoice_Status='New'";
	$result = mysqli_query($con, $query);
	$row = mysqli_num_rows($result);
	if ($row>0) {
		echo "Invoiced";
	}else{
		$query = "UPDATE booking SET Frame ='' WHERE Booking_No = '$bookingno'";
		$result = mysqli_query($con,$query);
		if ($result) {
			$query = "UPDATE vehicle SET Vehicle_Status ='Available' WHERE Frame_No = '$frameno'";
			$result = mysqli_query($con,$query);
			if ($result) {
				echo "Frame Deleted";
			}
		}else{ echo "Deletion Fail!!!";}
	}
}

// Update booking Detail
if (isset($_POST['updatebookingdetail'])) {
	$bookingno = $_POST['bookingno'];
	$purchasetype = $_POST['purchasetype'];
	$expectedreason = $_POST['expectedreason'];
	$expecteddate = $_POST['expecteddate'];
	$query = "SELECT Enquiry_No FROM booking WHERE Booking_No ='$bookingno'";
	$result = mysqli_query($con,$query);
	$data = mysqli_fetch_assoc($result);
	$enquiryno = $data['Enquiry_No'];
	if ($purchasetype !='Cash') {
		$financier = $_POST['financier'];
		$financeamount = $_POST['financeamount'];
		$financeapprove = $_POST['financeapprove'];	
		$query = "UPDATE enquiry SET Purchase_Type = '$purchasetype', F_Id = '$financier' WHERE Enquiry_No='$enquiryno'";
		$result = mysqli_query($con,$query);
		$query = "UPDATE booking SET Finance_Amount = '$financeamount' , Finance_Approve = 1 WHERE Booking_No='$bookingno'";
		$result = mysqli_query($con,$query);
	}else{
		$query = "UPDATE enquiry SET Purchase_Type = '$purchasetype', F_Id = '' WHERE Enquiry_No='$enquiryno'";
		$result = mysqli_query($con,$query);
		$query = "UPDATE booking SET Finance_Amount = '', Finance_Approve = 0 WHERE Booking_No='$bookingno'";
		$result = mysqli_query($con,$query);
	}
	$query = "UPDATE booking SET Expected_Date = '$expecteddate',  Expected_Reason = '$expectedreason' WHERE Booking_No='$bookingno'";
		$result = mysqli_query($con,$query);
		if ($result) {
			echo "Booking Updated";
		}else{ echo "Booking Updation Fail";}
}

// Create New Invoice
if (isset($_POST['createNewInvoice'])) {
	$bookingno = $_POST['bookingno'];
	$keyno = $_POST['keyno'];
	$batteyno = $_POST['batteyno'];
	$invoicetype = "Retail";
	$invoicestatus = "New";
	$query = "SELECT Enquiry_No,Frame FROM booking WHERE Booking_No = '$bookingno'";
	$result = mysqli_query($con,$query);
	$data = mysqli_fetch_assoc($result);

	$enquiryno = $data['Enquiry_No'];
	$frame = $data['Frame'];
	$query = "SELECT Invoice_Id FROM invoice ORDER BY Invoice_Id DESC LIMIT 1";
	$result = mysqli_query($con, $query);
	$rw =  mysqli_num_rows($result);
	$data = mysqli_fetch_assoc($result);
	$lastid = $data["Invoice_Id"];
	$year = date("y",time());
	$month = date("m",time());
		if ($month==1 || $month==2 || $month==3) {
			$year = $year-1;
		}
	$invoiceno = "VEHINV-GJ130001-$year".($year+1)."-".sprintf("%'05d",$lastid+1);
	$date = date("Y/m/d",time());
	$stmt = $con->prepare("INSERT INTO invoice (Invoice_No,Booking_No,Invoice_Date,Key_No,Battery_No,Invoice_Type,Invoice_Status) VALUES (?,?,?,?,?,?,?)");
	$stmt->bind_param("sssssss",$invoiceno,$bookingno,$date,$keyno,$batteyno,$invoicetype,$invoicestatus);
		if ($stmt->execute()==true) {
			$linsteredid = mysqli_insert_id($con);
			$query = "UPDATE enquiry SET Stage='Invoiced' WHERE Enquiry_No='$enquiryno'";
			$result= mysqli_query($con,$query);
			$query = "UPDATE vehicle SET Physical_Status='Sold' WHERE Frame_No='$frame'";
			$result= mysqli_query($con,$query);
			if ($result) {
				$addedPayment_id = "RCPT-GJ130001-$year".($year+1)."-".sprintf("%'05d",$linsteredid);
				echo $addedPayment_id;
			}	
		}else{
			echo "Error".mysqli_error($con);
		}
}


mysqli_close($con); // Connection Closed

} // End of Connection

?>