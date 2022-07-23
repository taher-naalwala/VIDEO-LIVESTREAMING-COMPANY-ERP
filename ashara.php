<?php

$html =$_POST['its'];
$needle = "a";
$lastPos = 0;
$its= array();

date_default_timezone_set("Asia/Kolkata");


$date = date('Y-m-d');
$year= date('Y');
$f_time = date("h:i:sa");

list($hour, $minute, $second) = explode(':', $f_time);
$state = substr($second, -2);

$timel;



require('connectDB.php');

if ($state == "am") {
  $timel;
  if ($hour == 12) {
    $timel = ($minute / 60);
  } else {
    $timel = ($hour) + ($minute / 60);
  }


  if (((($timel >= (11)) && ($timel <= (11 + 4))) || (($timel >= (11)) && ($timel <= (11 + 4))))) {


while (($lastPos = strpos($html, $needle, $lastPos))!== false) {
    $its[] = substr($html,$lastPos-8,8);
	
    $lastPos = $lastPos + strlen($needle);
	
}
$flag=0;
foreach($its as $value){
	  $sql = "SELECT id from event_info WHERE '$date' BETWEEN start_date AND end_date ";
        $run = $conn->query($sql);
       
        if ($run->num_rows > 0) {
            
			 while ($row = $run->fetch_assoc()) {
                $eventid = $row['id'];
				 $s1 = " SELECT COUNT(*) as c from reg_form WHERE its='$value' AND status='2' AND event_id=$eventid";

                $run1 = $conn->query($s1);
                $row1_0 = $run1->fetch_assoc();
                $c = $row1_0['c'];
                if ($c > 0) {

					$sub_timel = substr($timel, 0, 4);
                        $s1 = "UPDATE reg_form SET time='$sub_timel',date='$date' WHERE its='$value' AND event_id=$eventid AND status='2'";
                        if(mysqli_query($conn, $s1))
						{
							$flag=1;
						}
						else
						{
							$flag=0;
							break;
						}
						
				}
				
			 }
		}
	
}

if($flag==1)
{
	echo "Success";
}
else
{
	echo "Fail";
}
  }
}
else {
  $timel;
  if ($hour == 12) {
    $timel = ($hour) + ($minute / 60);
  } else {
    $timel = ($hour + 12) + ($minute / 60);
  }

  if (((($timel >= (11)) && ($timel <= (11 + 4))) || (($timel >= (11)) && ($timel <= (11 + 4))))) {
	  
while (($lastPos = strpos($html, $needle, $lastPos))!== false) {
    $its[] = substr($html,$lastPos-8,8);
	
    $lastPos = $lastPos + strlen($needle);
	
}
$flag=0;
foreach($its as $value){
	  $sql = "SELECT id from event_info WHERE '$date' BETWEEN start_date AND end_date ";
        $run = $conn->query($sql);
        $flag = 0;
        if ($run->num_rows > 0) {
            
			 while ($row = $run->fetch_assoc()) {
                $eventid = $row['id'];
				 $s1 = " SELECT COUNT(*) as c from reg_form WHERE its='$value' AND status='2' AND event_id=$eventid";

                $run1 = $conn->query($s1);
                $row1_0 = $run1->fetch_assoc();
                $c = $row1_0['c'];
                if ($c > 0) {

					$sub_timel = substr($timel, 0, 4);
                        $s1 = "UPDATE reg_form SET time='$sub_timel',date='$date' WHERE its='$value' AND event_id=$eventid AND status='2'";
                        mysqli_query($conn, $s1);
						$flag=1;
				}
				
			 }
		}
	
}

if($flag==1)
{
	echo "Success";
}
else
{
	echo "Fail";
}
  }
}
?>