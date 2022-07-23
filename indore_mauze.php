<?php

session_start();
date_default_timezone_set("Asia/Kolkata");


$date = date('Y-m-d');
$f_time = date("h:i:sa");
list($hour, $minute, $second) = explode(':', $f_time);
$state = substr($second, -2);
$year = date('Y');
$timel;



function get_operating_system()
{
    $u_agent = $_SERVER['HTTP_USER_AGENT'];
    $operating_system = 'Unknown Operating System';

    //Get the operating_system name
    if (preg_match('/linux/i', $u_agent)) {
        $operating_system = 'Linux';
    } elseif (preg_match('/macintosh|mac os x|mac_powerpc/i', $u_agent)) {
        $operating_system = 'Mac';
    } elseif (preg_match('/windows|win32|win98|win95|win16/i', $u_agent)) {
        $operating_system = 'Windows';
    } elseif (preg_match('/ubuntu/i', $u_agent)) {
        $operating_system = 'Ubuntu';
    } elseif (preg_match('/iphone/i', $u_agent)) {
        $operating_system = 'IPhone';
    } elseif (preg_match('/ipod/i', $u_agent)) {
        $operating_system = 'IPod';
    } elseif (preg_match('/ipad/i', $u_agent)) {
        $operating_system = 'IPad';
    } elseif (preg_match('/android/i', $u_agent)) {
        $operating_system = 'Android';
    } elseif (preg_match('/blackberry/i', $u_agent)) {
        $operating_system = 'Blackberry';
    } elseif (preg_match('/webos/i', $u_agent)) {
        $operating_system = 'Mobile';
    }

    return $operating_system;
}

