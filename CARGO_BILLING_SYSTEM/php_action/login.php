<?php
session_start(); 
include 'db_connection.php';

if ($con) {
// User Login	
if (isset($_POST['username'])) {
	$userid = $_POST['username'];
	$password = md5($_POST['password']);
	$query = "SELECT * FROM users WHERE User_Id = '$userid' AND Password = '$password' LIMIT 1";
	$result = mysqli_query($con,$query);
	$row = mysqli_num_rows($result);
	$data = mysqli_fetch_assoc($result);
	if ($row>0) {
		$_SESSION['Name'] = $data['F_Name']." ".$data['L_Name'];
		$_SESSION['Role'] = $data['Role'];
		$_SESSION['LoginId'] = $data['User_Id'];
		echo $row;
	}else{
		echo "Wrong ID or Password";
	}
}

// Reser Password
if (isset($_POST['userid'])) {
	$userid = $_POST['userid'];
	$mobile_email = $_POST['mobile-email'];
	$password = md5($_POST['newPassword']);
	$query = "SELECT * FROM users WHERE User_Id= '$userid' AND ( Mobile = '$mobile_email' OR Mail = '$mobile_email')";
	$result = mysqli_query($con,$query);

	$row = mysqli_num_rows($result);
		if ($row>0) {
			$query = "UPDATE users SET Password = '$password' WHERE User_Id = '$userid'";	
			$result = mysqli_query($con,$query);
			if ($result) {
				echo "Password successfully updated";
			}else{
				echo "Password updation fail".mysqli_error($con);
			}
		}else{
			echo "Data not match !...";
		}
	}

} // end connection

 ?>