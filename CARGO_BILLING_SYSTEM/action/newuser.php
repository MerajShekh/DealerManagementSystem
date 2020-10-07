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
<script type="text/javascript">
	$(document).ready(function(){
		$("#addUserbtn").click(function(){

			function alerthider(){
			window.setTimeout(function() {
			    $(".alert").fadeTo(500, 0).slideUp(500, function(){
			        $(this).remove(); 
			    });
		}, 2000);
		}
			$.ajax({
			url: '../php_action/adduser.php',
			method: 'post',
			datatype: 'json',
			data: $("#addnewUserForm").serialize(),
			success: function(data,status){
				// alert(data);
				$(".card-body .alert").remove();
				$(".card-body").prepend(data);
				alerthider();
					
			}
		});
		});

	});
</script>

<div class="container-fluid" id="pagebody">
	
	<div class="row">
		<div class="col-sm-3"></div>
		<div class="col-md-5">
			<div class="card border-info">
			<div class="card bg-info text-white">
				<div style="margin:5px 0px 0px 10px; "><h5><b>Add New User</b></h5></div>
			</div>
			<div class="card-body">
				
				<form action="#" method="POST" id="addnewUserForm">
				  <div class="form-group row">
				    <div class="col-sm">
				    	<input type="hidden" name="addnewUser">
				      <input type="text" class="form-control" id="fname" name="fname" placeholder="First Name" oninput="this.value =this.value.toUpperCase();" required>
				    </div>
				  </div>
				  <div class="form-group row">
				    <div class="col-sm">
				      <input type="text" class="form-control" id="lname" name="lname" placeholder="Middle Name" oninput="this.value =this.value.toUpperCase();">
				    </div>
				  </div>
				  <div class="form-group row">
				    <div class="col-sm">
				      <input type="text" class="form-control" id="password" name="password" placeholder="Login Password" oninput="this.value =this.value.toUpperCase();" required>
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
				     <button id="resetUserbtn" name="resetUserbtn" type="reset" class="btn btn-warning btn-larg btn-block"><b>Reset</b></button>
				    </div>
				    <div class="col-sm">
				     <button id="addUserbtn" name="addUserbtn" type="button" class="btn btn-success btn-larg btn-block"><b>Create</b></button>
				    </div>
				  </div>
				</form>			
			</div>
		</div>

	</div>
	</div>
</div>