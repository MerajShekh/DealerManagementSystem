<?php 
date_default_timezone_set('Asia/Kolkata');
require_once 'db_connection.php';

if ($con) {

function changeDateFormat($data){
		$date = substr(str_replace('/','',$data),0,2);
		$month = substr(str_replace('/','',$data),2,2);
		$year = substr(str_replace('/','',$data),4,4);
		$d = mktime(0,0,0,$month,$date,$year);
		return date('Y-m-d',$d);
	};
	
if (isset($_POST['fetchAllColors'])) {
	$query = "SELECT * FROM color";
	$result = mysqli_query($con,$query);
	if ($result) {
		while ($temp = mysqli_fetch_assoc($result)) {
			$data[] = $temp;
		}
		echo json_encode($data);
	}
}

if (isset($_POST['addColors'])) {
	$colorname = $_POST['colorname'];
	$colorcode = $_POST['colorcode'];

	$stmt = $con->prepare("INSERT INTO color (Color_Name,Color_Code) VALUES (?,?)");
	$stmt->bind_param("ss",$colorname,$colorcode);
	if ($stmt->execute()==true) {
		echo "Color Inserted";
	}else{ echo "Color Insertion Error";}
}
// is color exist or not
if (isset($_POST['fetchcolorcode'])) {
	$colorcode = $_POST['fetchcolorcode'];
	// $colorcode = "NH1";
	$query = "SELECT * FROM color WHERE Color_Code ='$colorcode'";
	$result = mysqli_query($con,$query);
	$row = mysqli_num_rows($result);
	if ($row>0) {
		while ($temp = mysqli_fetch_assoc($result)) {
			$data = $temp;
		}
		echo json_encode($data);
	}else { echo $row;}
}

if (isset($_POST['modelcode'])) {
	$modelcategory = $_POST['modelcategory'];
	$modelname = $_POST['modelname'];
	$modelvariant = $_POST['modelvariant'];
	$modelcolor = $_POST['color'];
	$modelcode = $_POST['modelcode'];
	$modeltype = $_POST['type'];
	$status = "Active";

	$stmt = $con->prepare("INSERT INTO product (Model_Category,Model_Name,Model_Variant,Model_Code,Model_Type,Model_Status,Color_Id) VALUES (?,?,?,?,?,?,?)");
	$stmt->bind_param("sssssss",$modelcategory,$modelname,$modelvariant,$modelcode,$modeltype,$status,$modelcolor);
	if ($stmt->execute()==true) {
		echo '<div class="alert alert-success"><strong>'.$modelvariant.' </strong>inserted successfully</div>';
	}else{ echo '<div class="alert alert-warning"><strong>'.$modelvariant.' </strong>insertion Error</div>';}
}

// is model exist or not
if (isset($_POST['isModelExist'])) {
	$colorid = $_POST['color'];
	$modelcode = $_POST['code'];
	$modeltype = $_POST['type'];

	$query = "SELECT * FROM product WHERE Model_Code ='$modelcode' AND Model_Type = '$modeltype' AND Color_Id = '$colorid'";
	$result = mysqli_query($con,$query);
	$row = mysqli_num_rows($result);
	if ($row>0) {
		while ($temp = mysqli_fetch_assoc($result)) {
			$data = $temp;
		}
		echo json_encode($data);
	}else { echo $row;}
}

// Add new DSE
if (isset($_POST['fname'])) {
	$fname = $_POST['fname'];
	$mname = $_POST['mname'];
	$lname = $_POST['lname'];
	$mobile = $_POST['mobile'];
	$email = $_POST['email'];
	$dealercode = "GJ130001";
	$status = "Active";
	$query = "SELECT * FROM dse WHERE DSE_Mobile = '$mobile'";
	$result = mysqli_query($con, $query);
	$row = mysqli_num_rows($result);
	if ($row>0) {
			echo '<div class="alert alert-warning"><strong>'.$mobile.' </strong>alread inserted</div>';
	}else{
		$query = "SELECT DSE_Id FROM dse ORDER BY DSE_Id DESC LIMIT 1";
		$result = mysqli_query($con, $query);
		$data = mysqli_fetch_assoc($result);
		$lastid = $data['DSE_Id'];
		$dsecode = $dealercode."SE".sprintf("%'03d",$lastid+1);
		// echo $dsecode;
		
		$stmt = $con->prepare("INSERT INTO dse (DSE_Code,Dealer_Code,DSE_F_Name,DSE_M_Name,DSE_L_Name,DSE_Mobile,DSE_Email,Status) VALUES (?,?,?,?,?,?,?,?)");
		$stmt->bind_param("sssssiss",$dsecode,$dealercode,$fname,$mname,$lname,$mobile,$email,$status);
		if ($stmt->execute()==true) {
			$insertedid = mysqli_insert_id($con);
			echo '<div class="alert alert-success"><strong>GJ130001SE'.$insertedid.' </strong>inserted successfully</div>';
		}else{ echo '<div class="alert alert-warning"><strong>'.$mobile.' </strong>insertion Error</div>';}
	}
}

if (isset($_POST['financiername'])) {
	$fname = $_POST['financiername'];
	$address = $_POST['address'];
	$state = $_POST['state'];
	$city = $_POST['city'];
	$pincode = $_POST['pincode'];
	$status = "Active";

	$query = "SELECT * FROM financier WHERE F_Name = '$fname'";
	$result = mysqli_query($con, $query);
	$row = mysqli_num_rows($result);

	if ($row>0) {
		echo '<div class="alert alert-warning"><strong>'.$fname.' </strong>alread inserted</div>';	
	}else{
		$stmt =  $con->prepare("INSERT INTO financier(F_Name,F_Address,F_City,F_State,F_Pin,Status) VALUES (?,?,?,?,?,?)");
		$stmt->bind_param("ssssss",$fname,$address,$city,$state,$pincode,$status);
		if ($stmt->execute()==true) {
			echo '<div class="alert alert-success"><strong>'.$fname.' </strong>inserted successfully</div>';
		}else{
			echo '<div class="alert alert-warning"><strong>'.$fname.' </strong>insertion Error</div>';
		}
	}
}

if (isset($_POST['a-modelcode'])) {
	$product = $_POST['a-modelcode'];
	$exshowroom = $_POST['a-exprice'];
	$basic = $_POST['a-basicprice'];
	$cgst = $_POST['a-basicprice'];
	$rate = 14;
	$sgst = $_POST['a-sgstprice'];
	$date = date("Y/m/d",time());

	$query = "SELECT * FROM price WHERE Product = '$product'";
	$result = mysqli_query($con, $query);
	$row = mysqli_num_rows($result);

	if ($row>0) {
		echo '<div class="alert alert-warning"><strong>'.$product.' </strong>alread inserted</div>';
	}else{

		$stmt =  $con->prepare("INSERT INTO price(Product,Basic_Price,SGST_Rate,SGST_Value,CGST_Rate,CGST_Value,Exshow_Room_Price,Change_Date) VALUES (?,?,?,?,?,?,?,?)");
		$stmt->bind_param("siiiiiis",$product,$basic,$rate,$cgst,$rate,$sgst,$exshowroom,$date);
		if ($stmt->execute()==true) {
			echo '<div class="alert alert-success">Price <strong>'.$exshowroom.' </strong>inserted successfully for mtoc <strong>'.$product.'</strong></div>';
		}else{
			echo '<div class="alert alert-warning"><strong>'.$fname.' </strong>insertion Error</div>';
		}
	}
}

if (isset($_POST['fetchproduct'])) {
	$product = $_POST['fetchproduct'];
	$query = "SELECT * FROM price WHERE Product = '$product'";
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

if (isset($_POST['u-modelcode'])) {
	$product = $_POST['u-modelcode'];
	$exshowroom = $_POST['u-exprice'];
	$basic = $_POST['u-basicprice'];
	$cgst = $_POST['u-cgstprice'];
	$sgst = $_POST['u-sgstprice'];
	$date = date("Y/m/d",time());

	$query = "UPDATE price SET Basic_Price='$basic', SGST_Value = '$sgst', CGST_Value = '$cgst',Change_Date = '$date',Exshow_Room_Price = '$exshowroom' WHERE Product = '$product' ";
	if (mysqli_query($con,$query)==true) {
		echo '<div class="alert alert-success"><strong>Price </strong> successfully updated</div>';
	}else{
		echo '<div class="alert alert-warning"><strong>Price </strong>updation Error</div>';
	}
}

if (isset($_POST['frame'])) {


	$frame = $_POST['frame'];
	$engine = $_POST['engine'];
	$invoiceno = $_POST['invoiceno'];
	$invoicedate = changeDateFormat($_POST['date']);
	$product = $_POST['product'];
	$mfd = changeDateFormat($_POST['mfdate']);
	$location = "Gandhidham";
	$emmission = $_POST['emmissionnorms'];
	$plant = $_POST['plant'];
	$vehiclestatus="Available";
	$physicalstatus = "In Transit";
	
	$query="SELECT * FROM vehicle WHERE Frame_No='$frame'";
	$result = mysqli_query($con,$query);
	$row = mysqli_num_rows($result);
	if ($row>0) {
		echo '<div class="alert alert-warning"><strong>'.$frame.'</strong> already exist</div>';
	}else{

		$stmt = $con->prepare("INSERT INTO vehicle(Frame_No,Engine_No,SAP_Invoice_No,SAP_Invoice_Date,Product,Vehicle_Status,Physical_Status,Manufacturing_Date,Plant_Name,Inventory_Location,Emission_Norms) VALUES (?,?,?,?,?,?,?,?,?,?,?)");
		$stmt->bind_param("sssssssssss",$frame,$engine,$invoiceno,$invoicedate,$product,$vehiclestatus,$physicalstatus,$mfd,$plant,$location,$emmission);
		if ($stmt->execute()==true) {
			echo '<div class="alert alert-success"><strong>'.$frame.'</strong> successfully inserted</div>';	
		}else{
			echo '<div class="alert alert-warning"><strong>Insertion </strong> Error</div>';
		}
	}
}

if (isset($_FILES['customFile'])) {
			if ($_FILES['customFile']['name']) {
			$filename=explode('.',$_FILES['customFile']['name']);
			if ($filename[1]=='csv') {
				$handle=fopen($_FILES['customFile']['tmp_name'],"r");
				while ($data = fgetcsv($handle)) {
					date_default_timezone_set('Asia/Calcutta');
					$frame= mysqli_real_escape_string($con,$data[0]);
					$engine=mysqli_real_escape_string($con,$data[1]);
					$sapinvoiceno=mysqli_real_escape_string($con,$data[2]);
					$sapinvoicedate=date("Y-m-d",strtotime(mysqli_real_escape_string($con,$data[3])));
					$product=mysqli_real_escape_string($con,$data[4]);
					$vehiclestatus=mysqli_real_escape_string($con,$data[5]);
					$physicalstatus=mysqli_real_escape_string($con,$data[6]);
					$mfd=date("Y-m-d",strtotime(mysqli_real_escape_string($con,$data[7])));
					$plant=mysqli_real_escape_string($con,$data[8]);
					$location=mysqli_real_escape_string($con,$data[9]);
					$emission=mysqli_real_escape_string($con,$data[10]);
					$query="INSERT INTO vehicle(Frame_No,Engine_No,SAP_Invoice_No,SAP_Invoice_Date,Product,Vehicle_Status,Physical_Status,Manufacturing_Date,Plant_Name,Inventory_Location,Emission_Norms) values('$frame','$engine','$sapinvoiceno','$sapinvoicedate','$product','$vehiclestatus','$physicalstatus','$mfd','$plant','$location','$emission')";
					$result = mysqli_query($con,$query);
					if ($result) {
						echo '<div class="alert alert-success"><strong>Frames </strong> Uploaded Successfully</div>';
					}else{ 
						echo '<div class="alert alert-warning"><strong>'.mysqli_error($con).'</strong></div>';
					}
				}
				fclose($handle);
			}
	}
}

if (isset($_FILES['uploadPrice'])) {
			if ($_FILES['uploadPrice']['name']) {
			$filename=explode('.',$_FILES['uploadPrice']['name']);
			if ($filename[1]=='csv') {
				$handle=fopen($_FILES['uploadPrice']['tmp_name'],"r");
				while ($data = fgetcsv($handle)) {
					$product= mysqli_real_escape_string($con,$data[3]);
					$basic=mysqli_real_escape_string($con,$data[4]);
					$srate=mysqli_real_escape_string($con,$data[5]);
					$svalue=mysqli_real_escape_string($con,$data[6]);
					$crate=mysqli_real_escape_string($con,$data[7]);
					$cvalue=mysqli_real_escape_string($con,$data[8]);
					$exshowroom=mysqli_real_escape_string($con,$data[9]);
					$changedate=date("Y-m-d",strtotime(mysqli_real_escape_string($con,$data[10])));
					$query="INSERT INTO price(Product,Basic_Price,SGST_Rate,SGST_Value,CGST_Rate,CGST_Value,Exshow_Room_Price,Change_Date) values('$product','$basic','$srate','$svalue','$crate','$cvalue','$exshowroom','$changedate')";
					$result = mysqli_query($con,$query);
					
				}
				if ($result) {
						echo '<div class="alert alert-success"><strong>Price </strong> Updated Successfully</div>';
					}else{ 
						echo '<div class="alert alert-warning"><strong>'.mysqli_error($con).'</strong></div>';
					}
				fclose($handle);
			}
	}
}

if (isset($_FILES['addBulkColorFile'])) {
			if ($_FILES['addBulkColorFile']['name']) {
			$filename=explode('.',$_FILES['addBulkColorFile']['name']);
			if ($filename[1]=='csv') {
				$handle=fopen($_FILES['addBulkColorFile']['tmp_name'],"r");
				while ($data = fgetcsv($handle)) {
					$code= mysqli_real_escape_string($con,$data[0]);
					$name=mysqli_real_escape_string($con,$data[1]);
					$query="INSERT INTO color(Color_Code,Color_Name) values('$code','$name')";
					$result = mysqli_query($con,$query);
					
				}
				if ($result) {
						echo '<div class="alert alert-success"><strong>Color </strong> Updated Successfully</div>';
					}else{ 
						echo '<div class="alert alert-warning"><strong>'.mysqli_error($con).'</strong></div>';
					}
				fclose($handle);
			}
	}
}

if (isset($_POST['cityname'])) {
	$city =  $_POST['cityname'];
	$state =  $_POST['citystate'];

	$query="SELECT * FROM city WHERE City_Name='$city'";
	$result = mysqli_query($con,$query);
	$row = mysqli_num_rows($result);
	if ($row>0) {
		echo '<div class="alert alert-warning"><strong>'.$city.'</strong> already exist</div>';
	}else{
		$stmt = $con->prepare("INSERT INTO city(City_Name,State) VALUES (?,?)");
		$stmt->bind_param("ss",$city,$state);
		if ($stmt->execute()==true) {
			echo '<div class="alert alert-success"><strong>'.$city.'</strong> successfully inserted</div>';	
		}else{
			echo '<div class="alert alert-warning"><strong>Insertion </strong> Error</div>';
		}
	}
	
}


}
?>