<?php
  require_once('connect.php');
  session_start();

  $text=$_POST['cus_info'];
  $cus_id = explode(" ",$text)[0];
  echo $cus_id;
  $q = "SELECT * FROM customer WHERE CUSTOMER_ID = '$cus_id'";
  $result = $mysqli->query($q);
  $row = $result->fetch_array();
  $_SESSION['customer_id']=$row[0];
  $_SESSION['customer_title']=$row[1];
  $_SESSION['customer_fname']=$row[2];
  $_SESSION['customer_lname']=$row[3];

  //echo "<a href='check_customer.php'>GO</a>";
  if(isset($_SESSION['model'])){
    header("Location: check_customer.php");
  } else {
    header("Location: sm_customization.php");
  }

 ?>
