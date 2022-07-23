<?php require('connectDB.php');
session_start();


if (isset($_GET["cityid"])) {
    $cityid = $_GET['cityid'];

    $sql = "SELECT * from mohalla WHERE cityid=$cityid";
    $run = $conn->query($sql);
    if ($run->num_rows > 0) {
        echo "<label>Mohalla</label><select class='form-control' name='mohalla_id[]' id='mohalladd' multiple required>";

        while ($row = mysqli_fetch_array($run)) {

            echo "<option value='$row[id]'>";
            echo $row['name'];
            echo "</option>";
        }
        echo "</select><br>";
    }
}

if (isset($_GET["cityid_edit"])) {
    $cityid = $_GET['cityid_edit'];

    $sql = "SELECT * from mohalla WHERE cityid=$cityid";
    $run = $conn->query($sql);
    if ($run->num_rows > 0) {
        echo "<select class='form-control' name='mohalla_id' id='mohalladd' required><option value=''>Select Mohalla</option>";

        while ($row = mysqli_fetch_array($run)) {

            echo "<option value='$row[id]'>";
            echo $row['name'];
            echo "</option>";
        }
        echo "</select><br>";
    }
}

if (isset($_GET["cityid_reg"])) {

    $cityid = $_GET['cityid_reg'];
    $sql = "SELECT * from mohalla WHERE cityid=$cityid";
    $run = $conn->query($sql);
    if ($run->num_rows > 0) {
        echo "<label>Mohalla</label><select class='form-control' name='mohalla_id' id='mohalladd_reg' onChange='change_mohalla_reg()' required>";
        echo '<option value="">Select Mohalla</option>';
        while ($row = mysqli_fetch_array($run)) {

            echo "<option value='$row[id]'>";
            echo $row['name'];
            echo "</option>";
        }
        echo "</select><br>";
    }
}

if (isset($_GET["mohallaid_reg"])) {
    $date = date('Y-m-d');
    $adminid=$_SESSION['id'];
    $mohallaid = $_GET['mohallaid_reg'];
    $sql = "SELECT * from event_mohalla WHERE mohallaid=$mohallaid";
    $run = $conn->query($sql);
    echo "<label>Event</label><select class='form-control' name='event_id'  required>";
    echo '<option value="">Select Event</option>';
    while ($row = $run->fetch_assoc()) {
      $eventid = $row['eventid'];

        $s1 = "SELECT * from event_info WHERE adminid=$adminid AND id=$eventid AND ( start_date>='$date' OR (start_date<='$date' AND end_date>='$date'))";
        $run1 = $conn->query($s1);
       
        while ($row1 = $run1->fetch_assoc()) {
            $eventname = $row1['name'];

            echo "<option value='$eventid'>";
            echo $eventname;
            echo "</option>";
        }
        
    }
    echo "</select><br>";
}

if (isset($_GET["start_date"]) ) {
   $start_date=$_GET['start_date'];
   $end_date=$_GET['end_date'];
   $adminid=$_SESSION['id'];

   echo "  <div class='form-group'><select class='form-control' name='event_id'  required>";
   echo '<option value="">Select Event</option>';
 
   

       $s1 = "SELECT * from event_info WHERE adminid=$adminid AND (start_date BETWEEN '$start_date' AND '$end_date' OR end_date BETWEEN '$start_date' AND '$end_date' )";
       $run1 = $conn->query($s1);
      
       while ($row1 = $run1->fetch_assoc()) {
           $eventname = $row1['name'];
           $eventid=$row1['id'];
           $s_date=$row1['start_date'];
           $e_date=$row1['end_date'];

           echo "<option value='$eventid'>";
           echo $eventname." (".$s_date." - ".$e_date.")";
           echo "</option>";
       }
       
   
   echo "</select></div><br>";
  
}


