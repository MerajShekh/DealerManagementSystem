<?php 
	  include_once '../includes/header.php';
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
<script type="text/javascript" src="../custom/js/adminaction.js"></script>

<div class="container-fluid" id="pagebody">
	<div class="row">
		<div class="col-2"></div>
		<div class="col-8">
			<a href="#" id="singleFrame"><i class="fa fa-plus"> Single Frame</i></a>
			<a href="#" id="bulkFrame"><i class="fa fa-plus"> Bulk Frames</i></a>
		</div>
	</div>
	<div class="row">
		<div class="col-sm-3"></div>
		<div class="col-md-5" id="UploadSingleFrame">
			<div class="card border-info">
			<div class="card bg-info text-white">
				<div style="margin:5px 0px 0px 10px; "><h5><b>Add Stock</b></h5></div>
			</div>
			<div class="card-body">
				
				<form action="#" method="POST" id="addFrameForm">
				  <div class="form-group row">
				    <div class="col-sm">
				      <input type="text" class="form-control isfill" id="frame" name="frame" placeholder="Frame Number" oninput="this.value =this.value.toUpperCase();" maxlength="17">
				    </div>
				  </div>
				  <div class="form-group row">
				    <div class="col-sm">
				      <input type="text" class="form-control isfill" id="engine" name="engine" placeholder="Engine Number" oninput="this.value =this.value.toUpperCase();">
				    </div>
				  </div>
				  <div class="form-group row">
				    <div class="col-sm-6">
				      <input type="text" class="form-control isfill" id="invoiceno" name="invoiceno" placeholder="Purchase Invoice Number" oninput="this.value =this.value.toUpperCase();">
				    </div>
				    <div class="col-sm-6">
				      <input type="text" class="form-control isfill" id="date" name="date" placeholder="Purchase Invoice Date">
				    </div>
				  </div>
				  <div class="form-group row">
				    <div class="col-sm-6">
				      <input type="text" class="form-control isfill" id="product" name="product" placeholder="Product" oninput="this.value =this.value.toUpperCase();">
				    </div>
				    <div class="col-sm-6">
				      <input type="text" class="form-control isfill" id="mfdate" name="mfdate" placeholder="Manufacturing Date">
				    </div>
				  </div>
				  <div class="form-group row">
				    <div class="col-sm-6">
				      <select name="plant" id="plant" class="custom-select isfill">
				      	<option value="">--Select Plant--</option>
				      	<!-- <option value="Gandhidham">Gandhidham</option>
				      	<option value="Bhuj">Bhuj</option>
				      	<option value="Anjar">Anjar</option>
				      	<option value="Mundra">Mundra</option>
				      	<option value="Bhachau">Bhachau</option>
				      	<option value="Mandvi">Mandvi</option>
				      	<option value="Samakhiyali">Samakhiyali</option>
				      	<option value="Rapar">Rapar</option> -->
				      	<option value="Gurgaon">Gurgaon</option>
				      	<option value="Rajasthan">Rajasthan</option>
				      	<option value="Karnataka">Karnataka</option>
				      	<option value="Ahmedabad">Ahmedabad</option>
				      </select>
				    </div>
				    <div class="col-sm-6">
				      <select name="emmissionnorms" id="emmissionnorms" class="custom-select isfill">
				      	<option value="">--Select Emmission Norms--</option>
				      	<option value="BS IV">BS 4</option>
				      	<option value="BS VI">BS 6</option>
				      </select>
				    </div>
				  </div>
				   <div class="form-group row">
				    <div class="col-sm">
				     <button id="resetFramebtn" name="resetFramebtn" type="reset" class="btn btn-warning btn-larg btn-block"><b>Reset</b></button>
				    </div>
				    <div class="col-sm">
				     <button id="addFramebtn" name="addFramebtn" type="button" class="btn btn-success btn-larg btn-block"><b>Add</b></button>
				    </div>
				  </div>
				</form>			
			</div>
		</div>
	</div>
	

	<div class="col-md-5" id="UploadBulkFrame">
			<div class="card border-info">
			<div class="card bg-info text-white">
				<div style="margin:5px 0px 0px 10px; "><h5><b>Upload Stock</b></h5></div>
			</div>
			<div class="card-body">
				<form method="POST" id="uploadStockForm" enctype="multipart/form-data">
				  <div class="form-group row">
				  	<div class="col-sm">
				    <div class="custom-file">
				    <input type="file" class="custom-file-input" id="customFile" name="customFile">
				    <label class="custom-file-label" for="customFile">Choose file</label>
				  </div>
				  </div>
				  </div>
				   <div class="form-group row">
				    <div class="col-sm">
				     <button id="uploadStockbtn" name="uploadStockbtn" type="submit" class="btn btn-success btn-larg btn-block"><b>Upload</b></button>
				    </div>
				  </div>
				</form>			
			</div>
		</div>
	</div>
	</div>
</div>