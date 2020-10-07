$(document).ready(function () {


    $("input, select").click(function(){
    $(this).addClass("bgchange");
     });

    $("input, select").on('blur',function(){
    $(this).removeClass("bgchange");
     });

function alerthider(){
	window.setTimeout(function() {
	    $(".alert").fadeTo(500, 0).slideUp(500, function(){
	        $(this).remove(); 
	    });
}, 2000);
}
// Date picker
$("#date,#mfdate").datepicker({
		dateFormat : 'dd/mm/yy',
});

fetchColor();
function fetchColor(){
	var html = '<option value="">--Select Color--</option>';
	$.ajax({
		url: '../php_action/adminaction.php',
		method:'post',
		datatype:'json',
		data:{fetchAllColors:""},
		success: function(data,status){
			var fetcheddata = $.parseJSON(data);
			$.each(fetcheddata, function(key, value){
	      	html += '<option value="'+value.Color_Id+'">'+value.Color_Name+' ('+value.Color_Code+')</option>';
	      })
			// alert($html);
	      $("#color").html(html);
		}
	});
}

// add color
$("#addColorbtn").click(function(){
	var colorname = $("#colorname").val();
	var colorcode = $("#colorcode").val();
	if (colorname=="" || colorcode=="") {
		alert("Fill Empty Fields!")
	}else{
		$.ajax({
			url: '../php_action/adminaction.php',
			method: 'post',
			datatype: 'json',
			data: {addColors:"",colorcode:colorcode,colorname:colorname},
			success: function(data,status){
				$(".card-body .alert").remove();
				$(".card-body").prepend('<div class="alert alert-success"><strong>Color </strong>added successfully</div>');
				// $("#colorAlert").alert();
				$("#addColorForm").trigger('reset');
				alerthider();
			}
		});
	}
});


$("#colorcode").on('input',function(){
	var colorcode = $(this).val();
	$.ajax({
			url: '../php_action/adminaction.php',
			method: 'post',
			datatype: 'json',
			data: {fetchcolorcode:colorcode},
			success: function(data,status){
				var fetcheddata = $.parseJSON(data);
				if (fetcheddata==0) {
					$(".card-body .alert").remove();
					$(".card-body").prepend('<div class="alert alert-success"><strong>'+colorcode+' </strong>available for insertion</div>');
					alerthider();
				}else{
					$(".card-body .alert").remove();
					$(".card-body").prepend('<div class="alert alert-warning"><strong>'+fetcheddata.Color_Name+'</strong> Already exist</div>');
					alerthider();
				}
			}
		});
});

// add model
$("#addModelbtn").click(function(){
		$.ajax({
			url: '../php_action/adminaction.php',
			method: 'post',
			datatype: 'json',
			data: $("#addnewModelform").serialize(),
			success: function(data,status){
				// alert(data);
				$(".card-body .alert").remove();
				$(".card-body").prepend(data);
				$("#addnewModelform").trigger('reset');
				alerthider();
			}
		});
});

//model exist or not
$("#modelcode, #type, #color").change(function(){
	var color = $("#color").val();
	var code = $("#modelcode").val();
	var modelvariant = $("#modelvariant").val();
	var type = $("#type").val();
	$.ajax({
			url: '../php_action/adminaction.php',
			method: 'post',
			datatype: 'json',
			data: {isModelExist:"",
					color:color,
					code:code,
					type:type
					},
			success: function(data,status){
				var fetcheddata = $.parseJSON(data);
				// alert(data);
				if (fetcheddata==0) {
					$(".card-body .alert").remove();
					$(".card-body").prepend('<div class="alert alert-success"><strong>'+modelvariant+' </strong>available for insertion</div>');
					alerthider();
				}else{
					$(".card-body .alert").remove();
					$(".card-body").prepend('<div class="alert alert-warning"><strong>'+fetcheddata.Model_Variant+'</strong> Already exist</div>');
					alerthider();
				}
			}
		});
})

// add new DSE
$("#addDSEbtn").click(function(){
	var fname = $("#fname").val();
	var lname = $("#lname").val();
	var mobile = $("#mobile").val();
	if (fname=="" || lname=="" || mobile=="") {
		$(".card-body .alert").remove();
		$(".card-body").prepend('<div class="alert alert-warning"><strong>Fill required fields</strong></div>');
		alerthider();
	}else{
		$.ajax({
			url:'../php_action/adminaction.php',
			method:'post',
			datatype:'json',
			data:$("#addnewDSEForm").serialize(),
			success: function(data,status){
				$(".card-body .alert").remove();
				$(".card-body").prepend(data);
				$("#addnewDSEForm").trigger('reset');
				alerthider();
			}
		});
	}
});

// add new Financier
$("#addnewfinancierbtn").click(function(){
	var financiername = $("#financiername").val();
	var address = $("#address").val();
	var state = $("#state").val();
	var city = $("#city").val();
	var pincode = $("#pincode").val();
	if (financiername=="" || state=="" || city=="" || pincode=="" || address=="") {
		$(".card-body .alert").remove();
		$(".card-body").prepend('<div class="alert alert-warning"><strong>Fill required fields</strong></div>');
		alerthider();
	}else{
		$.ajax({
			url:'../php_action/adminaction.php',
			method:'post',
			datatype:'json',
			data:$("#addnewfinancierForm").serialize(),
			success: function(data,status){
				$(".card-body .alert").remove();
				$(".card-body").prepend(data);
				$("#addnewfinancierForm").trigger('reset');
				alerthider();
			}
		});
	}
});

// Add new Frames
$("#addFramebtn").click(function(){
	var d = $(".isfill");
	var flag = 0;
	$.each(d, function(key,value){
	var el = value.value;
		if (el=="") {
			flag=0;
			$(this).css('border-color','red');
			$(".card-body .alert").remove();
			$(".card-body").prepend('<div class="alert alert-warning"><strong>Fill required fields</strong></div>');
			alerthider();

		}else{
			flag=1;
			$(this).css('border-color','');
		}
	});
	if (flag==1) {
		// alert($("#addFrameForm").serialize());
		$.ajax({
			url:'../php_action/adminaction.php',
			method:'post',
			datatype:'json',
			data:$("#addFrameForm").serialize(),
			success: function(data,status){
				$(".card-body .alert").remove();
				$(".card-body").prepend(data);
				$("#addPriceForm").trigger('reset');
				alerthider();
			}
		});
	}
	
});

$("#addPriceModal").hide();
$("#UploadBulkModal").hide();
//show Add new Price Modal
$("#addFormbtn").click(function(){
	$("#updatePriceModal").hide();
	$("#UploadBulkModal").hide();
	$("#addPriceModal").show();
})

// show Update Price Modal
$("#updateFormbtn").click(function(){
	$("#addPriceModal").hide();
	$("#UploadBulkModal").hide();
	$("#updatePriceModal").show();
})

// show Bulk Upload Price Modal
$("#bulkUploadbtn").click(function(){
	$("#addPriceModal").hide();
	$("#updatePriceModal").hide();
	$("#UploadBulkModal").show();
});

$("#a-exprice").on('change',function(){
	var exprice = $(this).val();
	var basicprice = (exprice*100/128).toFixed(2);
	$("#a-basicprice").val(basicprice);
	$("#a-sgstprice").val((basicprice*14/100).toFixed(2));
	$("#a-cgstprice").val((basicprice*14/100).toFixed(2));
});

// addpricebtn event
$("#addPricebtn").click(function(){
	if ($("#a-exprice").val()=="" || $("#a-modelcode").val()=="") {
		alert("Input Empty Filed");
	}else{

		$.ajax({
			url:'../php_action/adminaction.php',
			method:'post',
			datatype:'json',
			data:$("#addPriceForm").serialize(),
			success: function(data,status){
				$(".card-body .alert").remove();
				$(".card-body").prepend(data);
				$("#addPriceForm").trigger('reset');
				alerthider();
			}
		});
	}
});

// check mtoc for update
$("#u-modelcode").change(function(){
	var product = $("#u-modelcode").val();
	$.ajax({
			url:'../php_action/adminaction.php',
			method:'post',
			datatype:'json',
			data:{fetchproduct:product},
			success: function(data,status){
				var fetcheddata = $.parseJSON(data);
				if (fetcheddata==0) {
					$(".card-body .alert").remove();
					$(".card-body").prepend('<div class="alert alert-warning"><strong>MTOC</strong> not exist</div>');
					$("#updatePriceForm").trigger('reset');
					alerthider();
				}else{
					$("#u-exprice").val(fetcheddata.Exshow_Room_Price);
					$("#u-basicprice").val(fetcheddata.Basic_Price);
					$("#u-sgstprice").val(fetcheddata.SGST_Value);
					$("#u-cgstprice").val(fetcheddata.CGST_Value);
				}
				
			}
		});
});

// CALCULATE PRICE
$("#u-exprice").change(function(){
	var exprice = $(this).val();
	var basicprice = (exprice*100/128).toFixed(2);
	$("#u-basicprice").val(basicprice);
	$("#u-sgstprice").val((basicprice*14/100).toFixed(2));
	$("#u-cgstprice").val((basicprice*14/100).toFixed(2));
});

$("#updatePricebtn").click(function(){
	if ($("#u-exprice").val()=="" || $("#u-modelcode").val()=="") {
		alert("Input Empty Filed");
	}else{
	$.ajax({
		url:'../php_action/adminaction.php',
		method:'post',
		datatype:'json',
		data:$("#updatePriceForm").serialize(),
		success: function(data,status){
			$(".card-body .alert").remove();
			$(".card-body").prepend(data);
			$("#updatePriceForm").trigger('reset');
			alerthider();
			}
		});

	}
});

$("#UploadSingleFrame").hide();

$("#singleFrame").click(function(){
	$("#UploadBulkFrame").hide();
	$("#UploadSingleFrame").show();

});

$("#bulkFrame").click(function(){
	$("#UploadSingleFrame").hide();
	$("#UploadBulkFrame").show();
});

// show name on select box
$("#customFile, #uploadPrice,#addBulkColorFile, #uploadModelFile").on("change", function() {
  var fileName = $(this).val().split("\\").pop();
  $(this).siblings(".custom-file-label").addClass("selected").html(fileName);
});

$("#uploadStockForm").on('submit',function(e){
	e.preventDefault();
	$(".card-body .alert").remove();
	$(".card-body").prepend('<div class="alert alert-danger">Please wait...</div>');
	$.ajax({
		url:'../php_action/adminaction.php',
		method:'POST',
		data:new FormData(this),
		contentType:false,
		cache:false,
		processData:false,
		success: function(data,status){
			$(".card-body .alert").remove();
			$(".card-body").prepend(data);
			$("#uploadStockForm").trigger('reset');
			alerthider();
			}
		});
});

$("#uploadPriceForm").on('submit',function(e){
	e.preventDefault();
	$(".card-body .alert").remove();
	$(".card-body").prepend('<div class="alert alert-danger">Please wait...</div>');
	$.ajax({
		url:'../php_action/adminaction.php',
		method:'POST',
		data:new FormData(this),
		contentType:false,
		cache:false,
		processData:false,
		success: function(data,status){
			$(".card-body .alert").remove();
			$(".card-body").prepend(data);
			$("#uploadPriceForm").trigger('reset');
			alerthider();
			}
		});
});

$("#addBulkColor").hide();

$("#singlecolorbtn").click(function(){
	$("#addBulkColor").hide();
	$("#addSingleColor").show();
});

$("#bulkcolorbtn").click(function(){
	$("#addBulkColor").show();
	$("#addSingleColor").hide();
});

$("#addBulkColorForm").on('submit',function(e){
	e.preventDefault();
	$(".card-body .alert").remove();
	$(".card-body").prepend('<div class="alert alert-danger">Please wait...</div>');
	$.ajax({
		url:'../php_action/adminaction.php',
		method:'POST',
		data:new FormData(this),
		contentType:false,
		cache:false,
		processData:false,
		success: function(data,status){
			$(".card-body .alert").remove();
			$(".card-body").prepend(data);
			$("#addBulkColorForm").trigger('reset');
			alerthider();
			}
		});
});

$("#addBulkCity").hide();
$("#singlecitybtn").click(function(){
	$("#addBulkCity").hide();
	$("#addSingleCity").show();
});

$("#bulkcitybtn").click(function(){
	$("#addBulkCity").show();
	$("#addSingleCity").hide();
});
// add city
$("#addCitybtn").click(function(){
	if ($("#cityname").val()=="" || $("#citystate").val()=="") {
		alert("Input Empty Filed");
	}else{

		$.ajax({
			url:'../php_action/adminaction.php',
			method:'post',
			datatype:'json',
			data:$("#addCityForm").serialize(),
			success: function(data,status){
				$(".card-body .alert").remove();
				$(".card-body").prepend(data);
				$("#addCityForm").trigger('reset');
				alerthider();
			}
		});
	}
});


$("#UploadBulkModelModal").hide();




});