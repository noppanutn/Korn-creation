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
<script type="text/javascript">
$(document).ready(function()
{
 $(".manufacturer").change(function()
 {
  var id=$(this).val();
  var dataString = 'id='+ id;

  $.ajax
  ({
   type: "POST",
   url: "fetch_data.php",
   data: dataString,
   cache: false,
   success: function(html)
   {
      $(".model").html(html);
   }
   });
  });
 });
</script>

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
        <img src='http://localhost/Korn-creation/images/customer.png' style='height:30px; padding:15px 0px 15px 20px;'>
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
    <?php
      //echo $_SESSION['customer_id'];

     ?>
    <form action="check_customer.php" method="post">
      <div id="select_box">
        <label>Car Manufacturer</label>
        <select name="manufacturer" class="manufacturer">
          <option>Select Car Manufacturer</option>
          <?php
            $q="SELECT * FROM car_model GROUP BY MANUFACTURER";
            $result=$mysqli->query($q);
            while($row=$result->fetch_array())
            {
              echo '<option value="'.$row[1].'">'.$row[1].'</option>';
            }
          ?>
        </select>

        <label>Car Model</label>
        <select name="model" class="model">
          <option>Select a car model</option>
        </select>

      </div>
    <label>Interior Color</label>
    <select name="in_color">
      <?php
        $q='select * from in_color;';
        //$q = strtolower($q);
        if($result=$mysqli->query($q)){
          while($row=$result->fetch_array()){
            echo '<option value="'.$row[0].'">'.$row[1].'</option>';
          }
        }else{
          echo 'Query error: '.$mysqli->error;
        }
      ?>
    </select>
      <label>Exterior Color</label>
      <select name="ex_color">
        <?php
          $q='select * from ex_color;';
          //$q = strtolower($q);
          if($result=$mysqli->query($q)){
            while($row=$result->fetch_array()){
              echo '<option value="'.$row[0].'">'.$row[1].'</option>';
            }
          }else{
            echo 'Query error: '.$mysqli->error;
          }
        ?>
    </select>
    <label>Wheel</label>
    <select name="wheel">
      <?php
        $q='select * from wheel;';
        //$q = strtolower($q);
        if($result=$mysqli->query($q)){
          while($row=$result->fetch_array()){
            echo '<option value="'.$row[0].'">'.$row[1].'</option>';
          }
        }else{
          echo 'Query error: '.$mysqli->error;
        }
      ?>
    </select>
    <label>Insurance</label>
    <select name="insurance">
      <option value="1">Company A</option>
      <option value="2">Company B</option>
      <option value="3">Company C</option>
      <option value="4">Company D</option>

    </select>
    <input type="submit" name="order" value="Order">
    </form>
  </div>
</center>
</html>
