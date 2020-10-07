
<?php 
date_default_timezone_set('Asia/Kolkata');
// require_once 'db_connection.php';
$con = mysqli_connect("localhost","root","","cargo_honda");

if ($con) {


// customer row selection
if (isset($_POST['fetchcustomerid'])) {
	$Customer_Id = $_POST['fetchcustomerid'];
	// $Customer_Id = 'GJ13000119C00001';
	$query = "SELECT * FROM Customer LEFT JOIN City ON Customer.City_Id = City.City_Id WHERE Customer.Customer_Id = '".$Customer_Id."'";
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
	$query = "SELECT * FROM enquiry e INNER JOIN product p ON p.Product_Id = e.Product_Id INNER JOIN dse ON dse.DSE_Id = e.DSE_Id WHERE e.Customer_Id = '$customerid'";
	$result = mysqli_query($con, $query);
	$row = mysqli_num_rows($result);
	if ($row>0) {
		while($temp = mysqli_fetch_assoc($result))
		{
			$enquiryData[] = $temp;
		}
		echo json_encode($enquiryData);
	}else { echo $row;}

}

if (isset($_POST['fetchDSE'])) {
	$query = 'SELECT * FROM dse';
	$result = mysqli_query($con, $query);
	if ($result) {
		while($temp = mysqli_fetch_assoc($result))
		{
			$dseData[] = $temp;
		}
		echo json_encode($dseData);
	}
} // End of fetchDSE

mysqli_close($con);

} // End of con condition
 ?>