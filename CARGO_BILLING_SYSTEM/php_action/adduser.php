<?php
session_start(); 
include 'db_connection.php';

if ($con) {

// add new User	

if (isset($_POST['addnewUser'])) {
	$pass = md5($_POST['password']);
	$mobile = $_POST['mobile'];
	$email = $_POST['email'];
	$fname = $_POST['fname'];
	$lname = $_POST['lname'];
	$role = "User";
	$query = "SELECT Id FROM users ORDER BY Id DESC LIMIT 1";
	$result = mysqli_query($con, $query);
	$rw =  mysqli_num_rows($result);
	$data = mysqli_fetch_assoc($result);
	$lastid = $data["Id"];
	$newid = "GJ130001SA".sprintf("%'03d",$lastid+1);

	$stmt = $con->prepare("INSERT INTO `users`(`User_Id`, `Password`, `F_Name`, `L_Name`, `Mail`, `Mobile`, `Role`) VALUES (?,?,?,?,?,?,?)");
		$stmt->bind_param("sssssss",$newid,$pass,$fname,$lname,$email,$mobile,$role);

		if ($stmt->execute()==true) {
			$linsteredid = mysqli_insert_id($con);
			echo '<div class="alert alert-success"><strong> GJ130001SA'.$linsteredid.' </strong> created successfully</div>';
		}else{
			echo '<div class="alert alert-success">New User creation Failed</div>';
		}
}



} // end connection

 ?>