<?php 
	  include_once '../includes/header.php';
	  include_once '../includes/chartapi.php';
	  require '../php_action/db_connection.php';


	  if ($con) {
	  	date_default_timezone_set('Asia/Kolkata');
	  	$date = date("Y-m-d",strtotime("today"));
	  	// $date = date("Y-m-d");
	  	$query = "SELECT DISTINCT Model_Name FROM Product";
		$result = mysqli_query($con,$query);
		$totalEnq = 0;
		$totalStock = 0;
		$totalconverson = 0;
		$totalBooking = 0;
		$totalInvoice = 0;
		while ($temp = mysqli_fetch_assoc($result)) {
			$query = "SELECT '$temp[Model_Name]' as Model, count(e.Enquiry_No) as Enquiry FROM Enquiry e INNER JOIN Product p ON e.Product_Id = p.Product_Id INNER JOIN color ON p.Color_Id = color.Color_Id WHERE p.Model_Name = '$temp[Model_Name]' AND e.Enquiry_Date = '$date'";
			$result2 = mysqli_query($con,$query);
			$data = mysqli_fetch_assoc($result2);

			$query = "SELECT count(b.Booking_No) as Booking FROM Booking b INNER JOIN Enquiry e ON b.Enquiry_No = e.Enquiry_No INNER JOIN Product p ON e.Product_Id = p.Product_Id INNER JOIN color ON p.Color_Id = color.Color_Id WHERE p.Model_Name = '$temp[Model_Name]' AND b.Booking_Date ='$date'";
			$result2 = mysqli_query($con,$query);
			$data += mysqli_fetch_assoc($result2);

			$query = "SELECT count(i.Invoice_No) as Invoice FROM Invoice i INNER JOIN Booking b ON i.Booking_No = b.Booking_No INNER JOIN Enquiry e ON b.Enquiry_No = e.Enquiry_No INNER JOIN Product p ON e.Product_Id = p.Product_Id INNER JOIN color ON p.Color_Id = color.Color_Id WHERE p.Model_Name = '$temp[Model_Name]' AND i.Invoice_Date ='$date'";
			$result2 = mysqli_query($con,$query);
			$data += mysqli_fetch_assoc($result2);
			// $modelData[] = $data;
			$totalEnq += $data['Enquiry'];
			$totalBooking += $data['Booking'];
			$totalInvoice += $data['Invoice'];
			if ($data['Invoice']==0) {
				$conv['ratio'] = 0;	
			}else{
				$conv['ratio'] = round(($data['Invoice']/$data['Enquiry'])*100);	
			}
			$data += $conv;

			$query = "SELECT Model_Name, count(v.Frame_No) as Stock FROM Product p INNER JOIN color ON p.Color_Id = color.Color_Id LEFT JOIN Vehicle v ON v.Product = CONCAT(p.Model_Code,p.Model_Type,color.Color_Code) WHERE p.Model_Name = '$temp[Model_Name]' AND Physical_Status != 'Sold'";
			$result2 = mysqli_query($con,$query);
			$row = mysqli_num_rows($result2);
			$data += mysqli_fetch_assoc($result2);
			$modelData[] = $data;

			$totalStock += $data['Stock'];
			

		};
		// echo json_encode($modelData);
		// DSE wise Data
			$dsequery = "SELECT * FROM dse";
			$resultt = mysqli_query($con,$dsequery);
			$dsetotalenquiry = 0;
			$dsetotalbooking = 0;
			$dsetotalinvoice = 0;

			while ($temp = mysqli_fetch_assoc($resultt)) {
				$subquery = "SELECT CONCAT(d.DSE_F_Name,' ',d.DSE_L_Name) as Name, count(e.Enquiry_No) as Enquiry FROM Enquiry e INNER JOIN dse d ON e.DSE_Id = d.DSE_Id WHERE d.DSE_Id = '$temp[DSE_Id]' AND e.Enquiry_Date = '$date'";
				$subresult = mysqli_query($con,$subquery);
				$subdata = mysqli_fetch_assoc($subresult);
				$dsetotalenquiry += $subdata['Enquiry'];

				$subquery = "SELECT count(b.Booking_No) as Booking FROM Booking b INNER JOIN Enquiry e ON b.Enquiry_No = e.Enquiry_No INNER JOIN dse d ON e.DSE_Id = d.DSE_Id WHERE d.DSE_Id = '$temp[DSE_Id]' AND b.Booking_Date ='$date'";
				$subresult = mysqli_query($con,$subquery);
				$subdata += mysqli_fetch_assoc($subresult);
				$dsetotalbooking += $subdata['Booking'];

				$subquery = "SELECT count(i.Invoice_No) as Invoice FROM Invoice i INNER JOIN Booking b ON i.Booking_No = b.Booking_No INNER JOIN Enquiry e ON b.Enquiry_No = e.Enquiry_No INNER JOIN dse d ON e.DSE_Id = d.DSE_Id WHERE d.DSE_Id = '$temp[DSE_Id]' AND i.Invoice_Date ='$date'";
				$subresult = mysqli_query($con,$subquery);
				$subdata += mysqli_fetch_assoc($subresult);
				if ($subdata['Invoice']==0) {
					$dseconv['ratio'] = 0;	
				}else{
					$dseconv['ratio'] = round(($subdata['Invoice']/$subdata['Enquiry'])*100);	
				}
				$subdata += $dseconv;

				$dsetotalinvoice += $subdata['Invoice'];
				$modelData2[] = $subdata;
			}
	
	  }else{
	  	echo "Error";
	  }

