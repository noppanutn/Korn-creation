<?php
require_once('connect.php');
//echo "something";
if(($_POST['id']))
{

 $state = $_POST['id'];
 $q = "SELECT * FROM car_model WHERE MANUFACTURER = '$state'";
 //echo $q;
 echo "<option value='0'>--Select a car model--</option>";
 if($result=$mysqli->query($q)){
   while($row=$result->fetch_array()){
     echo '<option value="'.$row[0].'">'.$row[2].'</option>';
   }
 }else{
   echo 'Query error: '.$mysqli->error;
 }
 //$find=$mysql->query($q);
 //echo '<option>Select a car model</option>';
 //while($row=$find->fetch_array())
 //{
//  echo '<option>'.$row[2].'</option>';
 //}
// exit;
}
?>