if (isset($_GET["mohallaid_report"])) {
    $date = date('Y-m-d');
    $mohallaid = $_GET['mohallaid_report'];
    $_SESSION['mohallaid']=$mohallaid;
    $eventid=$_SESSION['eventid'];
    $s1 = "SELECT * from reg_form WHERE event_id=$eventid AND status=1 AND mohallaid=$mohallaid";
    $run1 = $conn->query($s1);
    if ($run1->num_rows > 0) {
   echo '<table border=1 class="table"><tr><th scope="col"><input type="checkbox" id="ckbCheckAll" checked /></th><th scope="col">ITS</th><th scope="col">Name</th><th scope="col">Mobile</th><th scope="col">City</th><th scope="col">Mohalla</th><th scope="col">Reason</th></tr>';
    echo "<input type='hidden' name='eventid' value='$eventid'>";
    while ($row = $run1->fetch_assoc()) {
        $its = $row['its'];
        $name = $row['name'];
        $mobile = $row['mobile'];
        $reason = $row['reason'];
        $cityid = $row['cityid'];
        $mohallaid = $row['mohallaid'];
        $s2 = "SELECT * from city WHERE id=$cityid";
        $run2 = $conn->query($s2);
        $row2 = $run2->fetch_assoc();
        $cityname = $row2['name'];
        $s3 = "SELECT * from mohalla WHERE id=$mohallaid";
        $run3 = $conn->query($s3);
        $row3 = $run3->fetch_assoc();
        $mohallaname = $row3['name'];

        echo "<tr><td><input name='its[]' type='checkbox' class='checkBoxClass' value='$its' checked><input type='hidden' name='all_its[]' value='$its'></td><td>" . $its . '</td><td>' . $name . '</td><td>' . $mobile . '</td><td>' . $cityname . '</td><td>' . $mohallaname . '</td><td class="show-read-more" style=" max-width:400px;word-wrap:break-word;">' . $reason . '</td></tr>';
    }
    echo '</table></div></div></div>';
}
else {
    echo '<div class="alert alert-warning" role="alert">
            No Report Found
        </div>';
}
}

