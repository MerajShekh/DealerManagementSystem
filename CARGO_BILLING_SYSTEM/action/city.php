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
			<a href="#" id="singlecitybtn"><i class="fa fa-plus">Single</i></a>
			<a href="#" id="bulkcitybtn"><i class="fa fa-plus">Bulk</i></a>
		</div>
	</div>
	<div class="row">
		<div class="col-sm-3"></div>
		<div class="col-md-5" id="addSingleCity">
			<div class="card border-info">
			<div class="card bg-info text-white">
				<div style="margin:5px 0px 0px 10px; "><h5><b>Add City</b></h5></div>
			</div>
			<div class="card-body">
				
				<form id="addCityForm">
				  <div class="form-group row">
				    <div class="col-sm">
				      <input type="text" class="form-control" id="cityname" name="cityname" placeholder="City Name" oninput="this.value =this.value.toUpperCase();">
				    </div>
				  </div>
				  <div class="form-group row">
				    <div class="col-sm">
				      <input type="text" class="form-control" id="citystate" name="citystate" placeholder="City State" oninput="this.value =this.value.toUpperCase();">
				    </div>
				  </div>
				   <div class="form-group row">
				    <div class="col-sm">
				     <button id="resetCitybtn" name="resetCitybtn" type="reset" class="btn btn-warning btn-block"><b>Reset</b></button>
				    </div>
				    <div class="col-sm">
				     <button id="addCitybtn" name="addCitybtn" type="button" class="btn btn-success btn-block"><b>Add</b></button>
				    </div>
				  </div>
				</form>			
			</div>
		</div>
	</div>

	<div class="col-md-5" id="addBulkCity">
			<div class="card border-info">
			<div class="card bg-info text-white">
				<div style="margin:5px 0px 0px 10px; "><h5><b>Add Bulk City</b></h5></div>
			</div>
			<div class="card-body">
				<form method="POST" id="addBulkCityForm" enctype="multipart/form-data">
				  <div class="form-group row">
				  	<div class="col-sm">
				    <div class="custom-file">
				    <input type="file" class="custom-file-input" id="addBulkCityFile" name="addBulkCityFile">
				    <label class="custom-file-label" for="addBulkCityFile">Choose file</label>
				  </div>
				  </div>
				  </div>
				   <div class="form-group row">
				    <div class="col-sm">
				     <button id="uploadCitykbtn" name="uploadCitybtn" type="submit" class="btn btn-success btn-larg btn-block"><b>Upload</b></button>
				    </div>
				  </div>
				</form>			
			</div>
		</div>
	</div>

	</div>
</div>