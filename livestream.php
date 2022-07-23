<?php
session_start();
if (isset($_SESSION['its'])) {
    $adminid = $_SESSION['id'];
    if ($_GET['name'] == "Buy Livestream") {
        $forms_access = $_SESSION['forms_access'];
        $flag = 0;
        foreach ($forms_access as $formid) {
            if ($formid == "26" || $formid == "25") {
                $flag = 1;
            }
        }
        if ($flag == 0) {
            header('Location:main.php');
            exit();
        }
    }
    if ($_GET['name'] == "View") {
        $forms_access = $_SESSION['forms_access'];
        $flag = 0;
        foreach ($forms_access as $formid) {
            if ($formid == "27" || $formid == "25") {
                $flag = 1;
            }
        }
        if ($flag == 0) {
            header('Location:main.php');
            exit();
        }
    }
    if ($_GET['name'] == "Config") {
        $forms_access = $_SESSION['forms_access'];
        $flag = 0;
        foreach ($forms_access as $formid) {
            if ($formid == "28" || $formid == "25") {
                $flag = 1;
            }
        }
        if ($flag == 0) {
            header('Location:main.php');
            exit();
        }
    }
    if ($_GET['name'] == "Subscribers") {
        $forms_access = $_SESSION['forms_access'];
        $flag = 0;
        foreach ($forms_access as $formid) {
            if ($formid == "29" || $formid == "25") {
                $flag = 1;
            }
        }
        if ($flag == 0) {
            header('Location:main.php');
            exit();
        }
    }
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
    <style>
        .btn-block {
            background-color: #4e73df;
        }

        .btn {
            color: #fff;
        }

        .razorpay-payment-button {
            color: #fff;
            background-color: #4e73df;
            border-radius: 3px;
            margin-bottom: 10px;
            margin-left: 10px;
        }
    </style>
    <title><?php echo $_GET['name'] ?></title>
</head>

<body id="page-top">
    <div id="wrapper">
        <?php
        require('style.php');
        ?>
        <div class="container-fluid">
            <!-- DataTales Example -->
            <div class="card shadow mb-4">

                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1"><?php echo $_GET['name'] ?></div>
                        </div>
                    </div>
                    <?php require('connectDB.php');
                    if ($_GET['name'] == "Buy Livestream") {
                    ?>
                        <div class="col-lg-6 col-md-6">
                            <div class="card mb-4 mt-3">
                                <div class="card-header py-3">
                                    <h6 class="m-0 font-weight-bold text-primary">Livestream For Ashara</h6>
                                </div>
                                <div class="card-body">
                                    <h4>Livestream Description</h4>
                                    <p>
                                        You will get 18 secure Livestreams. 9 Livestreams for Wayaz and 9 Livestreams for Raat Majlis. You will be provided with Server URL and Stream Key to livestream. Rest everything will be managed by us including the Embed Codes</p>
                                    <h6>Valid for a month</h6>
                                </div>
                                <?php require('connectDB.php');
                                $sql = "SELECT * from livestream WHERE userid=$adminid";
                                $run = $conn->query($sql);
                                if ($run->num_rows > 0) {
                                } else {
                                ?>
                                    <form action="success_purchase.php" method="POST">
                                        <script src="https://checkout.razorpay.com/v1/checkout.js" data-key="rzp_live_Kh537ClBqq46F6" // Enter the Key ID generated from the Dashboard data-amount="599900" // Amount is in currency subunits. Default currency is INR. Hence, 50000 refers to 50000 paise data-currency="INR" data-buttontext="Pay Now (Rs.5,999)" data-name="Relay" data-description="Ashara Livestreams (18 livestreams)" data-theme.color="#F37254"></script><input type="hidden" custom="Hidden Element" name="hidden">
                                    </form>
                                <?php
                                }
                                ?>
                            </div>
                        </div>
                        <?php
                    }
                    if ($_GET['name'] == "Config") {
                        $sql = "SELECT * from livestream WHERE stream_url='' OR server_key=''";
                        $run = $conn->query($sql);
                        if ($run->num_rows > 0) { ?>
                            <br>
                            <table class="table table-bordered">
                                <tr>
                                    <th>Name</th>
                                    <th>Edit</th>
                                </tr>
                                <?php while ($row = $run->fetch_assoc()) {
                                    $userid = $row['userid'];
                                    $s1 = "SELECT name from web_login WHERE id=$userid";
                                    $run1 = $conn->query($s1);
                                    $row1 = $run1->fetch_assoc();
                                    $name = $row1['name'];
                                ?>


                                    <tr>
                                        <td><?php echo $name ?></td>
                                        <form action="config_livestream.php">
                                            <td><button class="btn btn-primary" name="userid" value='<?php echo $userid ?>'>Edit</button></td>
                                        </form>
                                    </tr>


                                <?php  }
                                echo "</table>";
                            }
                        }
                        if ($_GET['name'] == "View") {
                            $sql = "SELECT * from livestream WHERE userid=$adminid AND server_key!='' AND stream_url!=''";
                            $run = $conn->query($sql);
                            if ($run->num_rows > 0) {
                                $row = $run->fetch_assoc();
                                $server_url = $row['server_key'];
                                $stream_key = $row['stream_url'];
                                ?>
                                <div class="col-lg-6 col-md-6">
                                    <div class="card mb-4 mt-3">
                                        <div class="card-header py-3">
                                            <h6 class="m-0 font-weight-bold text-primary">Livestream Info</h6>
                                        </div>
                                        <div class="card-body">
                                            <p>Server URL: <?php echo $server_url ?></p>
                                            <p>Stream KEY: <?php echo $stream_key ?></p>
                                        </div>
                                    </div>
                                </div>

                                <?php    } else {
                                echo "<br><p>Your Server URL and Stream Key will be generated within 24 hours after you buy the Livestreams</p>";
                            }
                        }
                        if ($_GET['name'] == "Subscribers") {
                            $sql = "SELECT userid from livestream";
                            $run = $conn->query($sql);
                            if ($run->num_rows > 0) {
                                while ($row = $run->fetch_assoc()) {
                                    $userid = $row['userid'];
                                    $s1 = "SELECT * from web_login WHERE id=$userid AND adminid=$adminid";
                                    $run1 = $conn->query($s1);
                                    if ($run1->num_rows > 0) { ?>
                                     <br>   <table class="table table-bordered">
                                            <tr>
                                                <th>Name</th>
                                            </tr>

                                            <?php while ($row1 = $run1->fetch_assoc()) {
                                                $name = $row1['name']; ?>
                                                <tr>
                                                    <td><?php echo $name ?></td>
                                                </tr>
                                            <?php   }
                                            ?>
                                        </table>
                        <?php }
                                }
                            }
                        }
                        ?>

                </div>
            </div>
        </div>
    </div>

    <script src="js/sb-admin-2.min.js"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js" integrity="sha384-wHAiFfRlMFy6i5SRaxvfOCifBUQy1xHdJ/yoi7FRNXMRBu5WHdZYu1hA6ZOblgut" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>

</body>

</html>