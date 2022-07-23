<?php 
require('connectDB.php');
$inittime = strtotime( date( "Y-m-d", strtotime( date("Y-m-d") ) ) . "-1 month" );
$getEventSql = sprintf("select * from ashara_event where starttime > %d or starttime=0",$inittime);
$result = mysqli_query($conn, $getEventSql);
$events = [];
$eventid = isset($_GET['eventid'])?$_GET['eventid']:1;
while ($row = mysqli_fetch_assoc($result) ){
    $data=[];
    $data = ["eventid"=>$row['id'],
    "name"=>$row['name']];
    $events[]=$data;

}
?>
<html>

<head>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.5.0/chart.min.js" integrity="sha512-asxKqQghC1oBShyhiBwA+YgotaSYKxGP1rcSYTDrB0U6DxwlJjU59B67U8+5/++uFjcuVM8Hh5cokLjZlhm3Vg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
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
        <select type="select" name="eventid">
            <?php 
            
            foreach($events as $e){
                if($e['eventid'] == $eventid){
                    $selected = "selected";
                }else{
                    $selected = "";
                }
                echo "<option value=".$e['eventid']." ".$selected.">".$e['name']."</option>";
            }
            ?>
</select>
            
</select>
        <input type="submit" value="Generate Report">
</form>
        </div>
    <div id="chart-container">
        <canvas id="graphCanvas"></canvas>
    </div>

    <script>
        $(document).ready(function() {
            showGraph();
        });


        function showGraph() {
            {
                $.get("as_stats_api.php",{'eventid':<?php echo $eventid;?>},
                    function(data) {
                        console.log(data);
                        var name = [];
                        var marks = [];

                        for (var i in data) {
                            name.push(data[i].venuename);
                            marks.push(data[i].total);
                        }

                        var chartdata = {
                            labels: name,
                            datasets: [{
                                label: 'Ashara Attendance',
                                backgroundColor: '#49e2ff',
                                borderColor: '#46d5f1',
                                hoverBackgroundColor: '#CCCCCC',
                                hoverBorderColor: '#666666',
                                data: marks
                            }]
                        };

                        var graphTarget = $("#graphCanvas");

                        var barGraph = new Chart(graphTarget, {
                            type: 'bar',

                            data: chartdata,
                            options: {
                                indexAxis: 'y',
                            }
                        });
                    });
            }
        }
    </script>
</body>

</html>