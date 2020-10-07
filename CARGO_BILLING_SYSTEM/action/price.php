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
			<a href="#" id="addFormbtn"><i class="fa fa-plus">Add</i></a>
			<a href="#" id="updateFormbtn"><i class="fa fa-plus">Update</i></a>
			<a href="#" id="bulkUploadbtn"><i class="fa fa-plus">Bulk Upload</i></a>
		</div>
	</div>
	<div class="row">
		<div class="col-sm-3"></div>
		<div class="col-md-5" id="addPriceModal">
			<div class="card border-info">
			<div class="card bg-info text-white">
				<div style="margin:5px 0px 0px 10px; "><h5><b>Add Price</b></h5></div>
			</div>
			<div class="card-body">
				
				<form action="#" method="POST" id="addPriceForm">
				  <div class="form-group row">
				    <div class="col-sm">
				      <input type="text" class="form-control" id="a-modelcode" name="a-modelcode" placeholder="Enter Model Code" oninput="this.value =this.value.toUpperCase();">
				    </div>
				  </div>
				  <div class="form-group row">
				    <div class="col-sm">
				      <input type="text" class="form-control" id="a-exprice" name="a-exprice" placeholder="Ex-Showromm Price" maxlength="6" oninput="this.value = this.value.replace(/[^0-9]/g, '');">
				    </div>
				    <div class="col-sm">
				      <input type="text" class="form-control" id="a-basicprice" name="a-basicprice" placeholder="Basic Price" readonly>
				    </div>
				  </div>
				  <div class="form-group row">
				    <div class="col-sm-6">
				      <input type="text" class="form-control" id="a-sgstrate" name="a-sgstrate" value="14%" readonly>
				    </div>
				    <div class="col-sm-6">
				      <input type="text" class="form-control" id="a-sgstprice" name="a-sgstprice" readonly>
				    </div>
				  </div>
				  <div class="form-group row">
				    <div class="col-sm-6">
				      <input type="text" class="form-control" id="a-cgstrate" name="a-cgstrate" value="14%" readonly>
				    </div>
				    <div class="col-sm-6">
				      <input type="text" class="form-control" id="a-cgstprice" name="a-cgstprice" readonly>
				    </div>
				  </div>
				  				 
				   <div class="form-group row">
				    <div class="col-sm">
				     <button id="resetPricebtn" name="resetPricebtn" type="reset" class="btn btn-warning btn-larg btn-block"><b>Reset</b></button>
				    </div>
				    <div class="col-sm">
				     <button id="addPricebtn" name="addPricebtn" type="button" class="btn btn-success btn-larg btn-block"><b>Add</b></button>
				    </div>
				  </div>
				</form>			
			</div>
		</div>
	</div>
	<!-- Update Price List -->
	<div class="col-md-5" id="updatePriceModal">
			<div class="card border-info">
			<div class="card bg-info text-white">
				<div style="margin:5px 0px 0px 10px; "><h5><b>Update Price</b></h5></div>
			</div>
			<div class="card-body">
				
				<form action="#" method="POST" id="updatePriceForm">
				  <div class="form-group row">
				    <div class="col-sm">
				      <input type="text" class="form-control" id="u-modelcode" name="u-modelcode" placeholder="Enter Model Code" oninput="this.value =this.value.toUpperCase();">
				    </div>
				  </div>
				  <div class="form-group row">
				    <div class="col-sm">
				      <input type="text" class="form-control" id="u-exprice" name="u-exprice" placeholder="Ex-Showromm Price" maxlength="6" oninput="this.value = this.value.replace(/[^0-9]/g, '');">
				    </div>
				    <div class="col-sm">
				      <input type="text" class="form-control" id="u-basicprice" name="u-basicprice" placeholder="Basic Price" readonly>
				    </div>
				  </div>
				  <div class="form-group row">
				    <div class="col-sm-6">
				      <input type="text" class="form-control" id="u-sgstrate" name="u-sgstrate" value="14%" readonly>
				    </div>
				    <div class="col-sm-6">
				      <input type="text" class="form-control" id="u-sgstprice" name="u-sgstprice" readonly>
				    </div>
				  </div>
				  <div class="form-group row">
				    <div class="col-sm-6">
				      <input type="text" class="form-control" id="u-cgstrate" name="u-cgstrate" value="14%" readonly>
				    </div>
				    <div class="col-sm-6">
				      <input type="text" class="form-control" id="u-cgstprice" name="u-cgstprice" readonly>
				    </div>
				  </div>
				  				 
				   <div class="form-group row">
				    <div class="col-sm">
				     <button id="resetPricebtn" name="resetPricebtn" type="reset" class="btn btn-warning btn-larg btn-block"><b>Reset</b></button>
				    </div>
				    <div class="col-sm">
				     <button id="updatePricebtn" name="updatePricebtn" type="button" class="btn btn-success btn-larg btn-block"><b>Update</b></button>
				    </div>
				  </div>
				</form>			
			</div>
		</div>
	</div>

	<div class="col-md-5" id="UploadBulkModal">
			<div class="card border-info">
			<div class="card bg-info text-white">
				<div style="margin:5px 0px 0px 10px; "><h5><b>Upload Price</b></h5></div>
			</div>
			<div class="card-body">
				<form method="POST" id="uploadPriceForm" enctype="multipart/form-data">
				  <div class="form-group row">
				  	<div class="col-sm">
				    <div class="custom-file">
				    <input type="file" class="custom-file-input" id="uploadPrice" name="uploadPrice">
				    <label class="custom-file-label" for="uploadPrice">Choose file</label>
				  </div>
				  </div>
				  </div>
				   <div class="form-group row">
				    <div class="col-sm">
				     <button id="uploadPricebtn" name="uploadPricebtn" type="submit" class="btn btn-success btn-larg btn-block"><b>Upload Price</b></button>
				    </div>
				  </div>
				</form>			
			</div>
		</div>
	</div>
	</div>
</div>