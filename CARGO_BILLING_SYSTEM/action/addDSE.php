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
		<div class="col-sm-3"></div>
		<div class="col-md-5">
			<div class="card border-info">
			<div class="card bg-info text-white">
				<div style="margin:5px 0px 0px 10px; "><h5><b>Add Dealer Sales Executive</b></h5></div>
			</div>
			<div class="card-body">
				
				<form action="#" method="POST" id="addnewDSEForm">
				  <div class="form-group row">
				    <div class="col-sm">
				      <input type="text" class="form-control" id="fname" name="fname" placeholder="First Name" oninput="this.value =this.value.toUpperCase();" required>
				    </div>
				  </div>
				  <div class="form-group row">
				    <div class="col-sm">
				      <input type="text" class="form-control" id="mname" name="mname" placeholder="Middle Name" oninput="this.value =this.value.toUpperCase();">
				    </div>
				  </div>
				  <div class="form-group row">
				    <div class="col-sm">
				      <input type="text" class="form-control" id="lname" name="lname" placeholder="Last Name" oninput="this.value =this.value.toUpperCase();" required>
				    </div>
				  </div>
				  <div class="form-group row">
				    <div class="col-sm-6">
				      <input type="mobile" class="form-control" id="mobile" name="mobile" oninput="this.value = this.value.replace(/[^0-9]/g, '');" maxlength="10" placeholder="Mobile" required>
				    </div>
				    <div class="col-sm-6">
				      <input type="email" class="form-control" id="email" name="email" placeholder="Email">
				    </div>
				  </div>
				   <div class="form-group row">
				   	<div class="col-sm">
				     <button id="resetDSEbtn" name="resetDSEbtn" type="reset" class="btn btn-warning btn-larg btn-block"><b>Reset</b></button>
				    </div>
				    <div class="col-sm">
				     <button id="addDSEbtn" name="addDSEbtn" type="button" class="btn btn-success btn-larg btn-block"><b>Add</b></button>
				    </div>
				  </div>
				</form>			
			</div>
		</div>

	</div>
	</div>
</div>