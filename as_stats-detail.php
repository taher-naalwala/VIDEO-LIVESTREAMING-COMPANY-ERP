<?php
require('connectDB.php');
$inittime = strtotime(date("Y-m-d", strtotime(date("Y-m-d"))) . "-1 month");
$getEventSql = sprintf("select * from ashara_event where starttime > %d or starttime=0", $inittime);
$result = mysqli_query($conn, $getEventSql);
$events = [];
$eventid = isset($_GET['eventid']) ? $_GET['eventid'] : 1;
while ($row = mysqli_fetch_assoc($result)) {
    $data = [];
    $data = [
        "eventid" => $row['id'],
        "name" => $row['name']
    ];
    $events[] = $data;
}
?>
<html>

<head>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.5.0/chart.min.js" integrity="sha512-asxKqQghC1oBShyhiBwA+YgotaSYKxGP1rcSYTDrB0U6DxwlJjU59B67U8+5/++uFjcuVM8Hh5cokLjZlhm3Vg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdn.datatables.net/1.10.25/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.7.1/js/dataTables.buttons.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.7.1/js/buttons.html5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.7.1/js/buttons.print.min.js"></script>
    <link type="text/css" rel="stylesheet" href="https://cdn.datatables.net/1.10.25/css/jquery.dataTables.min.css" />
    <style>
        .center {
            margin: auto;
            text-align: center;
            width: 50%;
            border: 3px solid green;
            padding: 10px;
        }
    </style>
</head>

<body>
    <div class="center">
        <form method="get" action="">
            <select type="select" name="eventid" id="eventid">
                <?php

                foreach ($events as $e) {
                    if ($e['eventid'] == $eventid) {
                        $selected = "selected";
                    } else {
                        $selected = "";
                    }
                    echo "<option value=" . $e['eventid'] . " " . $selected . ">" . $e['name'] . "</option>";
                }
                ?>
            </select>

            </select>
            <input type="submit" value="Generate Report">
            <button type="button" id="syncdb">Sync DB from CSV</button>
            <button type="button" id="generatedb">Generate Scanner list</button>
        </form>
    </div>
    <div id="chart-container">
        <canvas id="graphCanvas"></canvas>
    </div>
    <hr>
    <hr>
    <div id="result">
        <table id="resulttable" class="cell-border compact stripe" style="width:100%">
            <thead>
                <tr>
                    <th>venue_id</th>
                    <th>registered</th>
                    <th>mehmaan</th>
                    <th>other</th>
                    <th>venuename</th>
                </tr>
            </thead>
            <tfoot>
                <tr>
                    <th>venue_id</th>
                    <th>registered</th>
                    <th>mehmaan</th>
                    <th>other</th>
                    <th>venuename</th>
                </tr>
            </tfoot>
        </table>
    </div>
</body>
<script>
    $(document).ready(function() {
        showGraph();
        showTable();

        $('#syncdb').click(function() {
            var eventid = $('#eventid').val();
            var win = window.open("as_syncdb.php?eventid="+eventid, "_blank");
    win.focus();
  });
  $('#generatedb').click(function() {
            var eventid = $('#eventid').val();
            var win = window.open("as_generatedb.php?eventid="+eventid, "_blank");
    win.focus();
  });
    });

    function showTable() {
        $('#resulttable').DataTable({
            ajax: {
                url: "as_stats-detail_api.php",
                data: {
                    'eventid': <?php echo $eventid; ?>
                },
                dataSrc: "records"
            },
            dom: 'Bfrtip',
            buttons: [
                'copy', 'csv', 'print'
            ],

            columns: [{
                    data: "venue_id"
                },
                {
                    data: "registered"
                },
                {
                    data: "mehmaan"
                },
                {
                    data: "other"
                },
                {
                    data: "venuename"
                }
            ]

        });
    }


    function showGraph() {
        {
            $.get("as_stats-detail_api.php", {
                    'eventid': <?php echo $eventid; ?>
                },
                function(data) {
                    console.log(data);
                    var name = [];
                    var registered = [];
                    var mehmaan = [];
                    var other = [];
                    var records = data.records;
                    for (var i in records) {
                        name.push(records[i].venuename);
                        registered.push(records[i].registered);
                        mehmaan.push(records[i].mehmaan);
                        other.push(records[i].other);
                    }

                    var barOptions_stacked = {
                        tooltips: {
                            enabled: false
                        },
                        plugins: {
                            tooltip: {
                                callbacks: {
                                    footer: function(items) {
                                        return 'Total: ' + items.reduce((a, b) => a + b.parsed.x, 0)
                                    }
                                }
                            },
                        },
                        hover: {
                            animationDuration: 0
                        },
                        scales: {
                            x: {
                                stacked: true,
                            },
                            y: {
                                stacked: true
                            }
                        },

                        indexAxis: 'y',
                    };



                    var chartdata = {
                        labels: name,
                        datasets: [{
                                label: 'Registered',
                                backgroundColor: '#32a852',
                                borderColor: '#46d5f1',
                                hoverBackgroundColor: '#55a832',
                                hoverBorderColor: '#666666',
                                data: registered
                            },
                            {
                                label: 'Mehmaan',
                                backgroundColor: '#3db2bf',
                                borderColor: '#46d5f1',
                                hoverBackgroundColor: '#13494f',
                                hoverBorderColor: '#666666',
                                data: mehmaan
                            },
                            {
                                label: 'Other',
                                backgroundColor: '#cc30d1',
                                borderColor: '#46d5f1',
                                hoverBackgroundColor: '#611463',
                                hoverBorderColor: '#666666',
                                data: other
                            }
                        ]
                    };

                    var graphTarget = $("#graphCanvas");

                    var barGraph = new Chart(graphTarget, {
                        type: 'bar',

                        data: chartdata,
                        options: barOptions_stacked,
                    });
                });
        }
    }
</script>

</html>