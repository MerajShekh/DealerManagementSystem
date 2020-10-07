<?php 
session_start();
if (!$_SESSION) {
  header('location:/project/CARGO_BILLING_SYSTEM');
}else{
  include_once '../includes/Menu.php';
?>
<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>home</title>
  <style>
  .ui-autocomplete {
    height: 200px;
    overflow-y: auto;
    /* prevent horizontal scrollbar */
    overflow-x: hidden;
  }
  .custom-combobox {
    position: relative;
    display: inline-block;
  }
  .custom-combobox-toggle {
    position: absolute;
    top: 0;
    bottom: 0;
    height: 30px;
    margin-left: -1px;
    padding: 0;
  }
  .custom-combobox-input {
    margin: 0;
    padding: 5px 10px;
    height: 30px;
  }
  </style>

  
 <script type="text/javascript" src="../custom/js/searchablecombobox.js"></script>
</head>
<body>
  <div>Combobox Example</div>
  <div>
 <input type="text" name="" id="logs" class="custom-combobox-input ui-widget ui-widget-content ui-state-default ui-corner-left">
 </div>
 
</body>
</html>
<?php } ?>