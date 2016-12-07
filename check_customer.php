
<?php
  require_once('connect.php');
  session_start();
//echo "model: ".$_POST['model'];
  //$_SESSION['manufacturer'] = $_POST['manufacturer'];

  if(!isset($_SESSION['u_position'])){
      $_SESSION['nop']='<center><warn>You do not have permission. Please log in.</warn></center>';
      header('Location: login.php');
    }else{
      if(!($_SESSION['u_position']=='salesman')){
          $_SESSION['nop']='<center><warn>You do not have permission. Please log in.</warn></center>';
          header('Location: login.php');
        }
    }

  if(!isset($_SESSION['model'])){
  $_SESSION['model'] = $_POST['model'];
  $_SESSION['in_color'] = $_POST['in_color'];
  $_SESSION['ex_color'] = $_POST['ex_color'];
  $_SESSION['wheel'] = $_POST['wheel'];
  $_SESSION['insurance'] = $_POST['insurance'];
/*
  echo "Model: ".$_SESSION['model']." In_color: ".$_SESSION['in_color']
  ." Ex_color: ".$_SESSION['ex_color']
  ." Wheel: ".$_SESSION['wheel']." Insurance: ".$_SESSION['insurance'];

  echo $_SESSION['customer_title']." ".$_SESSION['customer_fname']." ".$_SESSION['customer_lname']." ";
  echo $_SESSION['u_fullname'];
*/
  $model = $_SESSION['model'];
  $q="SELECT * FROM car_model WHERE CAR_ID = $model";
  //echo $q;
  $result = $mysqli->query($q);
  $row = $result->fetch_array();
  $_SESSION['price1'] = $row[3];
  $_SESSION['modelname'] = $row[2];
  $_SESSION['manufacturername'] = $row[1];
  //echo " ".$_SESSION['price1'];
  //echo " ".$_SESSION['modelname'];

  $incolor = $_SESSION['in_color'];
  $q="SELECT * FROM in_color WHERE IN_COLOR_ID = $incolor";
  //echo $q;
  $result = $mysqli->query($q);
  $row = $result->fetch_array();
  $_SESSION['price2'] = $row[2];
  $_SESSION['incolorname'] = $row[1];
  //echo " ".$_SESSION['price2'];
  //echo " ".$_SESSION['$incolorname'];

  $excolor = $_SESSION['ex_color'];
  $q="SELECT * FROM ex_color WHERE EX_COLOR_ID = $excolor";
  $result = $mysqli->query($q);
  $row = $result->fetch_array();
  $_SESSION['price3'] = $row[2];
  $_SESSION['excolorname'] = $row[1];
  //echo " ".$_SESSION['price3'];

  $wheel = $_SESSION['wheel'];
  $q="SELECT * FROM wheel WHERE WHEEL_ID = $wheel";
  $result = $mysqli->query($q);
  $row = $result->fetch_array();
  $_SESSION['price4'] = $row[2];
  $_SESSION['wheelname'] = $row[1];
  //echo " ".$_SESSION['price4'];
  $sum = ($_SESSION['price1']+$_SESSION['price2']+$_SESSION['price3']+$_SESSION['price4']);
  $_SESSION['total'] = $sum*1.3;
  //echo " sum: ".$sum;
  //echo " plus service charge 30%: ".$_SESSION['total'];

  $insurance = $_SESSION['insurance'];
  date_default_timezone_set("Asia/Bangkok");
  $time = getdate();
  $_SESSION['timesql'] = $time['year']."-".$time['mon']."-".$time['mday'];

  $customerid = $_SESSION['customer_id'];
  $salesmanid = $_SESSION['u_id'];

  }

  if(!isset($_SESSION['customer_id'])){

  }
?>

<html lang="en">
<head>
  <link rel="icon" href="images/iconn.gif" />
