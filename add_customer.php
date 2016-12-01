<?php
  session_start();
  require_once('connect.php');
  if(isset($_POST['confirm'])){
    echo "add";

    $q="SELECT COUNT(*) FROM customer_address";
    $result=$mysqli->query($q);
    $row=$result->fetch_array();
    $count=$row[0];
    $count=$count+1;
    echo $count;

    $q="INSERT INTO customer (CUSTOMER_TITLE,CUSTOMER_FNAME,CUSTOMER_LNAME,CUSTOMER_DOB,CUSTOMER_ADDRESS,CUSTOMER_EMAIL,CUSTOMER_PHONE)
    VALUES ('".$_SESSION['c_title']."','".$_SESSION['c_fname']."','".$_SESSION['c_lname']."','"
    .$_SESSION['c_byear']."-".$_SESSION['c_bmonth']."-".$_SESSION['c_bday']."',".$count.",'".$_SESSION['c_email']."','".$_SESSION['c_mobile']."')";
    echo $q;
    $result=$mysqli->query($q);
    if(!$result){
      $_SESSION['dup_cus'] = "<h2 style='color:white;'>Registration failed. Error: ".$mysqli->error."</h2><br>" ;
      //break;
    } else {
      $q="INSERT INTO customer_address (ADDRESS,CITY,COUNTRY,ZIPCODE)
      VALUES ('".$_SESSION['c_address']."','".$_SESSION['c_city']."','".$_SESSION['c_country']."','".$_SESSION['c_zipcode']."')";
      echo $q;
      $result=$mysqli->query($q);

      $q="SELECT CUSTOMER_ID FROM customer WHERE CUSTOMER_FNAME='".$_SESSION['c_fname']."' AND CUSTOMER_LNAME='".$_SESSION['c_lname']."'";
      $result=$mysqli->query($q);
      $row=$result->fetch_array();
      $_SESSION['customer_id']=$row[0];
      $_SESSION['customer_title']=$_SESSION['c_title'];
      $_SESSION['customer_fname']=$_SESSION['c_fname'];
      $_SESSION['customer_lname']=$_SESSION['c_lname'];
      echo $_SESSION['customer_id'];
    }



  /*
  if($page=='adduser') {
    $q="INSERT INTO customer_address (ADDRESS,CITY,COUNTRY,ZIPCODE)
    VALUES ('$address','$city','$country','$zipcode')";
    //echo $q;
    $result=$mysqli->query($q);
    if(!$result){
      //echo "INSERT failed. Error: ".$mysqli->error."<br>" ;
      //break;
    }

    $q="SELECT ADDRESS_ID FROM customer_address WHERE ADDRESS = '$address'";
    //echo $q;
    $result=$mysqli->query($q);
    $addressid=$result->fetch_array();
    //echo $addressid[0];

    $q="INSERT INTO customer (CUSTOMER_TITLE,CUSTOMER_FNAME,CUSTOMER_LNAME,CUSTOMER_ADDRESS,CUSTOMER_EMAIL,CUSTOMER_PHONE)
    VALUES ('$title','$firstname','$lastname','$addressid[0]','$email','$mobile')";
    //$q = strtolower($q);
    //echo $q;
    $result=$mysqli->query($q);
    if(!$result){
      $_SESSION['dup_cus'] = "<h2 style='color:white;'>Registration failed. Error: ".$mysqli->error."</h2><br>" ;
      //break;
    }

    $q="SELECT * FROM customer WHERE CUSTOMER_FNAME='$firstname' AND CUSTOMER_LNAME='$lastname'";
    $result=$mysqli->query($q);
    $row=$result->fetch_array();
    $_SESSION['customer_id']=$row[0];
    $_SESSION['customer_title']=$row[1];
    $_SESSION['customer_fname']=$row[2];
    $_SESSION['customer_lname']=$row[3];

    //echo $_SESSION['customer_id'];


    //unset $_POST['page'];
  }*/

  //header('Location: sm_customization.html');
}
?>
<!--
<html lang="en">
<head>
<title>Korn Creation | Login</title>
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
      <?php/*
        if(isset($_SESSION['u_fullname'])){
          echo "<h4>".$_SESSION['u_fullname']." , ".$_SESSION['u_username']."</h4>";
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
<h3>CUSTOMER REGISTRATION CONFIRMATION</h3><br>
<?php
  if(isset($_SESSION['dup_cus'])){
    echo "<center>".$_SESSION['dup_cus']."</center>";
    unset($_SESSION['dup_cus']);
  } else {
?>

<form action="add_customer.php" method="POST">
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
<tr><td colspan="2" align="center"><input class="button-2" type="submit" name="confirm" value="confirm"></td></tr>
</table>
</form>
<?php } ?>*/
</body>
</html>
-->