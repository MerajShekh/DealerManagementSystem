<?php

$con = mysqli_connect("localhost","root","","cargo_honda");

if ($con) {
	
	if (isset($_POST['addFName'])) {
		
			echo $_POST["addFName"];
	}else{
		echo "variable not set";
	}
	// echo "call";

}else{
	echo "Database connection failed";
}

?>