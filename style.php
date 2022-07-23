<html>
<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

  <!-- Sidebar - Brand -->
  <a class="sidebar-brand d-flex align-items-center justify-content-center" href="main.php">
    <div class="sidebar-brand-icon rotate-n-15">

    </div>
    <div class="sidebar-brand-text mx-3">Relay</div>
  </a>

  <!-- Divider -->
  <hr class="sidebar-divider my-0">

  <!-- Nav Item - Dashboard -->
  <li class="nav-item active">
    <a class="nav-link" href="main.php">
      <i class="fas fa-fw fa-tachometer-alt"></i>
      <span>Dashboard</span></a>
  </li>


  <!-- Divider -->
  <hr class="sidebar-divider">

  <!-- Heading -->
  <div class="sidebar-heading">
    Powers
  </div>


  <?php
  $forms_access = $_SESSION['forms_access'];

  if (in_array("1", $forms_access) || in_array("2", $forms_access) || in_array("3", $forms_access) || in_array("4", $forms_access)) {

  ?>

    <!-- Nav Item - Pages Collapse Menu -->
    <li class="nav-item">
      <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo">
        <i class="fas fa-calendar-week"></i>
        <span>Event</span>
      </a>
      <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
        <div class="bg-white py-2 collapse-inner rounded">
          <h6 class="collapse-header">Event Powers:</h6>
          <?php


          foreach ($forms_access as $formid) {
          ?>


            <?php
            if ($formid == "2" || $formid == "1") {
            ?>
              <a class="collapse-item" href="add.php?name=Event">Add</a>
            <?php
            }
            ?>
            <?php
            if ($formid == "3" || $formid == "1") {
            ?>
              <a class="collapse-item" href="edit.php?name=Event">Edit</a>
            <?php
            }
            ?>
            <?php
            if ($formid == "4" || $formid == "1") {
            ?>
              <a class="collapse-item" href="remove.php?name=Event">Remove</a>
          <?php
            }
          }
          ?>



        </div>
      </div>
    </li>

  <?php
  }
  ?>


  <?php
  if (in_array("9", $forms_access) || in_array("10", $forms_access) || in_array("11", $forms_access) || in_array("30", $forms_access)) {

  ?>

    <!-- Nav Item - Utilities Collapse Menu -->
    <li class="nav-item">
      <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseUtilities" aria-expanded="true" aria-controls="collapseUtilities">
        <i class="fas fa-user"></i>
        <span>Member</span>
      </a>
      <div id="collapseUtilities" class="collapse" aria-labelledby="headingUtilities" data-parent="#accordionSidebar">
        <div class="bg-white py-2 collapse-inner rounded">
          <h6 class="collapse-header">Member Powers:</h6>
          <?php
          $forms_access = $_SESSION['forms_access'];


          foreach ($forms_access as $formid) {
          ?>


            <?php
            if ($formid == "10" || $formid == "9") {
            ?>
              <a class="collapse-item" href="add.php?name=Member">Add</a>
            <?php
            }
            ?>
            <?php
            if ($formid == "11" || $formid == "9") {
            ?>
              <a class="collapse-item" href="edit.php?name=Member">Edit</a>
            <?php
            }
            if ($formid == "30" || $formid == "9") {
              ?>
                <a class="collapse-item" href="add.php?name=Bulk Members">Bulk Add</a>
              <?php
              }
              if ($formid == "31" || $formid == "9") {
                ?>
                  <a class="collapse-item" href="add.php?name=Renew">Renew</a>
                <?php
                }
            ?>

          <?php

          }
          ?>


        </div>
      </div>
    </li>
  <?php
  }
  ?>

  <?php
  if (in_array("17", $forms_access) || in_array("18", $forms_access) || in_array("19", $forms_access) || in_array("20", $forms_access)) {

  ?>
    <!-- Nav Item - Utilities Collapse Menu -->
    <li class="nav-item">
      <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseUtilities1" aria-expanded="true" aria-controls="collapseUtilities1">
        <i class="fas fa-city"></i>
        <span>City</span>
      </a>
      <div id="collapseUtilities1" class="collapse" aria-labelledby="headingUtilities1" data-parent="#accordionSidebar">
        <div class="bg-white py-2 collapse-inner rounded">
          <h6 class="collapse-header">City Powers:</h6>
          <?php
          $forms_access = $_SESSION['forms_access'];


          foreach ($forms_access as $formid) {
          ?>


            <?php
            if ($formid == "18" || $formid == "17") {
            ?>
              <a class="collapse-item" href="add.php?name=City">Add</a>
            <?php
            }
            ?>
            <?php
            if ($formid == "19" || $formid == "17") {
            ?>
              <a class="collapse-item" href="edit.php?name=City">Edit</a>
            <?php
            }
            ?>
            <?php
            if ($formid == "20" || $formid == "17") {
            ?>
              <a class="collapse-item" href="remove.php?name=City">Remove</a>
            <?php
            }
            ?>

          <?php

          }
          ?>

        </div>
      </div>
    </li>
  <?php
  }
  ?>

  <?php
  if (in_array("21", $forms_access) || in_array("22", $forms_access) || in_array("23", $forms_access) || in_array("24", $forms_access)) {

  ?>

    <!-- Nav Item - Utilities Collapse Menu -->
    <li class="nav-item">
      <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseUtilities2" aria-expanded="true" aria-controls="collapseUtilities2">
        <i class="fas fa-map-marker"></i>
        <span>Mohalla</span>
      </a>
      <div id="collapseUtilities2" class="collapse" aria-labelledby="headingUtilities2" data-parent="#accordionSidebar">
        <div class="bg-white py-2 collapse-inner rounded">
          <h6 class="collapse-header">Mohalla Powers:</h6>
          <?php
          $forms_access = $_SESSION['forms_access'];


          foreach ($forms_access as $formid) {
          ?>


            <?php
            if ($formid == "22" || $formid == "21") {
            ?>
              <a class="collapse-item" href="add.php?name=Mohalla">Add</a>
            <?php
            }
            ?>
            <?php
            if ($formid == "23" || $formid == "21") {
            ?>
              <a class="collapse-item" href="edit.php?name=Mohalla">Edit</a>
            <?php
            }
            ?>
            <?php
            if ($formid == "24" || $formid == "21") {
            ?>
              <a class="collapse-item" href="remove.php?name=Mohalla">Remove</a>
            <?php
            }
            ?>

          <?php

          }
          ?>

        </div>
      </div>
    </li>

  <?php
  }
  ?>

  <?php
  if (in_array("13", $forms_access) || in_array("14", $forms_access) || in_array("15", $forms_access) || in_array("16", $forms_access)) {

  ?>
    <!-- Nav Item - Utilities Collapse Menu -->
    <li class="nav-item">
      <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseUtilities3" aria-expanded="true" aria-controls="collapseUtilities3">
        <i class="fas fa-key"></i>
        <span>Access</span>
      </a>
      <div id="collapseUtilities3" class="collapse" aria-labelledby="headingUtilities3" data-parent="#accordionSidebar">
        <div class="bg-white py-2 collapse-inner rounded">
          <h6 class="collapse-header">Access Powers:</h6>
          <?php
          $forms_access = $_SESSION['forms_access'];


          foreach ($forms_access as $formid) {
          ?>


            <?php
            if ($formid == "14" || $formid == "13") {
            ?>
              <a class="collapse-item" href="add.php?name=Access">Add</a>
            <?php
            }
            ?>
            <?php
            if ($formid == "15" || $formid == "13") {
            ?>
              <a class="collapse-item" href="edit.php?name=Access">Edit</a>
            <?php
            }
            ?>
            <?php
            if ($formid == "16" || $formid == "13") {
            ?>
              <a class="collapse-item" href="remove.php?name=Access">Remove</a>
          <?php
            }
          }
          ?>

        </div>
      </div>
    </li>

  <?php
  }
  ?>

  <?php
  if (in_array("5", $forms_access) || in_array("6", $forms_access) || in_array("7", $forms_access) || in_array("8", $forms_access)) {

  ?>

    <!-- Nav Item - Utilities Collapse Menu -->
    <li class="nav-item">
      <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseUtilities4" aria-expanded="true" aria-controls="collapseUtilities4">
        <i class="far fa-file-alt"></i>
        <span>Report</span>
      </a>
      <div id="collapseUtilities4" class="collapse" aria-labelledby="headingUtilities4" data-parent="#accordionSidebar">
        <div class="bg-white py-2 collapse-inner rounded">
          <h6 class="collapse-header">Report Powers:</h6>
          <?php
          $forms_access = $_SESSION['forms_access'];


          foreach ($forms_access as $formid) {
          ?>


            <?php
            if ($formid == "6" || $formid == "5") {
            ?>
              <a class="collapse-item" href="report.php?name=Pending">Pending</a>
            <?php
            }
            ?>
            <?php
            if ($formid == "7" || $formid == "5") {
            ?>
              <a class="collapse-item" href="report.php?name=Event">Event</a>
            <?php
            }
            ?>

            <?php
            if ($formid == "8" || $formid == "5") {
            ?>
              <a class="collapse-item" href="report.php?name=Member">Member</a>
            <?php
            }
            ?>
          <?php

          }
          ?>

        </div>
      </div>
    </li>

  <?php
  }
  ?>

  <!-- Divider -->
  <hr class="sidebar-divider">



  <!-- Nav Item - Charts -->
  <li class="nav-item">
    <a class="nav-link" href="logout.php">
      <i class="fas fa-sign-out-alt"></i>
      <span>LogOut</span></a>
  </li>



  <!-- Divider -->
  <hr class="sidebar-divider d-none d-md-block">

  <!-- Sidebar Toggler (Sidebar) -->
  <div class="text-center d-none d-md-inline">
    <button class="rounded-circle border-0" id="sidebarToggle"></button>
  </div>

</ul>
<!-- End of Sidebar -->

<!-- Content Wrapper -->
<div id="content-wrapper" class="d-flex flex-column">
  <!-- Main Content -->
  <div id="content">
    <!-- Topbar -->
    <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

      <!-- Sidebar Toggle (Topbar) -->
      <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
        <i class="fa fa-bars"></i>
      </button>

      <!-- Topbar Search -->
      <form method="GET" action="12umoorreport.php">


      </form>



      <ul class="navbar-nav ml-auto">





        <div class="topbar-divider d-none d-sm-block"></div>


        <a class="nav-link">
          <span class="mr-2 d-none d-lg-inline text-gray-600 small"><?php echo $_SESSION['Full_Name']  ?></span>
        </a>


      </ul>

    </nav>

</html>