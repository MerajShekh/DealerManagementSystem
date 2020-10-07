$(document).ready(function () {

// Data for recent Enquiries
$.ajax({

	url:"../php_action/enquiry.php",
	method: "POST",
	datatype: "JSON",
	data: {recentEnquiries:""},
	success: function(data, status){
		if (status='success') {
			$("#recentEnquiries").html(data);
		}
	}
});


});