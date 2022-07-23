<?php
session_start();
if (isset($_SESSION['its'])) {
    $adminid = $_SESSION['id'];
    if ($_GET['name'] == "Pending") {
        $forms_access = $_SESSION['forms_access'];
        $flag = 0;
        foreach ($forms_access as $formid) {
            if ($formid == "6" || $formid == "5") {
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
            if ($formid == "7" || $formid == "5") {
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
            if ($formid == "8" || $formid == "5") {
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
    <title><?php echo $_GET['name'] ?> Report</title>
    <style>
        .btn-block {
            background-color: #4e73df;
        }

        .btn {
            color: #fff;
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
                    <h6 class="m-0 font-weight-bold text-primary"><?php echo $_GET['name'] ?> Report</h6>
                </div>
                <div class="card-body">
                    <form method="POST" enctype="multipart/form-data">
                        <?php if ($_GET['name'] == "Pending") { ?>


                            <div class="row">
                                <div class="col-lg-4 col-md-4">
                                    <?php require('connectDB.php');
                                    $date = date('Y-m-d');

                                    $s1 = "SELECT * from event_info WHERE adminid=$adminid AND (start_date>='$date' OR (start_date<='$date' AND end_date>='$date'))";
                                    $run1 = $conn->query($s1);
                                    echo "<select class='form-control' name='event_id' >";
                                    echo '<option value="">Select Event</option>';
                                    while ($row1 = $run1->fetch_assoc()) {
                                        $eventname = $row1['name'];

                                        echo "<option value='$row1[id]'>";
                                        echo $eventname;
                                        echo "</option>";
                                    }

                                    echo "</select><br>";


                                    ?>

                                </div>
                                <div class="col-lg-2 col-md-2">
                                    <button name="view_pending" value="Add" class=" btn  btn-block ">View</button>
                                </div>
                            </div>
                            <?php

                            if (isset($_POST['view_pending'])) {
                                $eventid = $_POST['event_id'];
                                $_SESSION['eventid'] = $eventid;
                                $s0 = "SELECT * from event_info WHERE id=$eventid";
                                $run0 = $conn->query($s0);
                                $row0 = $run0->fetch_assoc();
                                $eventname = $row0['name'];
                                $heading = "Pending List of " . $eventname;
                                $s1 = "SELECT * from reg_form WHERE event_id=$eventid AND status=1";
                                $run1 = $conn->query($s1);
                                if ($run1->num_rows > 0) {
                                    echo '<form method="POST">
                                <br><div class="card"><div class="card-body"><h4>' . $heading . '</h4><br>'; ?>
                                    <label>Filters</label>
                                    <div class="row">
                                        <div class="col-lg-4 c0l-md-4">
                                            <select class="form-control" id="mohalladd" onChange="change_mohalla_report()">
                                                <option value=''>Select Mohalla</option>
                                                <?php
                                                $sa = "SELECT DISTINCT(mohallaid) from reg_form WHERE event_id=$eventid AND status=1";
                                                $runa = $conn->query($sa);
                                                while ($rowa = $runa->fetch_assoc()) {
                                                    $mohallaid = $rowa['mohallaid'];
                                                    $s3a = "SELECT * from mohalla WHERE id=$mohallaid";
                                                    $run3a = $conn->query($s3a);
                                                    $row3a = $run3a->fetch_assoc();
                                                    $mohallaname = $row3a['name']; ?>

                                                    <option value='<?php echo $mohallaid ?>'><?php echo $mohallaname ?></option>

                                                <?php }

                                                ?>
                                            </select>
                                        </div>
                                        <div class="col-lg-4 col-md-4">
                                            <input id="its" class="form-control" placeholder="ITS">
                                        </div>

                                    </div>
                                    <br>


                            <?php echo '<div id="table"><table border=1 class="table"><tr><th scope="col"><input type="checkbox" id="ckbCheckAll" checked /></th><th scope="col">ITS</th><th scope="col">Name</th><th scope="col">Mobile</th><th scope="col">City</th><th scope="col">Mohalla</th><th scope="col">Reason</th></tr>';
                                    echo "<input type='hidden' name='eventid' value='$eventid'>";
                                    while ($row = $run1->fetch_assoc()) {
                                        $its = $row['its'];
                                        $name = $row['name'];
                                        $mobile = $row['mobile'];
                                        $reason = $row['reason'];
                                        $cityid = $row['cityid'];
                                        $mohallaid = $row['mohallaid'];
                                        $s2 = "SELECT * from city WHERE id=$cityid";
                                        $run2 = $conn->query($s2);
                                        $row2 = $run2->fetch_assoc();
                                        $cityname = $row2['name'];
                                        $s3 = "SELECT * from mohalla WHERE id=$mohallaid";
                                        $run3 = $conn->query($s3);
                                        $row3 = $run3->fetch_assoc();
                                        $mohallaname = $row3['name'];

                                        echo "<tr><td><input name='its[]' type='checkbox' class='checkBoxClass' value='$its' checked><input type='hidden' name='all_its[]' value='$its'></td><td>" . $its . '</td><td>' . $name . '</td><td>' . $mobile . '</td><td>' . $cityname . '</td><td>' . $mohallaname . '</td><td class="show-read-more" style=" max-width:400px;word-wrap:break-word;">' . $reason . '</td></tr>';
                                    }
                                    echo '</table></div></div></div>
                                    <br><div class="text-right"><button name="submit_pending" value="Add" class=" btn btn-primary">Submit</button></div>
                                    </form> ';
                                } else {
                                    echo '<div class="alert alert-warning" role="alert">
                                        No Report Found
                                    </div>';
                                }
                            }

                            ?>

                            <?php

                            if (isset($_POST['submit_pending'])) {
                                $its = $_POST['its'];
                                $eventid = $_POST['eventid'];
                                $all_its = $_POST['all_its'];
                                foreach ($all_its as $un) {
                                    if (!empty($its)) {
                                        foreach ($its as $value) {
                                            if ($un == $value) {
                                                $flag = 1;
                                                break;
                                            } else {
                                                $flag = 0;
                                            }
                                        }
                                        if ($flag == 1) {
                                            $s1 = "UPDATE reg_form SET status=2 WHERE its='$un' AND event_id=$eventid";
                                            mysqli_query($conn, $s1);
                                        } else {
                                            $s1 = "UPDATE reg_form SET status=0 WHERE its='$un' AND event_id=$eventid";
                                            mysqli_query($conn, $s1);
                                        }
                                    } else {
                                        $s1 = "UPDATE reg_form SET status=0 WHERE its='$un' AND event_id=$eventid";
                                        mysqli_query($conn, $s1);
                                    }
                                }
                            }


                            ?>

                    </form>
                <?php    }

                        if ($_GET['name'] == "Event") {

                ?>
                    <div class="row">
                        <div class="col-lg-3 col-md-3">

                            <div class="form-group"><input type="text" class="form-control" style="height: calc(1.5em + .75rem + 2px);" name="daterange1" id="daterange" required></div>
                        </div>
                        <div class="col-lg-3 col-md-3">
                            <div id="event" class="form-group">
                                <select class="form-control" required>
                                    <option value="">Select Event</option>
                                </select>
                            </div>
                        </div>

                        <div class="col-lg-3 col-md-3">
                            <button name="view_event" value="Add" class=" btn  btn-primary ">View</button>

                        </div>
                        <?php

                        ?>


                        </form>
                    </div>

                </div>

            </div>






        </div>

        <?php
                            if (isset($_POST['view_event'])) {
                                $eventid = $_POST['event_id'];
                                $_SESSION['eventid'] = $eventid;
        ?>


            <!-- DataTales Example -->
            <div class="card shadow mb-4 mr-4 ml-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary"> Event Info

                    </h6>
                </div>

                <div class="card-body">
                    <?php require('connectDB.php');

                                $sql = "SELECT * from event_info WHERE id=$eventid";
                                $run = $conn->query($sql);
                                $row = $run->fetch_assoc();
                                $name = $row['name'];
                                $start_date = $row['start_date'];
                                $end_date = $row['end_date'];
                                if (isset($row['embed_code'])) {
                                    $embed_code = $row['embed_code'];
                                } else {
                                    $embed_code = "";
                                }

                                echo "<label>Name:</label><b><p> " . $name . "</p></b>";
                                echo "<label>Start Date:</label><b><p> " . $start_date . "</p></b>";
                                echo "<label>End Date:</label><b><p> " . $end_date . "</p></b>";
                                echo "<label>Embed Code:</label><b><p> " . $embed_code . "</p></b>";


                    ?>

                </div>
            </div>

            <!-- DataTales Example -->
            <div class="card shadow mb-4 mr-4 ml-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary"> Attendance List
                    </h6>

                </div>
                <div class="card-body">
                    <?php
                                $s1 = "SELECT DISTINCT its,name,date,time from reg_form WHERE event_id=$eventid AND status=2 AND date!='' AND time!=''";
                                $run1 = $conn->query($s1);
                                if ($run1->num_rows > 0) { ?>


                        <br>

                    <?php echo '
                                  <div class="table-responsive">   <table border=1 id="dataTable3" class="table table-bordered"><thead><tr><th scope="col">ITS</th><th scope="col">Name</th><th scope="col">Date</th><th scope="col">Time</th></tr></thead><tbody>';
                                    while ($row = $run1->fetch_assoc()) {
                                        $its = $row['its'];
                                        $name = $row['name'];
                                       $date=$row['date'];
                                       $start_time=$row['time'];

                                      

                                       


                                        echo "<tr><td>" . $its . '</td><td>' . $name . '</td><td>' . $date . '</td><td>' . $start_time . '</td></tr>';
                                    }
                                    echo '</tbody></table></div>';
                                } else {
                                    echo '<div class="alert alert-warning" role="alert">
                                            No Report Found
                                        </div>';
                                }
                    ?>
                </div>
            </div>



            <!-- DataTales Example -->
            <div class="card shadow mb-4 mr-4 ml-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary"> Absent List
                    </h6>

                </div>
                <div class="card-body">
                    <?php
                                $s1 = "SELECT * from reg_form WHERE event_id=$eventid AND date='0'";
                                $run1 = $conn->query($s1);
                                if ($run1->num_rows > 0) { ?>


                        <br>

                    <?php echo '
                                  <div class="table-responsive">   <table border=1 id="dataTable" class="table table-bordered"><thead><tr><th scope="col">ITS</th><th scope="col">Name</th><th scope="col">Mobile</th><th scope="col">Reason</th></tr></thead><tbody>';
                                    while ($row = $run1->fetch_assoc()) {
                                        $its = $row['its'];
                                        $name = $row['name'];
                                        $mobile = $row['mobile'];
                                        $reason = $row['reason'];


                                        echo "<tr><td>" . $its . '</td><td>' . $name . '</td><td>' . $mobile . '</td><td class="show-read-more" style=" max-width:400px;word-wrap:break-word;">' . $reason . '</td></tr>';
                                    }
                                    echo '</tbody></table></div>';
                                } else {
                                    echo '<div class="alert alert-warning" role="alert">
                                            No Report Found
                                        </div>';
                                }
                    ?>
                </div>
            </div>


            <!-- DataTales Example -->
            <div class="card shadow mb-4 mr-4 ml-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary"> Denied List

                    </h6>
                </div>
                <div class="card-body">
                    <?php
                                $s1 = "SELECT * from reg_form WHERE event_id=$eventid AND status=0";
                                $run1 = $conn->query($s1);
                                if ($run1->num_rows > 0) { ?>

                        <br>


                    <?php echo '
                                    <div class="table-responsive">   <table border=1 id="dataTable1" class="table table-bordered"><thead><tr><th scope="col">ITS</th><th scope="col">Name</th><th scope="col">Mobile</th><th scope="col">Reason</th></tr></thead><tbody>';

                                    while ($row = $run1->fetch_assoc()) {
                                        $its = $row['its'];
                                        $name = $row['name'];
                                        $mobile = $row['mobile'];
                                        $reason = $row['reason'];


                                        echo "<tr><td>" . $its . '</td><td>' . $name . '</td><td>' . $mobile . '</td><td class="show-read-more" style=" max-width:400px;word-wrap:break-word;">' . $reason . '</td></tr>';
                                    }
                                    echo '</tbody></table></div>';
                                } else {
                                    echo '<div class="alert alert-warning" role="alert">
                                            No Report Found
                                        </div>';
                                }
                    ?>

                </div>
            </div>

    </div>
    </div>

<?php
                            }
                        }
                        if ($_GET['name'] == "Member") {

?>

<form method="POST">
    <div class="row">
        <div class="col-lg-4 col-md-4">
            <div class="form-group">
                <input class="form-control" name="its" placeholder="Enter ITS">
            </div>
        </div>
        <div class="col-lg-2 col-md-2">
            <button name="open_report" value="open" class=" btn  btn-primary ">Open</button>
        </div>
    </div>
</form>
</div>
</div>
</div>

<?php require('connectDB.php');

                            if (isset($_POST['open_report'])) {
                                $its = $_POST['its'];
                                $sql = "SELECT * from reg_form WHERE its='$its'";
                                $run = $conn->query($sql);
                                if ($run->num_rows > 0) {
                                    echo '    <div class="card shadow mb-4 mr-4 ml-4">
                                    <div class="card-header py-3">
                                        <h6 class="m-0 font-weight-bold text-primary">
Info for ' . $its . '
</div>';
                                    echo '

                                  <br>  <div class="table-responsive ml-2 mr-2">   <table border=1 id="dataTable" class="table table-bordered"><thead><tr><th scope="col">ITS</th><th scope="col">Name</th><th scope="col">Mobile</th><th scope="col">Reason</th><th>Status</th></tr></thead><tbody>';

                                    while ($row = $run->fetch_assoc()) {
                                        $eventid = $row['event_id'];
                                        $status = $row['status'];
                                        $name = $row['name'];
                                        $mobile = $row['mobile'];
                                        $reason = $row['reason'];

                                        $s1 = "SELECT * from event_info WHERE id=$eventid";
                                        $run2 = $conn->query($s1);
                                        $row2 = $run2->fetch_assoc();
                                        $eventname = $row2['name'];
                                        if ($status == 0) {
                                            $status = "Denied";
                                        }
                                        if ($status == 1) {
                                            $status = "Pending";
                                        }
                                        if ($status == 2) {
                                            $status = "Approved";
                                        }
                                        echo "<tr><td>" . $name . '</td><td>' . $mobile . '</td><td>' . $eventname . '</td><td class="show-read-more" style=" max-width:400px;word-wrap:break-word;">' . $reason . '</td><td>' . $status . '</td></tr>';
                                    }
                                    echo '</tbody></table></div>';
                                } else {
                                    echo '<div id="report_forms" class="alert alert-warning" role="alert">
                            No Report Found
                        </div>';
                                }



?>



<?php

                            }
                        }
?>


<script>
    $(document).ready(function() {
        var maxLength = 50;
        $(".show-read-more").each(function() {
            var myStr = $(this).text();
            if ($.trim(myStr).length > maxLength) {
                var newStr = myStr.substring(0, maxLength);
                var removedStr = myStr.substring(maxLength, $.trim(myStr).length);
                $(this).empty().html(newStr);
                $(this).append(' <a href="javascript:void(0);" class="read-more">read more...</a>');
                $(this).append('<span class="more-text">' + removedStr + '</span>');
            }
        });
        $(".read-more").click(function() {
            $(this).siblings(".more-text").contents().unwrap();
            $(this).remove();
        });
    });


    $("#ckbCheckAll").click(function() {
        $(".checkBoxClass").prop('checked', $(this).prop('checked'));
    });
</script>

<!-- Page level plugins -->
<!-- Page level plugins -->
<script src="vendor/datatables/jquery.dataTables.min.js"></script>


<script src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.6.2/js/dataTables.buttons.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
<script src="vendor/datatables/dataTables.bootstrap4.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.6.2/js/buttons.html5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.6.2/js/buttons.print.min.js"></script>

<script src="js/demo/datatables-demo.js"></script>

<script src="select.js"></script>
<!-- Custom scripts for all pages-->
<script src="js/sb-admin-2.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js" integrity="sha384-wHAiFfRlMFy6i5SRaxvfOCifBUQy1xHdJ/yoi7FRNXMRBu5WHdZYu1hA6ZOblgut" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>
</div>
</body>

</html>