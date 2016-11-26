<?php
  require_once('connect.php');
  if(isset($_POST['page'])) {
  $title = $_POST["Title"];
  $firstname = $_POST["First_Name"];
  $lastname = $_POST["Last_Name"];
  $bday = $_POST["Birthday_Day"];
  $bmonth = $_POST["Birthday_Month"];
  $byear = $_POST["Birthday_Year"];
  //$gender = $_POST["gender"];
  $email = $_POST["Email_Id"];
  $mobile = $_POST["Mobile_Number"];
  $address = $_POST["Address"];
  $city = $_POST["City"];
  $zipcode = $_POST["Zip_Code"];
  $country = $_POST["Country"];
  //$username = $_POST["username"];
  //$passwd = $_POST["passwd"];
  //$cpasswd = $_POST["cpasswd"];
  //$usergroup = $_POST["usergroup"];
  //$disabled = $_POST["disabled"];
  $page = $_POST['page'];
  //$confirmation = $_POST['confirmation'];

  if($page=='adduser') {
    $q="INSERT INTO customer_address (ADDRESS,CITY,COUNTRY,ZIPCODE)
    VALUES ('$address','$city','$country','$zipcode')";
    echo $q;
    $result=$mysqli->query($q);
    if(!$result){
      echo "INSERT failed. Error: ".$mysqli->error ;
      //break;
    }

    $q="SELECT ADDRESS_ID FROM customer_address WHERE ADDRESS = '$address'";
    //echo $q;
    $result=$mysqli->query($q);
    $addressid=$result->fetch_array();
    //echo $addressid[0];

    $q="INSERT INTO customer (CUSTOMER_FNAME,CUSTOMER_LNAME,CUSTOMER_ADDRESS,CUSTOMER_EMAIL,CUSTOMER_PINCODE)
    VALUES ('$firstname','$lastname','$addressid[0]','$email','$mobile')";
    $q = strtolower($q);
    echo $q;
    $result=$mysqli->query($q);
    if(!$result){
      echo "INSERT failed. Error: ".$mysqli->error ;
      //break;
    }
  }

  //header('Location: sm_customization.html');
}
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
    <nav>
      <ul class="menu">
        <li><a href="index.html" class="home"><img src="images/home.jpg" alt=""></a></li>
        <li class="current"><a href="sm_cusreg.html">New Customer</a></li>
        <li><a href="sm_customization.html">Customization</a></li>
        <!--<li><a href="invoice.html">Invoice</a></li>-->
        <li><a href="sm_salesdata.html">Sales Data</a></li>
        <li><a href="sm_pinfo.php">Salesman Personal Info</a></li>
        <li><a href="logout.php">Logout</a></li>


      </ul>
      <div class="clear"></div>
    </nav>
  </header>
  <style type="text/css">
  h3{font-family: Calibri; font-size: 22pt; font-style: normal; font-weight: bold; color:red;
  text-align: center; text-decoration: underline }
  table{font-family: Calibri; color:white; font-size: 11pt; font-style: normal;
  text-align:; background-color: gray; border-collapse: collapse; border: 2px solid navy}
  table.inner{border: 0px}
  </style>

<br>
<body>
<h3>CUSTOMER REGISTRATION CONFIRMATION</h3><br>
<?php echo $lastname; ?>
<form action="add_customer.php" method="POST">

<table align="center" cellpadding = "10">

  <!----- First Name ---------------------------------------------------------->
  <tr>
  <td>FIRST NAME</td>
  <td><?php echo $firstname; ?></td>
  </tr>

  <!----- Last Name ---------------------------------------------------------->
  <tr>
  <td>LAST NAME</td>
  <td><?php echo $lastname; ?></td>
  </tr>

  <!----- Date Of Birth -------------------------------------------------------->
  <tr>
  <td>DATE OF BIRTH</td>

  <td><?php echo $bday." ".$bmonth." ".$byear; ?></td>

  <!---title-->
  <tr>
  <td>TITLE</td>
  <td>
  <?php echo $title; ?>
  </td>
  </tr>


  <!----- Email Id ---------------------------------------------------------->
  <tr>
  <td>EMAIL Address</td>
  <td><?php echo $email; ?></td>
  </tr>

  <!----- Mobile Number ---------------------------------------------------------->
  <tr>
  <td>MOBILE NUMBER</td>
  <td>
  <?php echo $mobile; ?>
  </td>
  </tr>

  <!----- Address ---------------------------------------------------------->
  <tr>
  <td>ADDRESS <br /><br /><br /></td>
  <td><?php echo $address; ?></td>
  </tr>

  <!----- City ---------------------------------------------------------->
  <tr>
  <td>CITY</td>
  <td><?php echo $city; ?>
  </td>
  </tr>

  <!----- Pin Code ---------------------------------------------------------->
  <tr>
  <td>ZIP CODE</td>
  <td><?php echo $zipcode; ?>
  </td>
  </tr>

  <!----- State ---------------------------------------------------------->
  <tr>
  <td>COUNTRY</td>
  <td><?php echo $country; ?>
  </td>
  </tr>

</table>

</form>

</body>
</html>