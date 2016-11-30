<?php
  require_once('connect.php');
  //session_start();

  $title = $_POST['title'];
  $fname = $_POST['fname'];
  $lname = $_POST['lname'];
  $email = $_POST['email'];
  $username = $_POST['username'];
  $password = $_POST['password'];
  $position = $_POST['position'];
  $phone = $_POST['phone'];
  $address = $_POST['address'];
  $city = $_POST['city'];
  $country = $_POST['country'];
  $zipcode = $_POST['zipcode'];

  $q = "SELECT COUNT(*) FROM useraddress";
  $result = $mysqli->query($q);
  $c = $result->fetch_array();
  $g = $c[0]+1;
  echo $g;

  $q = "INSERT INTO useraddress (ADDRESS,CITY,COUNTRY,ZIPCODE) VALUES
  ('$address','$city','$country','$zipcode')";
  //$q = "INSERT INTO useraddress (ADDRESS,CITY,COUNTRY,ZIPCODE) VALUES
  //('a','a',$country,'$zipcode')";
  $result = $mysqli->query($q);
  echo $q;

  $q = "INSERT INTO staff (USER_TITLE,USER_FNAME,USER_LNAME,USER_ADDRESS,USER_EMAIL,USER_USERNAME,USER_PASSWD,USER_POSITION,USER_PHONE) VALUES
  ('$title','$fname','$lname',$g,'$email','$username','$password','$position','$phone')";
  $result = $mysqli->query($q);
  echo $q;

  header('Location: admin.php?page=show');
?>