if (isset($_GET["its_report"])) {

    $its = $_GET['its_report'];
    $eventid=$_SESSION['eventid'];
   $mohallaid=$_GET['mohallaid'];
  

    if(empty($mohallaid))
    {
        
        $s1 = "SELECT * from reg_form WHERE event_id=$eventid AND status=1  AND its='$its'";
    $run1 = $conn->query($s1);
    if ($run1->num_rows > 0) {
   echo '<table border=1 class="table"><tr><th scope="col"><input type="checkbox" id="ckbCheckAll" checked /></th><th scope="col">ITS</th><th scope="col">Name</th><th scope="col">Mobile</th><th scope="col">City</th><th scope="col">Mohalla</th><th scope="col">Reason</th></tr>';
    echo "<input type='hidden' name='eventid' value='$eventid'>";
    while ($row = $run1->fetch_assoc()) {
        $its = $row['its'];
        $name = $row['name'];
        $mobile = $row['mobile'];
        $reason = $row['reason'];
        $cityid = $row['cityid'];
        $mohallaid = $row['mohallaid'];
        $s2 = "SELECT * from city WHERE id=$cityid";
        $run2 = $conn->query($s2);
        $row2 = $run2->fetch_assoc();
        $cityname = $row2['name'];
        $s3 = "SELECT * from mohalla WHERE id=$mohallaid";
        $run3 = $conn->query($s3);
        $row3 = $run3->fetch_assoc();
        $mohallaname = $row3['name'];

        echo "<tr><td><input name='its[]' type='checkbox' class='checkBoxClass' value='$its' checked><input type='hidden' name='all_its[]' value='$its'></td><td>" . $its . '</td><td>' . $name . '</td><td>' . $mobile . '</td><td>' . $cityname . '</td><td>' . $mohallaname . '</td><td class="show-read-more" style=" max-width:400px;word-wrap:break-word;">' . $reason . '</td></tr>';
    }
    echo '</table></div></div></div>'; 
    }
    else {
        echo '<div class="alert alert-warning" role="alert">
                No Report Found
            </div>';
    }
}
    else
    {
      
    $s1 = "SELECT * from reg_form WHERE event_id=$eventid AND status=1 AND mohallaid=$mohallaid AND its='$its'";
    $run1 = $conn->query($s1);
    if ($run1->num_rows > 0) {
   echo '<table border=1 class="table"><tr><th scope="col"><input type="checkbox" id="ckbCheckAll" checked /></th><th scope="col">ITS</th><th scope="col">Name</th><th scope="col">Mobile</th><th scope="col">City</th><th scope="col">Mohalla</th><th scope="col">Reason</th></tr>';
    echo "<input type='hidden' name='eventid' value='$eventid'>";
    while ($row = $run1->fetch_assoc()) {
        $its = $row['its'];
        $name = $row['name'];
        $mobile = $row['mobile'];
        $reason = $row['reason'];
        $cityid = $row['cityid'];
        $mohallaid = $row['mohallaid'];
        $s2 = "SELECT * from city WHERE id=$cityid";
        $run2 = $conn->query($s2);
        $row2 = $run2->fetch_assoc();
        $cityname = $row2['name'];
        $s3 = "SELECT * from mohalla WHERE id=$mohallaid";
        $run3 = $conn->query($s3);
        $row3 = $run3->fetch_assoc();
        $mohallaname = $row3['name'];

        echo "<tr><td><input name='its[]' type='checkbox' class='checkBoxClass' value='$its' checked><input type='hidden' name='all_its[]' value='$its'></td><td>" . $its . '</td><td>' . $name . '</td><td>' . $mobile . '</td><td>' . $cityname . '</td><td>' . $mohallaname . '</td><td class="show-read-more" style=" max-width:400px;word-wrap:break-word;">' . $reason . '</td></tr>';
    }
    echo '</table></div></div></div>';
}
else {
    echo '<div class="alert alert-warning" role="alert">
            No Report Found
        </div>';
}
    }
    
}


