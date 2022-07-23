<?php



if (isset($_COOKIE['its_user'])) {
    $its = $_COOKIE['its_user'];
    $its = preg_replace('/[\x00-\x1F\x7F]/u', '', $its);
	
} else {
  header("Location: index.php");
    die();
} 

?>
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
    <title>
        Relay | Umoor Dakhiliya (Indore)
    </title>
    <link rel="icon" href="https://www.alvazarat.org/1438/images/favicon.png" type="image/x-icon">
    <link rel="shortcut icon" href="https://www.alvazarat.org/1438/images/favicon.png" type="image/x-icon">
    <link href="vazarat/bootstrap.css" rel="stylesheet" type="text/css">
    <link rel="stylesheet" type="text/css" href="vazarat/style.css">
    <script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
	 <link href='https://fonts.googleapis.com/css?family=Lekton|Lobster' rel='stylesheet' type='text/css'>
  <link href="dist/css/jquery.mb.YTPlayer.min.css" media="all" rel="stylesheet" type="text/css">

  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <script src="dist/jquery.mb.YTPlayer.js"></script>
  <script src="assets/apikey.js"></script>

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="js/html5shiv.min.js"></script>
    <script src="js/respond.min.js"></script>
    <![endif]-->

    <!--[if lte IE 7]> <html class="ie7"> <![endif]-->
    <!--[if IE 8]>     <html class="ie8"> <![endif]-->
    <!--[if IE 9]>     <html class="ie9"> <![endif]-->
    <style type="text/css">
	
        .active_1 {
            background-color: #254924;
            color: #ffffff;
            width: 100px;
            cursor: pointer;
        }

        .inactive_1 {
            background-color: #a00f0c;
            color: #ffffff;
            width: 100px;
            cursor: pointer;
        }

        .active_1:hover {
            background-color: #254924;
            color: #ffffff;
            width: 100px;
            cursor: pointer;
        }

        .inactive_1:hover {
            background-color: #254924;
            color: #ffffff;
            width: 100px;
            cursor: pointer;
        }
    </style>
	<style>
.container {
  position: relative;
  width: 100%;
  overflow: hidden;
  padding-top: 56.25%; /* 16:9 Aspect Ratio */
}

.responsive-iframe {
  position: absolute;
  top: 0;
  left: 0;
  bottom: 0;
  right: 0;
  width: 100%;
  height: 100%;
  border: none;
}



    .player {
      border-radius: 10px;
      box-shadow: 0 0 10px rgba(0, 0, 0, .5);
    }

    .player.fullscreen {
      border-radius: 0;
      border: 0px solid #fff;
      box-shadow: none;
    }

    #wrapper {
      position: relative;
      padding: 30px 20px;
      z-index: 10;
    }

    .dida {
      color: #fff;
      font-size: 20px;
      position: relative;
      width: 800px;
      margin: 0 60px;
    }

    .controls {
      position: relative;
      width: 800px;
      margin: 0 50px;
    }

    button, .button {
      transition: all .4s;

      display: inline-block;
      padding: 0px 10px;
      font-size: 16px;

      cursor: pointer;

      background-color: rgba(248, 248, 248, 0.4);
      box-shadow: 0 0 4px rgba(0, 0, 0, 0.4);
      color: #000;

      border: 1px solid transparent;

      text-decoration: none;
      line-height: 30px;
      margin: 3px;
      border-radius: 10px;
    }

    button:hover, .button:hover {
      background-color: rgb(0, 0, 0);
      color: #FFF;
    }

    button:focus {
      outline: none;
    }

    #filtersControl {
      position: absolute;
      top: 70px;
      right: 50px;
      width: 400px;
      margin: 30px auto;
    }

    #filterScript {
      margin-top: 20px;
      padding: 10px;
      background-color: rgba(25, 34, 37, 0.35);
      color: #fff;
      border-radius: 10px;
    }

    .slider {
      position: relative;
      width: 100%;
      height: 25px;
      border: 0 solid transparent;
      background-color: #192225;
      border-radius: 4px;
      margin-top: 10px;
      overflow: hidden;
    }

    .slider .level {
      background-color: #3c6784;
      height: 100%;
    }

    .slider .desc {
      position: absolute;
      right: 0;
      top: 0;
      padding: 5px;
      font-size: 12px;
      line-height: 18px;
      color: #fff;
    }

    .slider span {
      font-family: Arial, 'Helvetica Neue', Helvetica, sans-serif;
      /*text-transform: uppercase;*/
      position: absolute;
      top: 0;
      font-size: 12px;
      line-height: 18px;
      color: #fff;
      padding: 4px;
      text-align: left;
      width: 100%;
      box-sizing: border-box;
    }

    .goto {
      margin-top: 20px;
      text-align: center;
      width: 100%;
      height: 50px;
    }

    .goto .button {
      font-size: 20px;
      font-family: 'Lobster', cursive;
      padding: 10px;
    }

    .player-container {
      width: 60vw;
      min-width: 600px
    }

    #wp {
      position: absolute;
      right: 60px;
      top: 20px;
      z-index: 10;
      min-width: 300px;
      background: rgba(0, 0, 0, 0.55);
      /*background: #ffb200;*/
      color: #fff;
      font-size: 24px;
      line-height: 24px;
      padding: 20px;
      cursor: pointer;
      text-align: left;
      border-radius: 10px;
      font-family: 'Lobster', cursive;
    }

    #wp:hover {
      background: #000000;
    }

    #wp img {
      width: 60px;
      margin-right: 20px;
    }

    @media only screen and (max-device-width: 480px) {


      #wrapper {
        position: relative;
        width: 100%;
        min-width: 0;
        padding: 0;
      }

      .player-container {
        width: 100%;
        min-width: 0;
      }

      .controls {
        position: relative;
        width: 100%;
        margin: 0;
      }

      #donate {
        display: none;
      }

      .dida {
        width: 100%;
        margin: 0;
      }

      #wp {
        position: relative !important;
        top: auto;
        left: auto;
      }

      #filtersControl {
        position: relative;
        top: 0;
        right: 0px;
        width: 100%;
        margin: 0;
      }
    }

 
