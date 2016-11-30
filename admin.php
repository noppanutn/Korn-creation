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
<h3>Admin Page</h3><br>
  <?php
    $q = "SELECT * FROM car_model";
    $result = $mysqli->query($q);

    if($page=='add'){
      //echo "<h2 style='color: white;'>Add</h2>";

    } else if ($page=='edit'){
      //echo "<h2 style='color: white;'>Edit</h2>";
      echo '<div class="main_content"><table class="add_table" align="center" cellpadding = "10">
        <tr><th>Car ID</th><th>manufacturer</th><th>Model</th><th>Price</th><th>Edit</th><th>Delete</th></tr>';
      while($row=$result->fetch_array()){
        echo "<tr><td>".$row['CAR_ID']."</td>
        <td>".$row['MANUFACTURER']."</td>
        <td>".$row['MODEL']."</td>
        <td>".$row['PRICE']."</td>
        <td><a href = 'edit_car.php?id=".$row['CAR_ID']."'><img src='images/edit.png' height = '30px'></a></td>
        <td><a href = 'delete_car.php?id=".$row['CAR_ID']."'><img src='images/delete.png' height = '30px'></a></td></tr>";

      }
      echo "</div>";

    }

  ?>

</body>
</html>
