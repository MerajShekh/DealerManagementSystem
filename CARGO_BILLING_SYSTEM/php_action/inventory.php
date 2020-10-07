<?php 
date_default_timezone_set('Asia/Kolkata');
// require_once 'db_connection.php';
$con = mysqli_connect("localhost","root","","cargo_honda");
if ($con) {

if (isset($_POST['fetchvehiclesgrid'])) {
	$query = "SELECT * FROM product p INNER JOIN color ON p.Color_Id = color.Color_Id INNER JOIN vehicle v ON v.Product = CONCAT(P.Model_Code,P.Model_Type,color.Color_Code) LEFT JOIN booking b ON v.Frame_No = b.Frame LEFT JOIN invoice i ON b.Booking_No = i.Booking_No LEFT JOIN Enquiry e ON b.Enquiry_No = e.Enquiry_No LEFT JOIN customer c ON e.Customer_Id = c.Customer_Id WHERE v.Physical_Status != 'Sold'";
	$result = mysqli_query($con,$query);
	$row = mysqli_num_rows($result);
	if ($row>0) {
		while ($temp = mysqli_fetch_assoc($result)) {
			$data[]=$temp;
		}
		echo json_encode($data);

		
	}else{ echo $row;}
}

if (isset($_POST['fetchframedetail'])) {
	$frame = $_POST['frame'];
	$query = "SELECT * FROM product p INNER JOIN color ON p.Color_Id = color.Color_Id INNER JOIN vehicle v ON v.Product = CONCAT(P.Model_Code,P.Model_Type,color.Color_Code) LEFT JOIN booking b ON v.Frame_No = b.Frame LEFT JOIN invoice i ON b.Booking_No = i.Booking_No LEFT JOIN Enquiry e ON b.Enquiry_No = e.Enquiry_No LEFT JOIN customer c ON e.Customer_Id = c.Customer_Id WHERE v.Frame_No='$frame'";
	$result = mysqli_query($con,$query);
	$row = mysqli_num_rows($result);
	if ($row>0) {
		while ($temp = mysqli_fetch_assoc($result)) {
			$data=$temp;
		}
		echo json_encode($data);
		
	}else{ echo $row;}
}

if (isset($_POST['searcheddata'])) {
	$searcheddata =  $_POST['searcheddata'];
	$searchedcolumn = $_POST['searchedcol'];

	if ($searchedcolumn == "SAP_Invoice_Date") {
		$query = "SELECT * FROM product p INNER JOIN color ON p.Color_Id = color.Color_Id INNER JOIN vehicle v ON v.Product = CONCAT(P.Model_Code,P.Model_Type,color.Color_Code) LEFT JOIN booking b ON v.Frame_No = b.Frame LEFT JOIN invoice i ON b.Booking_No = i.Booking_No LEFT JOIN Enquiry e ON b.Enquiry_No = e.Enquiry_No LEFT JOIN customer c ON e.Customer_Id = c.Customer_Id WHERE $searchedcolumn $searcheddata";		
	}else{

		$query = "SELECT * FROM product p INNER JOIN color ON p.Color_Id = color.Color_Id INNER JOIN vehicle v ON v.Product = CONCAT(P.Model_Code,P.Model_Type,color.Color_Code) LEFT JOIN booking b ON v.Frame_No = b.Frame LEFT JOIN invoice i ON b.Booking_No = i.Booking_No LEFT JOIN Enquiry e ON b.Enquiry_No = e.Enquiry_No LEFT JOIN customer c ON e.Customer_Id = c.Customer_Id WHERE $searchedcolumn LIKE '$searcheddata'";
	}

	$result = mysqli_query($con,$query);
	$row = mysqli_num_rows($result);
	// echo $row;
	if ($row>0) {
		while ($temp = mysqli_fetch_assoc($result)) {
			$data[]=$temp;
		}
		echo json_encode($data);

		
	}else{ echo $row;}

}



mysqli_close($con); // Connection Closed
} // End of Connection
 ?>