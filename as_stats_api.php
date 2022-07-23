<?php
header('Content-Type: application/json');
$eventid = $_GET['eventid'];
require('connectDB.php');
$checksql = sprintf("select venue_id,count(*) as `total`,(select name from venues where id=venue_id) as `venuename` from ashara_attendance where eventid=%d group by venue_id order by total desc",$eventid);
$result = mysqli_query($conn, $checksql);
if (mysqli_num_rows($result) == 0) {
    http_response_code(406);
    
    die(json_encode(array("message" => "Not allowed")));
}

$data = array();
foreach ($result as $row) {
	$data[] = $row;
}

mysqli_close($conn);
echo json_encode($data);
?>
