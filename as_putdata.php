<?php
require('connectDB.php');
$userfile = dirname(__FILE__) . "/store/users.csv";
if (($uhandle = fopen($userfile, 'r')) === false) {
    http_response_code(500);
    header('Content-Type: application/json');
    die(json_encode(array("message" => "no file available")));
}
//build pins
$uheaders = fgetcsv($uhandle, 1024, ',');
while ($users = fgetcsv($uhandle, 1024, ',')) {
    
    $allowedPins[$users[1]] = ['venue'=>$users[0]];
}

require('connectDB.php');

function isJson($string) {
    json_decode($string);
    return (json_last_error() == JSON_ERROR_NONE);
   }

//get request from user
$data = file_get_contents('php://input'); 
// insert request

if(!isJson($data)){
    http_response_code(417);
    header('Content-Type: application/json');
    die(json_encode(array("message" => "invalid json")));
}

$rd = json_decode($data,true);
//check if json 

$records = $rd['records'];
$userID = $rd['its'];
if (!array_key_exists($userID, $allowedPins)) {
    http_response_code(401);
    header('Content-Type: application/json');
    die(json_encode(array("message" => "Invalid User")));
}
//set some variable
$day = date('Y-m-d');

//INSERT EACH RECORD IN records key to database 
//its,venueid,time,mehman,others
foreach($records as $rec){
    $time = time();
    //check if eventid is sent
    if(!isset($rec['eventID'])){
        $rec['eventID']=1; 
    }
	$sql=sprintf("INSERT ignore INTO ashara_attendance (its,venue_id,`time`,`type`,user_id,upload_time,eventid) VALUES (%d,%d,%d,%d,%d,%d,%d)",
    $rec['its'],$rec['venue'],$rec['time'],$rec['type'],$userID,$time,$rec['eventID']);
	if(!mysqli_query($conn,$sql)){
//error andexit
http_response_code(500);
    header('Content-Type: application/json');
    die(json_encode(array("message" => "unable to enter records")));
    }
}
header('Content-Type: application/json');
echo json_encode(array("message"=>"uploaded succesfully"));
