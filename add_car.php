<?php
  require_once('connect.php');
  //session_start();

  $manufacturer = $_POST['manufacturer'];
  $model = $_POST['model'];
  $price = $_POST['price'];

  $q = "INSERT INTO car_model (MANUFACTURER,MODEL,PRICE) VALUES
  ('$manufacturer','$model',$price)";
  $result = $mysqli->query($q);

  header('Location: admin.php?page=edit');
?>