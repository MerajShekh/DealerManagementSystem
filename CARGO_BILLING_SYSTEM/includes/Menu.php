<?php 
if (!$_SESSION) {
  header('location:/project/CARGO_BILLING_SYSTEM');
}else{
  require_once "../includes/header.php";
?>
  <script>
    
          $(document).ready(function(){

            $("#menuitem a").each(function(){
                var p = location.pathname;
                var menuname = this.id;
                var r = p.search(menuname);
              if (r>0) {
                $("#"+menuname).addClass("active");
              }

            });

          });
       
   
   </script>

<div class="topnav" id="myTopnav">
  <div class="menucontain">
  <img src="../assets/images/cargologo.png" style="width: 45px; height: 35px; margin-top: 0px; padding: 0px;">
  <div class="menuitem" id="menuitem">
      <a href="../home" id="home" class="" accesskey="h"><i class="fa fa-home"></i><u>H</u>ome</a>
      <a href="../customer" id="customer" class="" accesskey="c"><i class="fa fa-user"></i><u>C</u>ustomer</a>
      <a href="../enquiry" id="enquiry" class="" accesskey="n"><i class="fa fa-envelope"></i>E<u>n</u>quiry</a>
      <a href="../booking" id="booking" class="" accesskey="b"><i class="fa fa-book"></i><u>B</u>ooking</a>
      <a href="../invoice" id="invoice" class="" accesskey="i"><i class="fa fa-file-invoice"></i><u>I</u>nvoice</a>
      <a href="../inventory" id="inventory" class="" accesskey="v"><i class="fa fa-truck"></i>In<u>v</u>entory</a>
      <a href="../report" id="report" class="" accesskey="r"><i class="fa fa-search"></i><u>R</u>eport</a>
      <a href="../action" id="action" class="unactive" accesskey="a"><i class="fa fa-wrench"></i><u>A</u>ction</a>
      <a href="../logout.php" id="logoutbtn" class="user"><i class="fa fa-sign-out-alt"> Logout</i>&nbsp;</a>
      <a href="../profile" id="username" class="user"><?php echo $_SESSION['Name']; ?></a>
      <a class="icon" onclick="myFunction()">
        <i class="fa fa-bars"></i>
      </a>
  </div>
</div>
</div>
<?php } ?>