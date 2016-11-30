<?php
  session_start(); // To use SESSION !!! Must be at the top of the page
  require_once('connect.php');

  $re_user = $_POST['username'];
  $re_pass = $_POST['passwd'];

  $q = "SELECT * FROM staff
  WHERE USER_USERNAME = '".$mysqli->real_escape_string($re_user)."'
  AND USER_PASSWD = '".$mysqli->real_escape_string($re_pass)."'
  ";//AND disable = 0; ";

  echo $q;

  $result = $mysqli->query($q);
  if($result)
  {
    $count_no_row = $result->num_rows;
    if($count_no_row == 1)
    {
      //echo "Login Success";
      // Keep data in SESSION
      $row = $result->fetch_array();
      $_SESSION['u_id'] = $row['USER_ID'];
      $_SESSION['u_fname'] = $row['USER_FNAME'];
      $_SESSION['u_lname'] = $row['USER_LNAME'];
      $_SESSION['u_fullname'] = $row['USER_FNAME']." ".$row['USER_LNAME'];
      $_SESSION['u_username'] = $row['USER_USERNAME'];
      $_SESSION['u_position'] = $row['USER_POSITION'];
      $_SESSION['u_title'] = $row['USER_TITLE'];
      $_SESSION['u_phone'] = $row['USER_PHONE'];
      $_SESSION['u_email'] = $row['USER_EMAIL'];
      $ad = $row['USER_ADDRESS'];

      $q = "SELECT * FROM useraddress WHERE ADDRESS_ID = $ad";
      $result = $mysqli->query($q);
      $row = $result->fetch_array();
      $_SESSION['u_ad'] = $row['ADDRESS']."<br>".$row['CITY']." , ".$row['COUNTRY']." , ".$row['ZIPCODE'];
      $_SESSION['u_adid'] = $row['ADDRESS_ID'];
      $_SESSION['u_address'] = $row['ADDRESS'];
      $_SESSION['u_city'] = $row['CITY'];
      $_SESSION['u_country'] = $row['COUNTRY'];
      $_SESSION['u_zipcode'] = $row['ZIPCODE'];

      //echo "<br>".$_SESSION['u_id'];
      //echo "<br>".$_SESSION['u_fullname'];
      //echo "<br>".$_SESSION['u_username'];
      //echo "<br>".$_SESSION['u_position'];
    //  echo json_encode($_SESSION['u_fullname']." logged in");
      //echo json_encode(42);
      if($_SESSION['u_position']=="salesman"){
        header("Location: sm_pinfo.php");
      }


    } else {
      $_SESSION['message'] = "<h2 style='font-size:24px !important;'> Wrong username or password </h2>";
      header("Location: login.php");
      //echo "Wrong username or password";
    }
  } else {
      echo "Wrong username or password!";
  }

?>
