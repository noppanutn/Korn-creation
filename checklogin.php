<?php
  session_start(); // To use SESSION !!! Must be at the top of the page
  require_once('connect.php');

  $re_user = $_POST['username'];
  $re_pass = $_POST['passwd'];

  //$q = "SELECT * FROM user WHERE username = '$re_user'
  //AND passwd = '$re_pass' AND disable = 0; ";

// For better security

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
      echo "Login Success";
      // Keep data in SESSION
      $row = $result->fetch_array();
      $_SESSION['u_id'] = $row['USER_ID'];
      $_SESSION['u_fullname'] = $row['USER_FNAME']." ".$row['USER_LNAME'];
      $_SESSION['u_username'] = $row['USER_USERNAME'];
      $_SESSION['u_position'] = $row['USER_POSITION'];
      $_SESSION['u_title'] = $row['USER_TITLE'];
      $_SESSION['u_pid'] = $row['USER_PINCODE'];

      echo "<br>".$_SESSION['u_id'];
      echo "<br>".$_SESSION['u_fullname'];
      echo "<br>".$_SESSION['u_username'];

      header("Location: sm_pinfo.php");

    } else {
      echo "Wrong username or password";
    }
  } else {
      echo "Wrong username or password!";
  }

?>
