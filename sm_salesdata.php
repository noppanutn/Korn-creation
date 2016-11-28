<?php session_start();
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
<!--[if lt IE 9]>
<link href='http://fonts.googleapis.com/css?family=Open+Sans+Condensed:300' rel='stylesheet' type='text/css'>
<link href='http://fonts.googleapis.com/css?family=Open+Sans+Condensed:700' rel='stylesheet' type='text/css'>
<script type="text/javascript" src="js/html5.js"></script>
<link rel="stylesheet" type="text/css" media="screen" href="css/ie.css">
<![endif]-->
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

    <nav>
      <ul class="menu">
        <li><a href="index.html" class="home"><img src="images/home.jpg" alt=""></a></li>
        <li><a href="sm_cusreg.php">New Customer</a></li>
        <li><a href="sm_customization.php">Customization</a></li>
        <li class="current"><a href="sm_salesdata.php">Sales Data</a></li>
        <li><a href="sm_pinfo.php">Salesman Personal Info</a></li>
        <li><a href="logout.php">Logout</a></li>
      </ul>
      <div class="clear"></div>
    </nav>
  </header>

      <center>
      <div class="main_content">
        <h2>Sales Record</h2>
        <table class="add_table" align="center" cellpadding = "10">
          <tr><th>Customer Name</th><th>Car Model</th><th>Price</th><th>Deal Date</th></tr>
        <?php
          $salesmanid = $_SESSION['u_id'];
          $q = "SELECT C.CUSTOMER_FNAME,C.CUSTOMER_LNAME,M.MODEL, O.PRICE, O.dealDate
          FROM car_model as M, customer as C, car_order as O
          WHERE O.SALESMAN_ID = $salesmanid
          AND C.CUSTOMER_ID = O.CUSTOMER_ID
          AND M.CAR_ID = O.CAR_ID";
          $result = $mysqli->query($q);
          while($row = $result->fetch_array()){
            //echo "something";
            echo "<tr><td>".$row['CUSTOMER_FNAME']." ".$row['CUSTOMER_LNAME']."</td>
            <td>".$row['MODEL']."</td><td>".number_format($row['PRICE'])."</td>
            <td>".$row['dealDate']."</td></tr>";
          }


        ?>
        </table>
      </div>
      </center>

</body>
