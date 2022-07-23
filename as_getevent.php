<?php
require('connectDB.php');
header('Content-Type: application/json');
//check current time
$time = time();
//get all event which are active and in time range 
$output = [];
$getEventSql = sprintf("select * from ashara_event where (starttime = 0 or starttime <= %d) and (endtime = 0 or endtime > %d) and status = 1 and visibility=1 order by starttime asc",$time,$time);
$result = mysqli_query($conn, $getEventSql);
while ($row = mysqli_fetch_assoc($result) ){
    $data=[];
    $data = ["eventid"=>$row['id'],
    "name"=>$row['name'],
    "starttime"=>$row['starttime'],
    "endtime"=>$row['endtime']];
    $output["events"][]=$data;

}
if(empty($output['events'])){
    http_response_code(400);
    header('Content-Type: application/json');
    die(json_encode(array("message" => "No Data available"))); 
}
echo json_encode($output);
