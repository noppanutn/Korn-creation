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
  $_SESSION['cid']=$data['CUSTOMER_ID'];
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
<option value="Company A" <?php if($data['INSURANCE']=='Company A'){echo "selected";} ?> >Company A</option>
<option value="Company B" <?php if($data['INSURANCE']=='Company B'){echo "selected";} ?> >Company B</option>
<option value="Company C" <?php if($data['INSURANCE']=='Company C'){echo "selected";} ?> >Company C</option>
<option value="Company D" <?php if($data['INSURANCE']=='Company D'){echo "selected";} ?> >Company D</option>

</select></td>
</tr>


<!-- <tr>
<td>Payment status</td>

<td>
  <select name="Pay_Day" id="Pay_Day">
  <option value="-1">Day:</option>
  <option value='1'>1</option>
  <option value='2'>2</option>
  <option value='3'>3</option>

  <option value='4'>4</option>
  <option value='5'>5</option>
  <option value='6'>6</option>
  <option value='7'>7</option>
  <option value='8'>8</option>
  <option value='9'>9</option>
  <option value='10'>10</option>
  <option value='11'>11</option>
  <option value='12'>12</option>

  <option value='13'>13</option>
  <option value='14'>14</option>
  <option value='15'>15</option>
  <option value='16'>16</option>
  <option value='17'>17</option>
  <option value='18'>18</option>
  <option value='19'>19</option>
  <option value='20'>20</option>
  <option value='21'>21</option>

  <option value='22'>22</option>
  <option value='23'>23</option>
  <option value='24'>24</option>
  <option value='25'>25</option>
  <option value='26'>26</option>
  <option value='27'>27</option>
  <option value='28'>28</option>
  <option value='29'>29</option>
  <option value='30'>30</option>

  <option value='31'>31</option>
  </select>

  <select id="Pay_Month" name="Pay_Month">
  <option value="-1">Month:</option>
  <option value='1'>Jan</option>
  <option value='2'>Feb</option>
  <option value='3'>Mar</option>
  <option value='4'>Apr</option>
  <option value='5'>May</option>
  <option value='6'>Jun</option>
  <option value='7'>Jul</option>
  <option value='8'>Aug</option>
  <option value='9'>Sep</option>
  <option value='10'>Oct</option>
  <option value='11'>Nov</option>
  <option value='12'>Dec</option>
  </select>

  <select name="Pay_Year" id="Pay_Year">

  <option value="-1">Year:</option>
  <option value='2012'>2012</option>
  <option value='2011'>2011</option>
  <option value='2010'>2010</option>
  <option value='2009'>2009</option>
  <option value='2008'>2008</option>
  <option value='2007'>2007</option>
  <option value='2006'>2006</option>
  <option value='2005'>2005</option>
  <option value='2004'>2004</option>
  <option value='2003'>2003</option>
  <option value='2002'>2002</option>
  <option value='2001'>2001</option>
  <option value='2000'>2000</option>

  <option value='1999'>1999</option>
  <option value='1998'>1998</option>
  <option value='1997'>1997</option>
  <option value='1996'>1996</option>
  <option value='1995'>1995</option>
  <option value='1994'>1994</option>
  <option value='1993'>1993</option>
  <option value='1992'>1992</option>
  <option value='1991'>1991</option>
  <option value='1990'>1990</option>

  <option value='1989'>1989</option>
  <option value='1988'>1988</option>
  <option value='1987'>1987</option>
  <option value='1986'>1986</option>
  <option value='1985'>1985</option>
  <option value='1984'>1984</option>
  <option value='1983'>1983</option>
  <option value='1982'>1982</option>
  <option value='1981'>1981</option>
  <option value='1980'>1980</option>
  </select>
  </td>
</tr> -->

<tr>
<td>Shipping status</td>
<td><select id="soflow" name="delivery">
<option value="Yes" >Yes</option>
<option value="No" >No</option>

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
