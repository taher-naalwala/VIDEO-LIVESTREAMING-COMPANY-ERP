<?php
session_start();
if (isset($_SESSION['its'])) {
    $adminid = $_SESSION['id'];
    if ($_GET['name'] == "Access") {
        $forms_access = $_SESSION['forms_access'];
        $flag = 0;
        foreach ($forms_access as $formid) {
            if ($formid == "15" || $formid == "13") {
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
            if ($formid == "11" || $formid == "9") {
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
            if ($formid == "3" || $formid == "1") {
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
    <?php
    if ($_GET['name'] == "Access") { ?>
        <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
        <link rel="stylesheet" href="/resources/demos/style.css">
        <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
        <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <?php } else { ?>
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
    <title>Edit <?php echo $_GET['name'] ?></title>
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
        ?>



        <div class="container-fluid">
            <!-- DataTales Example -->
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Edit <?php echo $_GET['name'] ?></h6>
                </div>
                <div class="card-body">

                    <?php if ($_GET['name'] == "Access") { ?>

                        <form method="POST">

                            <div class="row">
                                <div class="col-lg-6 col-md-6">
                                    <div class="form-group"> <select class="form-control" name="adminid">
                                            <option value=''>Select Admin</option>
                                            <?php require('connectDB.php');
                                            $sql = "SELECT * from web_login";
                                            $run = $conn->query($sql);
                                            while ($row = $run->fetch_assoc()) {
                                                $id = $row['id'];
                                                $name = $row['name'];
                                            ?>
                                                <option value="<?php echo $id; ?>"><?php echo $name; ?></option>

                                            <?php   }


                                            ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-6">
                                    <button name="editaccess" value="Add" class=" btn  btn-primary ">Open</button>
                                </div>
                            </div>
                            <?php
                            if (isset($_POST['editaccess'])) {
                                $adminid = $_POST['adminid'];
                                $sql = "SELECT * from web_login WHERE id=$adminid";
                                $run = $conn->query($sql);
                                $row = $run->fetch_assoc();
                                $name = $row['name'];
                                $pass = $row['password'];
                                $its = $row['its'];
                                $mobile = $row['mobile'];
                                $s_date = $row['start_date'];
                                $e_date = $row['end_date'];

                                list($f_y, $f_m, $f_d) = explode('-', $s_date);
                                $f_first0 = $f_m . "/" . $f_d . "/" . $f_y;
                                $start_date = str_replace(' ', '', $f_first0);

                                list($e_y, $e_m, $e_d) = explode('-', $e_date);
                                $f_first1 = $e_m . "/" . $e_d . "/" . $e_y;
                                $end_date = str_replace(' ', '', $f_first1);


                            ?>
                                <div class="form-group">
                                    <label>Name</label>
                                    <input type="text" class="form-control" value="<?php echo $name ?>" name="name" required>
                                </div>
                                <input type="hidden" class="form-control" value="<?php echo $adminid ?>" name="adminid" required>
                                <input type="hidden" class="form-control" value="<?php echo $its ?>" name="its" required>
                                <div class="form-group">
                                    <label>Mobile Number</label> <input type="number" max="9999999999" class="form-control" value="<?php echo $mobile ?>" name="mobile" required>
                                </div>

                                <div class="form-group">
                                    <label>Password</label> <input type="text" class="form-control" value="<?php echo $pass ?>" name="pass" required>
                                </div>

                                <div class="form-group">
                                    <label>From:</label>
                                    <input type="text" placeholder="From Date" value='<?php echo $start_date ?>' name="start_date" class="form-control datepicker">

                                </div>
                                <div class="form-group">
                                    <label>To:</label>
                                    <input type="text" value='<?php echo $end_date ?>' placeholder="To Date" name="end_date" class="form-control datepicker">

                                </div>


                                <button name="finaledit" value="Add" class=" btn  btn-block ">Submit</button>


                            <?php
                            }
                            if (isset($_POST['finaledit'])) {

                                $name = $_POST['name'];
                                $pass = $_POST['pass'];
                                $its = $_POST['its'];
                                $mobile = $_POST['mobile'];
                                $s_date = $_POST['start_date'];
                                $e_date = $_POST['end_date'];

                                list($f_m, $f_d, $f_y) = explode('/', $s_date);
                                $f_first0 = $f_y . "-" . $f_m . "-" . $f_d;
                                $start_date = str_replace(' ', '', $f_first0);

                                list($e_m, $e_d, $e_y) = explode('/', $e_date);
                                $f_first1 = $e_y . "-" . $e_m . "-" . $e_d;
                                $end_date = str_replace(' ', '', $f_first1);


                                $adminid = $_POST['adminid'];
                                $sql = "UPDATE web_login SET name='$name',password='$pass',mobile='$mobile',start_date='$start_date',end_date='$end_date'  WHERE its='$its'";
                                if (mysqli_query($conn, $sql)) {


                                    echo '<div class="alert alert-success mt-2">
                                            Access Editted
                                            </div>';
                                } else {
                                    echo '<div class="alert alert-danger mt-2">
                                            Fail
                                            </div>';
                                }
                            }
                        } else if ($_GET['name'] == "Member") { ?>
                            <form method="POST">
                                <div class="row">
                                    <div class="col-lg-6 col-md-6">
                                        <div class="form-group">
                                            <input class="form-control" type="number" max="99999999" name="its" placeholder="Enter ITS">
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-6">
                                        <button name="open_edit" value="open" class=" btn  btn-primary ">Open</button>
                                    </div>
                                </div>
                                <?php require('connectDB.php');

                                if (isset($_POST['open_edit'])) {
                                    $date = date('Y-m-d');
                                    $its = $_POST['its'];
                                    $sql = "SELECT * from reg_form WHERE its='$its'";
                                    $run = $conn->query($sql);
                                    if ($run->num_rows > 0) {
                                        $sql1 = "SELECT * from reg_form WHERE its='$its' AND (status=0 OR status=2)";
                                        $run1 = $conn->query($sql1);
                                        $row1 = $run1->fetch_assoc();
                                        $name = $row1['name'];
                                        $mobile = $row1['mobile']; ?>
                                        <input type="hidden" name="its" value='<?php echo $its ?>'>
                                        <div class="form-group"> <label>Info</label> <input name="name" class="form-control" value='<?php echo $name ?>' required></div>
                                        <div class="form-group">
                                            <input name="mobile" type="number" max="9999999999" class="form-control" value='<?php echo $mobile ?>' required></div>


                                    <?php
                                        $o_event_id = array();

                                        echo "<select class='form-control' name='event_id[]'  multiple>";


                                        while ($row1 = $run->fetch_assoc()) {
                                            echo  $eventid = $row1['event_id'];
                                            $s1 = "SELECT * from event_info WHERE adminid=$adminid AND id=$eventid AND (start_date>='$date' OR (start_date<='$date' AND end_date>='$date'))";
                                            $run2 = $conn->query($s1);
                                            if ($run2->num_rows > 0) {

                                                $row3 = $run2->fetch_assoc();
                                                $id = $row3['id'];
                                                array_push($o_event_id, $id);
                                                $eventname = $row3['name'];
                                                echo "<option value='$id' >";
                                                echo $eventname;
                                                echo "</option>";
                                            }
                                        }
                                        echo "</select><br>";
                                    } else {
                                        echo '<div class="alert alert-danger mt-2">
                                    No Record Found
                                    </div>';
                                    }

                                    ?>
                                    <input type='hidden' name='o_event_id' value="<?php echo htmlentities(serialize($o_event_id)); ?>" />

                                    <button name="m" value="edit" class=" btn  btn-block ">Edit</button>
                                <?php
                                }
                                if (isset($_POST['m'])) {
                                    $name = $_POST['name'];
                                    $its = $_POST['its'];
                                    $o_event_id = unserialize($_POST['o_event_id']);
                                    $mobile = $_POST['mobile'];
                                    $event_id = $_POST['event_id'];
                                    if (empty($event_id)) {
                                        $sql = "UPDATE reg_form SET name='$name',mobile='$mobile',status=0 WHERE its='$its'";
                                        if (mysqli_query($conn, $sql)) {
                                            echo '<div class="alert alert-success mt-2">
                                             Member Updated
                                            </div>';
                                        } else {
                                            echo '<div class="alert alert-danger mt-2">
                                            Fail
                                            </div>';
                                        }
                                    } else {
                                        $flag = 0;
                                        $f = 0;

                                        foreach ($o_event_id as $o_event) {
                                            foreach ($event_id as $event) {
                                                if ($o_event == $event) {
                                                    $flag = 1;
                                                    break;
                                                } else {
                                                    $flag = 0;
                                                }
                                            }
                                            if ($flag == 0) {
                                                $sql = "UPDATE reg_form SET name='$name',mobile='$mobile',status=0 WHERE its='$its' AND event_id=$o_event";
                                                if (mysqli_query($conn, $sql)) {
                                                    $f = 1;
                                                } else {
                                                    $f = 0;
                                                }
                                            } else {
                                                $sql = "UPDATE reg_form SET name='$name',mobile='$mobile',status=2 WHERE its='$its' AND event_id=$o_event";
                                                if (mysqli_query($conn, $sql)) {
                                                    $f = 1;
                                                } else {
                                                    $f = 0;
                                                }
                                            }
                                        }
                                        if ($f == 1) {

                                            echo '<div class="alert alert-success mt-2">
                                             Member Updated
                                            </div>';
                                        } else {
                                            echo '<div class="alert alert-danger mt-2">
                                            Fail
                                            </div>';
                                        }
                                    }
                                }


                                ?>

                                <?php


                                ?>
                            </form>

                        <?php     }

                        if ($_GET['name'] == "Event") {

                            date_default_timezone_set("Asia/Kolkata");
                            $date = date('Y-m-d');
                        ?>

                            <form method="POST">

                                <div class="row">
                                    <div class="col-lg-6 col-md-6">
                                        <div class="form-group"> <select class="form-control" name="eventid">
                                                <option value=''>Select Event</option>
                                                <?php require('connectDB.php');

                                                $adminid = $_SESSION['id'];
                                                $sql = "SELECT * from event_info WHERE adminid=$adminid AND end_date>='$date'";
                                                $run = $conn->query($sql);
                                                while ($row = $run->fetch_assoc()) {
                                                    $id = $row['id'];
                                                    $name = $row['name'];
                                                ?>
                                                    <option value="<?php echo $id; ?>"><?php echo $name; ?></option>

                                                <?php   }


                                                ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-6">
                                        <button name="editevent" value="Add" class=" btn  btn-primary ">Open</button>
                                    </div>
                                </div>
                                <?php require('connectDB.php');
                                if (isset($_POST['editevent'])) {
                                    $eventid = $_POST['eventid'];
                                    $sql = "SELECT * from event_info WHERE id=$eventid";
                                    $run = $conn->query($sql);
                                    $row = $run->fetch_assoc();
                                    $eventname = $row['name'];
                                    $start_time = $row['start_time'];
                                    $end_time = $row['end_time'];
                                    if ($start_time >= 12 && $start_time < 13) {
                                        $start_whole = "12";
                                        $start_fraction = floor(($start_time - $start_whole) * 60);
                                        $start_type = "PM";
                                    } else if ($start_time >= 0 && $start_time < 1) {
                                        $start_whole = "12";
                                        $start_fraction = floor(($start_time) * 60);
                                        $start_type = "AM";
                                    } else if ($start_time < 12) {
                                        $start_whole = floor($start_time);
                                        $start_fraction = floor(($start_time - $start_whole) * 60);
                                        $start_type = "AM";
                                    } else  if ($start_time > 12) {
                                        $start_whole = floor($start_time) - 12;
                                        $start_fraction = floor(($start_time - ($start_whole + 12)) * 60);
                                        $start_type = "PM";
                                    }


                                    if ($end_time >= 12 && $end_time < 13) {
                                        $end_whole = "12";
                                        $end_fraction = floor(($end_time - $end_whole) * 60);
                                        $end_type = "PM";
                                    } else if ($end_time >= 0 && $end_time < 1) {
                                        $end_whole = "12";
                                        $end_fraction = floor(($end_time) * 60);
                                        $end_type = "AM";
                                    } else if ($end_time < 12) {
                                        $end_whole = floor($end_time);
                                        $end_fraction = floor(($end_time - $end_whole) * 60);
                                        $end_type = "AM";
                                    } else  if ($end_time > 12) {
                                        $end_whole = floor($end_time) - 12;
                                        $end_fraction = floor(($end_time - ($end_whole + 12)) * 60);
                                        $end_type = "PM";
                                    }

                                    $embed_code = $row['embed_code'];
                                    $start_date = $row['start_date'];
                                    list($s_y, $s_m, $s_d) = explode('-', $start_date);
                                    $f_start_date = $s_m . "/" . $s_d . "/" . $s_y;

                                    $end_date = $row['end_date'];
                                    list($e_y, $e_m, $e_d) = explode('-', $end_date);
                                    $f_end_date = $e_m . "/" . $e_d . "/" . $e_y;

                                ?>
                                    <div class="form-group"><label>Event Name</label> <input type="text" class="form-control" value="<?php echo $eventname ?>" name="event_name" required>
                                    </div>
                                    <input type="hidden" class="form-control" value="<?php echo $eventid ?>" name="event_id" required>


                                    <div class="form-group"><label>Event Date:</label> <input class="form-control" type="text" style="height: calc(1.5em + .75rem + 2px);" name="daterange" value="<?php echo $f_start_date . " - " . $f_end_date ?>" required></div>
                                    <label>Start Time</label>
                                    <div class="row">
                                        <div class="col-lg-4">
                                            <input name="start_hour" value='<?php echo $start_whole ?>' class="form-control" placeholder="Hour" required>


                                        </div>
                                        <div class="col-lg-4">
                                            <input name="start_min" class="form-control" value='<?php echo $start_fraction ?>' placeholder="Minutes" required>

                                        </div>
                                        <div class="col-lg-4">
                                            <select class="form-control" name="start_type" required>
                                                <option value='<?php echo $start_type ?>'><?php echo $start_type ?></option>
                                                <option>---</option>
                                                <option value="AM">AM</option>
                                                <option value="PM">PM</option>
                                            </select>
                                        </div>
                                    </div>

                                    <label>End Time</label>
                                    <div class="row">
                                        <div class="col-lg-4">
                                            <input name="end_hour" class="form-control" value='<?php echo $end_whole ?>' placeholder="Hour" required>


                                        </div>
                                        <div class="col-lg-4">
                                            <input name="end_min" class="form-control" value='<?php echo $end_fraction ?>' placeholder="Minutes" required>

                                        </div>
                                        <div class="col-lg-4">
                                            <select class="form-control" name="end_type" required>
                                                <option value='<?php echo $end_type ?>'><?php echo $end_type ?></option>
                                                <option>---</option>
                                                <option value="AM">AM</option>
                                                <option value="PM">PM</option>
                                            </select>
                                        </div>
                                    </div>




                                    <div class="form-group"><label>Embed Code</label> <textarea type="text" class="form-control" name="embed_code"><?php echo $embed_code  ?></textarea>
                                    </div>

                                    <button name="final_editevent" value="edit" class=" btn  btn-block ">Edit</button>



                            </form>
                        <?php      }
                                if (isset($_POST['final_editevent'])) {
                                    $eventid = $_POST['event_id'];
                                    $embed_code = $_POST['embed_code'];
                                    if (empty($embed_code)) {
                                        $embed_code = "";
                                    }
                                    $event_name = $_POST['event_name'];
                                    $range = $_POST['daterange'];
                                    list($first, $second) = explode('-', $range);

                                    list($f_m, $f_d, $f_y) = explode('/', $first);
                                    $f_first0 = $f_y . "-" . $f_m . "-" . $f_d;
                                    $f_first = str_replace(' ', '', $f_first0);

                                    list($s_m, $s_d, $s_y) = explode('/', $second);
                                    $f_second0 = $s_y . "-" . $s_m . "-" . $s_d;
                                    $f_second = str_replace(' ', '', $f_second0);
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



                                    $sql = "UPDATE event_info SET name='$event_name',embed_code='$embed_code',start_date='$f_first',end_date='$f_second',start_time='$start_time',end_time='$end_time' WHERE id=$eventid";
                                    if (mysqli_query($conn, $sql)) {
                                        $s1 = "DELETE FROM event_mohalla WHERE eventid=$eventid";
                                        if (mysqli_query($conn, $s1)) {

                                            echo '<div class="alert alert-success mt-2">
                                    Event Updated
                                   </div>';
                                        } else {
                                            echo '<div class="alert alert-danger mt-2">
                                    Fail
                                   </div>';
                                        }
                                    }
                                }
                            }

                            if ($_GET['name'] == "City") { ?>
                        <form method="POST">
                            <div class="row">
                                <div class="col-lg-6 col-md-6">
                                    <div class=" form-group"><select class="form-control" name="cityid">
                                            <option value=''>Select City</option>
                                            <?php require('connectDB.php');
                                            $sql1 = "SELECT * FROM city";
                                            $results = $conn->query($sql1);
                                            while ($rs = $results->fetch_assoc()) {
                                                $cityid = $rs['id'];

                                                $cityname = $rs['name'];
                                            ?>
                                                <option value="<?php echo $cityname ?>"><?php echo $cityname; ?></option>
                                            <?php
                                            }
                                            ?>
                                        </select>


                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-6">
                                    <button name="editcity" value="edit" class=" btn  btn-primary ">Open</button>
                                </div>
                            </div>
                            <?php require('connectDB.php');
                                if (isset($_POST['editcity'])) {
                                    $cityname = $_POST['cityid'];
                            ?>

                                <div class="form-group">
                                    <input type="hidden" class="form-control" value='<?php echo $cityname ?>' name="city_id" required>
                                    <label>City Name</label>
                                    <input type="text" class="form-control" value='<?php echo $cityname ?>' name="city_name" required>
                                </div>
                                <button name="f_editcity" value="edit" class=" btn  btn-primary ">Submit</button>
                            <?php  }
                                if (isset($_POST['f_editcity'])) {
                                    $cityid = $_POST['city_id'];
                                    $cityname = $_POST['city_name'];
                                    $sql = "UPDATE city SET name='$cityname' WHERE name='$cityid'";
                                    if (mysqli_query($conn, $sql)) {
                                        echo '<div class="alert alert-success mt-2">
                                City Edited
                            </div>';
                                    } else {
                                        echo '<div class="alert alert-danger mt-2">
                                Fail
                           </div>';
                                    }
                                }

                            ?>
                        </form>

                    <?php       }

                            if ($_GET['name'] == "Mohalla") {

                    ?>
                        <form method="POST">
                            <div class="row">
                                <div class="col-lg-4 col-md-4">
                                    <div class=" form-group"><select class="form-control" name="cityid" id="citydd" onChange="change_city_edit()">
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
                                </div>
                                <div class="col-lg-4 col-md-4">
                                    <div id="mohalla">
                                        <select class="form-control" required>
                                            <option value="">Select Mohalla</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-4 col-md-4">
                                    <button name="editmohalla" value="edit" class=" btn  btn-primary ">Open</button>
                                </div>
                            </div>
                        </form>

                        <?php require('connectDB.php');

                                if (isset($_POST['editmohalla'])) {
                                    $mohalla_id = $_POST['mohalla_id'];
                                    $sql = "SELECT * from mohalla WHERE id=$mohalla_id";
                                    $run = $conn->query($sql);
                                    $row = $run->fetch_assoc();
                                    $mohalla_name = $row['name']; ?>
                            <form method="POST">
                                <input type="hidden" class="form-control" name="mohallaid" value='<?php echo $mohalla_id ?>' />
                                <div class="form-group"> <input type="text" class="form-control" name="newmohallaname" value='<?php echo $mohalla_name ?>' /></div>
                                <button name="f_editmohalla" value="edit" class=" btn  btn-block ">Submit</button>


                            </form>
                    <?php
                                }

                                if (isset($_POST['f_editmohalla'])) {
                                    $new_mohalla_name = $_POST['newmohallaname'];
                                    $mohalla_id = $_POST['mohallaid'];
                                    $sql = "UPDATE mohalla SET name='$new_mohalla_name' WHERE id=$mohalla_id";
                                    if (mysqli_query($conn, $sql)) {
                                        echo '<div class="alert alert-success mt-2">
                                    Mohalla Edited
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
                </div>

            </div>

        </div>




    </div>

    </div>
    </div>
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