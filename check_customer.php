<?php
  require_once('connect.php');
  session_start();

  //$_SESSION['manufacturer'] = $_POST['manufacturer'];
  if(!isset($_SESSION['model'])){
  $_SESSION['model'] = $_POST['model'];
  $_SESSION['in_color'] = $_POST['in_color'];
  $_SESSION['ex_color'] = $_POST['ex_color'];
  $_SESSION['wheel'] = $_POST['wheel'];
  $_SESSION['insurance'] = $_POST['insurance'];

  echo "Model: ".$_SESSION['model']." In_color: ".$_SESSION['in_color']
  ." Ex_color: ".$_SESSION['ex_color']
  ." Wheel: ".$_SESSION['wheel']." Insurance: ".$_SESSION['insurance'];
  }
  //echo $_SESSION['customer_id'];
  if(isset($_SESSION['customer_id'])){
    $model = $_SESSION['model'];
    $q="SELECT PRICE FROM car_model WHERE CAR_ID = $model";
    $result = $mysqli->query($q);
    $row = $result->fetch_array();
    $price1 = $row[0];
    echo " ".$price1;

    $incolor = $_SESSION['in_color'];
    $q="SELECT PRICE FROM in_color WHERE IN_COLOR_ID = $incolor";
    $result = $mysqli->query($q);
    $row = $result->fetch_array();
    $price2 = $row[0];
    echo " ".$price2;

    $excolor = $_SESSION['ex_color'];
    $q="SELECT PRICE FROM ex_color WHERE EX_COLOR_ID = $excolor";
    $result = $mysqli->query($q);
    $row = $result->fetch_array();
    $price3 = $row[0];
    echo " ".$price3;

    $wheel = $_SESSION['wheel'];
    $q="SELECT PRICE FROM wheel WHERE WHEEL_ID = $wheel";
    $result = $mysqli->query($q);
    $row = $result->fetch_array();
    $price4 = $row[0];
    echo " ".$price4;
    $sum = ($price1+$price2+$price3+$price4);
    $total = $sum*1.3;
    echo " sum: ".$sum;
    echo " plus service charge 30%: ".$total;
  } else {
    echo "select a customer";
  }
?>