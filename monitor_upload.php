<?php
$string="30349223a130349221a2";
$lastPos = 0;
$positions = array();
while (($lastPos = strpos($string, "a", $lastPos))!== false) {
   $positions[] = $lastPos;
    $lastPos = $lastPos + strlen("a");
}

foreach ($positions as $value) {
    echo "ITS -".substr($string,$value-8,8);
	
}

?>