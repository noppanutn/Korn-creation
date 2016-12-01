<?php session_start();
require_once('connect.php');
$uid = $_SESSION['u_id'];
$q = "SELECT * FROM staff
WHERE USER_ID = $uid";//AND disable = 0; ";

//echo $q;

$result = $mysqli->query($q);
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

?>
<html lang="en">
<head>
  <link rel="icon" href="images/iconn.gif" />
<title>Korn Creation | Personal Info</title>
<meta charset="utf-8">
<link rel="stylesheet" type="text/css" media="screen" href="css/reset.css">
<link rel="stylesheet" type="text/css" media="screen" href="css/style.css">
<link href='http://fonts.googleapis.com/css?family=Open+Sans+Condensed:700,300' rel='stylesheet' type='text/css'>
<script src="js/jquery-1.7.min.js"></script>
<script src="js/jquery.easing.1.3.js"></script>
</head>

<body>
<div class="bg">
  <header>
    <div class="main wrap">
      <h1><a href="index.html"><img src="images/logo.png" alt=""></a></h1>
        <p>8901 SIIT, NFG Group <span>8 (800) 552 5975</span></p>
    </div>

    <div class="staff">
      <?php
        if(isset($_SESSION['u_fullname'])){
          echo "<h3 style='color:white;'>".$_SESSION['u_fullname']." , ".$_SESSION['u_position']."</h3>";
        }
       ?>
    </div>

    <div class="main_header">
      <div id="div_menu">
        <ul class="menu">
          <li><a href="index.html" class="home"><img src="images/home.jpg" alt=""></a></li>
          <li><a href="sm_cusreg.php">New Customer</a></li>
          <li><a href="sm_customization.php">Customization</a></li>
          <li><a href="sm_salesdata.php">Sales Data</a></li>
          <li class="current"><a href="sm_pinfo.php">Salesman Personal Info</a></li>
          <li><a href="logout.php">Logout</a></li>
        </ul>
      </div>

      <div class="dropdown">
        <img src='images/customer.png' style='height:30px; padding:15px 0px 15px 20px;'>
        <button  class="dropbtn">
          <?php
            if(!isset($_SESSION['customer_id'])){ echo "no customer";}
            else{echo "Customer: ".$_SESSION['customer_title']." ".$_SESSION['customer_fname']." ".$_SESSION['customer_lname'];}
          ?>
        </button>
        <div class="dropdown-content">
          <a href="sm_findcustomer.php">Select Customer</a>
        </div>

      </div>
    </div>
  </header><br>

  <section id="content">
  <div class="sub-page">
    <div class="sub-page-left1" style='width:880px !important;'>
      <h2 class="p2">STAFF PROFILE</h2>
      <div class="wrap"> <img src="images/page2-img4.jpg" alt="" class="img-indent">
        <div class="extra-wrap">
          <table class="add_table" align="center" cellpadding = "10">
            <tr><td>NAME</td><td><?php echo $_SESSION['u_title']." ".$_SESSION['u_fullname']; ?></td></tr>
            <tr><td>USERNAME</td><td><?php echo $_SESSION['u_username']; ?></td></tr>
            <tr><td>POSITION</td><td><?php echo $_SESSION['u_position']; ?></td></tr>
            <tr><td>PHONE NUMBER</td><td><?php echo $_SESSION['u_phone']; ?></td></tr>
            <tr><td>ADDRESS</td><td><?php echo $_SESSION['u_ad']; ?></td></tr>
          </table>
          <br>
          <div style='margin-left: 261;'><a href='edit_staff.php' class='button-2'>Edit Profile</a></div>
        </div>
      </div>
      <h2 class="top-1 p3"></h2>
      <p class="upper"></p>

    </div>
  </div>
  </div>
  </section>


</body>
</html>