if (isset($_GET["its_empty"])) {
    $eventid=$_SESSION['eventid'];
    $mohallaid=$_GET['mohallaid'];
    if(empty($mohallaid))
    {
    $s1 = "SELECT * from reg_form WHERE event_id=$eventid AND status=1";
    $run1 = $conn->query($s1);
    if ($run1->num_rows > 0) {
   echo '<table border=1 class="table"><tr><th scope="col"><input type="checkbox" id="ckbCheckAll" checked /></th><th scope="col">ITS</th><th scope="col">Name</th><th scope="col">Mobile</th><th scope="col">City</th><th scope="col">Mohalla</th><th scope="col">Reason</th></tr>';
    echo "<input type='hidden' name='eventid' value='$eventid'>";
    while ($row = $run1->fetch_assoc()) {
        $its = $row['its'];
        $name = $row['name'];
        $mobile = $row['mobile'];
        $reason = $row['reason'];
        $cityid = $row['cityid'];
        $mohallaid = $row['mohallaid'];
        $s2 = "SELECT * from city WHERE id=$cityid";
        $run2 = $conn->query($s2);
        $row2 = $run2->fetch_assoc();
        $cityname = $row2['name'];
        $s3 = "SELECT * from mohalla WHERE id=$mohallaid";
        $run3 = $conn->query($s3);
        $row3 = $run3->fetch_assoc();
        $mohallaname = $row3['name'];

        echo "<tr><td><input name='its[]' type='checkbox' class='checkBoxClass' value='$its' checked><input type='hidden' name='all_its[]' value='$its'></td><td>" . $its . '</td><td>' . $name . '</td><td>' . $mobile . '</td><td>' . $cityname . '</td><td>' . $mohallaname . '</td><td class="show-read-more" style=" max-width:400px;word-wrap:break-word;">' . $reason . '</td></tr>';
    }
    echo '</table></div></div></div>';
}
else {
    echo '<div class="alert alert-warning" role="alert">
            No Report Found
        </div>';
}
}
else
{
    $s1 = "SELECT * from reg_form WHERE event_id=$eventid AND mohallaid=$mohallaid AND status=1";
    $run1 = $conn->query($s1);
    if ($run1->num_rows > 0) {
   echo '<table border=1 class="table"><tr><th scope="col"><input type="checkbox" id="ckbCheckAll" checked /></th><th scope="col">ITS</th><th scope="col">Name</th><th scope="col">Mobile</th><th scope="col">City</th><th scope="col">Mohalla</th><th scope="col">Reason</th></tr>';
    echo "<input type='hidden' name='eventid' value='$eventid'>";
    while ($row = $run1->fetch_assoc()) {
        $its = $row['its'];
        $name = $row['name'];
        $mobile = $row['mobile'];
        $reason = $row['reason'];
        $cityid = $row['cityid'];
        $mohallaid = $row['mohallaid'];
        $s2 = "SELECT * from city WHERE id=$cityid";
        $run2 = $conn->query($s2);
        $row2 = $run2->fetch_assoc();
        $cityname = $row2['name'];
        $s3 = "SELECT * from mohalla WHERE id=$mohallaid";
        $run3 = $conn->query($s3);
        $row3 = $run3->fetch_assoc();
        $mohallaname = $row3['name'];

        echo "<tr><td><input name='its[]' type='checkbox' class='checkBoxClass' value='$its' checked><input type='hidden' name='all_its[]' value='$its'></td><td>" . $its . '</td><td>' . $name . '</td><td>' . $mobile . '</td><td>' . $cityname . '</td><td>' . $mohallaname . '</td><td class="show-read-more" style=" max-width:400px;word-wrap:break-word;">' . $reason . '</td></tr>';
    }
    echo '</table></div></div></div>';
}
else {
    echo '<div class="alert alert-warning" role="alert">
            No Report Found
        </div>';
}
}
}



if (isset($_GET["mohallaid_report_app"])) {
    $date = date('Y-m-d');
    $mohallaid = $_GET['mohallaid_report_app'];
   
    $eventid=$_SESSION['eventid'];
    $s1 = "SELECT * from reg_form WHERE event_id=$eventid AND status=2 AND mohallaid=$mohallaid";
    $run1 = $conn->query($s1);
    if ($run1->num_rows > 0) {
   echo '<table border=1 class="table"><tr><th scope="col">ITS</th><th scope="col">Name</th><th scope="col">Mobile</th><th scope="col">City</th><th scope="col">Mohalla</th><th scope="col">Reason</th></tr>';
    echo "<input type='hidden' name='eventid' value='$eventid'>";
    while ($row = $run1->fetch_assoc()) {
        $its = $row['its'];
        $name = $row['name'];
        $mobile = $row['mobile'];
        $reason = $row['reason'];
        $cityid = $row['cityid'];
        $mohallaid = $row['mohallaid'];
        $s2 = "SELECT * from city WHERE id=$cityid";
        $run2 = $conn->query($s2);
        $row2 = $run2->fetch_assoc();
        $cityname = $row2['name'];
        $s3 = "SELECT * from mohalla WHERE id=$mohallaid";
        $run3 = $conn->query($s3);
        $row3 = $run3->fetch_assoc();
        $mohallaname = $row3['name'];

        echo "<tr><td>" . $its . '</td><td>' . $name . '</td><td>' . $mobile . '</td><td>' . $cityname . '</td><td>' . $mohallaname . '</td><td class="show-read-more" style=" max-width:400px;word-wrap:break-word;">' . $reason . '</td></tr>';
    }
    echo '</table></div></div></div>';
}
else {
    echo '<div class="alert alert-warning" role="alert">
            No Report Found
        </div>';
}
}

