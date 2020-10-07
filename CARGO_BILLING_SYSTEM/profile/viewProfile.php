<?php 
	session_start();
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

		function alerthider(){
			window.setTimeout(function() {
			    $(".alert").fadeTo(500, 0).slideUp(500, function(){
			        $(this).remove(); 
			    });
		}, 2000);
		}

		$.ajax({
			url: '../php_action/profile.php',
			method: 'post',
			datatype: 'json',
			data: {fetchUserData:""},
			success: function(data,status){
				var fetcheddata = $.parseJSON(data);
				$("#userid").val(fetcheddata['User_Id']);
				$("#mailid").val(fetcheddata['Mail']);
				$("#fname").val(fetcheddata['F_Name']);
				$("#lname").val(fetcheddata['L_Name']);
				$("#mobile").val(fetcheddata['Mobile']);
				$("#role").val(fetcheddata['Role']);
					
			}
		});

		$("#updateProfilebtn").click(function(){
			// alert($("#userProfileForm").serialize());
			$.ajax({
			url: '../php_action/profile.php',
			method: 'post',
			datatype: 'json',
			data: $("#userProfileForm").serialize(),
			success: function(data,status){
				
				$(".card-body .alert").remove();
				$(".card-body").prepend(data);
				alerthider();
					
			}
		});
		});


	});
</script>
<!-- <script type="text/javascript" src="../custom/js/adminaction.js"></script> -->
<div class="container-fluid" id="pagebody">

	<div class="row">
		<div class="col-sm-3"></div>
		<div class="col-md-5" id="updatePassword">
			<div class="card border-info">
			<div class="card bg-info text-white">
				<div style="margin:5px 0px 0px 10px; "><h5><b>User Profile</b></h5></div>
			</div>
			<div class="card-body">
				
				<form action="#" method="POST" id="userProfileForm">
				  <div class="form-group row">
				    <div class="col-sm">
				      <input type="text" class="form-control" id="userid" name="userid" readonly>
				    </div>
				  </div>
				  <div class="form-group row">
				    <div class="col-sm">
				      <input type="mail" class="form-control" id="mailid" name="mailid" placeholder="Enter E-mail">
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
				     <button id="updateProfilebtn" name="updateProfilebtn" type="button" class="btn btn-success btn-larg btn-block"><b>Update</b></button>
				    </div>
				  </div>
				</form>			
			</div>
		</div>
	</div>

	</div>
</div>
