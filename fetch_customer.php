<?php
  require_once('connect.php');
  session_start();
  echo "something";
  echo $text=$_POST['cus_info'];
  $cus_id = explode(" ",$text)[1];
  //$cus_id=$_POST['cus_info'];
  echo $cus_id;
  echo "something";
  $q = "SELECT * FROM customer WHERE CUSTOMER_ID = '$cus_id'";
  $result = $mysqli->query($q);
  $row = $result->fetch_array();
  $_SESSION['customer_id']=$row[0];
  $_SESSION['customer_title']=$row[1];
  $_SESSION['customer_fname']=$row[2];
  $_SESSION['customer_lname']=$row[3];
  echo $_SESSION['customer_addressid']=$row[4];
  $_SESSION['customer_email']=$row[5];
  $_SESSION['customer_phone']=$row[6];
  $cusadid = $row[4];
  $q = "SELECT * FROM customer_address WHERE ADDRESS_ID = 1";
  $result = $mysqli->query($q);
  $row = $result->fetch_array();
  $_SESSION['customer_address']=$row[1];
  $_SESSION['customer_city']=$row[2];
  $_SESSION['customer_country']=$row[3];
  $_SESSION['customer_zipcode']=$row[4];


  //echo "<a href='check_customer.php'>GO</a>";
/*
  if(isset($_SESSION['model'])){
    header("Location: check_customer.php");
  } else {
    header("Location: sm_customization.php");
  }*/

 ?>
