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
			<a href="#" id="singlecolorbtn"><i class="fa fa-plus">Single</i></a>
			<a href="#" id="bulkcolorbtn"><i class="fa fa-plus">Bulk</i></a>
		</div>
	</div>
	<div class="row">
		<div class="col-sm-3"></div>
		<div class="col-md-5" id="addSingleColor">
			<div class="card border-info">
			<div class="card bg-info text-white">
				<div style="margin:5px 0px 0px 10px; "><h5><b>Add Color</b></h5></div>
			</div>
			<div class="card-body">
				
				<form id="addColorForm">
				  <div class="form-group row">
				    <div class="col-sm">
				      <input type="text" class="form-control" id="colorname" name="colorname" placeholder="Color Name" oninput="this.value =this.value.toUpperCase();">
				    </div>
				  </div>
				  <div class="form-group row">
				    <div class="col-sm">
				      <input type="text" class="form-control" id="colorcode" name="colorcode" placeholder="Color Code" oninput="this.value =this.value.toUpperCase();">
				    </div>
				  </div>
				   <div class="form-group row">
				    <div class="col-sm">
				     <button id="resetColorbtn" name="resetColorbtn" type="reset" class="btn btn-warning btn-block"><b>Reset</b></button>
				    </div>
				    <div class="col-sm">
				     <button id="addColorbtn" name="addColorbtn" type="button" class="btn btn-success btn-block"><b>Add</b></button>
				    </div>
				  </div>
				</form>			
			</div>
		</div>
	</div>

	<div class="col-md-5" id="addBulkColor">
			<div class="card border-info">
			<div class="card bg-info text-white">
				<div style="margin:5px 0px 0px 10px; "><h5><b>Add Bulk Color</b></h5></div>
			</div>
			<div class="card-body">
				<form method="POST" id="addBulkColorForm" enctype="multipart/form-data">
				  <div class="form-group row">
				  	<div class="col-sm">
				    <div class="custom-file">
				    <input type="file" class="custom-file-input" id="addBulkColorFile" name="addBulkColorFile">
				    <label class="custom-file-label" for="addBulkColorFile">Choose file</label>
				  </div>
				  </div>
				  </div>
				   <div class="form-group row">
				    <div class="col-sm">
				     <button id="uploadStockbtn" name="uploadStockbtn" type="submit" class="btn btn-success btn-larg btn-block"><b>Upload Color</b></button>
				    </div>
				  </div>
				</form>			
			</div>
		</div>
	</div>

	</div>
</div>