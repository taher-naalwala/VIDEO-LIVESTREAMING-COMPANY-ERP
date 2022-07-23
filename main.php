<?php
session_start();
if (isset($_SESSION['its'])) {
    $its = $_SESSION['its'];
    $adminid = $_SESSION['id'];
} else {
    header("Location: login.php");
    die();
}
?>
<!DOCTYPE html>
<html lang="en">

<head>

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
    <script src="//code.jquery.com/jquery-1.11.1.min.js"></script>

    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <script src="https://use.fontawesome.com/3582a84b00.js"></script>
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="css/sb-admin-2.min.css" rel="stylesheet">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Main Portal</title>
    <style>
        .show-read-more .more-text {
            display: none;
        }
    </style>

</head>

<body id="page-top">
    <div id="wrapper">

        <?php
        require('style.php');
        require('connectDB.php');
        $date = date('Y-m-d');
        $sql = "SELECT * from event_info WHERE adminid=$adminid AND '$date' BETWEEN start_date AND end_date ";
        $run = $conn->query($sql);
        $total_ongoing_events = $run->num_rows;
        $sql1 = "SELECT * from event_info WHERE adminid=$adminid AND '$date'<start_date ";
        $run1 = $conn->query($sql1);
        $total_upcoming_events = $run1->num_rows;
        $sql2 = "SELECT * from event_info WHERE adminid=$adminid AND '$date'>end_date  LIMIT 5";
        $run2 = $conn->query($sql2);
        $total_finished_events = $run2->num_rows;
        $year = date('Y');
        $s1 = "SELECT * from event_info WHERE adminid=$adminid AND start_date LIKE '$year%' ";
        $r1 = $conn->query($s1);
        if ($r1->num_rows > 0) {
            $events_months = array();
            $jan_count = 0;
            $feb_count = 0;
            $mar_count = 0;
            $apr_count = 0;
            $may_count = 0;
            $jun_count = 0;
            $jul_count = 0;
            $aug_count = 0;
            $sep_count = 0;
            $oct_count = 0;
            $nov_count = 0;
            $dec_count = 0;
            $event_count_month = array();
            while ($row3 = $r1->fetch_assoc()) {
                $event_start_date = $row3['start_date'];
                $year = substr($event_start_date, 0, 4);
                if (strpos($event_start_date, "-06-") !== false) {
                    array_push($events_months, "June " . $year);
                    $jun_count++;
                }
                if (strpos($event_start_date, "-07-") !== false) {
                    array_push($events_months, "July " . $year);
                    $jul_count++;
                }
                if (strpos($event_start_date, "-08-") !== false) {
                    array_push($events_months, "August " . $year);
                    $aug_count++;
                }
                if (strpos($event_start_date, "-09-") !== false) {
                    array_push($events_months, "September " . $year);
                    $sep_count++;
                }
                if (strpos($event_start_date, "-10-") !== false) {
                    array_push($events_months, "October " . $year);
                    $oct_count++;
                }
                if (strpos($event_start_date, "-11-") !== false) {
                    array_push($events_months, "November " . $year);
                    $nov_count++;
                }
                if (strpos($event_start_date, "-12-") !== false) {
                    array_push($events_months, "December " . $year);
                    $dec_count++;
                }
                if (strpos($event_start_date, "-01-") !== false) {
                    array_push($events_months, "January " . $year);
                    $jan_count++;
                }
                if (strpos($event_start_date, "-02-") !== false) {
                    array_push($events_months, "February " . $year);
                    $feb_count++;
                }
                if (strpos($event_start_date, "-03-") !== false) {
                    array_push($events_months, "March " . $year);
                    $mar_count++;
                }
                if (strpos($event_start_date, "-04-") !== false) {
                    array_push($events_months, "April " . $year);
                    $apr_count++;
                }
                if (strpos($event_start_date, "-05-") !== false) {
                    array_push($events_months, "May " . $year);
                    $may_count++;
                }
            }
            $events_months_unique = array_unique($events_months);
            array_push($event_count_month, $jan_count);
            array_push($event_count_month, $feb_count);
            array_push($event_count_month, $mar_count);
            array_push($event_count_month, $apr_count);
            array_push($event_count_month, $may_count);
            array_push($event_count_month, $jun_count);
            array_push($event_count_month, $jul_count);
            array_push($event_count_month, $aug_count);
            array_push($event_count_month, $sep_count);
            array_push($event_count_month, $oct_count);
            array_push($event_count_month, $nov_count);
            array_push($event_count_month, $dec_count);
        }


        ?>
        <!-- Begin Page Content -->
        <div class="container-fluid">

            <!-- Page Heading -->
            <div class="d-sm-flex align-items-center justify-content-between mb-4">
                <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
            </div>
            <div class="row">

                <!-- Earnings (Monthly) Card Example -->
                <div class="col-xl-4 col-md-6 mb-4">
                    <div class="card border-left-primary shadow  py-2">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                    <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Total Ongoing Events</div>
                                    <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo $total_ongoing_events ?></div>
                                </div>
                                <div class="col-auto">

                                    <i class="fas fa-calendar-week fa-2x text-gray-300"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Earnings (Monthly) Card Example -->
                <div class="col-xl-4 col-md-6 mb-4">
                    <div class="card border-left-success shadow h-100 py-2">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                    <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Total Upcoming Events</div>
                                    <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo $total_upcoming_events ?></div>
                                </div>
                                <div class="col-auto">

                                    <i class="fas fa-calendar-week fa-2x text-gray-300"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Earnings (Monthly) Card Example -->
                <div class="col-xl-4 col-md-6 mb-4">
                    <div class="card border-left-success shadow h-100 py-2">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                    <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Total Finished Events</div>
                                    <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo $total_finished_events ?></div>
                                </div>
                                <div class="col-auto">

                                    <i class="fas fa-calendar-week fa-2x text-gray-300"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-xl-12 col-lg-12">
                <div class="card shadow mb-4 ml-4 mr-4">
                    <!-- Card Header - Dropdown -->
                    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                        <h6 class="m-0 font-weight-bold text-primary">Overview</h6>

                    </div>
                    <!-- Card Body -->
                    <div class="card-body">
                        <div class="chart-area">
                            <canvas id="myAreaChart"></canvas>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12 col-md-12">
                <div class="card border-left-success shadow py-2 mb-2 ml-4 mr-4" >
                    <div class="card-body">
                        <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Ongoing Tasks</div>
                        <div class="row">
                            <?php
                            if ($run->num_rows > 0) {
                                while ($row = $run->fetch_assoc()) {
                                    $name = $row['name'];
                                    $start_date = $row['start_date'];
                                    $end_date = $row['end_date']; ?>

                                    <div class="col-lg-6 col-md-6">
                                        <div class="card mb-4 mt-3">
                                            <div class="card-header py-3">
                                                <h6 class="m-0 font-weight-bold text-success"><?php echo $name ?></h6>
                                            </div>
                                            <div class="card-body">
                                                <p>End Date: <?php echo $end_date ?></p>
                                            </div>
                                        </div>
                                    </div>
                            <?php
                                }
                            } else {
                                echo  '<div class="alert alert-success"  role="alert">
                        No Current Event
                        </div>';
                            }
                            ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>


        <div class="row">
            <div class="col-lg-12 col-md-12">
                <div class="card border-left-primary shadow py-2 mb-2 ml-4 mr-4" >
                    <div class="card-body">
                        <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Upcoming Tasks</div>
                        <div class="row">
                            <?php
                            if ($run2->num_rows > 0) {
                                while ($row2 = $run2->fetch_assoc()) {
                                    $name = $row2['name'];
                                    $start_date = $row2['start_date'];
                                    $end_date = $row2['end_date']; ?>

                                    <div class="col-lg-6 col-md-6">
                                        <div class="card mb-4 mt-3 mr-4 ml-4">
                                            <div class="card-header py-3">
                                                <h6 class="m-0 font-weight-bold text-success"><?php echo $name ?></h6>
                                            </div>
                                            <div class="card-body">
                                                <p>Start Date: <?php echo $start_date ?></p>
                                            </div>
                                        </div>
                                    </div>
                            <?php
                                }
                            } else {
                                echo  '<div class="alert alert-primary" role="alert">
                        No Current Event
                        </div>';
                            }
                            ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-12 col-md-12">
                <div class="card border-left-warning shadow py-2 mb-2 ml-4 mr-4" >
                    <div class="card-body">
                        <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">Finished Tasks (Last 5)</div>
                        <div class="row">
                            <?php
                            if ($run2->num_rows > 0) {
                                while ($row2 = $run2->fetch_assoc()) {
                                    $name = $row2['name'];
                                    $start_date = $row2['start_date'];
                                    $end_date = $row2['end_date']; ?>

                                    <div class="col-lg-6 col-md-6">
                                        <div class="card mb-4 mt-3 mr-4 ml-4">
                                            <div class="card-header py-3">
                                                <h6 class="m-0 font-weight-bold text-warning"><?php echo $name ?></h6>
                                            </div>
                                            <div class="card-body">
                                                <p>Start Date: <?php echo $start_date ?></p>
                                                <p>End Date: <?php echo $end_date ?></p>
                                            </div>
                                        </div>
                                    </div>
                            <?php
                                }
                            } else {
                                echo  '<div class="alert alert-primary" role="alert">
                        No Current Event
                        </div>';
                            }
                            ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Bootstrap core JavaScript-->
        <script src="vendor/jquery/jquery.min.js"></script>
        <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

        <!-- Core plugin JavaScript-->
        <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

        <!-- Custom scripts for all pages-->
        <script src="js/sb-admin-2.min.js"></script>


        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js" integrity="sha384-wHAiFfRlMFy6i5SRaxvfOCifBUQy1xHdJ/yoi7FRNXMRBu5WHdZYu1hA6ZOblgut" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>


        <!-- Page level plugins -->
        <script src="vendor/chart.js/Chart.min.js"></script>
        <script>
            // Set new default font family and font color to mimic Bootstrap's default styling
            Chart.defaults.global.defaultFontFamily = 'Nunito', '-apple-system,system-ui,BlinkMacSystemFont,"Segoe UI",Roboto,"Helvetica Neue",Arial,sans-serif';
            Chart.defaults.global.defaultFontColor = '#858796';

            function number_format(number, decimals, dec_point, thousands_sep) {
                // *     example: number_format(1234.56, 2, ',', ' ');
                // *     return: '1 234,56'
                number = (number + '').replace(',', '').replace(' ', '');
                var n = !isFinite(+number) ? 0 : +number,
                    prec = !isFinite(+decimals) ? 0 : Math.abs(decimals),
                    sep = (typeof thousands_sep === 'undefined') ? ',' : thousands_sep,
                    dec = (typeof dec_point === 'undefined') ? '.' : dec_point,
                    s = '',
                    toFixedFix = function(n, prec) {
                        var k = Math.pow(10, prec);
                        return '' + Math.round(n * k) / k;
                    };
                // Fix for IE parseFloat(0.55).toFixed(0) = 0;
                s = (prec ? toFixedFix(n, prec) : '' + Math.round(n)).split('.');
                if (s[0].length > 3) {
                    s[0] = s[0].replace(/\B(?=(?:\d{3})+(?!\d))/g, sep);
                }
                if ((s[1] || '').length < prec) {
                    s[1] = s[1] || '';
                    s[1] += new Array(prec - s[1].length + 1).join('0');
                }
                return s.join(dec);
            }

            // Area Chart Example
            var ctx = document.getElementById("myAreaChart");
            var myLineChart = new Chart(ctx, {
                type: 'line',
                data: {
                    labels: ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"],
                    datasets: [{
                        label: "Events",
                        lineTension: 0.3,
                        backgroundColor: "rgba(78, 115, 223, 0.05)",
                        borderColor: "rgba(78, 115, 223, 1)",
                        pointRadius: 3,
                        pointBackgroundColor: "rgba(78, 115, 223, 1)",
                        pointBorderColor: "rgba(78, 115, 223, 1)",
                        pointHoverRadius: 3,
                        pointHoverBackgroundColor: "rgba(78, 115, 223, 1)",
                        pointHoverBorderColor: "rgba(78, 115, 223, 1)",
                        pointHitRadius: 10,
                        pointBorderWidth: 2,
                        data: [<?php
                                foreach ($event_count_month as $u) {
                                    echo '"' . $u . '",';
                                }
                                ?>],
                    }],
                },
                options: {
                    maintainAspectRatio: false,
                    layout: {
                        padding: {
                            left: 10,
                            right: 25,
                            top: 25,
                            bottom: 0
                        }
                    },
                    scales: {
                        xAxes: [{
                            time: {
                                unit: 'date'
                            },
                            gridLines: {
                                display: false,
                                drawBorder: false
                            },
                            ticks: {
                                maxTicksLimit: 7
                            }
                        }],
                        yAxes: [{
                            ticks: {
                                maxTicksLimit: 5,
                                padding: 10,
                                // Include a dollar sign in the ticks
                                callback: function(value, index, values) {
                                    return '' + number_format(value);
                                }
                            },
                            gridLines: {
                                color: "rgb(234, 236, 244)",
                                zeroLineColor: "rgb(234, 236, 244)",
                                drawBorder: false,
                                borderDash: [2],
                                zeroLineBorderDash: [2]
                            }
                        }],
                    },
                    legend: {
                        display: false
                    },
                    tooltips: {
                        backgroundColor: "rgb(255,255,255)",
                        bodyFontColor: "#858796",
                        titleMarginBottom: 10,
                        titleFontColor: '#6e707e',
                        titleFontSize: 14,
                        borderColor: '#dddfeb',
                        borderWidth: 1,
                        xPadding: 15,
                        yPadding: 15,
                        displayColors: false,
                        intersect: false,
                        mode: 'index',
                        caretPadding: 10,
                        callbacks: {
                            label: function(tooltipItem, chart) {
                                var datasetLabel = chart.datasets[tooltipItem.datasetIndex].label || '';
                                return datasetLabel + ': ' + number_format(tooltipItem.yLabel);
                            }
                        }
                    }
                }
            });
        </script>


</body>

</html>