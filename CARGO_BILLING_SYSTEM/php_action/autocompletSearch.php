
<?php 
date_default_timezone_set('Asia/Kolkata');
// require_once 'db_connection.php';
$con = mysqli_connect("localhost","root","","cargo_honda");

if ($con) {


// customer row selection
// if (isset($_POST['fetchcustomerid'])) {
	// $Customer_Id = $_POST['fetchcustomerid'];
	// $Customer_Id = 'GJ13000119C00001';
	$query = "SELECT First_Name FROM Customer";
	$result = mysqli_query($con, $query);
	// $arr = mysqli_fetch_assoc($result);
	$num = mysqli_num_rows($result);
	if ($num>0) {
	
		while($temp = mysqli_fetch_assoc($result))
			{
			
			// $data[] = $temp['First_Name'];
				$data[] = $temp;
		}

}
	echo json_encode($data);
	// echo $model;

// } // End of isset function

mysqli_close($con);

} // End of con condition
 ?>