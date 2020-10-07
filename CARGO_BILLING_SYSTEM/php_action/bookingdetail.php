<?php

require_once 'db_connection.php';

if ($con) {
	// echo "connected";
	if (isset($_POST['id'])) {
		$column = $_POST['id'];
		$data = $_POST['data'];
		$fetchedData = $_POST['fetcheddata'];
		// $column = "Model_Category";
		// $data = "SC";
		// $fetchedData = "Model_Name";
		// echo $column;
		// $html =
		$q = "SELECT DISTINCT ".$fetchedData." FROM product WHERE ".$column." = '".$data."'";
		$result = mysqli_query($con, $q);

		
		// $num = mysqli_num_rows($result);
		if ($result) {
			while($temp = mysqli_fetch_assoc($result)){

				$html[] = $temp[$fetchedData];
			}
			echo json_encode($html);
		}

}  //  /.isset function

}else{
echo "connection failed";
	
}


?>