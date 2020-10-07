
<?php 
date_default_timezone_set('Asia/Kolkata');
// require_once 'db_connection.php';
$con = mysqli_connect("localhost","root","","cargo_honda");

if ($con) {

if (isset($_POST['inputDSE'])) {
	$MVariant = $_POST['inputModelVariant'];
	// $MVariant = "ACITVA 5G DLX";

	$q = "SELECT Product_Id FROM product WHERE Model_Variant ='".$MVariant."' LIMIT 1";
	$result = mysqli_query($con, $q);
	$data = mysqli_fetch_assoc($result);
	$ProductId = $data['Product_Id'];

	$q = "SELECT Id FROM enquiry ORDER BY Id DESC LIMIT 1";
	$result = mysqli_query($con, $q);
	$rw =  mysqli_num_rows($result);
	$data = mysqli_fetch_assoc($result);
	$lastid = $data["Id"];
	$year = date("y",time());
	$month = date("m",time());
		if ($month==1 || $month==2 || $month==3) {
			$year = $year-1;
		}
	$EnquiryNo = "VEHENQ-GJ130001-".$year."-".sprintf("%'05d",$lastid+1);
	$Etype = $_POST['inputEnqType'];
	$Esource = $_POST['inputEnqSource'];
	$Ecategory = $_POST['inputEnqCate'];
	$Ptype = $_POST['inputPurType'];
	$Estatus = "New";
	$DseId = $_POST['inputDSE'];
	$CustomerId = $_POST['customerid'];
	
	$CreatedBy = "GJ130001SA002";
	$date = date("Y/m/d",time());

	$stmt = $con->prepare("INSERT INTO enquiry (Enquiry_No,Enquiry_Date,Product_Id,Customer_Id,DSE_Id, Created_By, Enquiry_Type, Enquiry_Source, Enquiry_Category, Purchase_Type, Enquiry_Status) VALUES (?,?,?,?,?,?,?,?,?,?,?)");

	$stmt->bind_param("ssisissssss",$EnquiryNo,$date,$ProductId,$CustomerId, $DseId, $CreatedBy, $Etype, $Esource, $Ecategory, $Ptype, $Estatus);
	if ($stmt->execute()==true) {
		$linsteredid = mysqli_insert_id($con); 
		$addedEnquiry_id = "VEHENQ-GJ130001-".$year."-".sprintf("%'05d",$linsteredid);
		echo $addedEnquiry_id;
		
	}else{
		echo "Error".mysqli_error($con);
	}
}

// customer row selection
if (isset($_POST['fetchenquiry'])) {
	$Customer_Id = $_POST['fetchenquiry'];
	// $Customer_Id = 'VEHENQ-GJ130001-19-00001';
	$query = "SELECT * FROM enquiry e LEFT JOIN Product p ON e.Product_Id = p.Product_Id LEFT JOIN dse d ON d.DSE_Id = e.DSE_Id LEFT JOIN customer c ON e.Customer_Id = c.Customer_Id LEFT JOIN financier f ON f.F_Id= e.F_Id WHERE e.Enquiry_No = '".$Customer_Id."'";
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

if (isset($_POST['customerid2'])) {
	$customerid = $_POST['customerid2'];
	$title = "";
	$fname = strtoupper($_POST['firstname']);
	$mname = strtoupper($_POST['middlename']);
	$lname = strtoupper($_POST['lastname']);
	$relation = strtoupper($_POST['relation']);
	$rname = strtoupper($_POST['relationname']);
	$mobile = $_POST['mobilenum'];
	$email = $_POST['email'];
	$gender = $_POST['gender'];
	$address1 = strtoupper($_POST['address1']);
	$address2 = strtoupper($_POST['address2']);
	$city = $_POST['city'];
	$pincode = $_POST['pincode'];
	$gst = $_POST['gstin'];

	$q = "UPDATE customer SET Title='$title',First_Name='$fname',Middle_Name='$mname',Last_Name='$lname',Gender='$gender',Email='$email',Mobile='$mobile',Address1='$address1',Address2='$address2',City_Id='$city',Pin_Code='$pincode',Relation='$relation',Relative_Name='$rname' WHERE Customer_Id = '$customerid'";

	if (mysqli_query($con, $q)) {
		echo "Data updated successfully";
	}else{

	echo "Data updation error";
	}
	// echo json_encode("ok");
} // End of isset function


if (isset($_POST['fetchState'])) {

	$query = 'SELECT DISTINCT State FROM city';
	$result = mysqli_query($con, $query);
	if ($result) {
		while($temp = mysqli_fetch_assoc($result))
		{
			$stateData[] = $temp['State'];
		}

		echo json_encode($stateData);
	}

} // /. End of fetchState isset Function

if (isset($_POST['fetchCity'])) {
	$state = $_POST['state'];
	$query = "SELECT * FROM city WHERE State = '".$state."'";
	$result = mysqli_query($con, $query);
	if ($result) {
		while($temp = mysqli_fetch_assoc($result))
		{
			$cityData[] = $temp;
		}

		echo json_encode($cityData);
	}

} // /. End of fetchCity isset Function

if (isset($_POST['fetchenquiries'])) {
	$customerid = $_POST['fetchenquiries'];
	// $customerid = 'GJ13000119C00001';
	// $query = "SELECT * FROM enquiry WHERE Customer_Id = '".$customerid."'";
	$query = "SELECT * FROM enquiry,product,dse WHERE enquiry.Customer_Id = '".$customerid."' AND enquiry.Product_Id = product.Product_Id AND enquiry.DSE_Id = dse.DSE_Id";
	$result = mysqli_query($con, $query);
	// $data = mysqli_fetch_assoc($result);
	if ($result) {
		while($temp = mysqli_fetch_assoc($result))
		{
			$enquiryData[] = $temp;
		}

		// echo $data['Model_Name'];
		echo json_encode($enquiryData);
	}

}
// Update Enquiry Details
if (isset($_POST['enquiry_id'])) {
	$mvariant = $_POST['model_variant'];
	$enquiryid = $_POST['enquiry_id'];
	$customerid = $_POST['customerid'];
	$purchasetype = $_POST['purchase_type'];
	if ($purchasetype!='Cash') {
		$financierid = $_POST['financier'];
		$query = "UPDATE enquiry SET Customer_Id='$customerid',Purchase_Type='$purchasetype',F_Id = '$financierid' WHERE Enquiry_No = '$enquiryid'";
	}else{
		$query = "UPDATE enquiry SET Customer_Id='$customerid',Purchase_Type='$purchasetype',F_Id='' WHERE Enquiry_No = '$enquiryid'";
	}
	if (mysqli_query($con, $query)) {
			echo "Enquiry Updated successfully";
		}else{
		
			echo "Enquiry Updatedation Fail";
		}
	}

if (isset($_POST['mtocproductvariant'])) {
	$enquiryno = $_POST['mtocproductvariant'];
	$query = "SELECT Product_Id FROM enquiry WHERE Enquiry_No = '$enquiryno'";
	$result = mysqli_query($con, $query);
	if ($result) {
		while ($temp = mysqli_fetch_assoc($result)) {
			$productid = $temp['Product_Id'];
		}
	}
	if ($productid) {
		$query = "SELECT * FROM product p INNER JOIN color c ON p.Color_Id = c.Color_Id WHERE Product_Id = '$productid'";
		$result = mysqli_query($con, $query);
		if ($result) {
			while ($temp = mysqli_fetch_assoc($result)) {
			$productData[] = $temp;
			}
		}
	}
	echo json_encode($productData);
}

if (isset($_POST['fetchAllProducts'])) {
	$modelvariant = $_POST['fetchAllProducts'];

	$query = "SELECT * FROM product p INNER JOIN color c ON p.Color_Id = c.Color_Id WHERE Model_Variant = '$modelvariant'";
	$result = mysqli_query($con, $query);
	if ($result) {
		while ($temp = mysqli_fetch_assoc($result)) {
		$productData[] = $temp;
			}
		}
	echo json_encode($productData);
}


if (isset($_POST['updateProduct'])) {
	$modelcode = $_POST['modelcode'];
	$modeltype = $_POST['modeltype'];
	$colorid = $_POST['colorid'];
	$enquiryno = $_POST['enquiryno'];
	// $pId="";
	$query = "SELECT Product_Id FROM product WHERE Model_Code = '$modelcode' AND Model_Type = '$modeltype' AND Color_Id = '$colorid' LIMIT 1";
	$result = mysqli_query($con, $query);
	if ($result) {
		while ($temp = mysqli_fetch_assoc($result)) {
			$pId = $temp['Product_Id'];
		}
	}
		if ($pId) {
			$query = "UPDATE enquiry SET Product_Id = '$pId' WHERE Enquiry_No = '$enquiryno'";
			$result = mysqli_query($con, $query);
			if ($result) {
					echo "Enquiry Table Successfully Updated";
				}
	}	
}

if (isset($_POST['createnewbooking'])) {
	$enquiryno = $_POST['enquiryno'];
	if ($enquiryno) {

		$q = "SELECT Booking_Id FROM booking ORDER BY Booking_Id DESC LIMIT 1";
		$result = mysqli_query($con, $q);
		$rw =  mysqli_num_rows($result);
		$data = mysqli_fetch_assoc($result);
		$lastid = $data["Booking_Id"];
		$year = date("y",time());
		$month = date("m",time());
			if ($month==1 || $month==2 || $month==3) {
				$year = $year-1;
			}
		$BookingNo = "VEHBK-GJ130001-".$year."-".sprintf("%'05d",$lastid+1);
		$Status = "New";	
		$date = date("Y/m/d",time());

		$stmt = $con->prepare("INSERT INTO booking (Booking_No,Booking_Date,Enquiry_No, Booking_Status) VALUES (?,?,?,?)");

		$stmt->bind_param("ssss",$BookingNo,$date,$enquiryno,$Status);
		if ($stmt->execute()==true) {
			$linsteredid = mysqli_insert_id($con); 
			$addedEnquiry_id = "VEHBK-GJ130001-".$year."-".sprintf("%'05d",$linsteredid);
			$query = "UPDATE enquiry SET Stage='Booked' WHERE Enquiry_No = '$enquiryno'";
			$result = mysqli_query($con, $query);
			if ($result) {
					echo $addedEnquiry_id;		
				}
			

			
		}else{
			echo "Error".mysqli_error($con);
		}

	}else{
		echo "Wrong Enquiry No..";
		
	}
}

if (isset($_POST['fetchenquirieslist'])) {
	$query = "SELECT * FROM enquiry e LEFT JOIN customer c ON e.Customer_Id=c.Customer_Id LEFT JOIN Product p ON e.Product_Id=p.Product_Id LEFT JOIN dse d ON d.DSE_Id=e.DSE_Id LEFT JOIN color ON color.Color_Id=p.Color_Id LEFT JOIN financier f ON f.F_Id=e.F_Id LEFT JOIN booking b ON b.Enquiry_No=e.Enquiry_No LEFT JOIN invoice i ON i.Booking_No=b.Booking_No";
	$result = mysqli_query($con,$query);
	$row = mysqli_num_rows($result);
	if ($row>0) {
		while ($temp = mysqli_fetch_assoc($result)) {
			$data[] = $temp;
		}
		echo json_encode($data);
	}
}

if (isset($_POST['searchenquiries'])) {
	$searchedcol = $_POST['searchedcol'];
	$searcheddata = $_POST['searcheddata'];
	if ($searchedcol=='Enquiry_Date') {
			$query = "SELECT * FROM enquiry e LEFT JOIN customer c ON e.Customer_Id=c.Customer_Id LEFT JOIN Product p ON e.Product_Id=p.Product_Id LEFT JOIN dse d ON d.DSE_Id=e.DSE_Id LEFT JOIN color ON color.Color_Id=p.Color_Id LEFT JOIN financier f ON f.F_Id=e.F_Id LEFT JOIN booking b ON b.Enquiry_No=e.Enquiry_No LEFT JOIN invoice i ON i.Booking_No=b.Booking_No WHERE $searchedcol $searcheddata";
	}else{

		$query = "SELECT * FROM enquiry e LEFT JOIN customer c ON e.Customer_Id=c.Customer_Id LEFT JOIN Product p ON e.Product_Id=p.Product_Id LEFT JOIN dse d ON d.DSE_Id=e.DSE_Id LEFT JOIN color ON color.Color_Id=p.Color_Id LEFT JOIN financier f ON f.F_Id=e.F_Id LEFT JOIN booking b ON b.Enquiry_No=e.Enquiry_No LEFT JOIN invoice i ON i.Booking_No=b.Booking_No WHERE e.$searchedcol LIKE '$searcheddata'";
	}
		$result = mysqli_query($con,$query);
		$row = mysqli_num_rows($result);
		if ($row>0) {
			while ($temp = mysqli_fetch_assoc($result)) {
				$data[] = $temp;
			}
			echo json_encode($data);
		}else{
			echo $row;
		}
}

// Data Recent customer list
if (isset($_POST['recentEnquiries'])) {
	$q = "SELECT Enquiry_No FROM enquiry ORDER BY Id DESC LIMIT 5";
	$result = mysqli_query($con, $q);
	$rw =  mysqli_num_rows($result);
	// $data = mysqli_fetch_assoc($result);
	while ($temp = mysqli_fetch_assoc($result)) {

		echo "<li><a href='enquirydetail.php?Enquiry_No=".$temp['Enquiry_No']."'>".$temp['Enquiry_No']."</a></li>";
		// echo $temp['First_Name'];
		// enquirydetail.php?Enquiry_No=VEHENQ-GJ130001-19-00005
	}
}

mysqli_close($con);

} // End of con condition
 ?>