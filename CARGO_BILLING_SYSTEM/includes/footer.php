<!DOCTYPE html>
<html>
<head>
  <title></title>
   <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- bootstrap -->
  <link rel="stylesheet" type="text/css" href="./assets/bootstrap/css/bootstrap.min.css">
  <!-- font-->
  <link rel="stylesheet" type="text/css" href="./assets/font/css/all.min.css">
  <!-- custom -->
  <link rel="stylesheet" type="text/css" href="./custom/css/navmenu.css">
  <script type="text/javascript" src="./custom/js/custom.js"></script>
  <!-- jquery -->
  <script type="text/javascript" src="./assets/jquery/jquery.min.js"></script>
  <!-- jquery-ui -->
  <link rel="stylesheet" type="text/css" href="./assets/jquery-ui2/jquery-ui.min.css">
  <script type="text/javascript" src="./assets/jquery-ui2/jquery-ui.min.js"></script>
  <!--bootstrap js -->
  <script type="text/javascript" src="./assets/bootstrap/js/bootstrap.min.js"></script>


  <script>
    // $(function() {
    //  $( "#dialog" ).hide();
    //   $( "#datepicker" ).datepicker();
        
    //  $("#datepicker").on("click", function(){

    //    $( "#dialog" ).dialog();
    //  });
    // });

//     $(document).ready(function(){
//   // alert("he");
//   $(".unactive").click(function(){
//   // alert("he");
//     $(".unactive").removeClass("active");
//     $(this).toggleClass("active");
//     //var n=("#myTopnav").firt();
//     //alert(this.className);  
    
//   });


// });


  $(".unactive").click(function(){
  alert("he");
    $(".unactive").removeClass("active");
    $(this).toggleClass("active");
    //var n=("#myTopnav").firt();
    //alert(this.className);  
    
  });

   
   </script>

</head>
<body>

<div class="topnav" id="myTopnav">
  <a class="navbar-brand" href="javascript:void(0);"><img src="assets/images/cargologo.png" style="width:45px; height: 23px; margin:0px; padding: 0px;"></a>
  <a href="javascript:void(0);" class="active" onclick="currentMenu(this.className)">Home</a>
  <a href="javascript:void(0);" class="unactive" onclick="currentMenu(this.className)">Customer</a>
  <a href="javascript:void(0);" class="unactive" onclick="currentMenu(this.className)">Enquiry</a>
  <a href="javascript:void(0);" class="unactive" onclick="currentMenu(this.className)">Booking</a>
  <a href="javascript:void(0);" class="unactive" onclick="currentMenu(this.className)">Invoice</a>
  <a href="javascript:void(0);" class="unactive">Inventory</a>
  <a href="javascript:void(0);" class="unactive">Report</a>
  <a href="javascript:void(0);" class="icon" onclick="myFunction()">
    <i class="fa fa-bars"></i>
  </a>
</div>

<!-- <div class="container-fluid">
  <iframe name="mainpage" id="mainpage" class="container-fluid" height="600" scrolling="no" frameborder="0"></iframe>
</div>
 -->
<!-- <div class="container">
  <div class="row">
    <div class="col-md-12 col-md-offset-4">
      <div class="card">
      <div class="card-header">abc</div>
      <div class="card-body">
      <div class="card-title">honda</div>
      <div class="card-text">carghondna</div>
      
      </div>
      <div class="card-footer">copyright</div>
      </div>
    </div>
  </div>
</div> -->


</body>
</html>
