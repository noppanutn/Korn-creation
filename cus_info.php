<?php
session_start();
require_once('connect.php');
?>
<html lang="en">
<head>
  <link rel="icon" href="images/iconn.gif" />
<title>Korn Creation | Customer</title>
<meta charset="utf-8">
<link rel="stylesheet" type="text/css" media="screen" href="css/reset.css">
<link rel="stylesheet" type="text/css" media="screen" href="css/style.css">
<link href='http://fonts.googleapis.com/css?family=Open+Sans+Condensed:700,300' rel='stylesheet' type='text/css'>
<script src="js/jquery-1.7.min.js"></script>
<script src="js/jquery.easing.1.3.js"></script>

<style type="text/css">
  h3{  font-size:35px; line-height:42px; color:red; font-weight:bold; font-family: 'Open Sans Condensed', sans-serif;
  text-align: center; text-decoration: underline }

  table{font-family: 'Open Sans Condensed', sans-serif; color:white; font-size: 11pt; font-style: normal; align:center; margin-left:auto; margin-right:auto; width:600px;
  text-align:; background-color: #353535; border-collapse: collapse; border: 2px solid red}
  table.inner{border: 0px}
</style>
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
          echo "<h4 style='color:white;'>".$_SESSION['u_fullname']." , ".$_SESSION['u_position']."</h4>";
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
              <li><a href="sm_pinfo.php">Salesman Personal Info</a></li>
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
  </header>
<?php
  $id = $_GET['cusid'];
  $q = "SELECT * FROM customer WHERE CUSTOMER_ID = $id";
  echo $q;
  $result = $mysqli->query($q);
  $row = $result->fetch_array();
  $_SESSION['c_title'] = $row[1];
  $_SESSION['c_fname'] = $row[2];
  $_SESSION['c_lname'] = $row[3];
  $_SESSION['c_dob'] = $row[4];
  $_SESSION['c_addressid'] = $row[5];
  $_SESSION['c_email'] = $row[6];
  $_SESSION['c_mobile'] = $row[7];
  $q = "SELECT * FROM customer_address WHERE ADDRESS_ID =".$_SESSION['c_addressid'];
  echo $q;
  $result = $mysqli->query($q);
  $row = $result->fetch_array();
  $_SESSION['c_address'] = $row[1];
  $_SESSION['c_city'] = $row[2];
  $_SESSION['c_zipcode'] = $row[3];
  $_SESSION['c_country'] = $row[4];

 ?>
  <center>
  <div class="main_content">
    <br><h2>Customer Profile</h2><br>
    <table class="add_table" align="center" cellpadding = "10">
    <tr><td>FIRST NAME</td><td><?php echo $_SESSION['c_fname']; ?></td></tr>
    <tr><td>LAST NAME</td><td><?php echo $_SESSION['c_lname']; ?></td></tr>
    <tr><td>DATE OF BIRTH</td><td><?php echo $_SESSION['c_dob']; ?></td>
    <tr><td>TITLE</td><td><?php echo $_SESSION['c_title']; ?></td></tr>
    <tr><td>EMAIL Address</td><td><?php echo $_SESSION['c_email']; ?></td></tr>
    <tr><td>MOBILE NUMBER</td><td><?php echo $_SESSION['c_mobile']; ?></td></tr>
    <tr><td>ADDRESS <br /><br /><br /></td><td><?php echo $_SESSION['c_address']; ?></td></tr>
    <tr><td>CITY</td><td><?php echo $_SESSION['c_city']; ?></td></tr>
    <tr><td>ZIP CODE</td><td><?php echo $_SESSION['c_zipcode']; ?></td></tr>
    <tr><td>COUNTRY</td><td><?php echo $_SESSION['c_country']; ?></td></tr>
    <tr><td colspan="2" align="center"><a class="button-2" href="edit_cus.php?cusid=<?php echo $id; ?>">Edit</a></td></tr>
    </table>
  </div>
  </center>