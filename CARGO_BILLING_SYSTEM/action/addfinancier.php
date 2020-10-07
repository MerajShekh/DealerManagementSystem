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
	<!-- <div class="row">
		<div class="col-2"></div>
		<div class="col-8">
			<a href=""><i class="fa fa-plus">New</i></a>
			<a href=""><i class="fa fa-plus">Edit</i></a>
		</div>
	</div> -->
	<div class="row">
		<div class="col-sm-3"></div>
		<div class="col-md-5">
			<div class="card border-info">
			<div class="card bg-info text-white">
				<div style="margin:5px 0px 0px 10px; "><h5><b>Add Financier</b></h5></div>
			</div>
			<div class="card-body">
				<form action="#" method="POST" id="addnewfinancierForm">
				  <div class="form-group row">
				    <div class="col-sm">
				      <input type="text" class="form-control" id="financiername" name="financiername" placeholder="Financier Name" oninput="this.value =this.value.toUpperCase();">
				    </div>
				  </div>
				  <div class="form-group row">
				    <div class="col-sm">
				      <input type="text" class="form-control" id="address" name="address" placeholder="Address" oninput="this.value =this.value.toUpperCase();">
				    </div>
				  </div>
				  <div class="form-group row">
				    <div class="col-sm">
				      <input type="text" class="form-control" id="state" name="state"placeholder="State">
				    </div>
				  </div>
				  <div class="form-group row">
				    <div class="col-sm-6">
				      <input type="text" class="form-control" id="city" name="city" placeholder="City">
				    </div>
				    <div class="col-sm-6">
				      <input type="text" class="form-control" id="pincode" name="pincode" oninput="this.value = this.value.replace(/[^0-9]/g, '');" maxlength="6" placeholder="Pin Code">
				    </div>
				  </div>
				   <div class="form-group row">
				    <div class="col-sm">
				     <button id="resetfinancierbtn" name="resetfinancierbtn" type="reset" class="btn btn-warning btn-larg btn-block"><b>Add</b></button>
				    </div>
				    <div class="col-sm">
				     <button id="addnewfinancierbtn" name="addnewfinancierbtn" type="button" class="btn btn-success btn-larg btn-block"><b>Add</b></button>
				    </div>
				  </div>
				</form>			
			</div>
		</div>

	</div>
	</div>
</div>