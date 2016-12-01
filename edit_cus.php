<?php session_start();
require_once('connect.php');

if(isset($_POST['First_Name'])){
  $title = $_POST['Title'];
  $fname = $_POST['First_Name'];
  $lname = $_POST['Last_Name'];
  $email = $_POST['Email_Id'];
  $phone = $_POST['Mobile_Number'];
  $id = $_SESSION['customer_id'];
  $addressid = $_SESSION['customer_addressid'];
  $address = $_POST['Address'];
  $city = $_POST['City'];
  $country = $_POST['Country'];
  $zipcode = $_POST['Zip_Code'];
  //echo "something";
  $q = "UPDATE customer SET CUSTOMER_TITLE='$title'
  , CUSTOMER_FNAME = '$fname'
  , CUSTOMER_LNAME = '$lname'
  , CUSTOMER_EMAIL = '$email'
  , CUSTOMER_PHONE = '$phone'
  WHERE CUSTOMER_ID = $id
  ";
  $result = $mysqli->query($q);

  $q = "UPDATE customer_address SET ADDRESS='$address'
  , CITY ='$city'
  , COUNTRY ='$country'
  , ZIPCODE ='$zipcode'
  WHERE ADDRESS_ID = $addressid ";
  $result = $mysqli->query($q);

  unset($_SESSION['customer_id']);
  header('Location: sm_findcustomer.php');
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
<?php

    $cid = $_GET['cusid'];
    $q = "SELECT * FROM customer WHERE CUSTOMER_ID = '$cid'";
    $result = $mysqli->query($q);
    $row = $result->fetch_array();
    $_SESSION['customer_id']=$row[0];
    $_SESSION['customer_title']=$row[1];
    $_SESSION['customer_fname']=$row[2];
    $_SESSION['customer_lname']=$row[3];
    $_SESSION['customer_addressid']=$row[4];
    $_SESSION['customer_email']=$row[5];
    $_SESSION['customer_phone']=$row[6];
    $cusadid = $row[4];
    $q = "SELECT * FROM customer_address WHERE ADDRESS_ID = $cusadid";
    $result = $mysqli->query($q);
    $row = $result->fetch_array();
    $_SESSION['customer_address']=$row[1];
    $_SESSION['customer_city']=$row[2];
    $_SESSION['customer_country']=$row[3];
    $_SESSION['customer_zipcode']=$row[4];


?>

<body>
<h3>Edit Staff Profile</h3><br>
<form action="edit_cus.php" method="POST">

<table class="add_table" align="center" cellpadding = "10">

<!----- First Name ---------------------------------------------------------->
<tr>
<td>FIRST NAME</td>
<td><input type="text" name="First_Name" value="<?php echo $_SESSION['customer_fname'] ?>" maxlength="30"/>
(max 30 characters a-z and A-Z)
</td>
</tr>

<!----- Last Name ---------------------------------------------------------->
<tr>
<td>LAST NAME</td>
<td><input type="text" name="Last_Name" value="<?php echo $_SESSION['customer_lname'] ?>" maxlength="30"/>
(max 30 characters a-z and A-Z)
</td>
</tr>

<!---title-->
<tr>
<td>TITLE</td>
<td>
MR. <input type="radio" name="Title" value="Mr."  <?php if($_SESSION['customer_title']=='Mr.'){ echo 'checked';}?>>
MS. <input type="radio" name="Title" value="Ms."  <?php if($_SESSION['customer_title']=='Ms.'){ echo 'checked';}?>/>
</td>
</tr>


<!----- Email Id ---------------------------------------------------------->
<tr>
<td>EMAIL Address</td>
<td><input type="text" name="Email_Id" value="<?php echo $_SESSION['customer_email'] ?>" maxlength="100" /></td>
</tr>

<!----- Mobile Number ---------------------------------------------------------->
<tr>
<td>MOBILE NUMBER</td>
<td>
<input type="text" name="Mobile_Number" value="<?php echo $_SESSION['customer_phone'] ?>" maxlength="10" />
(10 digit number)
</td>
</tr>

<!----- Address ---------------------------------------------------------->
<tr>
<td>ADDRESS <br /><br /><br /></td>
<td><textarea name="Address" rows="4" cols="30"><?php echo $_SESSION['customer_address'] ?></textarea></td>
</tr>

<!----- City ---------------------------------------------------------->
<tr>
<td>CITY</td>
<td><input type="text" name="City" maxlength="30" value="<?php echo $_SESSION['customer_city'] ?>">
(max 30 characters a-z and A-Z)
</td>
</tr>

<!----- State ---------------------------------------------------------->
<tr>
<td>COUNTRY</td>
<td><input type="text" name="Country" maxlength="30" value="<?php echo $_SESSION['customer_country'] ?>">
(max 30 characters a-z and A-Z)
</td>
</tr>

<!----- ZIP CODE ---------------------------------------------------------->
<tr>
<td>ZIP CODE</td>
<td><input type="text" name="Zip_Code" maxlength="6" value="<?php echo $_SESSION['customer_zipcode'] ?>">
(6 digit number)
</td>
</tr>



<!----- Submit and Reset ------------------------------------------------->
<input type="hidden" name="page" value="editcus">
<tr>
<td colspan="2" align="center">
  <input type="submit" class="button-2" value="Submit">
  <input type="reset" class="button-2" value="Reset">
</td>
</tr>
</table>

</form>

</body>
</html>
