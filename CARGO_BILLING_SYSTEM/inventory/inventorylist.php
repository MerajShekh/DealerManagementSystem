<?php 
session_start();
if (!$_SESSION) {
    header('location:/project/CARGO_BILLING_SYSTEM');
}else{
    include_once '../includes/Menu.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<title></title>
	<?php
	// require_once "../includes/files2.php";
	// require_once "../includes/datagrid.php";
 	?>

 	<!-- <script type="text/javascript" src="../custom/js/customer.js"></script> -->

    <script type="text/javascript">
        $(document).ready(function(){

        // $("#customer_table_grid").jqxGrid();
        $.ajax({
            url: "../php_action/enquiry_action.php",
            method: "POST",
            data : {name:'meraj'},
            datatype:"JSON",
            success: function(data){
            alert(data.model);

            }
        })

        });
    </script>
</head>
<body class='default'>
    
</body>
</html>

