 <?php 
if(isset($_SESSION['loggedin']) && $_SESSION['loggedin']==true){
  $loggedin= true;
}
else{
  $loggedin = false;
}
?>


<?php

$server = 'localhost';
$user = 'root';
$password= '';
$db = 'usersignup0';


$con = mysqli_connect($server,$user,$password,$db);

if($con){
?>
 
<?php
}

?> 