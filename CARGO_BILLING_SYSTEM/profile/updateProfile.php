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
<!-- <script type="text/javascript" src="../custom/js/adminaction.js"></script> -->
<div class="container-fluid" id="pagebody">

	<div class="row">
		<div class="col-sm-3"></div>
		<div class="col-md-5" id="updatePassword">
			<div class="card border-info">
			<div class="card bg-info text-white">
				<div style="margin:5px 0px 0px 10px; "><h5><b>Update Password</b></h5></div>
			</div>
			<div class="card-body">
				
				<form action="#" method="POST" id="addPriceForm">
				  <div class="form-group row">
				    <div class="col-sm">
				      <input type="text" class="form-control" id="userid" name="userid" readonly>
				    </div>
				  </div>
				  <div class="form-group row">
				    <div class="col-sm">
				      <input type="mail" class="form-control" id="a-modelcode" name="a-modelcode" placeholder="Enter E-mail">
				    </div>
				  </div>
				  <div class="form-group row">
				    <div class="col-sm-6">
				      <input type="text" class="form-control" id="fname" name="fname" placeholder="First Name">
				    </div>
				    <div class="col-sm-6">
				      <input type="text" class="form-control" id="lname" name="lname" placeholder="First Name">
				    </div>
				  </div>
				  <div class="form-group row">
				    <div class="col-sm-6">
				      <input type="text" class="form-control" id="mobile" name="mobile" placeholder="Mobile">
				    </div>
				    <div class="col-sm-6">
				      <input type="text" class="form-control" id="role" name="role" readonly>
				    </div>
				  </div>
				  				 
				   <div class="form-group row">
				    <div class="col-sm">
				     <button id="updatePasswordbtn" name="updatePasswordbtn" type="button" class="btn btn-success btn-larg btn-block"><b>Update</b></button>
				    </div>
				  </div>
				</form>			
			</div>
		</div>
	</div>

	</div>
</div>