if (isset($_GET["its_report_app"])) {

    $its = $_GET['its_report_app'];
    $eventid=$_SESSION['eventid'];
    $mohallaid=$_GET['mohallaid'];
    if(empty($mohallaid))
    {
        $s1 = "SELECT * from reg_form WHERE event_id=$eventid AND status=2  AND its='$its'";
    $run1 = $conn->query($s1);
    if ($run1->num_rows > 0) {
   echo '<table border=1 class="table"><tr><th scope="col">ITS</th><th scope="col">Name</th><th scope="col">Mobile</th><th scope="col">City</th><th scope="col">Mohalla</th><th scope="col">Reason</th></tr>';
    echo "<input type='hidden' name='eventid' value='$eventid'>";
    while ($row = $run1->fetch_assoc()) {
        $its = $row['its'];
        $name = $row['name'];
        $mobile = $row['mobile'];
        $reason = $row['reason'];
        $cityid = $row['cityid'];
        $mohallaid = $row['mohallaid'];
        $s2 = "SELECT * from city WHERE id=$cityid";
        $run2 = $conn->query($s2);
        $row2 = $run2->fetch_assoc();
        $cityname = $row2['name'];
        $s3 = "SELECT * from mohalla WHERE id=$mohallaid";
        $run3 = $conn->query($s3);
        $row3 = $run3->fetch_assoc();
        $mohallaname = $row3['name'];

        echo "<tr><td>" . $its . '</td><td>' . $name . '</td><td>' . $mobile . '</td><td>' . $cityname . '</td><td>' . $mohallaname . '</td><td class="show-read-more" style=" max-width:400px;word-wrap:break-word;">' . $reason . '</td></tr>';
    }
    echo '</table></div></div></div>'; 
    }
    else {
        echo '<div class="alert alert-warning" role="alert">
                No Report Found
            </div>';
    }
}
    else
    {
       
    $s1 = "SELECT * from reg_form WHERE event_id=$eventid AND status=2 AND mohallaid=$mohallaid AND its='$its'";
    $run1 = $conn->query($s1);
    if ($run1->num_rows > 0) {
   echo '<table border=1 class="table"><tr><th scope="col">ITS</th><th scope="col">Name</th><th scope="col">Mobile</th><th scope="col">City</th><th scope="col">Mohalla</th><th scope="col">Reason</th></tr>';
    echo "<input type='hidden' name='eventid' value='$eventid'>";
    while ($row = $run1->fetch_assoc()) {
        $its = $row['its'];
        $name = $row['name'];
        $mobile = $row['mobile'];
        $reason = $row['reason'];
        $cityid = $row['cityid'];
        $mohallaid = $row['mohallaid'];
        $s2 = "SELECT * from city WHERE id=$cityid";
        $run2 = $conn->query($s2);
        $row2 = $run2->fetch_assoc();
        $cityname = $row2['name'];
        $s3 = "SELECT * from mohalla WHERE id=$mohallaid";
        $run3 = $conn->query($s3);
        $row3 = $run3->fetch_assoc();
        $mohallaname = $row3['name'];

        echo "<tr><td>" . $its . '</td><td>' . $name . '</td><td>' . $mobile . '</td><td>' . $cityname . '</td><td>' . $mohallaname . '</td><td class="show-read-more" style=" max-width:400px;word-wrap:break-word;">' . $reason . '</td></tr>';
    }
    echo '</table></div></div></div>';
}
else {
    echo '<div class="alert alert-warning" role="alert">
            No Report Found
        </div>';
}
    }
    
}


