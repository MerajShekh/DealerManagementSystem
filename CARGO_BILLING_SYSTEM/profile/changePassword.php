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

		$("#cnfrmpass").on('input',function(){
			if ($(this).val().length>=6) {
				$("#cnfrmpasssign").html('<i class="fa fa-check" aria-hidden="true"></i>');
				$("#cnfrmpasssign").css('background-color','green');
				$("#cnfrmpasssign").css('color','white');
			}else{
				$("#cnfrmpasssign").html('<i class="fa fa-times" aria-hidden="true"></i>');
				$("#cnfrmpasssign").css('color','white');
				$("#cnfrmpasssign").css('background-color','red');
			}
		});

		$("#newpass").on('input',function(){
			if ($(this).val().length>=6) {
				$("#newpasssign").html('<i class="fa fa-check" aria-hidden="true"></i>');
				$("#newpasssign").css('background-color','green');
				$("#newpasssign").css('color','white');
			}else{
				$("#newpasssign").html('<i class="fa fa-times" aria-hidden="true"></i>');
				$("#newpasssign").css('color','white');
				$("#newpasssign").css('background-color','red');
			}
		});

		$("#updatePasswordbtn").click(function(){
			if ($("#newpass").val()=="" || $("#cnfrmpass").val() =="" || $("#oldpass").val()=="") {
					$(".card-body .alert").remove();
					$(".card-body").prepend('<div class="alert alert-warning">All fields are required</div>');
					alerthider();
			}else{
				if ($("#newpass").val().length>=6 && $("#cnfrmpass").val().length>=6) {
					if ($("#newpass").val() == $("#cnfrmpass").val()) {
						// alert($("#updatePasswordForm").serialize());
									$.ajax({
										url: '../php_action/profile.php',
										method: 'post',
										datatype: 'json',
										data: $("#updatePasswordForm").serialize(),
										success: function(data,status){
											$(".card-body .alert").remove();
											$(".card-body").prepend(data);
											alerthider();
												
											}
										});
					}else{
						$(".card-body .alert").remove();
						$(".card-body").prepend('<div class="alert alert-warning">Confirm Password Should be Same</div>');
						alerthider();	
					}
				}else{
					$(".card-body .alert").remove();
					$(".card-body").prepend('<div class="alert alert-warning">Short Password (Min 6 Char)</div>');
					alerthider();
				}
			}
			// $.ajax({
			// url: '../php_action/profile.php',
			// method: 'post',
			// datatype: 'json',
			// data: $("#updatePasswordForm").serialize(),
			// success: function(data,status){
				
			// 	$(".card-body .alert").remove();
			// 	$(".card-body").prepend(data);
			// 	alerthider();
					
			// 	}
			// });
		});


	});
</script>
<div class="container-fluid" id="pagebody">

	<div class="row">
		<div class="col-sm-3"></div>
		<div class="col-md-5" id="updatePassword">
			<div class="card border-info">
			<div class="card bg-info text-white">
				<div style="margin:5px 0px 0px 10px; "><h5><b>Update Password</b></h5></div>
			</div>
			<div class="card-body">
				
				<form action="#" method="POST" id="updatePasswordForm">
				  
				  <div class="input-group mb-3">
				  	<input type="hidden" name="userid2reset" value="<?php echo $_SESSION['LoginId']; ?>">
				    <input type="password" class="form-control inptcheck" placeholder="Current Password" id="oldpass" name="oldpass" autocomplete="off">
				    <div class="input-group-append">
				      <span class="input-group-text" id="oldpasssign"></span>
				    </div>

				</div>
				  <div class="input-group mb-3">
				    <input type="password" class="form-control inptcheck" placeholder="New Password"  id="newpass" name="newpass" autocomplete="off">
				    <div class="input-group-append">
				      <span class="input-group-text" id="newpasssign"></span>
				    </div>

				</div>
				<div class="input-group mb-3">
				    <input type="text" class="form-control inptcheck" placeholder="Confirm Password"  id="cnfrmpass" name="cnfrmpass" autocomplete="off">
				    <div class="input-group-append">
				      <span class="input-group-text" id="cnfrmpasssign"></span>
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