<?php
header('Content-Type: application/json');
$eventid = $_GET['eventid'];
require('connectDB.php');
$checksql = sprintf("select venue_id,sum(case when `type`=0 then 1 else 0 end) as `registered`,sum(case when `type`=1 then 1 else 0 end) as `mehmaan`,sum(case when `type`=2 then 1 else 0 end) as `other`,(select name from venues where id=venue_id) as `venuename` from ashara_attendance where eventid=%d group by venue_id",$eventid);

$result = mysqli_query($conn, $checksql);
if (mysqli_num_rows($result) == 0) {
    http_response_code(406);
    
    die(json_encode(array("message" => "Not allowed")));
}

$data = array();
foreach ($result as $row) {
	$data['records'][] = $row;
    
}

mysqli_close($conn);
echo json_encode($data);
?>
