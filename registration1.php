<?php require('connectDB.php');
                    if (isset($_POST['addreg'])) {
                        $its = $_POST['its'];
                        $mobile = $_POST['mobile'];
                        if (strlen($its) == 8 && strlen($mobile)==10) {
                            $eventid = $_POST['event_id'];
                            $name = $_POST['name'];
                            $cityid=$_POST['cityid_reg'];
                            $mohallaid=$_POST['mohalla_id'];
                            
                            $reason = $_POST['reason'];
                            $sql = "SELECT * from reg_form WHERE its='$its' AND event_id=$eventid";
                            $run = $conn->query($sql);
                            if ($run->num_rows > 0) {
                                $row=$run->fetch_assoc();
                                $status=$row['status'];
                                if($status==0)
                                {
                                    echo '<div id="forms" class="alert alert-danger mt-2">
                                Registration Cancelled By Admin
                                </div>';
                                  

                                }
                               else if($status==1)
                               {
                                echo '<div id="forms" class="alert alert-danger mt-2">
                        Registration already in Process
                        </div>';
                               }
                               else
                               {
                                echo '<div id="forms" class="alert alert-success mt-2">
                                Already Registered
                                </div>';
                               }
                            } else {
                                $s1 = "INSERT INTO reg_form VALUES ('','$its','$name','$mobile',$cityid,$mohallaid,'$reason',$eventid,1,'','')";
                                if (mysqli_query($conn, $s1)) {
                                    echo '<div id="forms" class="alert alert-success mt-2">
                            ITS Submitted.. Registration in process
                            </div>';
                                } else {
                                    echo '<div id="forms" class="alert alert-danger mt-2">
                           Fail
                            </div>';
                                }
                            }
                        } else {
                            if(strlen($its)!=8)
                            {
                            echo '<div id="forms" class="alert alert-danger mt-2">
                        Invalid ITS
                        </div>';
                            }
                            if(strlen($mobile)!=10)
                            {
                            echo '<div id="forms" class="alert alert-danger mt-2">
                        Invalid Mobile Number
                        </div>';
                            }
                           

                        }
                    }

                    ?>


<!DOCTYPE html>
<html lang="en">

<head>

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <style>
        /* make sidebar nav vertical */
        @media (min-width: 768px) {
            #dashboard {
                margin-left: 90px;
            }

            #maincard {
                width: 300px;
                height: 300px;
            }

            #innercard {
                width: 250px;
                height: 150px;
            }


            .nav-item {
                margin-left: 20px;
            }


            #first_card {
                margin-left: 10px;
            }

            #last_card {
                margin-right: 10px;
            }

            #forms {
                margin-left: 10px;
                width: 50%;
                margin: 0 auto;
                /* Added */
                float: none;
                /* Added */
                margin-bottom: 10px;
                /* Added */
            }

            #report_forms {
                margin-left: 10px;
                width: 70%;
                margin: 0 auto;
                /* Added */
                float: none;
                /* Added */
                margin-bottom: 10px;
                /* Added */
            }
        }


        .card-header {
            background-color: #52658F;
            color: white
        }

        .btn {
            background-color: #52658F;
            color: white
        }

        body {
            background-color: #EFEFEF
        }
    </style>


</head>

<body style="background-color:#EFEFEF">

    <div class="mt-2">

        <div class="card" id="forms">
            <div class="card-header" style="background-color: #52658F;color:white">
                <h3>Registration Form</h3>
            </div>
            <div class="card-body" style="background-color: #F7F5E6;">
                <form method="POST">

                    <div class=" form-group"><label>City</label> <select class="form-control" name="cityid_reg" id="citydd_reg" onChange="change_city_reg()" required>
                            <option value=''>Select City</option>
                            <?php require('connectDB.php');
                            $sql1 = "SELECT * FROM city";
                            $results = $conn->query($sql1);
                            while ($rs = $results->fetch_assoc()) {
                                $cityid = $rs['id'];

                                $cityname = $rs['name'];
                            ?>
                                <option value="<?php echo $cityid ?>"><?php echo $cityname; ?></option>
                            <?php
                            }
                            ?>
                        </select>


                    </div>

                    <div id="mohalla">
                        <div class="form-group">
                            <label>Mohalla</label> <select class="form-control" required>
                                <option value=''>Select Mohalla</option>
                            </select>
                        </div>

                    </div>

                    <div id="event">
                        <div class="form-group">
                            <label>Event</label> <select class="form-control" required>
                                <option value=''>Select Event</option>
                            </select>
                        </div>

                    </div>
                    <div class="form-group"><label>ITS</label> <input type="number" maxlength="8" class="form-control" placeholder="Enter Your ITS" name="its" required>
                    </div>
                    <div class="form-group"><label>Name</label> <input type="text" class="form-control" placeholder="Enter Your Full Name" name="name" required>
                    </div>
                    <div class="form-group"><label>Mobile Number</label> <input type="number" class="form-control" placeholder="Enter Your Mobile Number" name="mobile" required>
                    </div>

                    <div class="form-group"><label>Reason</label> <textarea type="text" class="form-control" placeholder="Enter Your Reason" name="reason" required></textarea>
                    </div>
                    <button name="addreg" value="Add" class=" btn  btn-block ">Submit</button>

                    
                </form>

            </div>
        </div>
    </div>


    <script src="select.js"></script>
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js" integrity="sha384-wHAiFfRlMFy6i5SRaxvfOCifBUQy1xHdJ/yoi7FRNXMRBu5WHdZYu1hA6ZOblgut" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>

</body>

</html>