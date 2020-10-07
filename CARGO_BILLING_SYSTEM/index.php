<?php 
session_start();
if ($_SESSION) {
  header('location:/project/CARGO_BILLING_SYSTEM/home');
}else{
?>
<html>
<head>
  <title>Cargo Honda</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="icon" type="text/css" href="./assets/images/cargologo.png">
  <link rel="stylesheet" type="text/css" href="./assets/bootstrap/css/bootstrap.min.css">
  <script type="text/javascript" src="./assets/jquery/jquery.min.js"></script>
  <script type="text/javascript" src="./assets/bootstrap/js/bootstrap.min.js"></script>
  <style type="text/css">
    body{
      background: url('./assets/images/banner6.jpg');
      background-repeat: no-repeat;
      background-size: 100% 100%;
    }
    #loginrow, #resetrow{
      margin: 120px 45px 0px 0px;
    }
    #loginrow .col, #resetrow .col{
      width: 100%;
      margin: 25px;
      margin-top: 40px;
    }
    #loginrow .col-3, #resetrow .col-3{
      background-color: black;
      opacity: 0.8;
    }
    input,button{
      margin-top: 30px;
    }
    p{
      color: lightblue;
    }
    #reseterrormsg, #errormsg{
      color: red;
    }

    a{
      float: right;
    }
    a:hover{
      color: white;
      text-decoration: none;
    }

  </style>
  <script>
       $(document).ready(function(){
        $("#resetrow").hide();
        $("#forgotPassword").click( function(e){
          e.preventDefault();
          $("#resetrow").show();
          $("#loginrow").hide();
        });

        $("#login").click( function(e){
          e.preventDefault();
          $("#resetrow").hide();
          $("#loginrow").show();
        })
        $("#loginForm").on('submit',function(e){
          e.preventDefault();
          var uid = $("#username").val();
          var password = $("#password").val();
          if (uid==="" || password==="") {
            $("#errormsg").html("ID Password Required");
          }else{
              $.ajax({
                url:'./php_action/login.php',
                method:'post',
                datatype:'JSON',
                data:$("#loginForm").serialize(),
                success: function(data,status){
                  if (data==1) {
                    $(location).attr('href', '/project/CARGO_BILLING_SYSTEM/home');
                  }else{
                    $("#errormsg").html(data);
                  }
                }
              });
            }
          })

        $("#restPasswordForm").on('submit',function(e){
          e.preventDefault();
          var uid = $("#userid").val();
          var mobile_email = $("#mobile-email").val();
          var newpassword = $("#newPassword").val();
          var renewpassword = $("#confirmPassword").val();

          if (uid==="" || mobile_email==="" || newpassword==="" || renewpassword==="") {
            $("#reseterrormsg").html("All fields are required");
          }else if(newpassword!=renewpassword){
            $("#reseterrormsg").html("Re-Enter Password should be same");
          }else{
              $.ajax({
                url:'./php_action/login.php',
                method:'post',
                datatype:'JSON',
                data:$("#restPasswordForm").serialize(),
                success: function(data,status){
                    $("#reseterrormsg").html(data);
                }
              });
            }
          })
   });
   </script>
</head>
<body>
<div class="row" id="loginrow">
  <div class="col"></div>
  <div class="col"></div>
  <div class="col-3">
    <div class="row">
      <div class="col" id="">
        <p id="errormsg"></p>
      <form method="post" id="loginForm" name="loginForm">
      <input class="form-control" type="text" name="username" id="username" placeholder="User ID">
      <input class="form-control" type="password" name="password" id="password" placeholder="Password">
      <input type="submit" name="" class="btn btn-success btn-block" value="Login">
      </form>
      <a href="#" id="forgotPassword">Forgot Password</a>
      </div>
    </div>
  </div>
</div>

<div class="row" id="resetrow">
  <div class="col"></div>
  <div class="col"></div>
  <div class="col-3">
    <div class="row">
      <div class="col" id="">
        <p id="reseterrormsg"></p>
        <h4><p>Password Recovery</p></h4>
      <form method="post" id="restPasswordForm" name="restPasswordForm">
      <input class="form-control" type="text" name="userid" id="userid" placeholder="User ID">
      <input class="form-control" type="text" name="mobile-email" id="mobile-email" placeholder="Register Email or Mobile">
      <input class="form-control" type="text" name="newPassword" id="newPassword" placeholder="New Password">
      <input class="form-control" type="text" name="confirmPassword" id="confirmPassword" placeholder="Confirm Password">
      <input type="submit" name="" class="btn btn-success btn-block" value="Reset">
      </form>
      <a href="#" id="login">Login</a>
      </div>
    </div>
  </div>
</div>

</body>
</html>
<?php } ?>