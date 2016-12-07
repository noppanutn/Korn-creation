<?php
  session_start();
  require_once('connect.php');

  if(!isset($_SESSION['u_position'])){
      $_SESSION['nop']='<center><warn>You do not have permission. Please log in.</warn></center>';
      header('Location: login.php');
    }else{
      if(!($_SESSION['u_position']=='admin')){
          $_SESSION['nop']='<center><warn>You do not have permission. Please log in.</warn></center>';
          header('Location: login.php');
        }
    }

  $page = $_GET['page'];

  if(isset($_POST['model'])){
    $manufacturer = $_POST['manufacturer'];
    $model = $_POST['model'];
    $price = $_POST['price'];
    $edit_id = $_POST['edit_id'];

    $q = "UPDATE car_model SET MANUFACTURER = '$manufacturer',
    MODEL = '$model' , PRICE = $price WHERE CAR_ID = $edit_id" ;
    $result = $mysqli->query($q);
    //echo $q;
    header('Location: admin.php?page=edit');
  }
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

<br>
<body>
<h3 style="font-size:35px; line-height:42px; color:white; font-weight:bold; font-family: 'Open Sans Condensed', sans-serif;
text-align: center;">Admin Page</h3><br>
  <?php
  if(isset($_GET['id'])){
    $id = $_GET['id'];
    $q = "SELECT * FROM car_model WHERE CAR_ID = $id";
    $result = $mysqli->query($q);
    $row = $result->fetch_array();

    echo
    '<style type="text/css">
    table{font-family: "Open Sans Condensed", sans-serif; color:white; font-size: 11pt; font-style: normal; align:center; margin-left:auto; margin-right:auto; width:600px;
    text-align:; background-color: #353535; border-collapse: collapse; border: 2px solid red}
    table.inner{border: 0px}*/
    </style>
    <div class="main_content">
    <form action="edit_car.php" method="POST">
    <table class="add_table" align="center" cellpadding = "10">
    <tr><td>manufacturer</td><td><input type="text" name="manufacturer" value="'.$row["MANUFACTURER"].'"></td><tr>
    <tr><td>model</td><td><input type="text" name="model" value="'.$row["MODEL"].'"></td><tr>
    <tr><td>price</td><td><input type="text" name="price" value="'.$row["PRICE"].'"></td><tr>
    <tr><td colspan="2" align="center"><input type="submit" class="button-2" value="Submit">
    </td></tr></table></div><input type="hidden" name="edit_id" value="'.$id.'"';
  }

  ?>

</body>
</html>