if (isset($_GET["its_empty_app"])) {
    $eventid=$_SESSION['eventid'];
    $mohallaid=$_GET['mohallaid'];
    if(empty($mohallaid))
    {
    $s1 = "SELECT * from reg_form WHERE event_id=$eventid AND status=2";
    $run1 = $conn->query($s1);
    if ($run1->num_rows > 0) {
   echo '<table border=1 class="table"><tr><th scope="col">ITS</th><th scope="col">Name</th><th scope="col">Mobile</th><th scope="col">City</th><th scope="col">Mohalla</th><th scope="col">Reason</th></tr>';
    echo "<input type='hidden' name='eventid' value='$eventid'>";
    while ($row = $run1->fetch_assoc()) {
        $its = $row['its'];
        $name = $row['name'];
        $mobile = $row['mobile'];
        $reason = $row['reason'];
        $cityid = $row['cityid'];
        $mohallaid = $row['mohallaid'];
        $s2 = "SELECT * from city WHERE id=$cityid";
        $run2 = $conn->query($s2);
        $row2 = $run2->fetch_assoc();
        $cityname = $row2['name'];
        $s3 = "SELECT * from mohalla WHERE id=$mohallaid";
        $run3 = $conn->query($s3);
        $row3 = $run3->fetch_assoc();
        $mohallaname = $row3['name'];

        echo "<tr><td>" . $its . '</td><td>' . $name . '</td><td>' . $mobile . '</td><td>' . $cityname . '</td><td>' . $mohallaname . '</td><td class="show-read-more" style=" max-width:400px;word-wrap:break-word;">' . $reason . '</td></tr>';
    }
    echo '</table></div></div></div>';
}
else {
    echo '<div class="alert alert-warning" role="alert">
            No Report Found
        </div>';
}
}
else
{
    $s1 = "SELECT * from reg_form WHERE event_id=$eventid AND mohallaid=$mohallaid AND status=2";
    $run1 = $conn->query($s1);
    if ($run1->num_rows > 0) {
   echo '<table border=1 class="table"><tr><th scope="col">ITS</th><th scope="col">Name</th><th scope="col">Mobile</th><th scope="col">City</th><th scope="col">Mohalla</th><th scope="col">Reason</th></tr>';
    echo "<input type='hidden' name='eventid' value='$eventid'>";
    while ($row = $run1->fetch_assoc()) {
        $its = $row['its'];
        $name = $row['name'];
        $mobile = $row['mobile'];
        $reason = $row['reason'];
        $cityid = $row['cityid'];
        $mohallaid = $row['mohallaid'];
        $s2 = "SELECT * from city WHERE id=$cityid";
        $run2 = $conn->query($s2);
        $row2 = $run2->fetch_assoc();
        $cityname = $row2['name'];
        $s3 = "SELECT * from mohalla WHERE id=$mohallaid";
        $run3 = $conn->query($s3);
        $row3 = $run3->fetch_assoc();
        $mohallaname = $row3['name'];

        echo "<tr><td>" . $its . '</td><td>' . $name . '</td><td>' . $mobile . '</td><td>' . $cityname . '</td><td>' . $mohallaname . '</td><td class="show-read-more" style=" max-width:400px;word-wrap:break-word;">' . $reason . '</td></tr>';
    }
    echo '</table></div></div></div>';
}
else {
    echo '<div class="alert alert-warning" role="alert">
            No Report Found
        </div>';
}
}
}



// DENIED

if (isset($_GET["mohallaid_report_denied"])) {
    $date = date('Y-m-d');
    $mohallaid = $_GET['mohallaid_report_denied'];

    $eventid=$_SESSION['eventid'];
    $s1 = "SELECT * from reg_form WHERE event_id=$eventid AND status=0 AND mohallaid=$mohallaid";
    $run1 = $conn->query($s1);
    if ($run1->num_rows > 0) {
   echo '<table border=1 class="table"><tr><th scope="col">ITS</th><th scope="col">Name</th><th scope="col">Mobile</th><th scope="col">City</th><th scope="col">Mohalla</th><th scope="col">Reason</th></tr>';
    echo "<input type='hidden' name='eventid' value='$eventid'>";
    while ($row = $run1->fetch_assoc()) {
        $its = $row['its'];
        $name = $row['name'];
        $mobile = $row['mobile'];
        $reason = $row['reason'];
        $cityid = $row['cityid'];
        $mohallaid = $row['mohallaid'];
        $s2 = "SELECT * from city WHERE id=$cityid";
        $run2 = $conn->query($s2);
        $row2 = $run2->fetch_assoc();
        $cityname = $row2['name'];
        $s3 = "SELECT * from mohalla WHERE id=$mohallaid";
        $run3 = $conn->query($s3);
        $row3 = $run3->fetch_assoc();
        $mohallaname = $row3['name'];

        echo "<tr><td>" . $its . '</td><td>' . $name . '</td><td>' . $mobile . '</td><td>' . $cityname . '</td><td>' . $mohallaname . '</td><td class="show-read-more" style=" max-width:400px;word-wrap:break-word;">' . $reason . '</td></tr>';
    }
    echo '</table></div></div></div>';
}
else {
    echo '<div class="alert alert-warning" role="alert">
            No Report Found
        </div>';
}
}

