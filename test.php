<?php


date_default_timezone_set("Asia/Kolkata");


$date = date('Y-m-d');
$f_time = date("h:i:sa");
list($hour, $minute, $second) = explode(':', $f_time);
$state = substr($second, -2);
$timel;




require('connectDB.php');
//3. If the form is submitted or not.







    if (isset($_POST['submit'])) {
       setcookie("relay_public", "1", time() + (2 * 60 * 60), "/");
	   header('Location:https://www.its52.com/Login.aspx?OneLogin=SAIFYNAGAR');
           
      } else {
       
       
      }
    
 


if (isset($_COOKIE['its_user'])) {
  $username = $_COOKIE['its_user'];


  header("Location: online_broadcast.php");
  die();
} else {
 
}

?>

<html>

<head>
  <link rel="icon" href="http://indoreestates.com/sabaq/photo.png">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Login-Relay</title>
</head>
<style>
  * {
    box-sizing: border-box;
  }

  body {
    padding-top: 40px;
    padding-bottom: 40px;
  }

  .form-signin {
    max-width: 300px;
    padding: 15px;
    margin: 0 auto;
  }

  .form-signin .form-signin-heading,
  .form-signin .checkbox {
    margin-bottom: 10px;
    display: block;
    margin-left: auto;
    margin-right: auto;
    width: 50%;
  }

  .form-signin .checkbox {
    font-weight: normal;
  }

  .form-signin .form-control {
    position: relative;
    height: auto;
    -webkit-box-sizing: border-box;
    -moz-box-sizing: border-box;
    box-sizing: border-box;
    padding: 10px;
    font-size: 16px;
  }

  .form-signin .form-control:focus {
    z-index: 2;
  }

  .form-signin input[type="email"] {
    margin-bottom: -1px;
    width: 100%;
    border-bottom-right-radius: 0;
    border-bottom-left-radius: 0;
    padding: 10px;
  }

  .form-signin input[type="password"] {
    margin-bottom: 10px;
    border-top-left-radius: 0;
    border-top-right-radius: 0;

  }

  div {
    border-radius: 15px;
    background-color: #ffffff;
    padding: 20px 40px;
    width: 30%;
    margin: 0 auto;
    border-color: #790b98;
    /* border: 1px solid #d4d4d4; */
    box-shadow: 7px 29px 39px -10px rgba(179, 179, 179, 0.29);
    margin-top: 20px;
  }

  .center {
    display: block;
    margin-left: auto;
    margin-right: auto;
    width: 15%;

  }

  label,
  input {
    display: block;
  }

  label {
    margin-bottom: 30px;
  }

  input[type=text] {
    width: 100%;
    padding: 12px 20px;
    margin: 8px 0;
    display: inline-block;
    border: 1px solid #ccc;
    border-radius: 4px;
    box-sizing: border-box;
    resize: vertical;


  }

  input[type=number] {
    width: 100%;
    padding: 12px 20px;
    margin: 8px 0;
    display: inline-block;
    border: 1px solid #ccc;
    border-radius: 4px;
    box-sizing: border-box;
    resize: vertical;


  }

  input[type=password] {
    width: 100%;

    padding: 12px 20px;
    margin: 8px 0;
    display: inline-block;
    border: 1px solid #ccc;
    border-radius: 4px;
    box-sizing: border-box;

  }

  .loginText {
    margin-top: 5px;
    margin-bottom: 10px;


    text-align: center;
  }

  .button {
    width: 100%;
    border-radius: 12px;
    background-color: #790b98;
    /* Green */
    border: none;
    color: white;
    padding: 10px;
    text-align: center;
    text-decoration: none;
    display: inline-block;
    font-size: 20px;
    margin: 4px 2px;
    cursor: pointer;

  }

  @media screen and (max-width: 600px) {
    div {
      border-radius: 15px;
      background-color: #ffffff;
      padding: 0px;
      width: 80%;
      margin: 0 auto;
      border-color: #790b98;
      /* border: 1px solid #d4d4d4; */
      box-shadow: 7px 29px 39px -10px rgba(179, 179, 179, 0.29);
      margin-top: 30px;
    }

    .center {
      display: block;
      margin-left: auto;
      margin-right: auto;
      width: 50%;

    }

    .button {

      margin-bottom: 10px;

    }

  }
</style>

<body background="photos/bg.png">

  <img class="center" src="photos/photo.png">

  <!-- Latest compiled and minified CSS -->
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">

  <!-- Optional theme -->
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css">

  <link rel="stylesheet" href="styles.css">

  <!-- Latest compiled and minified JavaScript -->
  <script src="photos/https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  <div>
        <h3 class="loginText">
        <font color="#790b98"><b>SIGN IN</b></font>
      </h3>


    <form method="POST">

      <button  name="submit" value="sub" class="button" type="submit">Login</button>
</form>
  </div>
</body>

</html>