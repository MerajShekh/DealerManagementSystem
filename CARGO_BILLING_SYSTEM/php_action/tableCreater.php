<?php 
$conn = mysqli_connect("localhost","root","","CARGO_HONDA");
date_default_timezone_set('Asia/Kolkata');
if ($conn) {
	// echo "databse connected";
	$q = "CREATE TABLE IF NOT EXISTS Product(
		Product_Id int PRIMARY KEY AUTO_INCREMENT,
		Model_Categry varchar(5) NOT NULL,
		Model_Variant varchar(50) NOT NULL,
		Model_Name varchar(40) NOT NULL,
		Model_Code varchar(30) NOT NULL,
		Model_Type varchar(5) NOT NULL,
		Model_Status varchar(10) NOT NULL DEFAULT 'Active',
		Product_Name varchar(50) NOT NULL)";
	$result = mysqli_query($conn, $q);
	if ($result) {
		echo "Table created";
	}else{
		echo "\nsome error ".mysqli_error($conn);
	}

	$q = "CREATE TABLE IF NOT EXISTS City(
		City_Id int PRIMARY KEY AUTO_INCREMENT,
		City_Name varchar(50) NOT NULL,
		State varchar(50) NOT NULL)";

		if (mysqli_query($conn, $q)) {
			echo "City Table created\n";
		}else{
			echo "City Table creation failed due to ".mysqli_error($conn);
		}

	$q = "CREATE TABLE IF NOT EXISTS Customer(
		Id int PRIMARY KEY AUTO_INCREMENT,
		Customer_Id varchar(20) NOT NULL,
		Title varchar(10),
		First_Name varchar(50) NOT NULL,
		Middle_Name varchar(50),
		Last_Name varchar(50),
		Gender varchar(10) NOT NULL,
		Email varchar(50),
		Mobile varchar(15) NOT NULL,
		Address1 varchar(50) NOT NULL,
		Address2 varchar(50),
		City_Id int NOT NULL,
		Pin_Code int(6) NOT NULL,
		Relation varchar(20) NOT NULL,
		Relative_Name varchar(50) NOT NULL,
		Creation_Date date NOT NULL)";
	$result = mysqli_query($conn, $q);
	if ($result) {
		echo "\nCustomer Table Created";
	}else{
		echo "\nCustomer table creation failed due to ".mysqli_error($conn);
	}


	$q = "CREATE TABLE IF NOT EXISTS Enquiry(
		Id int PRIMARY KEY AUTO_INCREMENT,
		Enquiry_Id varchar(20) NOT NULL,
		Enquiry_Date date NOT NULL,
		Product_Id int NOT NULL,
		Customer_Id int NOT NULL,
		DSE_Id int NOT NULL,
		Created_By varchar(20) NOT NULL,
		Enquiry_Type varchar(30) NOT NULL,
		Enquiry_Source varchar(30) NOT NULL,
		Enquiry_Category varchar(40) NOT NULL)";
		
		// echo $q;
	$result = mysqli_query($conn, $q);
	if ($result) {
		echo "\nEnquiry Table Created";
	}else{
		echo "\nEnquiry table creation failed due to ".mysqli_error($conn);
	}


	$q = "CREATE TABLE IF NOT EXISTS dse(
		DSE_Id int PRIMARY KEY AUTO_INCREMENT,
		Dealer_Code varchar(20) NOT NULL,
		DSE_F_Name varchar(50) NOT NULL,
		DSE_M_Name varchar(50) NOT NULL,
		DSE_L_Name varchar(50) NOT NULL,
		DSE_Mobile bigint(10) NOT NULL,
		DSE_Email varchar(50) NOT NULL,
		Status varchar(30) NOT NULL)";
		
	$result = mysqli_query($conn, $q);
	if ($result) {
		echo "\ndse Table Created";
	}else{
		echo "\ndse table creation failed due to ".mysqli_error($conn);
	}

	$q = "CREATE TABLE IF NOT EXISTS financier(
		F_Id int PRIMARY KEY AUTO_INCREMENT,
		F_Name varchar(255) NOT NULL,
		F_Address varchar(100) NOT NULL,
		F_City varchar(50) NOT NULL,
		F_Dist varchar(50) NOT NULL,
		F_State varchar(50) NOT NULL,
		F_Pin varchar(6) NOT NULL,
		Status varchar(30) NOT NULL)";
		
	$result = mysqli_query($conn, $q);
	if ($result) {
		echo "\ndse Table Created";
	}else{
		echo "\ndse table creation failed due to ".mysqli_error($conn);
	}	

	$q = "CREATE TABLE IF NOT EXISTS color(
		Color_Id int PRIMARY KEY AUTO_INCREMENT,
		Color_Code varchar(20) NOT NULL,
		Color_Name varchar(100) NOT NULL)";
		
	$result = mysqli_query($conn, $q);
	if ($result) {
		echo "\ndse Table Created";
	}else{
		echo "\ndse table creation failed due to ".mysqli_error($conn);
	}

	$q = "CREATE TABLE IF NOT EXISTS booking(
		Booking_Id int PRIMARY KEY AUTO_INCREMENT,
		Booking_No varchar(30) NOT NULL,
		Booking_Date varchar(20) NOT NULL,
		Enquiry_Id varchar(100) NOT NULL,
		Booking_Ex_Price DECIMAL(5,2),
		Booking_SGST_Rate DECIMAL(5,2),
		Booking_SGST_Value DECIMAL(5,2),
		Booking_CGST_Rate DECIMAL(5,2),
		Booking_CGST_Value DECIMAL(5,2),
		Booking_Taxble_Price DECIMAL(5,2),
		Booking_Discount_Value DECIMAL(5,2),
		Frame varchar(20),
		Booking_Status varchar(20) NOT NULL)";
	$result = mysqli_query($conn, $q);
	if ($result) {
		echo "\ndse Table Created";
	}else{
		echo "Booking table creation failed due to ".mysqli_error($conn);
	}	

