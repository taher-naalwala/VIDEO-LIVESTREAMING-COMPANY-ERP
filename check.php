<?php require('connectDB.php');
session_start();
if (isset($_SESSION['mobile_client'])) {
    $number = $_SESSION['number'];
    $id = $_SESSION['booking_id_client'];
    $mobile = $_SESSION['mobile_client'];
    $link=$_SESSION['actual_link'];

    $otp = $_POST['otp'];
    if ($otp == $number) {
        $sql = "UPDATE booking_info SET refund_sc=1 WHERE id=$id";
        if (mysqli_query($conn, $sql)) {
            $s2 = "SELECT its,name,mobile,date,jk_id from booking_info WHERE id=$id";
            $run2 = $conn->query($s2);
            $row2 = $run2->fetch_assoc();
            $mobile = $row2['mobile'];
            $its = $row2['its'];
            $name = $row2['name'];
            $date = $row2['date'];
            $jk_id = $row2['jk_id'];
            $s4 = "SELECT name,amount,capacity from jk_info WHERE id=$jk_id";
            $run4 = $conn->query($s4);
            $row4 = $run4->fetch_assoc();
            $jk_name = $row4['name'];
            $amount = $row4['amount'];
            $capacity = $row4['capacity'];
            $timings_id = $row2['timings_id'];
            $s6 = "SELECT label,start_time,end_time from timings WHERE id=$timings_id";
            $run6 = $conn->query($s6);
            $row6 = $run6->fetch_assoc();
            $label_name = $row6['label'];
            $start_time = $row6['start_time'];
            $end_time = $row6['end_time'];
            $whole = floor($start_time);
            $fraction = $start_time - $whole;

            if ($start_time < 12) {
                $whole = floor($start_time);
                $fraction = ($start_time - $whole) * 60;
                if ($fraction == "0") {
                    $final_start_time = $whole . ":00 AM";
                } else {
                    $final_start_time = $whole . ":" . $fraction . " AM";
                }
            } else  if ($start_time > 12) {
                $whole = floor($start_time) - 12;
                $fraction = ($start_time - ($whole + 12)) * 60;
                if ($fraction == "0") {
                    $final_start_time = $whole . ":00 PM";
                } else {
                    $final_start_time = $whole . ":" . $fraction . " PM";
                }
            } else if ($start_time == 12) {
                $whole = floor($start_time);
                $fraction = ($start_time - $whole) * 60;
                if ($fraction == "0") {
                    $final_start_time = $whole . ":00 PM";
                } else {
                    $final_start_time = $whole . ":" . $fraction . " PM";
                }
            }

            $whole_end = floor($end_time);
            $fraction_end = $end_time - $whole_end;

            if ($end_time < 12) {
                $whole_end = floor($end_time);
                $fraction_end = ($end_time - $whole_end) * 60;
                if ($fraction_end == "0") {
                    $final_end_time = $whole_end . ":00 AM";
                } else {
                    $final_end_time = $whole_end . ":" . $fraction_end . " AM";
                }
            } else  if ($end_time > 12) {
                $whole_end = floor($end_time) - 12;
                $fraction_end = ($end_time - ($whole_end + 12)) * 60;
                if ($fraction_end == "0") {
                    $final_end_time = $whole_end . ":00 PM";
                } else {
                    $final_end_time = $whole_end . ":" . $fraction_end . " PM";
                }
            } else if ($end_time == 12) {
                $whole_end = floor($end_time);
                $fraction_end = ($end_time - $whole_end) * 60;
                if ($fraction_end == "0") {
                    $final_end_time = $whole_end . ":00 PM";
                } else {
                    $final_end_time = $whole_end . ":" . $fraction_end . " PM";
                }
            }
            $msg = "Security Deposit Refunded to You..%0D%0A" . "Booking Details- %0D%0A" . "Booking ID: " . $input . "%0D%0AJamaat Khana: " . $jk_name . "%0D%0ABooking Date: " . $date . "%0D%0ATimings: " . $label_name . " (" . $final_start_time . " - " . $final_end_time . ")" . "%0D%0ARent: " . $amount . "%0D%0ACapacity: " . $capacity . " Thaals%0D%0ALaagat: " . $laagat . "%0D%0AThaals: " . $thaals . "%0D%0A%0D%0AUser Details:%0D%0AITS: " . $its . "%0D%0AName: " . $name . "%0D%0AMobile Number: " . $mobile . "%0D%0A%0D%0A";
            $final_msg = str_replace(" ", "%20", $msg);
            $url = 'http://prime.sms-excel.com/submitsms.jsp?user=aesindor&key=00a7b283abXX&mobile=+91' . $mobile . '&message=' . $final_msg . '&senderid=INFOSM&accusage=1';

            $ch = curl_init();

            // set url 
            curl_setopt($ch, CURLOPT_URL, $url);

            //return the transfer as a string 
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

            // $output contains the output string 
            $output = curl_exec($ch);


            // close curl resource to free up system resources 
            curl_close($ch);
            $_SESSION['done']=1;
            echo "<script>window.location='$link'</script>";
            $_SESSION['mobile_client']='';
            unset($_SESSION['mobile_client']);
        }
    } else {

        echo "<script>window.location='mobile_check_admin.php'</script>";
        
    }
} else {
    $number = $_SESSION['number'];
    $otp = $_POST['otp'];
	$its=$_SESSION['username'];
    if ($otp == $number) {
		$sql="UPDATE web_login SET state=1 WHERE its='$its'";
		mysqli_query($conn,$sql);
         setcookie("its_user", "11111111", time() + (4 * 60 * 60), "/");
		 setcookie("Full_Name", "Other Mauze", time() + (4 * 60 * 60), "/");
        echo "<script>window.location='online_broadcast.php'</script>";
    } else {

        echo "<script>window.location='mobile_check_admin.php'</script>";
    }
}
