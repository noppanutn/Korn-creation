<?php
session_start();
require_once('connect.php');

if(!isset($_SESSION['u_position'])){
    $_SESSION['nop']='<center><warn>You do not have permission. Please log in.</warn></center>';
    header('Location: login.php');
  }else{
    if(!($_SESSION['u_position']=='salesman')){
        $_SESSION['nop']='<center><warn>You do not have permission. Please log in.</warn></center>';
        header('Location: login.php');
      }
  }


if(isset($_POST['page'])) {
  $_SESSION['c_title'] = $_POST["Title"];
  $_SESSION['c_fname'] = $_POST["First_Name"];
  $_SESSION['c_lname'] = $_POST["Last_Name"];
  $_SESSION['c_bday'] = $_POST["Birthday_Day"];
  $_SESSION['c_bmonth'] = $_POST["Birthday_Month"];
  $_SESSION['c_byear'] = $_POST["Birthday_Year"];
  $_SESSION['c_email'] = $_POST["Email_Id"];
  $_SESSION['c_mobile'] = $_POST["Mobile_Number"];
  $_SESSION['c_address'] = $_POST["Address"];
  $_SESSION['c_city'] = $_POST["City"];
  $_SESSION['c_zipcode'] = $_POST["Zip_Code"];
  $_SESSION['c_country'] = $_POST["Country"];
  $_SESSION['c_page'] = $_POST['page'];
  //echo "wait for confirmation";
} else if(isset($_POST['confirm'])){
  //echo "add";

  $q="SELECT COUNT(*) FROM customer_address";
  $result=$mysqli->query($q);
  $row=$result->fetch_array();
  $count=$row[0];
  $count=$count+1;
  //echo $count;

  $q="INSERT INTO customer (CUSTOMER_TITLE,CUSTOMER_FNAME,CUSTOMER_LNAME,CUSTOMER_DOB,CUSTOMER_ADDRESS,CUSTOMER_EMAIL,CUSTOMER_PHONE)
  VALUES ('".$_SESSION['c_title']."','".$_SESSION['c_fname']."','".$_SESSION['c_lname']."','"
  .$_SESSION['c_byear']."-".$_SESSION['c_bmonth']."-".$_SESSION['c_bday']."',".$count.",'".$_SESSION['c_email']."','".$_SESSION['c_mobile']."')";
  //echo $q;
  $result=$mysqli->query($q);
  if(!$result){
    $_SESSION['dup_cus'] = "<h2 style='color:white; text-align:center;'>Registration failed. Error: ".$mysqli->error."</h2>" ;
    //break;
  } else {
    $q="INSERT INTO customer_address (ADDRESS,CITY,COUNTRY,ZIPCODE)
    VALUES ('".$_SESSION['c_address']."','".$_SESSION['c_city']."','".$_SESSION['c_country']."','".$_SESSION['c_zipcode']."')";
    //echo $q;
    $result=$mysqli->query($q);

    $q="SELECT CUSTOMER_ID FROM customer WHERE CUSTOMER_FNAME='".$_SESSION['c_fname']."' AND CUSTOMER_LNAME='".$_SESSION['c_lname']."'";
    $result=$mysqli->query($q);
    $row=$result->fetch_array();
    $_SESSION['customer_id']=$row[0];
    $_SESSION['customer_title']=$_SESSION['c_title'];
    $_SESSION['customer_fname']=$_SESSION['c_fname'];
    $_SESSION['customer_lname']=$_SESSION['c_lname'];
    //echo $_SESSION['customer_id'];
  }
}
/*echo "Test: <br>";
if(!isset($_POST['page']) && !isset($_POST['confirm'])){
  echo " no page no confirm <br>";
} else if(isset($_POST['page']) && !isset($_POST['confirm'])){
  echo " has page no confirm ";
}
if(isset($_SESSION['dup_cus'])){
  echo $_SESSION['dup_cus']."<br>";
}*/
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
          echo "<h4>".$_SESSION['u_fullname']." , ".$_SESSION['u_position']."</h4>";
        }
       ?>
    </div>

    <nav>
      <ul class="menu">
        <li><a href="index.html" class="home"><img src="images/home.jpg" alt=""></a></li>
        <li class="current"><a href="sm_cusreg.php">New Customer</a></li>
        <li><a href="sm_customization.php">Customization</a></li>
        <li><a href="sm_salesdata.php">Sales Data</a></li>
        <li><a href="sm_pinfo.php">Salesman Personal Info</a></li>
        <li><a href="logout.php">Logout</a></li>
      </ul>
      <div class="clear"></div>
    </nav>
  </header>
  <style type="text/css">
  h3{  font-size:35px; line-height:42px; color:red; font-weight:bold; font-family: 'Open Sans Condensed', sans-serif;
  text-align: center; text-decoration: underline }

  table{font-family: 'Open Sans Condensed', sans-serif; color:white; font-size: 11pt; font-style: normal; align:center; margin-left:auto; margin-right:auto; width:600px;
  text-align:; background-color: #353535; border-collapse: collapse; border: 2px solid red}
  table.inner{border: 0px}
  </style>

<br>
<body>
<?php
  if(!isset($_POST['page']) && !isset($_POST['confirm'])){
?>
<h3>CUSTOMER REGISTRATION FORM</h3><br>
<form action="sm_cusreg.php" method="POST">
<table class="add_table" align="center" cellpadding = "10">
<tr><td>FIRST NAME</td><td><input type="text" name="First_Name" maxlength="30"/>(max 30 characters a-z and A-Z)</td></tr>
<tr><td>LAST NAME</td><td><input type="text" name="Last_Name" maxlength="30"/>(max 30 characters a-z and A-Z)</td></tr>
<tr><td>DATE OF BIRTH</td>
<td>
<select name="Birthday_Day" id="Birthday_Day">
<option value="-1">Day:</option>
<?php
  for($i=1;$i<=31;$i=$i+1){
    echo "<option value='".$i."'>".$i."</option>";
  }
?>
</select>

<select id="Birthday_Month" name="Birthday_Month">
<option value="-1">Month:</option>
<option value="1">Jan</option>
<option value="2">Feb</option>
<option value="3">Mar</option>
<option value="4">Apr</option>
<option value="5">May</option>
<option value="6">Jun</option>
<option value="7">Jul</option>
<option value="8">Aug</option>
<option value="9">Sep</option>
<option value="10">Oct</option>
<option value="11">Nov</option>
<option value="12">Dec</option>
</select>

<select name="Birthday_Year" id="Birthday_Year">
<option value="-1">Year:</option>
<?php
  for($i=2012;$i>1900;$i=$i-1){
    echo "<option value='".$i."'>".$i."</option>";
  }
?>
</select>
</td>
</tr>
<!---title-->
<tr><td>TITLE</td><td>
    MR. <input type="radio" name="Title" value="Mr." />
    MS. <input type="radio" name="Title" value="Ms." />
</td></tr>

<tr><td>EMAIL Address</td><td><input type="text" name="Email_Id" maxlength="100" /></td></tr>
<tr><td>MOBILE NUMBER</td><td><input type="text" name="Mobile_Number" maxlength="10" />(10 digit number)</td></tr>
<tr><td>ADDRESS <br /><br /><br /></td><td><textarea name="Address" rows="4" cols="30"></textarea></td></tr>
<tr><td>CITY</td><td><input type="text" name="City" maxlength="30" />(max 30 characters a-z and A-Z)</td></tr>
<tr><td>ZIP CODE</td><td><input type="text" name="Zip_Code" maxlength="6" />(6 digit number)</td></tr>
<tr><td>COUNTRY</td><td><input type="text" name="Country" maxlength="30" />(max 30 characters a-z and A-Z)</td></tr>
<tr><td colspan="2" align="center">
  <input type="hidden" name="page" value="adduser">
  <input type="submit" class="button-2" value="Submit">
  <input type="reset" class="button-2" value="Reset">
</td>
</tr>
</table>
</form>
<?php } else if (isset($_POST['page']) && !isset($_POST['confirm'])) { ?>
  <h3>CUSTOMER REGISTRATION CONFIRMATION</h3><br>
  <form action="sm_cusreg.php" method="POST">
  <table class="add_table" align="center" cellpadding = "10">
  <tr><td>FIRST NAME</td><td><?php echo $_SESSION['c_fname']; ?></td></tr>
  <tr><td>LAST NAME</td><td><?php echo $_SESSION['c_lname']; ?></td></tr>
  <tr><td>DATE OF BIRTH</td><td><?php echo $_SESSION['c_byear']."-".$_SESSION['c_bmonth']."-".$_SESSION['c_bday']; ?></td>
  <tr><td>TITLE</td><td><?php echo $_SESSION['c_title']; ?></td></tr>
  <tr><td>EMAIL Address</td><td><?php echo $_SESSION['c_email']; ?></td></tr>
  <tr><td>MOBILE NUMBER</td><td><?php echo $_SESSION['c_mobile']; ?></td></tr>
  <tr><td>ADDRESS <br /><br /><br /></td><td><?php echo $_SESSION['c_address']; ?></td></tr>
  <tr><td>CITY</td><td><?php echo $_SESSION['c_city']; ?></td></tr>
  <tr><td>ZIP CODE</td><td><?php echo $_SESSION['c_zipcode']; ?></td></tr>
  <tr><td>COUNTRY</td><td><?php echo $_SESSION['c_country']; ?></td></tr>
  <tr><td colspan="2" align="center">
    <!--<input type="hidden" name="confirm" value="adduser">-->
    <input class="button-2" type="submit" name="confirm" value="Confirm">
    <a class="button-2" href="javascript:history.go(-1)">Edit</a>
  </td></tr>
  </table>
  </form>
<?php } else if (isset($_POST['confirm']) && isset($_SESSION['dup_cus'])) {
  echo $_SESSION['dup_cus'];
  unset($_SESSION['dup_cus']);
} else if (isset($_POST['confirm']) && !isset($_SESSION['dup_cus'])) {
  echo "<h2 style='color:white; text-align:center;'>Customer Registration Success</h2><br>" ;
  if(isset($_SESSION['model'])){ header("Location: check_customer.php");}
}
?>

</body>
</html>
