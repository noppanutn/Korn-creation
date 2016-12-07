<?php
session_start();
require_once('connect.php');

if(!isset($_SESSION['u_position'])){
    $_SESSION['nop']='<center><warn>You do not have permission. Please log in.</warn></center>';
    header('Location: login.php');
  }else{
    if(!($_SESSION['u_position']=='delivery man')){
        $_SESSION['nop']='<center><warn>You do not have permission. Please log in.</warn></center>';
        header('Location: login.php');
      }
  }

$listby="name";
if(isset($_POST['choice'])){
  $listby=$_POST['choice'];
}
?>
<html lang="en">
<head>
  <link rel="icon" href="images/iconn.gif" />
<title>Korn Creation | Delivery Man</title>
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
          <li class="current"><a href="delivery.php">Delivery List</a></li>
          <li><a href="logout.php">Logout</a></li>
        </ul>
      </div>
    </div>
  </header>
  <center>
  <div class="main_content">
    <br><h2>Delivery List</h2><br>
    <h3 style="font-size: 20px;">
      <form action="delivery.php" method="POST">
        Filters:
        <input type="radio" name="choice" value="name"    <?php if($listby=="name"){echo "checked";}?>>Name ||
        <input type="radio" name="choice" value="order"   <?php if($listby=="order"){echo "checked";}?>>Shipping Status ||
        <input type="submit" name="submit" value="submit">
      </form><br>
    </h3>
    <table style="font-size: 16px !important;">
      <tr><th style='width:30 !important;'>No.</th><th style='width:30 !important;'>Title</th>
        <th>Customer Name</th><th>Car Model</th><th>Address</th><th>Phone Number</th><th>Shipping Status</th></tr>

      <?php
      $q = "SELECT C.CUSTOMER_TITLE,C.CUSTOMER_FNAME,C.CUSTOMER_LNAME,C.CUSTOMER_PHONE
      ,CA.ADDRESS,CA.CITY,CA.COUNTRY,CA.ZIPCODE
      ,M.MANUFACTURER,M.MODEL
      ,O.DELIVERY_STATUS
      FROM car_model as M, customer as C, car_order as O, customer_address as CA
      WHERE C.CUSTOMER_ID = O.CUSTOMER_ID
      AND M.CAR_ID = O.CAR_ID
      AND C.CUSTOMER_ADDRESS = CA.ADDRESS_ID";

      if($listby=="name"){$q = $q." ORDER BY C.CUSTOMER_FNAME,C.CUSTOMER_LNAME";}
      else if ($listby == "order"){$q = $q." ORDER BY O.DELIVERY_STATUS DESC";}


      $i=1;
      $result = $mysqli->query($q);
      while($row = $result->fetch_array()){
        echo "<tr><td>".$i."</td><td>".$row['CUSTOMER_TITLE']."</td><td>".$row['CUSTOMER_FNAME']." ".$row['CUSTOMER_LNAME']."</td>
        <td>".$row['MANUFACTURER']." ".$row['MODEL']."</td>
        <td>".$row['ADDRESS']." ".$row['CITY']." ".$row['COUNTRY']." ".$row['ZIPCODE']."</td>
        <td>".$row['CUSTOMER_PHONE']."</td><td>".$row['DELIVERY_STATUS']."</td></tr>";

        $i=$i+1;
      }

      $mysqli->close();
      ?>
    </table>
  </form>
  </div>
  </center>

</body>