?>
<style type="text/css">
	#pagebody .row{
		/*border:1px solid red;*/
		margin-top: 30px;
	}
	#pagebody .row a{
		margin-right: 40px;
	}


</style>
<script type="text/javascript">
	$(document).ready(function (){
		$("#printbtn").click(function () {
                var content = $("thead")[0].outerHTML;
                content += $("tbody")[0].outerHTML;
                var newWindow = window.open('', '', 'width=800, height=500'),
                document = newWindow.document.open(),
                pageContent =
                    '<!DOCTYPE html>' +
                    '<html>' +
                    '<head>' +
                    '<meta charset="utf-8" />' +
                    '<title>Month Till Date Sales Chart</title>' +
                    '<style>table,th,td{boder:1px solid black; border-collapse:collapse;}</style>'+
                    '</head>' +
                    '<body>' + 
                    '<table cellpadding="15">' +content + '</table></body></html>';
                try
                {
                    document.write(pageContent);
                    document.close();
                    newWindow.print();
                    newWindow.close();
                }
                catch (error) {
                }
            });
	});
</script>
<!-- <script type="text/javascript" src="../custom/js/adminaction.js"></script> -->
<div class="container-fluid" id="pagebody">
	
	<div class="row">
		<div class="col-md-1"></div>
		<div class="col-md-5" id="meraj">
			<div class="card border-info">
			<div class="card bg-info text-white">
				<div style="margin:5px 0px 0px 10px; ">
				<a href="#" id="printbtn" style="float: right; margin:5px 30px 0px 0px; color: maroon; font-size: 18px"><i class="fa fa-Print"> Print</i></a>
				<h5><b>Daily Sales Report</b></h5>
			</div>
			</div>
			<div class="card-body">
				<table class="table">
					<thead>
						<tr>
							<th>Model</th>
							<th>Enquiry</th>
							<th>Booking</th>
							<th>Invoice</th>
							<th>Conersion</th>
							<th>Stock</th>
						</tr>
					</thead>
					<tbody>
						<?php 
						foreach ($modelData as $key => $value) {
							$data= '
									<tr>
									<td>'.$value['Model'].'</td>
									<td>'.$value['Enquiry'].'</td>
									<td>'.$value['Booking'].'</td>
									<td>'.$value['Invoice'].'</td>
									<td>'.$value['ratio'].'%</td>
									<td>'.$value['Stock'].'</td>';
									
							echo $data;		
						}
						 ?>
						 <tr>
							<th>Total</th>
							<th><?php echo $totalEnq; ?></th>
							<th><?php echo $totalBooking; ?></th>
							<th><?php echo $totalInvoice; ?></th>
							<th><?php if ($totalInvoice==0) {
								echo 0;
							}else{echo round(($totalInvoice/$totalEnq)*100);} ?>%</th>
							<th><?php echo $totalStock; ?></th>
						</tr>
					</tbody>
				</table>
						
			</div>
		</div>
	</div>
	<div class="col-md-1"></div>
	<div class="col-md-5" id="meraj">
			<div class="card border-info">
			<div class="card bg-info text-white">
				<div style="margin:5px 0px 0px 10px; ">
				<a href="#" id="printbtn" style="float: right; margin:5px 30px 0px 0px; color: maroon; font-size: 18px"><i class="fa fa-Print"> Print</i></a>
				<h5><b>Daily Sales Report</b></h5>
			</div>
			</div>
			<div class="card-body">
				<table class="table">
					<thead>
						<tr>
							<th>Saleman</th>
							<th>Enquiry</th>
							<th>Booking</th>
							<th>Invoice</th>
							<th>Conversion</th>
						</tr>
					</thead>
					<tbody>
						<?php 
						foreach ($modelData2 as $key => $value) {
							echo '
									<tr>
									<td>'.$value['Name'].'</td>
									<td>'.$value['Enquiry'].'</td>
									<td>'.$value['Booking'].'</td>
									<td>'.$value['Invoice'].'</td>
									<td>'.$value['ratio'].'%</td>
									</tr>
									';
						}
						 ?>
						 <tr>
							<th>Total</th>
							<th><?php echo $totalEnq; ?></th>
							<th><?php echo $totalBooking; ?></th>
							<th><?php echo $totalInvoice; ?></th>
							<th><?php if ($totalInvoice==0) {
								echo 0;
							}else{ echo round($totalInvoice/$totalEnq*100);}?>%</th>
						</tr>
					</tbody>
				</table>
						
			</div>
		</div>

	</div>
	</div>
	<div class="col-md-1"></div>

</div>