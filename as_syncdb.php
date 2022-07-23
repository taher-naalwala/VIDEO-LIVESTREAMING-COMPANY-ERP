<?php
/*
* this is to sync allocation to db
*/
require('connectDB.php');
//load csv
$eventid = isset($_GET['eventid'])?$_GET['eventid']:1;
echo $eventid;

$file = dirname(__FILE__) . "/store/synclist/".$eventid.".csv";
if (($handle = fopen($file, 'r')) === false) {
    http_response_code(500);
    header('Content-Type: application/json');
    die(json_encode(array("message" => "no file available")));
}

$headers = fgetcsv($handle, 1024, ',');
$complete = array();

while ($row = fgetcsv($handle, 1024, ',')) {
    $q = sprintf("replace into ashara_allocation (`its`,`venue`,eventid) values (%d,%d,%d)",$row[0],$row[1],$eventid);
    
    if(mysqli_query($conn,$q)){
        echo $row[0]." has been allocated venue ".$row[1]."<br>";
    }else{
        echo "<span style=\"color:red\">".$row[0]." failed allocation to venue ".$row[1]."</span>";
    }
    flush();
    ob_flush();
}

fclose($handle);
