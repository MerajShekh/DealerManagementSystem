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
			<a href="#" id="addSingleModelbtn"><i class="fa fa-plus">Single</i></a>
			<a href="#" id="addBulkModelbtn"><i class="fa fa-plus">Bulk</i></a>
		</div>
	</div>
	<div class="row">
		<div class="col-sm-3"></div>
		<div class="col-md-5">
			<div class="card border-info">
			<div class="card bg-info text-white">
				<div style="margin:5px 0px 0px 10px; "><h5><b>Add Model</b></h5></div>
			</div>
			<div class="card-body">
				
				<form id="addnewModelform">
				  <div class="form-group row">
				    <div class="col-sm">
				      <select name="modelcategory" class="custom-select" required>
				      	<option value="">--Select Category--</option>
				      	<option value="SC">SC</option>
				      	<option value="MC">MC</option>
				  		</select>
				    </div>
				  </div>
				  <div class="form-group row">
				    <div class="col-sm">
				      <input type="text" class="form-control" id="modelname" name="modelname" placeholder="Model Name" oninput="this.value =this.value.toUpperCase();" required>
				    </div>
				  </div>
				  <div class="form-group row">
				    <div class="col-sm">
				      <input type="text" class="form-control" id="modelvariant" name="modelvariant" placeholder="Model Variant" oninput="this.value =this.value.toUpperCase();" required>
				    </div>
				  </div>
				  <div class="form-group row">
				    <div class="col-sm">
				    	<select name="color" id="color" class="custom-select" required>
				    		<option value="">--Select Color--</option>
				    	</select>
				    </div>
				  </div>
				  <div class="form-group row">
				    <div class="col-sm-6">
				      <input type="text" class="form-control" id="modelcode" name="modelcode" placeholder="Model Code" oninput="this.value =this.value.toUpperCase();" required>
				    </div>
				    <div class="col-sm-6">
				      <input type="text" class="form-control" id="type" name="type" placeholder="Model Type" maxlength="3" oninput="this.value =this.value.toUpperCase();" required>
				    </div>
				  </div>
				   <div class="form-group row">
				    <div class="col-sm">
				     <button id="resetModelbtn" name="resetModelbtn" type="reset" class="btn btn-warning btn-larg btn-block"><b>Reset</b></button>
				    </div>
				    <div class="col-sm">
				     <button id="addModelbtn" name="addModelbtn" type="button" class="btn btn-success btn-larg btn-block"><b>Add</b></button>
				    </div>
				  </div>
				</form>			
			</div>
		</div>

	</div>

	<div class="col-md-5" id="UploadBulkModelModal">
			<div class="card border-info">
			<div class="card bg-info text-white">
				<div style="margin:5px 0px 0px 10px; "><h5><b>Upload Model</b></h5></div>
			</div>
			<div class="card-body">
				<form method="POST" id="uploadModelForm" enctype="multipart/form-data">
				  <div class="form-group row">
				  	<div class="col-sm">
				    <div class="custom-file">
				    <input type="file" class="custom-file-input" id="uploadModelFile" name="uploadModelFile">
				    <label class="custom-file-label" for="uploadModelFile">Choose file</label>
				  </div>
				  </div>
				  </div>
				   <div class="form-group row">
				    <div class="col-sm">
				     <button id="uploadModelbtn" name="uploadModelbtn" type="submit" class="btn btn-success btn-larg btn-block"><b>Upload Price</b></button>
				    </div>
				  </div>
				</form>			
			</div>
		</div>
	</div>
	</div>
</div>