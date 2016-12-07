<?php
session_start();
require_once('connect.php');

if(!isset($_SESSION['u_position'])){
    $_SESSION['nop']='<center><warn>You do not have permission. Please log in.</warn></center>';
    header('Location: login.php');
  }else{
    if(!($_SESSION['u_position']=='salesman')and!($_SESSION['u_position']=='accountant')){
        $_SESSION['nop']='<center><warn>You do not have permission. Please log in.</warn></center>';
        header('Location: login.php');
      }
  }

  function editupdate(){
    if($_SESSION['u_position']=='salesman'){
      echo 'edit order / update shipping status';
    }else{
      echo 'update payment status';
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
<title>Korn Creation | Sales Record</title>
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
<?php if($_SESSION['u_position']=="accountant") { ?>
  <div class="main_header">
    <div id="div_menu">
      <ul class="menu">
        <li><a href="index.html" class="home"><img src="images/home.jpg" alt=""></a></li>
        <li class="current"><a href="sm_salesdata.php">Sales Data</a></li>
        <!--<li><a href="sm_pinfo.php">Salesman Personal Info</a></li>-->
        <li><a href="logout.php">Logout</a></li>
      </ul>
    </div>
  </div>
<?php } else if ($_SESSION['u_position']=="salesman") {?>
    <div class="main_header">
      <div id="div_menu">
        <ul class="menu">
          <li><a href="index.html" class="home"><img src="images/home.jpg" alt=""></a></li>
          <li><a href="sm_cusreg.php">New Customer</a></li>
          <li><a href="sm_customization.php">Customization</a></li>
          <li class="current"><a href="sm_salesdata.php">Sales Data</a></li>
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
<?php } ?>
  </header>

  <center>
  <div class="main_content">
    <br><h2>Sales Record</h2><br>
    <?php //if(isset($_SESSION['error_date'])){ echo "<h2>".$_SESSION['error_date']."</h2><br>"; unset($_SESSION['error_date']);} ?>
    <h3 style="font-size: 20px;">
      <form action="sm_salesdata.php" method="POST">
        Filters:
        <input type="radio" name="choice" value="name"    <?php if($listby=="name"){echo "checked";}?>>Name ||
        <input type="radio" name="choice" value="date"    <?php if($listby=="date"){echo "checked";}?>>Deal Date ||
        <input type="radio" name="choice" value="model"   <?php if($listby=="model"){echo "checked";}?>>Car model ||
        <input type="radio" name="choice" value="payment" <?php if($listby=="payment"){echo "checked";}?>>Payment Status ||
        <input type="radio" name="choice" value="order"   <?php if($listby=="order"){echo "checked";}?>>Shipping Status ||
        <input type="submit" name="submit" value="submit">
      </form><br>
    </h3>
    <table style="font-size: 16px !important;">
      <tr><th style='width:30 !important;'>No.</th><th>Customer Name</th><th>Car Model</th><th>Price</th><th>Deal Date</th>
        <th>Payment Status</th><th>Shipping Status</th><th><?php editupdate();?></th>

      <?php
      //if($_SESSION['u_position']=="salesman"){ echo "<th style='width:30 !important;'>Cancel Order</th></tr>"; }
      $salesmanid = $_SESSION['u_id'];
      $q = "SELECT C.CUSTOMER_TITLE,C.CUSTOMER_FNAME,C.CUSTOMER_LNAME,M.MANUFACTURER,M.MODEL
      ,O.PRICE,O.dealDate,O.DEPOSIT_PAYMENT_STATUS,O.DELIVERY_STATUS,O.CAR_ORDER_ID
      FROM car_model as M, customer as C, car_order as O ";

      if($_SESSION['u_position']=="salesman"){
        $q = $q."WHERE O.SALESMAN_ID = $salesmanid
        AND C.CUSTOMER_ID = O.CUSTOMER_ID
        AND M.CAR_ID = O.CAR_ID";
      } else if ($_SESSION['u_position']=="accountant"){
        $q = $q."WHERE C.CUSTOMER_ID = O.CUSTOMER_ID
        AND M.CAR_ID = O.CAR_ID";
      }

      if($listby=="name"){$q = $q." ORDER BY C.CUSTOMER_FNAME,C.CUSTOMER_LNAME,O.dealDate DESC";}
      else if ($listby == "date"){$q = $q." ORDER BY O.dealDate DESC, C.CUSTOMER_ID DESC";}
      else if ($listby == "model"){$q = $q." ORDER BY M.MANUFACTURER,M.MODEL,O.dealDate DESC ";}
      else if ($listby == "payment"){$q = $q." ORDER BY O.DEPOSIT_PAYMENT_STATUS,O.dealDate DESC";}
      else if ($listby == "order"){$q = $q." ORDER BY O.DELIVERY_STATUS,O.dealDate DESC";}

      $i=1;
      $result = $mysqli->query($q);
      while($row = $result->fetch_array()){
        //echo $row['dealDate'];
        $print = $row['DEPOSIT_PAYMENT_STATUS'];
        if($row['DEPOSIT_PAYMENT_STATUS']==Null){$print="Waiting";}
        echo "<tr><td>".$i."</td><td>".$row['CUSTOMER_TITLE']." ".$row['CUSTOMER_FNAME']." ".$row['CUSTOMER_LNAME']."</td>
        <td>".$row['MANUFACTURER']." ".$row['MODEL']."</td><td>".number_format($row['PRICE'])."</td>
        <td>".$row['dealDate']."</td><td>".$print."</td><td>".$row['DELIVERY_STATUS'];//.

        if($_SESSION['u_position']=="salesman" && $row['DELIVERY_STATUS']=="Yes"){
          echo "</td><td> - </td></tr>";
        } else if ($_SESSION['u_position']=="salesman" && $row['DELIVERY_STATUS']=="No"){
          echo "</td><td><a href = 'edit_order.php?orderid=".$row['CAR_ORDER_ID']."'><img src='images/edit.png' height = '30px'></a></td></tr>";
        } else if ($_SESSION['u_position']=="accountant" && $row['DEPOSIT_PAYMENT_STATUS']==Null){
          echo "</td><td><a href = 'edit_order.php?orderid=".$row['CAR_ORDER_ID']."'><img src='images/edit.png' height = '30px'></a></td></tr>";
        } else if ($_SESSION['u_position']=="accountant" && $row['dealDate']!=Null){
          echo "</td><td> - </td></tr>";
        }
        //if($_SESSION['u_position']=="salesman"){echo "<td><a href = 'cancel_order.php?orderid=".$row['CAR_ORDER_ID']."'><img src='images/delete.png' height = '30px'></a></td></tr>";}
        $i=$i+1;
      }

      $mysqli->close();
      ?>
    </table>
  </div>
  </center>

</body>
