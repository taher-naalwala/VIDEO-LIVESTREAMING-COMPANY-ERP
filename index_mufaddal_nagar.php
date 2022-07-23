<?php


date_default_timezone_set("Asia/Kolkata");

$year= date('Y');
$date = date('Y-m-d');
$f_time = date("h:i:sa");
list($hour, $minute, $second) = explode(':', $f_time);
$state = substr($second, -2);
$timel;



require('connectDB.php');
//3. If the form is submitted or not.
//3.1 If the form is submitted

if ($state == "am") {
  $timel;
  if ($hour == 12) {
    $timel = ($minute / 60);
  } else {
    $timel = ($hour) + ($minute / 60);
  }


  if (((($timel >= (21)) && ($timel <= (21 + 5))) || (($timel >= (21)) && ($timel <= (21 + 5))))) {




    if (isset($_POST['username'])) {
      //3.1.1 Assigning posted values to variables.
      $username = $_POST['username'];
      //3.1.2 Checking the values are existing in the database or not
      $s1 = "SELECT COUNT(*) as c_1 from reg_form WHERE its='$username1' AND status='2'";
      $run1 = $conn->query($s1);
      $row1_1 = $run1->fetch_assoc();
      $c_1 = $row1_1['c_1'];
      if ($c_1 > 0) {

     
         
            // $_SESSION['its_user'] = $username;
            setcookie("its_user", $username, time() + (4 * 60 * 60), "/");
            
            header("Location: online_broadcast_mufaddal_nagar.php");
           
        
      } else {
        //3.1.3 If the login credentials doesn't match, he will be shown with an error message.
        echo '<div class="alert alert-danger">
    You dont have access
    </div>';
      }
    }
  }
} else {
  $timel;
  if ($hour == 12) {
    $timel = ($hour) + ($minute / 60);
  } else {
    $timel = ($hour + 12) + ($minute / 60);
  }

  if (((($timel >= (21)) && ($timel <= (21 + 5))) || (($timel >= (21)) && ($timel <= (21 + 5))))) {

    if (isset($_POST['username'])) {
      //3.1.1 Assigning posted values to variables.
      $username = $_POST['username'];
      //3.1.2 Checking the values are existing in the database or not
      $s1 = "SELECT COUNT(*) as c_1 from reg_form WHERE its='$username' AND status='2'";
      $run1 = $conn->query($s1);
      $row1_1 = $run1->fetch_assoc();
      $c_1 = $row1_1['c_1'];
      if ($c_1 > 0) {

       
          setcookie("its_user", $username, time() + (4 * 60 * 60), "/");
          
          header("Location: online_broadcast_mufaddal_nagar.php");
        
          }
        else {
        //3.1.3 If the login credentials doesn't match, he will be shown with an error message.
        echo '<div class="alert alert-danger">
    You dont have access
    </div>';
      }
    }
  }
}




//3.1.4 if the user is logged in Greets the user with message
if (isset($_COOKIE['its_user'])) {
  $username = $_COOKIE['its_user'];


  header("Location: online_broadcast_mufaddal_nagar.php");
  die();
} else {
  //3.2 When the user visits the page first time, simple login form will be displayed.
}

?>

<html xmlns="http://www.w3.org/1999/xhtml">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
    <title>
        Relay - Umoor Dakhiliya (Indore)
    </title>
    <link rel="icon" href="https://www.alvazarat.org/1438/images/favicon.png" type="image/x-icon">
    <link rel="shortcut icon" href="https://www.alvazarat.org/1438/images/favicon.png" type="image/x-icon">
    <link href="vazarat/bootstrap.css" rel="stylesheet" type="text/css">
    <link rel="stylesheet" type="text/css" href="vazarat/style.css">
    <script src="//code.jquery.com/jquery-1.11.1.min.js"></script>

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="js/html5shiv.min.js"></script>
    <script src="js/respond.min.js"></script>
    <![endif]-->

    <!--[if lte IE 7]> <html class="ie7"> <![endif]-->
    <!--[if IE 8]>     <html class="ie8"> <![endif]-->
    <!--[if IE 9]>     <html class="ie9"> <![endif]-->



</head>

<body>
    <div id="site-header">
        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12 header-left">
                <div></div>
            </div>


        </div>
    </div>

    <div id="main-content" class="container-fluid">
        <div class="back-border" style="border: 0;">
            <div class="row">
                <br>
                <div class="login-form">
                    <h2>Login for Live Relay (9 PM)</h2>
                    <br>
                    <div class="col-md-12">
                        <form method="post" id="form1">

                            <div id="div_mess1" style="display: none;">
                                <div id="div_mess2"></div>
                            </div>
                      <input name="username"  type="text" id="txt1" class="fadeIn second" title="Enter ITS ID" maxlength="8" value="Enter ITS ID and click on Login" onfocus="if(this.value==this.defaultValue)this.value='';" onblur="if(this.value=='')this.value=this.defaultValue;" placeholder="Enter ITS ID">
                            <input type="submit" name="btn1" value="Login" id="btn1" class="fadeIn fourth">
							
                        </form>
                    </div>
                    <div style="clear: both;"></div>
                </div>
            </div>
        </div>
    </div>

    <div id="footer">

        <div id="site-footer" class="container-fluid">
            <div class="row">
                <div class="col-xs-12">
                    <p class="footer-text">© <?php echo $year ?> UMOOR DAKHILIYA (INDORE) - ALL RIGHTS RESERVED</p>
                </div>
            </div>
        </div>
    </div>



<script>
$(document).bind("contextmenu",function(e){
  return false;
    });
    
    $(document).keydown(function (event) {
            if (event.keyCode == 123) {
                return false;
            }
            else if ((event.ctrlKey && event.shiftKey && event.keyCode == 73) || (event.ctrlKey && event.shiftKey && event.keyCode == 74)) {
                return false;
            }
        });
</script>

</body>

</html>