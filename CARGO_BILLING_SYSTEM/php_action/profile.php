<?php
session_start(); 
include 'db_connection.php';

if ($con) {
// User Login	
if (isset($_POST['fetchUserData'])) {
	// echo $_SESSION['LoginId'];
	$userid = $_SESSION['LoginId'];
	$query = "SELECT * FROM users WHERE User_Id = '$userid'";
	$result = mysqli_query($con,$query);
	$row = mysqli_num_rows($result);
	if ($row>0) {
		while ($temp = mysqli_fetch_assoc($result)) {
			$data = $temp;
		}
		echo json_encode($data);
	}else{
		echo $row;
	}
}

// Reser Password
if (isset($_POST['userid'])) {
	$userid = $_POST['userid'];
	$mobile = $_POST['mobile'];
	$email = $_POST['mailid'];
	$fname = $_POST['fname'];
	$lname = $_POST['lname'];
	$query = "UPDATE users SET Mail = '$email',Mobile = '$mobile', L_Name = '$lname', F_Name = '$fname' WHERE User_Id = '$userid'";
	$result = mysqli_query($con,$query);

		if (mysqli_query($con,$query)) {
			$_SESSION['Name'] = $fname." ".$lname;
			echo '<div class="alert alert-success">Profile Updated successfully</div>';
		}else{
			echo '<div class="alert alert-success">Profile Updation Failed</div>';
		}
	}

if (isset($_POST['userid2reset'])) {
	// echo "reset";
	$userid = $_POST['userid2reset'];
	$oldpassword = md5($_POST['oldpass']);
	$newpassword = md5($_POST['newpass']);

	$query = "SELECT User_Id FROM users WHERE User_Id = '$userid' AND Password = '$oldpassword'";
	$result = mysqli_query($con,$query);
	$row = mysqli_num_rows($result);
	if ($row>0) {
			$query = "UPDATE users SET Password = '$newpassword'WHERE User_Id = '$userid'";
			if (mysqli_query($con,$query)) {
				echo '<div class="alert alert-success">Password Updated successfully</div>';	
			}else{

			echo '<div class="alert alert-success">Password Updation Failed</div>';
			}
	}else{
		echo '<div class="alert alert-warning">Current Password is Wrong</div>';
	}
}


} // end connection

 ?>