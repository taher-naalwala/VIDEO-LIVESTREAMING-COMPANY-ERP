<?php
session_start();
if (isset($_SESSION['its'])) {
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
            if ($formid == "12" || $formid == "9") {
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
            if ($formid == "4" || $formid == "1") {
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
    <script type="text/javascript" src="https://cdn.jsdelivr.net/jquery/latest/jquery.min.js"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />


    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <script src="https://use.fontawesome.com/3582a84b00.js"></script>
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="css/sb-admin-2.min.css" rel="stylesheet">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Remove <?php echo $_GET['name'] ?></title>
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
                    <h6 class="m-0 font-weight-bold text-primary">Remove <?php echo $_GET['name'] ?></h6>
                </div>
                <div class="card-body">
                    <form method="POST" enctype="multipart/form-data">
                        <?php if ($_GET['name'] == "Access") { ?>

                            <div class="row">
                                <div class="col-lg-6 col-md-6">
                                    <div class="form-group"> <select class="form-control" name="adminid" required>
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
                                    <button name="removeaccess" value="remove" class=" btn  btn-primary ">Remove</button>
                                </div>
                            </div>
                            <?php require('connectDB.php');
                            if (isset($_POST['adminid'])) {

                                $adminid = $_POST['adminid'];
                                $sql = "DELETE FROM web_login WHERE id=$adminid";
                                if (mysqli_query($conn, $sql)) {

                                    echo '<div class="alert alert-success mt-2">
                                         Account Deleted
                                         </div>';
                                } else {
                                    echo '<div class="alert alert-danger mt-2">
                                            Fail
                                         </div>';
                                }
                            }
                        }
                        if ($_GET['name'] == "Member") {
                            ?>
                            <div class="row">
                                <div class="col-lg-6 col-md-6">
                                    <div class="form-group">
                                        <input name="its" class="form-control" placeholder="Enter ITS" required>
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-6">
                                    <button name="removemember" value="remove" class=" btn  btn-primary ">Remove</button>
                                </div>
                            </div>

                            <?php require('connectDB.php');

                            if (isset($_POST['removemember'])) {
                                $its = $_POST['its'];
                                $sql = "UPDATE reg_form SET status=0 WHERE its='$its'";
                                if (mysqli_query($conn, $sql)) {
                                    echo '<div class="alert alert-success mt-2">
                     Member Removed
                    </div>';
                                } else {
                                    echo '<div class="alert alert-danger mt-2">
                    Fail
                    </div>';
                                }
                            }
                        }
                        if ($_GET['name'] == "Event") {
                            date_default_timezone_set("Asia/Kolkata");
                            $date = date('Y-m-d');
                            ?>
                            <div class="row">
                                <div class="col-lg-6 col-md-6">
                                    <div class="form-group"> <select class="form-control" name="eventid" required>
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
                                    <button name="removeevent" value="remove" class=" btn  btn-primary ">Remove</button>
                                </div>
                            </div>

                            <?php require('connectDB.php');
                            if (isset($_POST['removeevent'])) {
                                $eventid = $_POST['eventid'];
                                $sql = "DELETE FROM event_info WHERE id=$eventid";
                                if (mysqli_query($conn, $sql)) {
                                    $s1 = "DELETE FROM reg_form WHERE event_id=$eventid";
                                    if (mysqli_query($conn, $s1)) {

                                        echo '<div class="alert alert-success mt-2">
                        Event Removed
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
                                                    <option value="<?php echo $cityid ?>"><?php echo $cityname; ?></option>
                                                <?php
                                                }
                                                ?>
                                            </select>


                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-6">
                                        <button name="removecity" value="edit" class=" btn  btn-primary ">Remove</button>
                                    </div>
                                </div>
                                <?php require('connectDB.php');
                                if (isset($_POST['removecity'])) {
                                    $cityid = $_POST['cityid'];
                                    $sql = "DELETE FROM city WHERE id=$cityid";
                                    if (mysqli_query($conn, $sql)) {
                                        $s1 = "DELETE FROM mohalla WHERE cityid=$cityid";
                                        if (mysqli_query($conn, $s1)) {
                                            echo '<div class="alert alert-success mt-2">
                                    City Removed
                                   </div>';
                                        } else {
                                            echo '<div class="alert alert-danger mt-2">
                                    Fail
                                   </div>';
                                        }
                                    }

                                ?>
                            </form>

                        <?php   }
                            }
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
                                    <button name="removemohalla" value="edit" class=" btn  btn-primary ">Remove</button>
                                </div>
                            </div>

                            <?php require('connectDB.php');
                                if (isset($_POST['removemohalla'])) {
                                    $mohalla_id = $_POST['mohalla_id'];
                                    $sql = "DELETE FROM mohalla WHERE id=$mohalla_id";
                                    if (mysqli_query($conn, $sql)) {
                                        echo '<div class="alert alert-success mt-2">
                            Mohalla Removed
                           </div>';
                                    } else {
                                        echo '<div class="alert alert-danger mt-2">
                           Fail
                           </div>';
                                    }
                                }

                            ?>
                        </form>
                    <?php    }
                    ?>
                    </form>
                </div>

            </div>

        </div>

    </div>




    </div>
    </div>
    <script src="select.js"></script>
    <!-- Custom scripts for all pages-->
    <script src="js/sb-admin-2.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js" integrity="sha384-wHAiFfRlMFy6i5SRaxvfOCifBUQy1xHdJ/yoi7FRNXMRBu5WHdZYu1hA6ZOblgut" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>

</body>

</html>