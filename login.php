<?php
  session_start();
  if(isset($_SESSION['u_position'])){
  if($_SESSION['u_position']=="salesman"){
    header("Location: sm_pinfo.php");
  } else if ($_SESSION['u_position']=="admin"){
    header("Location: admin.php?page=edit");
  } else if ($_SESSION['u_position']=="delivery man") {
    header("Location: delivery.php");
  } else if ($_SESSION['u_position']=="accountant") {
    header("Location: sm_salesdata.php");
  }

}
?>
<html lang="en">
<head>
  <link rel="icon" href="images/iconn.gif" >
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
    <nav>
      <ul class="menu">
        <li><a href="index.html" class="home"><img src="images/home.jpg" alt=""></a></li>
        <li><a href="about.html">About</a></li>

        <li class="current"><a href="login.php">Login</a></li>
      </ul>
      <div class="clear"></div>
    </nav>
  </header>


<style class="cp-pen-styles">@import url(https://fonts.googleapis.com/css?family=Source+Sans+Pro:200,300,400,700);
@import url(https://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css);
@import url(https://maxcdn.bootstrapcdn.com/font-awesome/4.1.0/css/font-awesome.min.css);
* {
  margin: 0;
  padding: 0;
}

html {
  background: url(https://dl.dropboxusercontent.com/u/159328383/background.jpg) no-repeat center center fixed;
  -webkit-background-size: cover;
  -moz-background-size: cover;
  -o-background-size: cover;
  background-size: cover;
}

body {
  background: transparent;
}

body, input, button {
  font-family: 'Source Sans Pro', sans-serif;
}

.login {
  padding: 15px;
  width: 400px;
  min-height: 400px;
  margin: 2% auto 0 auto;
}
.login .heading {
  text-align: center;
  margin-top: 1%;
}
.login .heading h2 {
  font-size: 3em;
  font-weight: 300;
  color: rgba(255, 255, 255, 0.7);
  display: inline-block;
  padding-bottom: 5px;
  text-shadow: 1px 1px 3px #23203b;
}
.login form .input-group {
  border-bottom: 1px solid rgba(255, 255, 255, 0.1);
  border-top: 1px solid rgba(255, 255, 255, 0.1);
}
.login form .input-group:last-of-type {
  border-top: none;
}
.login form .input-group span {
  background: transparent;
  min-width: 53px;
  border: none;
}
.login form .input-group span i {
  font-size: 1.5em;
  color: rgba(255, 255, 255, 0.2);
}
.login form input.form-control {
  display: block;
  width: auto;
  height: auto;
  border: none;
  outline: none;
  box-shadow: none;
  background: none;
  border-radius: 0px;
  padding: 10px;
  font-size: 1.6em;
  width: 100%;
  background: transparent;
  color: #c2b8b1;
}
.login form input.form-control:focus {
  border: none;
}
.login form input[type=submit] {
  margin-top: 20px;
  background: #27AE60;
  border: none;
  font-size: 1.6em;
  font-weight: 300;
  padding: 5px 0;
  width: 100%;
  border-radius: 3px;
  color: #b3eecc;
  border-bottom: 4px solid #1e8449;
}
.login form input[type=submit]:hover {
  background: #30b166;
  -webkit-animation: hop 1s;
  animation: hop 1s;
}

.float {
  display: inline-block;
  -webkit-transition-duration: 0.3s;
  transition-duration: 0.3s;
  -webkit-transition-property: transform;
  transition-property: transform;
  -webkit-transform: translateZ(0);
  transform: translateZ(0);
  box-shadow: 0 0 1px transparent;
}

.float:hover, .float:focus, .float:active {
  -webkit-transform: translateY(-3px);
  transform: translateY(-3px);
}

/* Large Devices, Wide Screens */
@media only screen and (max-width: 1200px) {
  .login {
    width: 600px;
    font-size: 2em;
  }
}
@media only screen and (max-width: 1100px) {
  .login {
    margin-top: 2%;
    width: 600px;
    font-size: 1.7em;
  }
}
/* Medium Devices, Desktops */
@media only screen and (max-width: 992px) {
  .login {
    margin-top: 1%;
    width: 550px;
    font-size: 1.7em;
    min-height: 0;
  }
}
/* Small Devices, Tablets */
@media only screen and (max-width: 768px) {
  .login {
    margin-top: 0;
    width: 500px;
    font-size: 1.3em;
    min-height: 0;
  }
}
/* Extra Small Devices, Phones */
@media only screen and (max-width: 480px) {
  .login {
    margin-top: 0;
    width: 400px;
    font-size: 1em;
    min-height: 0;
  }
  .login h2 {
    margin-top: 0;
  }
}
/* Custom, iPhone Retina */
@media only screen and (max-width: 320px) {
  .login {
    margin-top: 0;
    width: 200px;
    font-size: 0.7em;
    min-height: 0;
  }
}
/* warning statement */
warn{
  font-size: 2rem;
  color: red;
}
</style></head>

<body>
  <div class="login">
  <div class="heading">
    <?php
    if(isset($_SESSION['nop'])){
      echo $_SESSION['nop'];
      session_destroy();
    }
    ?>

    <h2>Sign in</h2>
    <?php
      if(isset($_SESSION['message'])){
        echo $_SESSION['message'];
        unset ($_SESSION['message']);
      }
    ?>
    <form method="POST" action="checklogin.php">
      <div class="input-group input-group-lg">
        <span class="input-group-addon"><i class="fa fa-user"></i></span>
        <input type="text" class="form-control" name="username" placeholder="Username or email">
          </div>

        <div class="input-group input-group-lg">
          <span class="input-group-addon"><i class="fa fa-lock"></i></span>
          <input type="password" class="form-control" name="passwd" placeholder="Password">
        </div>
        <input type="submit" class="float" name="submit">
        <!--<button type="submit" class="float">Login</button>-->
       </form>
 		</div>

 </div>


</body>
<footer>Korn Creation &copy; 2045 | <a href="#">Privacy Policy</a> | Designed by: <a href="#">NFG.com</a></footer>

</html>
