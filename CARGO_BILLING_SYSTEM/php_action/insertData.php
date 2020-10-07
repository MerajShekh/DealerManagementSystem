<?php
date_default_timezone_set('Asia/Kolkata');
require_once 'db_connection.php';

if ($con) {
		
	$stmt = $con->prepare("INSERT INTO product (Model_Category,Model_Variant, Model_Name, Model_Code, Model_Type, Model_Status, Product_Name) VALUES (?,?,?,?,?,?,?)");

	$MCategory="MC";
	$MVariant = "SP125 DRUM CBS";
	$MName = "SP125";
	$MCode = "CBF125ML";
	$MType = "3ID";
	$MStatus = "Active";
	$PName = "CBF125ML3IDNH1D";

	$stmt->bind_param("sssssss",$MCategory,$MVariant,$MName,$MCode,$MType,$MStatus,$PName);
	if ($stmt->execute()) {	

		echo "data inserted ".mysqli_insert_id($con);

	}else{
		echo "data could not insert".mysqli_error($con);
	}


}else{
	echo "connection failed";
}


?>