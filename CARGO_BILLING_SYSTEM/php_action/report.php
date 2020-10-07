<?php 
date_default_timezone_set('Asia/Kolkata');
require_once 'db_connection.php';
if ($con) {

$fdate = date("Y-m-d",strtotime("2020-01-01"));
$tdate = date("Y-m-d",strtotime("today"));
function changeDateFormat($data){
		$date = substr(str_replace('/','',$data),0,2);
		$month = substr(str_replace('/','',$data),2,2);
		$year = substr(str_replace('/','',$data),4,4);
		$d = mktime(0,0,0,$month,$date,$year);
		return date('Y-m-d',$d);
	};

if (isset($_POST['mtddata'])) {
	// $fdate = changeDateFormat($_POST['fdate']);
	// $tdate = changeDateFormat($_POST['tdate']);

	$query = "SELECT DISTINCT Model_Name FROM Product";
	$result = mysqli_query($con,$query);

	while ($temp = mysqli_fetch_assoc($result)) {
		$query = "SELECT '$temp[Model_Name]' as Model, count(e.Enquiry_No) as Enquiry FROM Enquiry e INNER JOIN Product p ON e.Product_Id = p.Product_Id INNER JOIN color ON p.Color_Id = color.Color_Id WHERE p.Model_Name = '$temp[Model_Name]' AND e.Enquiry_Date BETWEEN '$fdate' AND '$tdate'";
			$result2 = mysqli_query($con,$query);
			$data = mysqli_fetch_assoc($result2);

			$query = "SELECT count(b.Booking_No) as Booking FROM Booking b INNER JOIN Enquiry e ON b.Enquiry_No = e.Enquiry_No INNER JOIN Product p ON e.Product_Id = p.Product_Id INNER JOIN color ON p.Color_Id = color.Color_Id WHERE p.Model_Name = '$temp[Model_Name]' AND e.Enquiry_Date BETWEEN '$fdate' AND '$tdate'";
			$result2 = mysqli_query($con,$query);
			$data += mysqli_fetch_assoc($result2);

			$query = "SELECT count(i.Invoice_No) as Invoice FROM Invoice i INNER JOIN Booking b ON i.Booking_No = b.Booking_No INNER JOIN Enquiry e ON b.Enquiry_No = e.Enquiry_No INNER JOIN Product p ON e.Product_Id = p.Product_Id INNER JOIN color ON p.Color_Id = color.Color_Id WHERE p.Model_Name = '$temp[Model_Name]' AND e.Enquiry_Date BETWEEN '$fdate' AND '$tdate'";
			$result2 = mysqli_query($con,$query);
			$data += mysqli_fetch_assoc($result2);
			if ($data['Invoice']==0) {
				$conv['ratio'] = 0;	
			}else{
				$conv['ratio'] = round(($data['Invoice']/$data['Enquiry'])*100);	
			}
			$data += $conv;
			$modelData[] = $data;

	}
	echo json_encode($modelData);
	// print_r($modelData);
}

if (isset($_POST['MTDDSEData'])) {
		// $fdate =changeDateFormat($_POST['fdate']);
		// $tdate =changeDateFormat($_POST['tdate']);
			$dsequery = "SELECT * FROM dse";
			$resultt = mysqli_query($con,$dsequery);

			while ($temp = mysqli_fetch_assoc($resultt)) {
				$subquery = "SELECT CONCAT(d.DSE_F_Name,' ',d.DSE_L_Name) as Name, count(e.Enquiry_No) as Enquiry FROM Enquiry e INNER JOIN dse d ON e.DSE_Id = d.DSE_Id WHERE d.DSE_Id = '$temp[DSE_Id]' AND e.Enquiry_Date BETWEEN '$fdate' AND '$tdate'";
				$subresult = mysqli_query($con,$subquery);
				$subdata = mysqli_fetch_assoc($subresult);

				$subquery = "SELECT count(b.Booking_No) as Booking FROM Booking b INNER JOIN Enquiry e ON b.Enquiry_No = e.Enquiry_No INNER JOIN dse d ON e.DSE_Id = d.DSE_Id WHERE d.DSE_Id = '$temp[DSE_Id]' AND b.Booking_Date BETWEEN '$fdate' AND '$tdate'";
				$subresult = mysqli_query($con,$subquery);
				$subdata += mysqli_fetch_assoc($subresult);

				$subquery = "SELECT count(i.Invoice_No) as Invoice FROM Invoice i INNER JOIN Booking b ON i.Booking_No = b.Booking_No INNER JOIN Enquiry e ON b.Enquiry_No = e.Enquiry_No INNER JOIN dse d ON e.DSE_Id = d.DSE_Id WHERE d.DSE_Id = '$temp[DSE_Id]' AND i.Invoice_Date BETWEEN '$fdate' AND '$tdate'";
				$subresult = mysqli_query($con,$subquery);
				$subdata += mysqli_fetch_assoc($subresult);
				$modelData[] = $subdata;
			}
			echo json_encode($modelData);
	// echo "ok";
}


}

?>