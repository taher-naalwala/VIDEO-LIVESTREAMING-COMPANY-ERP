<?php
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


//$allowedPins = [30341645=>["venue"=>1],30341402=>["venue"=>2]];

//get request from user
$userID = $_GET['userID'];
if (!array_key_exists($userID, $allowedPins)) {
    http_response_code(401);
    header('Content-Type: application/json');
    die(json_encode(array("message" => "Invalid User")));
}

//all good lets give him the data
//readfile(dirname(__FILE__)."/store/list.json");
//check if event is available
$eventid = isset($_GET['eventid'])?$_GET['eventid']:1;

//if event is no event
if($eventid == 12){
    http_response_code(401);
    header('Content-Type: application/json');
    die(json_encode(array("message" => "Invalid Event")));
}

$file = dirname(__FILE__) . "/store/eventallocation/".$eventid.".csv";
if (($handle = fopen($file, 'r')) === false) {
    http_response_code(500);
    header('Content-Type: application/json');
    die(json_encode(array("message" => "no file available")));
}

$headers = fgetcsv($handle, 1024, ',');
$complete = array();

while ($row = fgetcsv($handle, 1024, ',')) {
    $complete[] = array_combine($headers, $row);
}

fclose($handle);

$output = array("records" => $complete,"venue"=>$allowedPins[$userID]['venue']);
echo json_encode($output);
