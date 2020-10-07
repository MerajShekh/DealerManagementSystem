$(document).ready(function(){
	// alert(location.pathname);

// $("#rbody #recentCustomer").html("<b>Hello world!</b>");


$("input, select").click(function(){
	$(this).addClass("bgchange");
})

$("input, select").on('blur',function(){
	$(this).removeClass("bgchange");
})

// Data for recent customer
$.ajax({

	url:"../php_action/customerList.php",
	method: "POST",
	datatype: "JSON",
	data: {Rcustomer:'RecentCustomer'},
	success: function(data, status){
		if (status='success') {
			$("#recentCustomer").html(data);
		}
	}
});


$("#searchCustomerbtn").click(function(){
	$("#searchCustomerForm").submit();
	// $("#searchCustomerForm")[0].reset();
	// alert("clicked");
})


$("#addCustomerbtn").click(function(){
	var fname = $("#addCustomerForm #addFName").val();
	var mobile = $("#addCustomerForm #addMobile").val();
	var gender = $("#addCustomerForm #addGender").val();
	if (fname==="" || mobile==="" || gender==="") {
		alert("please put value");
	}else{
		
	$.ajax({
		url:"../php_action/customerList.php",
		method:"POST",
		datatype:"JSON",
		data : $("#addCustomerForm").serialize(),
		success: function(data,status){
			if (status='success') {
			// alert(data);
			$("#addCustomerForm").trigger('reset');
			$("#customerId").val(data);
			$("#addCustomerForm").submit();
			}else{
				alert("something wrong!");
			}

		}

	}); // End of ajax

	} //End of if statement
});




});