$os = get_operating_system();

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


    if (((($timel >= (10)) && ($timel <= (10 + 9))) || (($timel >= (10)) && ($timel <= (10 + 9))))) {

        if (isset($_POST['username']) and isset($_POST['password'])) {
            //3.1.1 Assigning posted values to variables.


            $username = $_POST['username'];
            $password = $_POST['password'];
            //3.1.2 Checking the values are existing in the database or not
            $query = "SELECT COUNT(*) as c FROM web_login WHERE its='$username' and password='$password' AND state=0";

            $runc = $conn->query($query);
            $rowc = $runc->fetch_assoc();
            $c = $rowc['c'];
            //3.1.2 If the posted values are equal to the database values, then session will be created for the user.
            if ($c > 0) {
                $s1 = "SELECT mobile,name,its FROM web_login WHERE its='$username' and password='$password'";
                $run1 = $conn->query($s1);

                $_SESSION['username'] = $username;
                while ($row = $run1->fetch_assoc()) {

                    $mobile = $row['mobile'];
                    $its = $row['its'];
                    setcookie("its_user", $its, time() + (4 * 60 * 60), "/");


                    $_SESSION['mobile'] = $mobile;
                }
            } else {
                //3.1.3 If the login credentials doesn't match, he will be shown with an error message.
                echo '<div class="alert alert-danger">
Invalid Login
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

    if (((($timel >= (10)) && ($timel <= (10 + 9))) || (($timel >= (10)) && ($timel <= (10 + 9))))) {
        if (isset($_POST['username']) and isset($_POST['password'])) {
            //3.1.1 Assigning posted values to variables.


            $username = $_POST['username'];
            $password = $_POST['password'];
            //3.1.2 Checking the values are existing in the database or not
            $query = "SELECT COUNT(*) as c FROM web_login WHERE its='$username' and password='$password' AND state=0";

            $runc = $conn->query($query);
            $rowc = $runc->fetch_assoc();
            $c = $rowc['c'];
            //3.1.2 If the posted values are equal to the database values, then session will be created for the user.
            if ($c > 0) {
                $s1 = "SELECT mobile,name,its FROM web_login WHERE its='$username' and password='$password'";
                $run1 = $conn->query($s1);

                $_SESSION['username'] = $username;
                while ($row = $run1->fetch_assoc()) {

                    $mobile = $row['mobile'];

                    $_SESSION['mobile'] = $mobile;
                    $its = $row['its'];
                    setcookie("its_user", $its, time() + (4 * 60 * 60), "/");
                }
            } else {
                //3.1.3 If the login credentials doesn't match, he will be shown with an error message.
                echo '<div class="alert alert-danger">
Invalid Login
</div>';
            }
        }
    }
}
//3.1.4 if the user is logged in Greets the user with message
if (isset($_SESSION['username'])) {
    $username = $_SESSION['username'];

    if ($username == "30349223" || $username == "22233344") {
        setcookie("its_user", $username, time() + (4 * 60 * 60), "/");
        setcookie("Full_Name", "Taher", time() + (4 * 60 * 60), "/");
        header("Location: online_broadcast_mauze.php");
    } else {
        if (isset($_COOKIE['its_user'])) {
            header("Location: online_broadcast_mauze.php");
            die();
        } else {

            header("Location: online_broadcast_mauze.php");
            die();
        }
    }
} else {
    //3.2 When the user visits the page first time, simple login form will be displayed.
}

?>

<html>

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
    <title>
        Relay - Indore Mauze
    </title>
    <link rel="icon" href="https://www.alvazarat.org/1438/images/favicon.png" type="image/x-icon">
    <link rel="shortcut icon" href="https://www.alvazarat.org/1438/images/favicon.png" type="image/x-icon">
    <link href="vazarat/bootstrap.css" rel="stylesheet" type="text/css">
    <link rel="stylesheet" type="text/css" href="vazarat/style.css">
    <script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
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
                    <h2>Login for Live Relay (10:15 AM)</h2>
                    <br>
                    <div class="col-md-12">

                        <form method="post" id="form1">

                            <div id="div_mess1" style="display: none;">
                                <div id="div_mess2"></div>
                            </div>




                            <input name="username" type="text" id="txt1" class="fadeIn second" title="Enter ITS ID" maxlength="10" value="Enter Username" onfocus="if(this.value==this.defaultValue)this.value='';" onblur="if(this.value=='')this.value=this.defaultValue;" placeholder="Enter Username">
                            <input name="password" type="text" id="txt1" class="fadeIn second" title="Enter Password" maxlength="15" value="Enter Password" onfocus="if(this.value==this.defaultValue)this.value='';" onblur="if(this.value=='')this.value=this.defaultValue;" placeholder="Enter Password">


                            <input type="submit" name="btn1" value="Login" id="btn1" class="fadeIn fourth">



                        </form>


                        <!--
						<form method="post" id="form1">

                            <div id="div_mess1" style="display: none;">
                                <div id="div_mess2"></div>
                            </div>
                      <input name="username"  type="text" id="txt1" class="fadeIn second" title="Enter ITS ID" maxlength="8" value="Enter ITS ID and click on Login" onfocus="if(this.value==this.defaultValue)this.value='';" onblur="if(this.value=='')this.value=this.defaultValue;" placeholder="Enter ITS ID">
                            <input type="submit" name="btn1" value="Login" id="btn1" class="fadeIn fourth">
							
                        </form>
						-->
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

                <div class="col-xs-12">
                    <p class="footer-text">Developed in Khidmat By <a target="_blank" href="https://mail.google.com/mail/?view=cm&amp;fs=1&amp;to=naalwala12taher@gmail.com">Taher Bhai Naalwala</a></p>



                </div>

            </div>
        </div>
    </div>




    <script>
        $(document).bind("contextmenu", function(e) {
            return false;
        });

        $(document).keydown(function(event) {
            if (event.keyCode == 123) {
                return false;
            } else if ((event.ctrlKey && event.shiftKey && event.keyCode == 73) || (event.ctrlKey && event.shiftKey && event.keyCode == 74)) {
                return false;
            }
        });
    </script>





</body>

</html>