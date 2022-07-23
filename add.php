<?php
ini_set('max_execution_time', 600);
session_start();
if (isset($_SESSION['its'])) {
    if ($_GET['name'] == "Access") {
        $forms_access = $_SESSION['forms_access'];
        $flag = 0;
        foreach ($forms_access as $formid) {
            if ($formid == "14" || $formid == "13") {
                $flag = 1;
            }
        }
        if ($flag == 0) {
            header('Location:main.php');
            exit();
        }
    }

    if ($_GET['name'] == "Event") {
        $forms_access = $_SESSION['forms_access'];
        $flag = 0;
        foreach ($forms_access as $formid) {
            if ($formid == "2" || $formid == "1") {
                $flag = 1;
            }
        }
        if ($flag == 0) {
            header('Location:main.php');
            exit();
        }
    }

    if ($_GET['name'] == "Member") {
        $forms_access = $_SESSION['forms_access'];
        $flag = 0;
        foreach ($forms_access as $formid) {
            if ($formid == "9" || $formid == "10") {
                $flag = 1;
            }
        }
        if ($flag == 0) {
            header('Location:main.php');
            exit();
        }
    }

    if ($_GET['name'] == "City") {
        $forms_access = $_SESSION['forms_access'];
        $flag = 0;
        foreach ($forms_access as $formid) {
            if ($formid == "18" || $formid == "17") {
                $flag = 1;
            }
        }
        if ($flag == 0) {
            header('Location:main.php');
            exit();
        }
    }

    if ($_GET['name'] == "Bulk Members") {
        $forms_access = $_SESSION['forms_access'];
        $flag = 0;
        foreach ($forms_access as $formid) {
            if ($formid == "30" || $formid == "9") {
                $flag = 1;
            }
        }
        if ($flag == 0) {
            header('Location:main.php');
            exit();
        }
    }
    if ($_GET['name'] == "Renew") {
        $forms_access = $_SESSION['forms_access'];
        $flag = 0;
        foreach ($forms_access as $formid) {
            if ($formid == "31" || $formid == "9") {
                $flag = 1;
            }
        }
        if ($flag == 0) {
            header('Location:main.php');
            exit();
        }
    }
} else {
    header("Location: login.php");
    die();
}


?>
<!DOCTYPE html>
<html lang="en">

<head>
    <style>
        .btn-block {
            background-color: #4e73df;
        }

        .btn {
            color: #fff;
        }

        @media (min-width: 600px) {
            .card {
                width: 50%;
            }
        }
    </style>

    <?php
    if ($_GET['name'] == "Access") { ?>
        <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
        <link rel="stylesheet" href="/resources/demos/style.css">
        <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
        <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <?php } else {
    ?>
        <script type="text/javascript" src="https://cdn.jsdelivr.net/jquery/latest/jquery.min.js"></script>
        <script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
        <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
        <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />
    <?php
    }
    ?>

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <script src="https://use.fontawesome.com/3582a84b00.js"></script>
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="css/sb-admin-2.min.css" rel="stylesheet">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add <?php echo $_GET['name'] ?></title>
    <script>
        $(function() {
            $(".datepicker").datepicker();
        });
    </script>
</head>

