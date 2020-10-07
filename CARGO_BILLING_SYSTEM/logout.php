<?php 
session_start();
session_unset();
session_destroy();

// echo "session destroyed";
header('location:/project/CARGO_BILLING_SYSTEM');

 ?>