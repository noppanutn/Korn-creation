<?php
  session_start(); // To use SESSION !!! Must be at the top of the page
  require_once('connect.php');

  $re_user = $_POST['username'];
  $re_pass = $_POST['passwd'];
  //$re_pass = md5($re_pass);

// For better security

  $q = "SELECT * FROM user,usergroup
  WHERE USER_NAME = '".$mysqli->real_escape_string($re_user)."'
  AND USER_PASSWD = '".$mysqli->real_escape_string($re_pass)."'
  AND DISABLE = 0 AND USER.USER_GROUPID = USERGROUP.USERGROUP_ID";

  //echo $q;

  $result = $mysqli->query($q);
  if($result)
  {
    $count_no_row = $result->num_rows;
    if($count_no_row == 1)
    {
      echo "Login Success";
      // Keep data in SESSION
      $row = $result->fetch_array();
      $_SESSION['user'] = $row;
    //  $_SESSION['user_fullname'] = $row['USER_FNAME'];
    //  $_SESSION['user_username'] = $row['USER_NAME'];
      $_SESSION['group'] = $row['USER_GROUPID'];
      if($_SESSION['group']==1 || $_SESSION['group']==3){
        header("Location: user.php");
      } else {
        header("Location: group.php");
      }

    } else {
      echo "Wrong username or password";
    }
  } else {
      echo "Wrong username or password!";
  }

?>
