<?php
require('connectDB.php');
//get eventid
$eventid = isset($_GET['eventid'])?$_GET['eventid']:1;
$query = sprintf("select its,venue,eventid from ashara_allocation where eventid=%d",$eventid);
$result = mysqli_query($conn,$query);

$num_fields = mysqli_num_fields($result);
$headers = array();
for ($i = 0; $i < $num_fields; $i++) {
    $headers[] = mysqli_fetch_field_direct($result , $i)->name;
}

$file = dirname(__FILE__) . "/store/eventallocation/".$eventid.".csv";

$fp = fopen($file, 'w');
if ($fp && $result) {
   
    fputcsv($fp, $headers);
    while ($row = $result->fetch_array(MYSQLI_NUM)) {
        fputcsv($fp, array_values($row));
    }
}

echo json_encode(array("message"=>"all data written to ".$file));