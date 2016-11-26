<?php
  session_start(); // To use SESSION !!! Must be at the top of the page
  require_once('connect.php');

  $re_user = $_POST['username'];
  $re_pass = $_POST['passwd'];

  //$q = "SELECT * FROM user WHERE username = '$re_user'
  //AND passwd = '$re_pass' AND disable = 0; ";

// For better security

  $q = "SELECT * FROM user
  WHERE username = '".$mysqli->real_escape_string($re_user)."'
  AND passwd = '".$mysqli->real_escape_string($re_pass)."'
  AND disable = 0; ";

  //echo $q;

  $result = $mysqli->query($q);
  if($result)
  {
    $count_no_row = $result->num_rows;
    if($count_no_row == 1)
    {
      echo "Login Success".'<br><a href="mainpage.php">Go to Main Page</a>';
      // Keep data in SESSION
      $row = $result->fetch_array();
      $_SESSION['user_id'] = $row['id'];
      $_SESSION['user_fullname'] = $row['name'];
      $_SESSION['user_username'] = $row['username'];

    } else {
      echo "Wrong username or password";
    }
  } else {
      echo "Wrong username or password!";
  }

?>
