<?php
session_start();
require_once('connect.php');
?>
<html lang="en">
<head>
<title>Korn Creation | Login</title>
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
          echo "<h3 style='color:white;'>".$_SESSION['u_fullname']." , ".$_SESSION['u_username']."</h3>";
        }
       ?>
    </div>

    <div class="main_header">
      <div id="div_menu">
        <ul class="menu">
          <li><a href="index.html" class="home"><img src="images/home.jpg" alt=""></a></li>
          <li><a href="sm_cusreg.php">New Customer</a></li>
          <li class="current"><a href="sm_customization.php">Customization</a></li>
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
            else{echo $_SESSION['customer_title']." ".$_SESSION['customer_fname']." ".$_SESSION['customer_lname'];}
          ?>
        </button>


      </div>
    </div>
  </header>
  <center>
  <div class="main_content">
    <form action="sm_findcustomer.php" method="POST">
      <label>Customer Name</label>
    <input type="input" name="cus_search">
    <input type="submit" name="search" value="search">
  </form>
    <?php
      if(isset($_POST['cus_search'])){
        $q="SELECT * FROM customer WHERE CUSTOMER_FNAME LIKE '%".$_POST['cus_search']."%'";
        $result = $mysqli->query($q);
        echo "<form action='fetch_customer.php' method='POST'>";
        while($row=$result->fetch_array()){
          $text=$row[0].' '.$row[1].' '.$row[2].' '.$row[3];
          echo "<input type='submit' name='cus_info' value='".$text."'><br>";
        }
      }
     ?>
     </form>
  </div>
  </center>
</body>
