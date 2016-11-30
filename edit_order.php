<?php
session_start();
require_once('connect.php');
?>
<html lang="en">
<head>
  <link rel="icon" href="images/iconn.gif" />
<title>Korn Creation | Customization</title>
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
          echo "<h4 style='color:white;'>".$_SESSION['u_fullname']." , ".$_SESSION['u_username']."</h4>";
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
          <a href="sm_findcustomer.php">Select Customer</a>
        </div>

      </div>
    </div>
  </header>
<?php
  $orderid = $_GET['orderid'];
  $_SESSION['orderid'] = $_GET['orderid'];
  $q = "SELECT * FROM car_order WHERE CAR_ORDER_ID = $orderid";
  $result = $mysqli->query($q);
  $data = $result->fetch_array();
  if($data['DEPOSIT_PAYMENT_STATUS']==Null){
?>
  <center>
  <table class="add_table" align="center" cellpadding = "10">
    <?php echo $data['IN_COLOR_ID'];?>
    <form action="update_order.php" method="post">
      <div id="select_box">
        <br>
        <h3>Edit Car Order</h3><br><tr>

        <td>Car Manufacturer</td>
        <td>
          <p><?php
            $cid = $data['CAR_ID'];
            $q="SELECT * FROM car_model WHERE CAR_ID = $cid";
            $result=$mysqli->query($q);
            $row=$result->fetch_array();
            echo $row[1];
           ?> was previously selected.</p>
          <select id="soflow" name="manufacturer" class="manufacturer">
          <option value='0' selected>Select Car Manufacturer</option>
          <?php
            $q="SELECT * FROM car_model GROUP BY MANUFACTURER";
            $result=$mysqli->query($q);
            while($row=$result->fetch_array())
            {
                echo '<option value="'.$row[1].'">'.$row[1].'</option>';
            }
          ?>
        </select></td>
      </tr>
      <tr>
      <td>Car Model</td>

      <td>
        <p><?php
          $cid = $data['CAR_ID'];
          $q="SELECT * FROM car_model WHERE CAR_ID = $cid";
          $result=$mysqli->query($q);
          $row=$result->fetch_array();
          echo $row[2];
         ?> was previously selected.</p>
        <select  id="soflow" name="model" class="model">
          <option value='0' selected>--Select a car model--</option>
        </select></td>
</tr>

<tr>
<td>Interior Color</td>
<td><select  id="soflow" name="in_color" >
<option value='0'>--Select a interior Color--</option>

<?php
$q='select * from in_color;';
//$q = strtolower($q);
if($result=$mysqli->query($q)){
  while($row=$result->fetch_array()){
    if($row[0]==$data['IN_COLOR_ID']){
      echo '<option value="'.$row[0].'" selected>'.$row[1].'</option>';
    } else {
      echo '<option value="'.$row[0].'">'.$row[1].'</option>';
    }
  }
}else{
  echo 'Query error: '.$mysqli->error;
}
?>
</select></td>
</tr>

<tr>
<td>Exterior Color</td>

<td><select id="soflow" name="ex_color">
<option value='0'>--Select a exterior Color--</option>
<?php
  $q='select * from ex_color;';
  //$q = strtolower($q);
  if($result=$mysqli->query($q)){
    while($row=$result->fetch_array()){
      if($row[0]==$data['EX_COLOR_ID']){
        echo '<option value="'.$row[0].'" selected>'.$row[1].'</option>';
      } else {
        echo '<option value="'.$row[0].'">'.$row[1].'</option>';
      }
    }
  }else{
    echo 'Query error: '.$mysqli->error;
  }
?>
</select></td>
</tr>

<tr>
<td>Wheel</td>
<td><select id="soflow" name="wheel">

<option value='0'>--Select a exterior Color--</option>
<?php
$q='select * from wheel;';
//$q = strtolower($q);
if($result=$mysqli->query($q)){
  while($row=$result->fetch_array()){
    if($row[0]==$data['WHEEL_ID']){
      echo '<option value="'.$row[0].'" selected>'.$row[1].'</option>';
    } else {
      echo '<option value="'.$row[0].'">'.$row[1].'</option>';
    }
  }
}else{
  echo 'Query error: '.$mysqli->error;
}
?>
</select></td>
</tr>

<tr>
<td>Insurance</td>

<td><select id="soflow" name="insurance">
<option value='0' selected >--Select a insurance--</option>
<option value="Company A" <?php if($data['INSURANCE']==1){echo "selected";} ?> >Company A</option>
<option value="Company B" <?php if($data['INSURANCE']==2){echo "selected";} ?> >Company B</option>
<option value="Company C" <?php if($data['INSURANCE']==3){echo "selected";} ?> >Company C</option>
<option value="Company D" <?php if($data['INSURANCE']==4){echo "selected";} ?> >Company D</option>

</select></td>
</tr>
<tr>
<td colspan="2" align="center">
<input type="submit" class="button-2" name="order" value="Order">
</td>
</tr>
</table>
</form>
</div>
</center>
<?php }
  else {
    echo "<h2 style='color:white;'>The payment was done. Cannot change the order anymore.</h2>";
  }

?>
</body>
<br>
</html>