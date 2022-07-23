<?php require('connectDB.php');
session_start();
$username=$_COOKIE["its_user"];



setcookie("its_user", "", time() - (24*60*60),"/");
setcookie("Full_Name", "", time() - (24*60*60),"/");
$_SESSION['Full_Name']="";
$_SESSION['username']="";
session_destroy();


header("Location: indore_mauze.php");