if (isset($_GET["its_report_denied"])) {

    $its = $_GET['its_report_denied'];
    $eventid=$_SESSION['eventid'];
    $mohallaid=$_GET['mohallaid'];

    if(empty($mohallaid))
    {
        $s1 = "SELECT * from reg_form WHERE event_id=$eventid AND status=0  AND its='$its'";
    $run1 = $conn->query($s1);
    if ($run1->num_rows > 0) {
   echo '<table border=1 class="table"><tr><th scope="col">ITS</th><th scope="col">Name</th><th scope="col">Mobile</th><th scope="col">City</th><th scope="col">Mohalla</th><th scope="col">Reason</th></tr>';
    echo "<input type='hidden' name='eventid' value='$eventid'>";
    while ($row = $run1->fetch_assoc()) {
        $its = $row['its'];
        $name = $row['name'];
        $mobile = $row['mobile'];
        $reason = $row['reason'];
        $cityid = $row['cityid'];
        $mohallaid = $row['mohallaid'];
        $s2 = "SELECT * from city WHERE id=$cityid";
        $run2 = $conn->query($s2);
        $row2 = $run2->fetch_assoc();
        $cityname = $row2['name'];
        $s3 = "SELECT * from mohalla WHERE id=$mohallaid";
        $run3 = $conn->query($s3);
        $row3 = $run3->fetch_assoc();
        $mohallaname = $row3['name'];

        echo "<tr><td>" . $its . '</td><td>' . $name . '</td><td>' . $mobile . '</td><td>' . $cityname . '</td><td>' . $mohallaname . '</td><td class="show-read-more" style=" max-width:400px;word-wrap:break-word;">' . $reason . '</td></tr>';
    }
    echo '</table></div></div></div>'; 
    }
    else {
        echo '<div class="alert alert-warning" role="alert">
                No Report Found
            </div>';
    }
}
    else
    {
        
    $s1 = "SELECT * from reg_form WHERE event_id=$eventid AND status=0 AND mohallaid=$mohallaid AND its='$its'";
    $run1 = $conn->query($s1);
    if ($run1->num_rows > 0) {
   echo '<table border=1 class="table"><tr><th scope="col">ITS</th><th scope="col">Name</th><th scope="col">Mobile</th><th scope="col">City</th><th scope="col">Mohalla</th><th scope="col">Reason</th></tr>';
    echo "<input type='hidden' name='eventid' value='$eventid'>";
    while ($row = $run1->fetch_assoc()) {
        $its = $row['its'];
        $name = $row['name'];
        $mobile = $row['mobile'];
        $reason = $row['reason'];
        $cityid = $row['cityid'];
        $mohallaid = $row['mohallaid'];
        $s2 = "SELECT * from city WHERE id=$cityid";
        $run2 = $conn->query($s2);
        $row2 = $run2->fetch_assoc();
        $cityname = $row2['name'];
        $s3 = "SELECT * from mohalla WHERE id=$mohallaid";
        $run3 = $conn->query($s3);
        $row3 = $run3->fetch_assoc();
        $mohallaname = $row3['name'];

        echo "<tr><td>" . $its . '</td><td>' . $name . '</td><td>' . $mobile . '</td><td>' . $cityname . '</td><td>' . $mohallaname . '</td><td class="show-read-more" style=" max-width:400px;word-wrap:break-word;">' . $reason . '</td></tr>';
    }
    echo '</table></div></div></div>';
}
else {
    echo '<div class="alert alert-warning" role="alert">
            No Report Found
        </div>';
}
    }
    
}