</style>
 <script>

			var myPlayer;
			jQuery(function () {

					myPlayer = jQuery("#P1").YTPlayer();
					myPlayer.on("YTPData", function (e) {
							$(".dida").html(e.prop.title + "<br>@" + e.prop.channelTitle);
					});

					
					

					myPlayer.on('YTPPlay', function () {
							console.log('playing');
					});

			});

			function toggleFullScreenOnPlay(el) {
					if ($(el).is(':checked'))
							myPlayer.get(0).opt.goFullScreenOnPlay = true;
					else
							myPlayer.get(0).opt.goFullScreenOnPlay = false;
			}

  </script>
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
        <?php require('connectDB.php');


        date_default_timezone_set('Asia/Kolkata');
        $date = date('Y-m-d');
        $f_time = date("h:i:sa");


        list($hour, $minute, $second) = explode(':', $f_time);
        $state = substr($second, -2);
        $timel;
        if ($state == "am") {

            if ($hour == 12) {
                $timel = ($minute / 60);
            } else {
                $timel = ($hour) + ($minute / 60);
            }
        } else {
            if ($hour == 12) {
                $timel = ($hour) + ($minute / 60);
            } else {
                $timel = ($hour + 12) + ($minute / 60);
            }
        }

        $sql = "SELECT id,name,embed_code,adminid from event_info WHERE '$date' BETWEEN start_date AND end_date AND ((start_time)<$timel AND (end_time)>$timel)";
        $run = $conn->query($sql);
        $flag = 0;
        if ($run->num_rows > 0) {
            $flag = 1;
            while ($row = $run->fetch_assoc()) {
                $eventid = $row['id'];
                $eventname = $row['name'];
                $embed_code = $row['embed_code'];
                $adminid = $row['adminid'];


                $s1 = " SELECT COUNT(*) as c from reg_form WHERE its='$its' AND status='2' AND event_id=$eventid";

                $run1 = $conn->query($s1);
                $row1_0 = $run1->fetch_assoc();
                $c = $row1_0['c'];
                if ($c > 0) {
                    $flag = 1;

                    $query = "SELECT COUNT(*) as c_1 FROM web_login WHERE id=$adminid AND (start_date<='$date' AND end_date>='$date')";
                    $squery = $conn->query($query);
                    $row1_1 = $squery->fetch_assoc();
                    $c_1 = $row1_1['c_1'];
                    if ($c_1 > 0) {
                        $sub_timel = substr($timel, 0, 4);
                        $s1 = "UPDATE reg_form SET time='$sub_timel',date='$date' WHERE its='$its' AND event_id=$eventid AND status='2'";
                        mysqli_query($conn, $s1);
        ?>


					<br>
					<div class="alert alert-info text-center mt-2 mr-2 ml-2 mb-2" role="alert">
                        <b>If you face any issues with Server A, switch to server B</b> 
                    </div>
					<br>
					
                        <div class="back-border">
                            <div class="row">
                                <center>
                                    <div class="day-5 days" style="display: block;">
                                        <div class="col-xs-9 col-sm-7 content-heading">
                                            <h3><span id="sp_title_1"></span>
                                                <?php echo $eventname ?>
                                            </h3>
                                        </div>

                                        <div id="relay">


                                            <div class="col-lg-12 col-md-12 col-xs-12 bottom-menu">

                                                <a class="btn btn-default btn-sm active_1" href="https://www.indorejamaat.org/sabaq/online_broadcast.php?server=a">Server A</a>
                                                <a class="btn btn-default btn-sm active_1" href="https://www.indorejamaat.org/sabaq/online_broadcast.php?server=b">Server B</a>
                                               <a class="btn btn-default btn-sm active_1" style="background-color:#c9302c;" href="logout_user.php">Logout</a>
 
                                                <br>
                                                <br>
                                                <div style="clear:both;"></div>

                                                <?php
                                                if (!isset($_GET['server']) || $_GET['server'] == "a") {
													echo $embed_code;
														
                                                ?>
											
  
  <br>
												
													<?php } else if ($_GET['server'] == "b") {
														echo $embed_code;
													
                                                ?>
												
												
  <br>
												
													  <?php
                                                } else if ($_GET['server'] == "c") {
                                                ?>
                                                          <?php
                                                } else if ($_GET['server'] == "d") {
                                                ?>
												
                                                          <?php
                                                }
                                                ?>
                                            </div>



                                            <div style="clear:both;"></div>
                                        </div>
                                    </div>
                                </center>
                            </div>
                        </div>
            <?php
                    }
                }
				else
				{ ?>
				
				  <div class="container-fluid mt-2">
                <div class="row">
                    <div class="alert alert-info text-center mt-2 mr-2 ml-2 mb-2" role="alert">
                        <a class="btn btn-default btn-sm active_1" style="background-color:#c9302c;" href="logout_user.php">Logout</a>

                    </div>
                </div>
            </div>
				<?php
					
				}
            }
        }
		else
		{ ?>
		
		<div class="container-fluid mt-2">
                <div class="row">
                    <div class="alert alert-info text-center mt-2 mr-2 ml-2 mb-2" role="alert">
                        <b>No Ongoing Events  </b><a class="btn btn-default btn-sm active_1" style="background-color:#c9302c;" href="logout_user.php">Logout</a>

                    </div>
                </div>
            </div>
		<?php
			
		}
       
        ?>
    </div>

    <div id="footer">

        <div id="site-footer" class="container-fluid">
            <div class="row">
                <div class="col-xs-12">
                    <p class="footer-text">© 2021 UMOOR DAKHILIYA (INDORE) - ALL RIGHTS RESERVED</p>
                </div>
				
				<div class="col-xs-12">
                    <p class="footer-text">Developed in Khidmat By  <a target="_blank" href="https://mail.google.com/mail/?view=cm&amp;fs=1&amp;to=naalwala12taher@gmail.com">Taher Bhai Naalwala</a></p>
      
       
       
                </div>
				
            </div>
        </div>
    </div>



    <script>
        $(document).bind("contextmenu", function(e) {
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
	<!-- Begin of Chaport Live Chat code -->
	<!--
<script type="text/javascript">
(function(w,d,v3){
w.chaportConfig = {
appId : '5eeb955a7d77f32895d0cd8b'
};

if(w.chaport)return;v3=w.chaport={};v3._q=[];v3._l={};v3.q=function(){v3._q.push(arguments)};v3.on=function(e,fn){if(!v3._l[e])v3._l[e]=[];v3._l[e].push(fn)};var s=d.createElement('script');s.type='text/javascript';s.async=true;s.src='https://app.chaport.com/javascripts/insert.js';var ss=d.getElementsByTagName('script')[0];ss.parentNode.insertBefore(s,ss)})(window, document);
</script>
-->
<!-- End of Chaport Live Chat code -->
</body>

</html>