<?php require('connectDB.php');
$its=$_GET['its'];
$sql="SELECT COUNT(*) as c from monitor_ashara WHERE its='$its'";
$run=$conn->query($sql);
$row=$run->fetch_assoc();
$c=$row['c'];
if($c>0)
{
	echo "Success";
}
else
{
	echo $its;
}

?>