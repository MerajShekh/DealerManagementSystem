<?php
date_default_timezone_set('Asia/Kolkata');
require_once '../php_action/db_connection.php';

if ($con) {

	// if (isset($_POST['model'])) {
	$model = "ACTIVA 5G";
	$model = $_POST["model"];

	$q = "SELECT * FROM product WHERE model='$model'";
	// $q += "WHERE model='"+$model+"'";
	$result = mysqli_query($con,$q);
	while($row = mysqli_fetch_array($result))
	{
		// $data["model"] = $row["model"];
		// $data["type"] = $row["type"];
		// $data["productname"] = $row["productname"];

		$data = $row;
	}

	echo json_encode($data);
	// $mydata2 = JSON.parse($mydata);
// }

}else{
	echo "Database connection failed";
}
?>