$q = "CREATE TABLE IF NOT EXISTS price(
		Price_Id int PRIMARY KEY AUTO_INCREMENT,
		Product varchar(50) NOT NULL,
		Basic_Price DECIMAL(8,2),
		SGST_Rate DECIMAL(8,2),
		SGST_Value DECIMAL(8,2),
		CGST_Rate DECIMAL(8,2),
		CGST_Value DECIMAL(8,2),
		Taxble_Price DECIMAL(8,2),
		Exshow_Room_Price DECIMAL(8,2),
		Change_Date date NOT NULL)";
	$result = mysqli_query($conn, $q);
	if ($result) {
		echo "\nPrice Table Created";
	}else{
		echo "Price table creation failed due to ".mysqli_error($conn);
	}

$q = "CREATE TABLE IF NOT EXISTS payment(
		Payment_Id int PRIMARY KEY AUTO_INCREMENT,
		Receipt_No varchar(50) NOT NULL,
		Booking_No varchar(50) NOT NULL,
		Payment_Type varchar(30) NOT NULL,
		Payment_Date date NOT NULL,
		Payment_Amount DECIMAL(8,2),
		Cheque_No varchar(50) NOT NULL,
		Bank_Name varchar(50) NOT NULL,
		Branch_Name varchar(50) NOT NULL,
		Cancellation_Reason varchar(50) NOT NULL,
		Cancellation_Remark varchar(50) NOT NULL,
		Cancellation_Date date NOT NULL,
		Payment_Status varchar(30) NOT NULL)";
	$result = mysqli_query($conn, $q);
	if ($result) {
		echo "\nPrice Table Created";
	}else{
		echo "Price table creation failed due to ".mysqli_error($conn);
	}

$q = "CREATE TABLE IF NOT EXISTS vehicle(
		Frame_No varchar(20) PRIMARY KEY,
		Engine_No varchar(20) NOT NULL,
		SAP_Invoice_No varchar(50) NOT NULL,
		SAP_Invoice_Date date NOT NULL,
		Product varchar(50) NOT NULL,
		Vehicle_Status varchar(30) NOT NULL,
		Physical_Status varchar(30) NOT NULL,
		Manufacturing_Date date NOT NULL,
		Plant_Name varchar(50) NOT NULL,
		Inventory_Location varchar(100) NOT NULL,
		Emission_Norms varchar(10) NOT NULL)";
	$result = mysqli_query($conn, $q);
	if ($result) {
		echo "\nVehicle Table Created";
	}else{
		echo "Vehicle table creation failed due to ".mysqli_error($conn);
	}

$q = "CREATE TABLE IF NOT EXISTS invoice(
		Invoice_Id int PRIMARY KEY AUTO_INCREMENT,
		Invoice_No varchar(40) NOT NULL,
		Booking_No varchar(40) NOT NULL,
		Invoice_Date date NOT NULL,
		Key_No varchar(30) NOT NULL,
		Battery_No varchar(30) NOT NULL,
		Invoice_Type varchar(30) NOT NULL,
		Invoice_Status varchar(30) NOT NULL)";
	$result = mysqli_query($conn, $q);
	if ($result) {
		echo "\nInvoice Table Created";
	}else{
		echo "Invoice table creation failed due to ".mysqli_error($conn);
	}

$q = "CREATE TABLE IF NOT EXISTS users(
		Id int PRIMARY KEY AUTO_INCREMENT,
		User_Id varchar(40) NOT NULL,
		Password varchar(100) NOT NULL,
		F_Name varchar(40) NOT NULL,
		L_Name varchar(40) NOT NULL,
		Mail varchar(100) NOT NULL,
		Mobile varchar(10) NOT NULL,
		Role varchar(30) NOT NULL)";
	$result = mysqli_query($conn, $q);
	if ($result) {
		echo "\nuser Table Created";
	}else{
		echo "user table creation failed due to ".mysqli_error($conn);
	}	

}else{
	echo "database connection failed";
}

mysqli_close($conn);
?>