<?php
  session_start();
  require_once('connect.php');
  $page = $_GET['page'];
?>
<html lang="en">
<head>
  <link rel="icon" href="images/iconn.gif" />
<title>Korn Creation | Admin</title>
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
          echo "<h4>".$_SESSION['u_fullname']." , ".$_SESSION['u_username']."</h4>";
        }
       ?>
    </div>

    <nav>
      <ul class="menu">
        <li><a href="index.html" class="home"><img src="images/home.jpg" alt=""></a></li>
        <li <?php if($page=='add'){echo "class='current'";} ?>><a href="admin.php?page=add">Add Car</a></li>
        <li <?php if($page=='edit'){echo "class='current'";} ?>><a href="admin.php?page=edit">Edit Car</a></li>
        <li <?php if($page=='adds'){echo "class='current'";} ?>><a href="admin.php?page=adds">Add Staff</a></li>
        <li <?php if($page=='show'){echo "class='current'";} ?>><a href="admin.php?page=show">List Staffs</a></li>

        <li><a href="logout.php">Logout</a></li>


      </ul>
      <div class="clear"></div>
    </nav>
  </header>

<br>
<body>

<h3 style="font-size:35px; line-height:42px; color:white; font-weight:bold; font-family: 'Open Sans Condensed', sans-serif;
text-align: center;">Admin Page</h3><br>
  <?php


    if($page=='add'){
      //echo "<h2 style='color: white;'>Add</h2>";
      echo
      '<style type="text/css">
      table{font-family: "Open Sans Condensed", sans-serif; color:white; font-size: 11pt; font-style: normal; align:center; margin-left:auto; margin-right:auto; width:600px;
      text-align:; background-color: #353535; border-collapse: collapse; border: 2px solid red}
      table.inner{border: 0px}*/
      </style>
      <div class="main_content">
      <form action="add_car.php" method="POST">
      <table class="add_table" align="center" cellpadding = "10">
      <tr><td>manufacturer</td><td><input type="text" name="manufacturer"></td><tr>
      <tr><td>model</td><td><input type="text" name="model"></td><tr>
      <tr><td>price</td><td><input type="text" name="price"></td><tr>
      <tr><td colspan="2" align="center"><input type="submit" class="button-2" value="Submit">
      </td></tr></table></div>';

    } else if ($page=='edit'){
      //echo "<h2 style='color: white;'>Edit</h2>";
      $q = "SELECT * FROM car_model";
      $result = $mysqli->query($q);
      echo '<div class="main_content"><table class="add_table" align="center" cellpadding = "10">
        <tr><th>Car ID</th><th>manufacturer</th><th>Model</th><th>Price</th><th>Edit</th></tr>';
      while($row=$result->fetch_array()){
        echo "<tr><td>".$row['CAR_ID']."</td>
        <td>".$row['MANUFACTURER']."</td>
        <td>".$row['MODEL']."</td>
        <td>".$row['PRICE']."</td>
        <td><a href = 'edit_car.php?id=".$row['CAR_ID']."'><img src='images/edit.png' height = '30px'></a></td></tr>";

      }
      echo "</div>";

    } else if ($page=='adds') {
      echo
      '<style type="text/css">
      table{font-family: "Open Sans Condensed", sans-serif; color:white; font-size: 11pt; font-style: normal; align:center; margin-left:auto; margin-right:auto; width:600px;
      text-align:; background-color: #353535; border-collapse: collapse; border: 2px solid red}
      table.inner{border: 0px}*/
      </style>
      <div class="main_content">
      <form action="add_staff.php" method="POST">
      <table class="add_table" align="center" cellpadding = "10">
      <tr><td>Title</td><td>MR. <input type="radio" name="title" value="Mr.">
      MS. <input type="radio" name="title" value="Ms."></td><tr>
      <tr><td>First Name</td><td><input type="text" name="fname"></td><tr>
      <tr><td>Last Name</td><td><input type="text" name="lname"></td><tr>
      <tr><td>Email</td><td><input type="text" name="email"></td><tr>
      <tr><td>Username</td><td><input type="text" name="username"></td><tr>
      <tr><td>Password</td><td><input type="text" name="password"></td><tr>
      <tr><td>Position</td><td><input type="text" name="position"></td><tr>
      <tr><td>Phone Number</td><td><input type="text" name="phone"></td><tr>
      <tr><td>Address</td><td><textarea name="address" rows="4" cols="30"></textarea></td><tr>
      <tr><td>City</td><td><input type="text" name="city"></td><tr>
      <tr><td>Country</td><td><input type="text" name="country"></td><tr>
      <tr><td>Zipcode</td><td><input type="text" name="zipcode"></td><tr>
      <tr><td colspan="2" align="center"><input type="submit" class="button-2" value="Submit">
      </td></tr></table></div>';
    } else if ($page=="show"){
      $q = "SELECT * FROM staff";
      $result = $mysqli->query($q);
      echo '<div class="main_content"><table class="add_table" align="center" cellpadding = "10">
        <tr><th>Name</th><th>Position</th><th>Email</th><th>Phone Number</th></tr>';
      while($row=$result->fetch_array()){
        echo "<tr><td>".$row['USER_TITLE']." ".$row['USER_FNAME']." ".$row['USER_LNAME']."</td>
        <td>".$row['USER_POSITION']."</td>
        <td>".$row['USER_EMAIL']."</td>
        <td>".$row['USER_PHONE']."</td>
        </tr>";

      }
      echo "</div>";

    }


  ?>

</body>
</html>
