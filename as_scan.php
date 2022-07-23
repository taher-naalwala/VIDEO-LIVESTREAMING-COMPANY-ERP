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
$user = isset($_GET['user'])?$_GET['user']:0;
$its = isset($_GET['its'])?$_GET['its']:0;
$type = isset($_GET['type'])?$_GET['type']:0;
$venue = isset($_GET['venueid'])?$_GET['venueid']:0;
$eventid = isset($_GET['eventid'])?$_GET['eventid']:1; // if no event is sent then default general event is declared
$time = time();
if (!array_key_exists($user, $allowedPins)) {
    http_response_code(401);
    header('Content-Type: application/json');
    die(json_encode(array("message" => "Invalid User")));
}


//check if event is open
$getEventSql = sprintf("select true from ashara_event where id=%d and (starttime = 0 or starttime <= %d) and (endtime = 0 or endtime > %d) and status = 1",$eventid,$time,$time);
$result = mysqli_query($conn, $getEventSql);
if(!$result || mysqli_num_rows($result)==0){
    //return error that even it either not available or expired
    http_response_code(410);
    header('Content-Type: application/json');
    die(json_encode(array("message" => "Event not available or expired"))); 
}

//check if already scanned , if yes then send 409
$scanksql = sprintf("select venue_id from ashara_attendance where its=%d and eventid=%d",$its,$eventid);
$result = mysqli_query($conn, $scanksql);
if(mysqli_num_rows($result) > 0){
    $row = mysqli_fetch_assoc($result);
    http_response_code(409);
    header('Content-Type: application/json');
    die(json_encode(array("message" => "Already scanned",'venue'=>$row['venue_id']))); 
}


//check if its allowed
if($type == 0){
$checksql = sprintf("select true from ashara_allocation where its=%d and venue=%d and eventid=%d",$its,$venue,$eventid);

$result = mysqli_query($conn, $checksql);
if(mysqli_num_rows($result) == 0){
    http_response_code(406);
    header('Content-Type: application/json');
    die(json_encode(array("message" => "Not allowed"))); 
}
}





//if not then enter the punch  else return false

$time = time();
	$sql=sprintf("INSERT ignore INTO ashara_attendance (its,venue_id,`time`,`type`,user_id,upload_time,islive,eventid) VALUES (%d,%d,%d,%d,%d,%d,%d,%d)",
    $its,$venue,$time,$type,$user,$time,1,$eventid);
	mysqli_query($conn,$sql);
    http_response_code(200);
    header('Content-Type: application/json');
    die(json_encode(array("message" => "scan succesfull"))); 