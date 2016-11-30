<?php
  session_start();
  if(isset($_SESSION['u_fullname'])){
    echo json_encode($_SESSION['u_fullname']." - logged in");
  }

 ?>