<body id="page-top">
    <div id="wrapper">
        <?php
        require('style.php');
		require('connectDB.php');
        ?>

        <div class="container-fluid">
            <!-- DataTales Example -->
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Add <?php echo $_GET['name']  ?></h6>
                </div>
                <div class="card-body">
                    <?php if ($_GET['name'] == "Access") { ?>

                        <form method="POST" enctype="multipart/form-data">

                            <div class="form-group"> <input type="text" class="form-control" placeholder="Enter Full Name" name="name" required>


                            </div>

                            <div class="form-group"> <input type="number" class="form-control" max="99999999" placeholder="Enter ITS" name="its" required>


                            </div>
                            <div class="form-group"> <input type="text" class="form-control" placeholder="Enter Password" name="pass" required>


                            </div>
                            <div class="form-group"> <input type="number" max="9999999999" class="form-control" placeholder="Enter Mobile Number" name="mobile" required>


                            </div>
                            <div class="form-group">
                                <label>From:</label>
                                <input type="text" placeholder="From Date" name="start_date" class="form-control datepicker">

                            </div>
                            <div class="form-group">
                                <label>To:</label>
                                <input type="text" placeholder="To Date" name="end_date" class="form-control datepicker">

                            </div>


                            <button name="addaccess" value="Add" class="btn btn-primary btn-block">Add</button>

                            <?php require('connectDB.php');

                            if (isset($_POST['addaccess'])) {
                                $powers = array("1", "7", "8", "9");
                                $name = $_POST['name'];
                                $its = $_POST['its'];
                                $mobile = $_POST['mobile'];
                                $pass = $_POST['pass'];
                                $adminid = $_SESSION['id'];
                                $s_date = $_POST['start_date'];
                                $e_date = $_POST['end_date'];

                                list($f_m, $f_d, $f_y) = explode('/', $s_date);
                                $f_first0 = $f_y . "-" . $f_m . "-" . $f_d;
                                $start_date = str_replace(' ', '', $f_first0);

                                list($e_m, $e_d, $e_y) = explode('/', $e_date);
                                $f_first1 = $e_y . "-" . $e_m . "-" . $e_d;
                                $end_date = str_replace(' ', '', $f_first1);


                                $sql = "SELECT * from web_login WHERE its='$its'";
                                $run = $conn->query($sql);
                                if ($run->num_rows > 0) {
                                    echo '<div class="alert alert-danger mt-2">
                            Account Already Exists
                            </div>';
                                } else {
                                    $s1 = "INSERT INTO web_login VALUES('$name','$its','$pass','$mobile',$adminid,'$start_date','$end_date',0)";
                                    if (mysqli_query($conn, $s1)) {
                                        $s2 = "SELECT * from web_login WHERE its='$its'";
                                        $run1 = $conn->query($s2);
                                        $row = $run1->fetch_assoc();
                                        $id = $row['id'];


                                        foreach ($powers as $formid) {
                                            $s3 = "INSERT INTO access_web_login VALUES($id,$formid)";
                                            if (mysqli_query($conn, $s3)) {
                                                $flag = 1;
                                            } else {
                                                $flag = 0;
                                            }
                                        }
                                        if ($flag == 1) {
                                            echo '<div class="alert alert-success mt-2">
                                    Access Granted
                                    </div>';
                                        } else {
                                            echo '<div class="alert alert-danger mt-2">
                                    Fail
                                    </div>';
                                        }
                                    } else {
                                        echo '<div class="alert alert-danger mt-2">
                                        Fail

                                        </div>';
                                    }
                                }
                            }
                            echo '</form>';
                        } else if ($_GET['name'] == "Event") { ?>
                            <form method="POST" enctype="multipart/form-data">
                                <div class="form-group"><label>Event Name</label> <input type="text" class="form-control" placeholder="Enter Event Name" name="event_name" required>


                                </div>
                                <div class="form-group"><label>Event Date:</label> <input type="text" style="height: calc(1.5em + .75rem + 2px);" class="form-control" name="daterange" required></div>
                                <label>Start Time</label>
                                <div class="row">
                                    <div class="col-lg-4">
                                        <input name="start_hour" class="form-control" placeholder="Hour" required>


                                    </div>
                                    <div class="col-lg-4">
                                        <input name="start_min" class="form-control" placeholder="Minutes" required>

                                    </div>
                                    <div class="col-lg-4">
                                        <select class="form-control" name="start_type">
                                            <option value="AM">AM</option>
                                            <option value="PM">PM</option>
                                        </select>
                                    </div>
                                </div>

                                <label>End Time</label>
                                <div class="row">
                                    <div class="col-lg-4">
                                        <input name="end_hour" class="form-control" placeholder="Hour" required>


                                    </div>
                                    <div class="col-lg-4">
                                        <input name="end_min" class="form-control" placeholder="Minutes" required>

                                    </div>
                                    <div class="col-lg-4">
                                        <select class="form-control" name="end_type">
                                            <option value="AM">AM</option>
                                            <option value="PM">PM</option>
                                        </select>
                                    </div>
                                </div>



                                <div class="form-group"><label>Embed Code</label> <textarea type="text" class="form-control" placeholder="Paste Embed Code (Optional)" name="embed_code"></textarea>
                                </div>
                                <button name="addevent" value="Add" class="btn btn-primary btn-block">Add</button>
                                <?php 
                                if (isset($_POST['addevent'])) {
                                    $embed_code = $_POST['embed_code'];

                                    if (empty($embed_code)) {
                                        $embed_code = "";
                                    }
                                    $start_hour = $_POST['start_hour'];
                                    $start_min = $_POST['start_min'];
                                    $start_type = $_POST['start_type'];
                                    $end_hour = $_POST['end_hour'];
                                    $end_min = $_POST['end_min'];
                                    $end_type = $_POST['end_type'];

                                    if ($start_type == "AM") {

                                        if ($start_hour == 12) {
                                            $start_time = ($start_min / 60);
                                        } else {
                                            $start_time = ($start_hour) + ($start_min / 60);
                                        }
                                    } else {
                                        if ($start_hour == 12) {
                                            $start_time = ($start_hour) + ($start_min / 60);
                                        } else {
                                            $start_time = ($start_hour + 12) + ($start_min / 60);
                                        }
                                    }


                                    if ($end_type == "AM") {

                                        if ($end_hour == 12) {
                                            $end_time = ($end_min / 60);
                                        } else {
                                            $end_time = ($end_hour) + ($end_min / 60);
                                        }
                                    } else {
                                        if ($end_hour == 12) {
                                            $end_time = ($end_hour) + ($end_min / 60);
                                        } else {
                                            $end_time = ($end_hour + 12) + ($end_min / 60);
                                        }
                                    }




                                  $adminid = $_SESSION['id'];

                                 $event_name = $_POST['event_name'];
                                    $range = $_POST['daterange'];
                                    list($first, $second) = explode('-', $range);

                                    list($f_m, $f_d, $f_y) = explode('/', $first);
                                    $f_first0 = $f_y . "-" . $f_m . "-" . $f_d;
                                 $f_first = str_replace(' ', '', $f_first0);

                                    list($s_m, $s_d, $s_y) = explode('/', $second);
                                    $f_second0 = $s_y . "-" . $s_m . "-" . $s_d;
                                   $f_second = str_replace(' ', '', $f_second0);
                                 
                                        $sql = "INSERT INTO event_info (`name`,embed_code,start_date,end_date,adminid,start_time,end_time) VALUES('$event_name','$embed_code','$f_first','$f_second',$adminid,'$start_time','$end_time')";
                                      
                                        if (mysqli_query($conn, $sql)) {



                                            echo '<div class="alert alert-success mt-2">
                            Event Added
                            </div>';
                                        } else {
                                            echo '<div class="alert alert-danger mt-2">
                            Fail
                            </div>';
                                        }
                                    
                                }

                                ?>
                            </form>
                        <?php    } else if ($_GET['name'] == "Member") { ?>
                            <form method="POST">


                                <div id="event">
                                    <div class="form-group">
                                        <label>Event</label> <select name="event_id" class="form-control" required>
                                            <option value=''>Select Event</option>
                                            <?php require('connectDB.php');
                                            $adminid = $_SESSION['id'];
                                            $date = date('Y-m-d');
                                            $sql = "SELECT * from event_info WHERE adminid=$adminid AND (('$date' BETWEEN start_date AND end_date) OR '$date'<start_date )";
                                            $run = $conn->query($sql);
                                            if ($run->num_rows > 0) {
                                                while ($row = $run->fetch_assoc()) {
                                                    $event_id = $row['id'];
                                                    $event_name = $row['name'];
                                            ?>
                                                    <option value='<?php echo $event_id ?>'><?php echo $event_name ?></option>
                                            <?php
                                                }
                                            }
                                            ?>
                                        </select>
                                    </div>

                                </div>
                                <div class="form-group"><label>Info</label> <input type="number" max="99999999" class="form-control" placeholder="Enter Your ITS" name="its" required>
                                </div>
                                <div class="form-group"><input type="text" class="form-control" placeholder="Enter Your Full Name" name="name" required>
                                </div>
                                <div class="form-group"><input type="number" class="form-control" max="9999999999" placeholder="Enter Your Mobile Number" name="mobile" required>
                                </div>
                                <div class="form-group"><textarea type="text" class="form-control" placeholder="Enter Reason" name="reason" required></textarea>
                                </div>

                                <button name="addmember" value="Add" class="btn btn-primary btn-block">Submit</button>

                                <?php
                                if (isset($_POST['addmember'])) {
                                    $its = $_POST['its'];
                                    $mobile = $_POST['mobile'];
                                    if (strlen($its) == 8 && strlen($mobile) == 10) {
                                        $eventid = $_POST['event_id'];
                                        $name = $_POST['name'];

                                        $reason = $_POST['reason'];
                                        $sql = "SELECT * from reg_form WHERE its='$its' AND event_id=$eventid";
                                        $run = $conn->query($sql);
                                        if ($run->num_rows > 0) {
                                            $row = $run->fetch_assoc();
                                            $status = $row['status'];
                                            if ($status == 0) {
                                                echo '<div class="alert alert-danger mt-2">
                                                    Registration Cancelled By Admin
                                                 </div>';
                                            } else if ($status == 1) {
                                                echo '<div class="alert alert-danger mt-2">
                                                    Registration already in Process
                                                    </div>';
                                            } else {
                                                echo '<div class="alert alert-success mt-2">
                                                    Already Registered
                                                 </div>';
                                            }
                                        } else {
                                            $s1 = "INSERT INTO reg_form (its,name,mobile,cityid,mohallaid,reason,event_id,status,date,time) VALUES ('$its','$name','$mobile',0,0,'$reason',$eventid,2,'','')";
                                            if (mysqli_query($conn, $s1)) {
                                                echo '<div class="alert alert-success mt-2">
                                                    Member Added
                                                 </div>';
                                            } else {
                                                echo '<div class="alert alert-danger mt-2">
                                                    Fail
                                                </div>';
                                            }
                                        }
                                    } else {
                                        if (strlen($its) != 8) {
                                            echo '<div class="alert alert-danger mt-2">
                                                Invalid ITS
                                            </div>';
                                        }
                                        if (strlen($mobile) != 10) {
                                            echo '<div class="alert alert-danger mt-2">
                                                Invalid Mobile Number
                                            </div>';
                                        }
                                    }
                                }


                                ?>

                            </form>

                        <?php   } else if ($_GET['name'] == "City") { ?>
                            <form method="POST">
                                <div class="row">
                                    <div class="col-lg-6 col-md-6">
                                        <div class="form-group">
                                            <input name="city" type="text" class="form-control" placeholder="Enter City Name" required>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-6">
                                        <button name="addcity" value="add" class=" btn  btn-primary ">Add</button>
                                    </div>
                                </div>
                                <?php require('connectDB.php');
                                if (isset($_POST['addcity'])) {
                                    $city = $_POST['city'];
                                    $sql = "SELECT * from city WHERE name='$city'";
                                    $run = $conn->query($sql);
                                    if ($run->num_rows > 0) {
                                        echo '<div class="alert alert-danger mt-2">
                                City Already Exists
                                </div>';
                                    } else {
                                        $s1 = "INSERT INTO city VALUES ('$city')";
                                        if (mysqli_query($conn, $s1)) {
                                            echo '<div class="alert alert-success mt-2">
                                            City Added
                                        </div>';
                                        } else {
                                            echo '<div class="alert alert-danger mt-2">
                                             Fail
                                        </div>';
                                        }
                                    }
                                }
                                ?>
                            </form>
                        <?php      } else if ($_GET['name'] == "Mohalla") {
                        ?>
                            <form method="POST">
                                <div class=" form-group"><label>City</label> <select class="form-control" name="cityid" required>
                                        <option value=''>Select City</option>
                                        <?php require('connectDB.php');
                                        $sql1 = "SELECT * FROM city";
                                        $results = $conn->query($sql1);
                                        while ($rs = $results->fetch_assoc()) {
                                            $cityid = $rs['id'];

                                            $cityname = $rs['name'];
                                        ?>
                                            <option value="<?php echo $cityid ?>"><?php echo $cityname; ?></option>
                                        <?php
                                        }
                                        ?>
                                    </select>


                                </div>

                                <div class="form-group">
                                    <label>Mohalla</label>
                                    <input type="text" class="form-control" placeholder="Enter Mohalla Name" name="mohalla" required>
                                </div>

                                <button name="addmohalla" value="Add" class="btn btn-primary btn-block">Add</button>

                                <?php require('connectDB.php');
                                if (isset($_POST['addmohalla'])) {
                                    $mohallaname = $_POST['mohalla'];
                                    $cityid = $_POST['cityid'];
                                    $sql = "SELECT * from mohalla WHERE name='$mohallaname' AND cityid=$cityid";
                                    $run = $conn->query($sql);
                                    if ($run->num_rows > 0) {

                                        echo '<div class="alert alert-danger mt-2">
                                Mohalla Already Exists
                                </div>';
                                    } else {
                                        $s1 = "INSERT INTO mohalla VALUES ('$mohallaname',$cityid)";
                                        if (mysqli_query($conn, $s1)) {
                                            $s2 = "SELECT * from mohalla WHERE name='$mohallaname' AND cityid=$cityid";
                                            $run2 = $conn->query($s2);
                                            $row2 = $run2->fetch_assoc();
                                            $mohallaid = $row2['id'];
                                            $s3 = "INSERT INTO mohalla_admin VALUES($mohallaid,1,$cityid)";
                                            if (mysqli_query($conn, $s3)) {
                                                echo '<div class="alert alert-success mt-2">
                                            Mohalla Added
                                            
                                        </div>';
                                            } else {
                                                echo '<div class="alert alert-danger mt-2">
                                             Fail
                                        </div>';
                                            }
                                        }
                                    }
                                }

                                ?>

                            </form>
                        <?php  } else if ($_GET['name'] == "Bulk Members") {
                        ?>
                            <style>
                                .card {
                                    width: 100%;
                                }
                            </style>
                            <form method="post" enctype="multipart/form-data">

                                <div class="row">
                                    <div class="col-lg-4">



                                        <select name="event_id" class="form-control" required>
                                            <option value=''>Select Event</option>
                                            <?php require('connectDB.php');
                                            $adminid = $_SESSION['id'];
                                            $sql = "SELECT * from event_info WHERE adminid=$adminid AND (('$date' BETWEEN start_date AND end_date) OR '$date'<start_date )";

                                            $run = $conn->query($sql);
                                            if ($run->num_rows > 0) {
                                                while ($row = $run->fetch_assoc()) {
                                                    $event_id = $row['id'];
                                                    $event_name = $row['name'];
                                            ?>
                                                    <option value='<?php echo $event_id ?>'><?php echo $event_name ?></option>
                                            <?php
                                                }
                                            }
                                            ?>
                                        </select>
                                    </div>
                                    <div class="col-lg-4"> <input class="form-control" type="file" name="file" required /></div>

                                    <div class="col-lg-4"> <input type="submit" name="submit" value="Submit" class="btn btn-primary" /></div>

                                </div>
                                <?php require('connectDB.php');
                                if (isset($_POST["submit"])) {
                                    $event_id = $_POST['event_id'];
                                    if ($_FILES['file']['name']) {
                                        $filename = explode(".", $_FILES['file']['name']);
                                        if ($filename[1] == 'csv') {
                                            $handle = fopen($_FILES['file']['tmp_name'], "r");
                                            while ($data = fgetcsv($handle)) {
                                                $its = mysqli_real_escape_string($conn, $data[0]);
                                                $name = mysqli_real_escape_string($conn, $data[1]);

                                                $mobile = mysqli_real_escape_string($conn, $data[2]);
                                                $reason = mysqli_real_escape_string($conn, $data[3]);
                                                if (strlen($its) == 8) {
                                                    $sql = "SELECT * from reg_form WHERE its='$its' AND event_id=$event_id";
                                                    $run = $conn->query($sql);
                                                    if ($run->num_rows > 0) {
                                                    } else {

                                                        $sql = "INSERT INTO reg_form VALUES('$its','$name','$mobile','','','$reason',$event_id,2,'','')";
                                                        mysqli_query($conn, $sql);
                                                    }
                                                }
                                            }
                                            echo '<div class="alert alert-success mt-2">
                                            File Uploaded Successfully!! Check Report to Confirm..
                                            
                                        </div>';
                                        } else {

                                            echo '<div class="alert alert-danger mt-2">
                                            Not a CSV.. Upload a CSV File Only
                                            
                                        </div>';
                                        }
                                    }
                                }

                                ?>
                            </form>
                            <br>
                            <h4>Remeber:</h4>

                            <p>Only Upload CSV File</p>

                            <p>CSV File should contain FOUR COLUMNS in this order only(<b>ITS,NAME,MOBILE,REASON</b>)</p>
                            <p>See a Demo File: <a href="bulk add members.csv">Demo File</a></p>
                        <?php   } else if ($_GET['name'] == "Renew") {

                        ?>

                            <form method="POST">



                                <div class="form-group"> <input type="number" class="form-control" max="99999999" placeholder="Enter ITS" name="its" required>


                                </div>




                                <button name="renew" value="Add" class="btn btn-primary btn-block">Add</button>

                                <?php require('connectDB.php');

                                if (isset($_POST['renew'])) {
                                    $its = $_POST['its'];
                                    $s1 = "UPDATE reg_form SET time='',date='' WHERE its='$its' AND status=2";
                                    if (mysqli_query($conn, $s1)) {
                                        echo '<div class="alert alert-success mt-2">
                                       Success
                                        
                                    </div>';
                                    } else {
                                        echo '<div class="alert alert-danger mt-2">
                                       Fail
                                    </div>';
                                    }
                                }


                                ?>
                            </form>
                        <?php

                        }
                        ?>




                        </form>
                </div>

            </div>

        </div>


    </div>



    </div>
    </div>
    <script>
        $(function() {
            $('input[name="daterange"]').daterangepicker({
                opens: 'left'
            }, function(start, end, label) {
                console.log("A new date selection was made: " + start.format('YYYY-MM-DD') + ' to ' + end.format('YYYY-MM-DD'));
            });
        });
    </script>

    <script>
        $(document).ready(function() {

            $('input[type=number][max]:not([max=""])').on('input', function(ev) {
                var $this = $(this);
                var maxlength = $this.attr('max').length;
                var value = $this.val();
                if (value && value.length >= maxlength) {
                    $this.val(value.substr(0, maxlength));
                }
            });

        });
    </script>
    <!-- Custom scripts for all pages-->
    <script src="js/sb-admin-2.min.js"></script>
    <script src="select.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js" integrity="sha384-wHAiFfRlMFy6i5SRaxvfOCifBUQy1xHdJ/yoi7FRNXMRBu5WHdZYu1hA6ZOblgut" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>

</body>

</html>