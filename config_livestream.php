<?php
session_start();
if (isset($_SESSION['its'])) {
    $adminid = $_SESSION['id'];
  
        $forms_access = $_SESSION['forms_access'];
        $flag = 0;
        foreach ($forms_access as $formid) {
            if ($formid == "28" || $formid == "25") {
                $flag = 1;
            }
        }
        if ($flag == 0) {
            header('Location:main.php');
            exit();
        }
    
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/jquery/latest/jquery.min.js"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <script src="https://use.fontawesome.com/3582a84b00.js"></script>
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="css/sb-admin-2.min.css" rel="stylesheet">

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        .btn-block {
            background-color: #4e73df;
        }

        .btn {
            color: #fff;
        }

        .razorpay-payment-button {
            color: #fff;
            background-color: #4e73df;
            border-radius: 3px;
            margin-bottom: 10px;
            margin-left: 10px;
        }
    </style>
    <title><?php echo $_GET['userid'] ?></title>
</head>

<body id="page-top">
    <div id="wrapper">
        <?php
        require('style.php');
        ?>
        <div class="container-fluid">
            <!-- DataTales Example -->
            <div class="card shadow mb-4">

                <div class="card-body">
                    <?php require('connectDB.php');
                    $userid = $_GET['userid'];
                    $sql = "SELECT name from web_login WHERE id=$userid";
                    $run = $conn->query($sql);
                    $row = $run->fetch_assoc();
                 $name = $row['name'];
                    date_default_timezone_set('Asia/Kolkata');
                    $date = date('Y-m-d');
                    $s1 = "SELECT * from event_info WHERE adminid=$userid AND (start_date>='$date'  )";
                    $run1 = $conn->query($s1);
                    if ($run1->num_rows > 0) {
                        while ($row1 = $run1->fetch_assoc()) {
                            echo   "<br>" . $event_name = $row1['name'] . "<br>";
                            echo   $embed_code = $row1['embed_code'] . "<br>";
                            echo  $start_date = $row1['start_date'] . "<br>";
                            echo  $end_date = $row1['end_date'] . "<br>";
                            echo  $start_time = $row1['start_time'] . "<br>";
                            echo  $end_time = $row1['end_time'] . "<br>";
                        }
                    ?>
                        <form method="POST">
                            <div class="form-group">
                                <label>Server URL</label>
                                <textarea name="server_url" class="form-control"></textarea>
                            </div>
                            <div class="form-group">
                                <label>Stream Key</label>
                                <textarea name="stream_key" class="form-control"></textarea>
                            </div>
                            <div class="form-group">
                                <label>Embed Code</label>
                                <textarea name="embed_code" class="form-control"></textarea>
                            </div>
                            <button name="submit" value="sub" class="btn btn-primary">Submit</button>
                            <?php
                            if (isset($_POST['submit'])) {
                                $server_url=$_POST['server_url'];
                                $stream_key=$_POST['stream_key'];
                                $embcode=$_POST['embed_code'];
                                $adminid=$_GET['userid'];
                                $sql="UPDATE livestream SET stream_url='$stream_key',server_key='$server_url' WHERE userid=$userid";
                                if(mysqli_query($conn,$sql))
                                {
                                    $s1="UPDATE event_info SET embed_code='$embcode' WHERE adminid=$userid";
                                    if(mysqli_query($conn,$s1))
                                    {
                                        echo "Success";
                                    }
                                }
                            }
                            ?>
                        </form>
                    <?php }
                    ?>
                </div>
            </div>
        </div>
    </div>
    <script src="js/sb-admin-2.min.js"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js" integrity="sha384-wHAiFfRlMFy6i5SRaxvfOCifBUQy1xHdJ/yoi7FRNXMRBu5WHdZYu1hA6ZOblgut" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>

</body>

</html>