<title>Korn Creation | Add Customer</title>
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
        <div class="dropdown-content">
          <a href="sm_findcustomer.php">Change Customer</a>
        </div>
      </div>
    </div>
  </header>

  <center>
  <div class="main_content">
    <?php if(isset($_SESSION['customer_id']) && !isset($_POST['confirm'])) { ?>
    <h2>Order Confirmation</h2>
    <table class="add_table" align="center" cellpadding = "10">
      <tr><td>CUSTOMER FIRST NAME</td><td><?php echo $_SESSION['customer_fname']; ?></td></tr>
      <tr><td>CUSTOMER LAST NAME</td><td><?php echo $_SESSION['customer_lname']; ?></td></tr>
      <tr><td>STAFF NAME</td><td><?php echo $_SESSION['u_fullname']; ?></td></tr>
      <tr><td>Deal Date</td><td><?php echo $_SESSION['timesql']; ?></td></tr>
      <tr><td>CAR MANUFACTURER</td><td><?php echo $_SESSION['manufacturername']; ?></td></tr>
      <tr><td>CAR MODEL</td><td><?php echo $_SESSION['modelname']; ?></td></tr>
      <tr><td>MODEL PRICE</td><td><?php echo $_SESSION['price1']; ?></td></tr>
      <tr><td colspan="2"><?php echo "<img height='200px' src='images/car".$_SESSION['model'].".jpg'"; ?></td></tr>
      <tr><td>CAR Interior Color</td><td><?php echo $_SESSION['incolorname']; ?></td></tr>
      <tr><td>Interior Color PRICE</td><td><?php echo $_SESSION['price2']; ?></td></tr>
      <tr><td>CAR Exterior Color</td><td><?php echo $_SESSION['excolorname']; ?></td></tr>
      <tr><td>Exterior Color PRICE</td><td><?php echo $_SESSION['price3']; ?></td></tr>
      <tr><td>CAR Wheel</td><td><?php echo $_SESSION['wheelname']; ?></td></tr>
      <tr><td>Wheel PRICE</td><td><?php echo $_SESSION['price4']; ?></td></tr>
      <tr><td colspan="2"><?php echo "<img height='200px' src='images/wheel".$_SESSION['wheel'].".jpg'"; ?></td></tr>
      <tr><td>CAR Insurance</td><td><?php echo $_SESSION['insurance']; ?></td></tr>
      <tr><td>Additional Charges</td><td>30%</td></tr>
      <tr><td>TOTAL PRICE</td><td><?php echo $_SESSION['total']; ?></td></tr>
      <tr><td colspan="2" align="center">
        <form action="check_customer.php" method="POST">
        <input class="button-2" type="submit" name="confirm" value="Confirm">
        <a class="button-2" href="sm_customization.php">Edit</a></form>
      </td></tr>
    </table>
    <?php } else if (isset($_SESSION['customer_id']) && isset($_POST['confirm'])) {

      $q = "INSERT INTO car_order (CAR_ID,PRICE,EX_COLOR_ID,IN_COLOR_ID,WHEEL_ID,INSURANCE,dealDate,SALESMAN_ID,CUSTOMER_ID)
      VALUES (".$_SESSION['model'].",".$_SESSION['total'].",".$_SESSION['ex_color'].",".$_SESSION['in_color'].",".$_SESSION['wheel'].
      ",'".$_SESSION['insurance']."','".$_SESSION['timesql']."',".$_SESSION['u_id'].",".$_SESSION['customer_id'].")";
        //echo $q;
      $result = $mysqli->query($q);
      unset($_SESSION['model']);
      //echo "<a href='sm_customization.php'>GO</a>";

    ?>
      <h2>Order Success</h2>
    <?php } else if (!isset($_SESSION['customer_id']) && !isset($_POST['confirm'])) { ?>
      <br><br>
      <h2><a href="sm_cusreg.php" style="color:white !important;">Add New Customer</a></h2><br>
      <h2> or </h2><br>
      <h2><a href="sm_findcustomer.php" style="color:white !important;">Select Customer</a></h2>
    <?php } ?>
  </div>
  </center>
</html>
