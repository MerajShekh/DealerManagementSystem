<?php 
date_default_timezone_set('Asia/Kolkata');
// require_once 'db_connection.php';
$con = mysqli_connect("localhost","root","","cargo_honda");
if ($con) {

if (isset($_POST['fetchinvoicedata'])) {
	$invoiceno = $_POST['fetchinvoicedata'];
	// $invoiceno = "VEHINV-GJ130001-1920-00002";
	$query = "SELECT *  FROM invoice i LEFT JOIN booking b ON b. Booking_No = i.Booking_No LEFT JOIN enquiry e ON e.Enquiry_No = b.Enquiry_No LEFT JOIN customer c ON c.Customer_Id = e.Customer_Id LEFT JOIN product p ON p.Product_Id = e.Product_Id LEFT JOIN payment ON payment.Booking_No = b.Booking_No LEFT JOIN city ON city.City_Id = c.City_Id LEFT JOIN financier f ON f.F_Id=e.F_Id LEFT JOIN vehicle v ON b.Frame = v.Frame_No WHERE Invoice_No = '$invoiceno'";
	$result = mysqli_query($con,$query);
	if ($result) {
		while ($temp = mysqli_fetch_assoc($result)) {
			$invoiceData[] = $temp;
		}
		echo json_encode($invoiceData);
	}
}

if (isset($_POST['fetchinvoicedatagrid'])) {
	$query = "SELECT * FROM invoice i INNER JOIN booking b ON b.Booking_No=i.Booking_No INNER JOIN enquiry e ON e.Enquiry_No = b.Enquiry_No INNER JOIN customer c ON c.Customer_Id = e.Customer_Id INNER JOIN product p ON p.Product_Id = e.Product_Id INNER JOIN vehicle v oN v.Frame_No= b.Frame LEFT JOIN financier f ON f.F_Id=e.F_Id INNER JOIN color ON color.Color_Id = p.Color_Id INNER JOIN city ON city.City_Id=c.City_Id INNER JOIN dse ON dse.dse_Id = e.dse_Id ";
	$result = mysqli_query($con,$query);
	$row = mysqli_num_rows($result);
	if ($row>0) {
		while ($temp = mysqli_fetch_assoc($result)) {
			$data[] = $temp;
		}
		echo json_encode($data);
	}else{ echo $row;}
}

// 
if (isset($_POST['searchinvoicedata'])) {
	$invoiceno = $_POST['invoiceno'];
	$date = $_POST['date'];
	$query = "SELECT * FROM invoice i LEFT JOIN booking b ON i.Booking_No=b.Booking_No LEFT JOIN enquiry e ON b.Enquiry_No = e.Enquiry_No LEFT JOIN customer c ON e.Customer_Id = c.Customer_Id LEFT JOIN product p ON e.Product_Id = p.Product_Id LEFT JOIN vehicle v ON b.Frame= v.Frame_No LEFT JOIN financier f ON f.F_Id=e.F_Id LEFT JOIN color ON color.Color_Id = p.Color_Id LEFT JOIN city ON city.City_Id=c.City_Id LEFT JOIN dse ON dse.dse_Id = e.dse_Id WHERE i.Invoice_No like '$invoiceno'";
	// $query = "SELECT * FROM invoice i WHERE i.Invoice_No like '$invoiceno'";
	$result = mysqli_query($con,$query);
	$row = mysqli_num_rows($result);
	if ($row>0) {
		while ($temp = mysqli_fetch_assoc($result)) {
			$data[] = $temp;
		}
		echo json_encode($data);
	}else{ echo $row;}
	// echo $query;
}

// recently 5 invoices created
if (isset($_POST['fetchrecentlyinvoices'])) {
	$query="SELECT *  FROM invoice ORDER BY Invoice_Id DESC LIMIT 5";
	$result = mysqli_query($con,$query);
	if ($result) {
		while ($temp = mysqli_fetch_assoc($result)) {
			echo "<li><a href='invoicedetail.php?Invoice_No=".$temp['Invoice_No']."'>".$temp['Invoice_No']."</a></li>";
		}
	}
}
// Update Invoice Detail page
if (isset($_POST['updateInvoiceDetail'])) {
	$flag = 0;
	$invoiceno = $_POST['invoiceno']; 
	$battery = $_POST['battery'];
	$key = $_POST['key'];
	$regnumber = $_POST['regnumber'];
	$data = mysqli_fetch_assoc(mysqli_query($con,"SELECT Booking_No FROM invoice WHERE Invoice_No = '$invoiceno'"));
	$data = mysqli_fetch_assoc(mysqli_query($con,"SELECT Frame FROM Booking WHERE Booking_No ='".$data['Booking_No']."'"));
	$frame = $data['Frame'];

	$query = "UPDATE `invoice` SET `Key_No`='$key',`Battery_No`='$battery' WHERE Invoice_No = '$invoiceno'";
	if (mysqli_query($con,$query)) {

		if (mysqli_query($con,"UPDATE `vehicle` SET `Registration_NO`='$regnumber' WHERE Frame_No = '$frame'")) {
			$flag = 1;
		}else{ $flag = 0;}
	}else{ $flag = 0;}

	echo $flag;
}

if (isset($_POST['cancelInvoice'])) {
	$reason = $_POST['reason'];
	$invoiceno = $_POST['invoiceno'];
	$flag = 0;
	$date = date("Y-m-d");
	$data = mysqli_fetch_assoc(mysqli_query($con,"SELECT Booking_No FROM invoice WHERE Invoice_No = '$invoiceno'"));
	$data = mysqli_fetch_assoc(mysqli_query($con,"SELECT Frame FROM Booking WHERE Booking_No ='".$data['Booking_No']."'"));
	$frame = $data['Frame'];

	$query = "UPDATE `invoice` SET `Invoice_Status`='Cancelled',Cancellation_Date = '$date', Cancellation_Reason = '$reason' WHERE Invoice_No = '$invoiceno'";
	if (mysqli_query($con,$query)) {

		if (mysqli_query($con,"UPDATE `vehicle` SET `Physical_Status`='Received-OK' WHERE Frame_No = '$frame'")) {
			$flag = 1;
		}else{ $flag = 0;}
	}else{ $flag = 0;}

	echo $flag;
}

if (isset($_POST['searchInvoiceGridData'])) {
	$searchedcol = $_POST['searchedcol'];
	$searcheddata = $_POST['searcheddata'];
	if ($searchedcol =='Invoice_Date') {
		$query = "SELECT * FROM invoice i LEFT JOIN booking b ON b.Booking_No=i.Booking_No LEFT JOIN enquiry e ON e.Enquiry_No = b.Enquiry_No LEFT JOIN customer c ON c.Customer_Id = e.Customer_Id LEFT JOIN product p ON p.Product_Id = e.Product_Id LEFT JOIN vehicle v oN v.Frame_No= b.Frame LEFT JOIN financier f ON f.F_Id=e.F_Id LEFT JOIN color ON color.Color_Id = p.Color_Id LEFT JOIN city ON city.City_Id=c.City_Id LEFT JOIN dse ON dse.dse_Id = e.dse_Id WHERE $searchedcol $searcheddata ";
	}else{
		$query = "SELECT * FROM invoice i LEFT JOIN booking b ON b.Booking_No=i.Booking_No LEFT JOIN enquiry e ON e.Enquiry_No = b.Enquiry_No LEFT JOIN customer c ON c.Customer_Id = e.Customer_Id LEFT JOIN product p ON p.Product_Id = e.Product_Id LEFT JOIN vehicle v oN v.Frame_No= b.Frame LEFT JOIN financier f ON f.F_Id=e.F_Id LEFT JOIN color ON color.Color_Id = p.Color_Id LEFT JOIN city ON city.City_Id=c.City_Id LEFT JOIN dse ON dse.dse_Id = e.dse_Id WHERE $searchedcol LIKE '$searcheddata'";
	}

	$result = mysqli_query($con,$query);
	$row = mysqli_num_rows($result);
	if ($row>0) {
		while ($temp = mysqli_fetch_assoc($result)) {
			$data[] = $temp;
		}
		echo json_encode($data);
	}else{ echo $row;}

}

mysqli_close($con); // Connection Closed
} // End of Connection
 ?>