if (isset($_GET["its_empty_denied"])) {
    $eventid=$_SESSION['eventid'];
    $mohallaid=$_GET['mohallaid'];
    if(empty($mohallaid))
    {
    $s1 = "SELECT * from reg_form WHERE event_id=$eventid AND status=0";
    $run1 = $conn->query($s1);
    if ($run1->num_rows > 0) {
   echo '<table border=1 class="table"><tr><th scope="col">ITS</th><th scope="col">Name</th><th scope="col">Mobile</th><th scope="col">City</th><th scope="col">Mohalla</th><th scope="col">Reason</th></tr>';
    echo "<input type='hidden' name='eventid' value='$eventid'>";
    while ($row = $run1->fetch_assoc()) {
        $its = $row['its'];
        $name = $row['name'];
        $mobile = $row['mobile'];
        $reason = $row['reason'];
        $cityid = $row['cityid'];
        $mohallaid = $row['mohallaid'];
        $s2 = "SELECT * from city WHERE id=$cityid";
        $run2 = $conn->query($s2);
        $row2 = $run2->fetch_assoc();
        $cityname = $row2['name'];
        $s3 = "SELECT * from mohalla WHERE id=$mohallaid";
        $run3 = $conn->query($s3);
        $row3 = $run3->fetch_assoc();
        $mohallaname = $row3['name'];

        echo "<tr><td>" . $its . '</td><td>' . $name . '</td><td>' . $mobile . '</td><td>' . $cityname . '</td><td>' . $mohallaname . '</td><td class="show-read-more" style=" max-width:400px;word-wrap:break-word;">' . $reason . '</td></tr>';
    }
    echo '</table></div></div></div>';
}
else {
    echo '<div class="alert alert-warning" role="alert">
            No Report Found
        </div>';
}
}
else
{
    $s1 = "SELECT * from reg_form WHERE event_id=$eventid AND mohallaid=$mohallaid AND status=0";
    $run1 = $conn->query($s1);
    if ($run1->num_rows > 0) {
   echo '<table border=1 class="table"><tr><th scope="col">ITS</th><th scope="col">Name</th><th scope="col">Mobile</th><th scope="col">City</th><th scope="col">Mohalla</th><th scope="col">Reason</th></tr>';
    echo "<input type='hidden' name='eventid' value='$eventid'>";
    while ($row = $run1->fetch_assoc()) {
        $its = $row['its'];
        $name = $row['name'];
        $mobile = $row['mobile'];
        $reason = $row['reason'];
        $cityid = $row['cityid'];
        $mohallaid = $row['mohallaid'];
        $s2 = "SELECT * from city WHERE id=$cityid";
        $run2 = $conn->query($s2);
        $row2 = $run2->fetch_assoc();
        $cityname = $row2['name'];
        $s3 = "SELECT * from mohalla WHERE id=$mohallaid";
        $run3 = $conn->query($s3);
        $row3 = $run3->fetch_assoc();
        $mohallaname = $row3['name'];

        echo "<tr><td>" . $its . '</td><td>' . $name . '</td><td>' . $mobile . '</td><td>' . $cityname . '</td><td>' . $mohallaname . '</td><td class="show-read-more" style=" max-width:400px;word-wrap:break-word;">' . $reason . '</td></tr>';
    }
    echo '</table></div></div></div>';
}
else {
    echo '<div class="alert alert-warning" role="alert">
            No Report Found
        </div>';
}
}
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>

</body>
</html>