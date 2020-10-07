<head>
  <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- bootstrap -->
  <link rel="stylesheet" type="text/css" href="../assets/bootstrap/css/bootstrap.min.css">
  <!-- font-->
  <link rel="stylesheet" type="text/css" href="../assets/font/css/all.min.css">
  <!-- custom -->
  <link rel="stylesheet" type="text/css" href="../custom/css/custom.css">
  <script type="text/javascript" src="../custom/js/custom.js"></script>
  <!-- jquery -->
  <script type="text/javascript" src="../assets/jquery/jquery.min.js"></script>
  <!-- jquery-ui -->
  <link rel="stylesheet" type="text/css" href="../assets/jquery-ui2/jquery-ui.min.css">
  <script type="text/javascript" src="../assets/jquery-ui2/jquery-ui.min.js"></script>
  <!--bootstrap js -->
  <script type="text/javascript" src="../assets/bootstrap/js/bootstrap.min.js"></script>
  <script type="text/javascript">
    $(document).ready(function(){
  
    var pagelink = window.location.href.substr(window.location.href.lastIndexOf("./")+1);
    // alert(location.href.lastIndexOf(attr("href")));
    $("#myTopnav a").each(function(){
      var t = $(this).attr("href");
      // alert(t);
      var l = (pagelink.length)-(t.length);
      alert(pagelink+">>>>"+pagelink.length+"\n"+t+" >>>> "+t.length+"->>>"+t.lastIndexOf(".")+"\n"+l);
      
    //   alert($(this).attr("href"));
    //  if ($(this).attr("href")==pagelink){
    //       $(this).toggleClass("active");
    // }else{
    //      $(this).removeClass("active");
    //   }
    
      });
  });

  </script>
</head>

<div class="topnav" id="myTopnav">
  <a class="navbar-brand" href="javascript:void(0);"><img src="assets/images/cargologo.png" style="width:45px; height: 23px; margin:0px; padding: 0px;"></a>
  <a href="javascript:void(0);" class="menubtn">Home</a>
  <a href="../customer/" class="menubtn">Customer</a>
  <a href="../enquiry/" class="menubtn">Enquiry</a>
  <a href="../booking/" class="menubtn">Booking</a>
  <a href="../invoice/" class="menubtn">Invoice</a>
  <a href="../inventory/" class="menubtn">Inventory</a>
  <a href="javascript:void(0);" class="icon" onclick="myFunction()">
    <i class="fa fa-bars"></i>
  </a>
</div>