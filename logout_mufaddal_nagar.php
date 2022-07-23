<?php require('connectDB.php');
//session_start();
$username=$_COOKIE["its_user"];

$s1="UPDATE oda SET date='',time='' WHERE its='$username'";

if(mysqli_query($conn,$s1))
{

setcookie("its_user", "", time() - (24*60*60),"/");
setcookie("Full_Name", "", time() - (24*60*60),"/");
header("Location: index_mufaddal_nagar.php");
}
else
{
   header("Location: online_broadcast_mufaddal_nagar.php");
}
