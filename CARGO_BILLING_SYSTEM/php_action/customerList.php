<?php
date_default_timezone_set('Asia/Kolkata');
// require_once 'db_connection.php';
$con = mysqli_connect("localhost","root","","cargo_honda");

if ($con) {
	// echo "Database connected";
	if (isset($_GET['defaul'])) {
	
		$query = "SELECT * FROM Customer LEFT JOIN  City ON Customer.City_Id=City.City_Id";
		$result = mysqli_query($con, $query);
		$num = mysqli_num_rows($result);
		
		if ($result) {
		
			while($temp = mysqli_fetch_assoc($result))
				{
					$data[] = $temp;
				}
			echo json_encode($data);
		}
}

// when customer search

if (isset($_GET['mobile'])) {
	$mobile = $_GET['mobile'];
	$fname = $_GET['fname'];
	$lname = $_GET['lname'];
	$custid = $_GET['customerid'];
	if (strpos($mobile,"*")>=0) {
		$mobile = str_replace("*", "%", $mobile);
	}else{}

	if (strpos($fname,"*")>=0) {
		$fname = str_replace("*", "%", $fname);
	}else{}

	if (strpos($lname,"*")>=0) {
		$lname = str_replace("*", "%", $lname);
	}else{}
	
	$query = "SELECT * FROM customer WHERE First_Name ='$mobile'";
	if ($custid !="") {
		$query = "SELECT * FROM Customer LEFT JOIN City ON Customer.City_Id = City.City_Id WHERE Customer.Customer_Id = '$custid'";
	}else if ($mobile !="" && $fname !="" && $lname !="") {
		$query = "SELECT * FROM Customer LEFT JOIN City ON Customer.City_Id = City.City_Id WHERE Customer.Mobile LIKE '$mobile' AND Customer.First_Name LIKE '$fname' AND Customer.Last_Name LIKE '$lname'";

	}else if ($mobile !="" && $fname !="") {
		$query = "SELECT * FROM Customer LEFT JOIN City ON Customer.City_Id = City.City_Id WHERE Customer.Mobile LIKE '$mobile' AND Customer.First_Name LIKE '$fname'";

	}else if ($mobile !="" && $lname !="") {
		$query = "SELECT * FROM Customer LEFT JOIN City ON Customer.City_Id = City.City_Id WHERE Customer.Mobile LIKE '$mobile' AND Customer.Last_Name LIKE '$lname'";

	}else if ($fname !="" && $lname !="") {
		$query = "SELECT * FROM Customer LEFT JOIN City ON Customer.City_Id = City.City_Id WHERE Customer.First_Name LIKE '$fname' AND Customer.Last_Name LIKE '$lname'";
	}else if($mobile!=""){
		$query = "SELECT * FROM Customer LEFT JOIN City ON Customer.City_Id = City.City_Id WHERE Customer.Mobile LIKE '$mobile'";
	}else{
		$query = "SELECT * FROM Customer LEFT JOIN City ON Customer.City_Id = City.City_Id WHERE Customer.Mobile LIKE '$mobile' OR Customer.First_Name LIKE '$fname.' OR Customer.Last_Name LIKE '$lname'";
	}
		// echo $query;
	// $query = "SELECT * FROM Customer WHERE Customer.Mobile = '".$mobile."'";

	$result = mysqli_query($con, $query);
// 	// $arr = mysqli_fetch_assoc($result);
	$num = mysqli_num_rows($result);
	if ($num>0) {
	
		while($temp = mysqli_fetch_assoc($result))
			{
			
			$data[] = $temp;
		}

		echo json_encode($data);

}else{ echo json_encode("Data Not Found");
		// echo "Data "
	}


} // End of isset function


// customer row selection
if (isset($_POST['Customer_Id'])) {
	$Customer_Id = $_POST['Customer_Id'];
	// $model = "2ID";
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


// Add new customer
if (isset($_POST["addFName"])) {	
	
	$q = "SELECT Id FROM Customer ORDER BY Id DESC LIMIT 1";
	$result = mysqli_query($con, $q);
	$rw =  mysqli_num_rows($result);
	$data = mysqli_fetch_assoc($result);
	$lastid = $data["Id"];
	$year = date("y",time());
	$month = date("m",time());
		if ($month==1 || $month==2 || $month==3) {
			$year = $year-1;
		}
	$customerid = "GJ130001".$year."C".sprintf("%'05d",$lastid+1);
	// echo $customerid;
	$Fname = $_POST['addFName'];
	$Gender = $_POST['addGender'];
	$Mobile = $_POST['addMobile'];
	$date = date("Y/m/d",time());

	$stmt = $con->prepare("INSERT INTO customer (Customer_Id,First_Name, Gender,Mobile,Creation_Date) VALUES (?,?,?,?,?)");

	$stmt->bind_param("sssss",$customerid,$Fname,$Gender,$Mobile,$date);
	if ($stmt->execute()==true) {
		$laddedid = mysqli_insert_id($con); 
		$addedCustomer_id = "GJ130001".$year."C".sprintf("%'05d",$laddedid);
		echo $addedCustomer_id;
		// echo "last inserted ID ".$cid;
		// $lid = mysqli_insert_id($con);
	}else{
		echo "Error".mysqli_error($con);
	}
	

}
// Data Recent customer list
if (isset($_POST["Rcustomer"])) {	
	
	$q = "SELECT Customer_Id, First_Name, Last_Name FROM customer ORDER BY Id DESC LIMIT 5";
	$result = mysqli_query($con, $q);
	$rw =  mysqli_num_rows($result);
	// $data = mysqli_fetch_assoc($result);
	while ($temp = mysqli_fetch_assoc($result)) {

		echo "<li><a href='customerlist.php?Customer_Id=".$temp['Customer_Id']."'>".$temp['First_Name']." ".$temp['Last_Name']."</a></li>";
		// echo $temp['First_Name'];
	}
	
}


mysqli_close($con);

}else{
	echo "Database connection failed";
} // End connection block


// mysqli_close($con);
?>