<?php
session_start();
  if(!isset($_SESSION["user_id"]) || ($_SESSION["user_type"]=="warden"))
  {
    ?>
      <header id="header" class="header d-flex align-items-center sticky-top">
    <div class="container-fluid container-xl position-relative d-flex align-items-center">

      <a href="../index.php" class="logo d-flex align-items-center me-auto">
        <!-- Uncomment the line below if you also wish to use an image logo -->
        <!-- <img src="assets/img/logo.png" alt=""> -->
        <h1 class="sitename">HMS</h1>
      </a>

      <nav id="navmenu" class="navmenu">
        <ul>
          <li><a href="../index.php" >Home</a></li>
          <li class="dropdown"><a href="#"><span>Rooms</span> <i class="bi bi-chevron-down toggle-dropdown"></i></a>
            <ul>
              <li><a href="../Guest/basicRoomDetails.php">Room Shares</a></li>
              <li><a href="../Guest/viewRoomDetails.php">View Rooms</a></li>
            </ul>
          </li>
          <li><a href="newStudent.php" style="color:green;"><b>Register</b></a></li>
        </ul>
        <i class="mobile-nav-toggle d-xl-none bi bi-list"></i>
      </nav>
      
      <a class="btn-getstarted" href="../Login.php">Login</a>

    </div>
  </header>
    <?php
  }
  else if(isset($_SESSION["user_id"]) && ($_SESSION["user_type"]=="student")){
    ?>
      <header id="header" class="header d-flex align-items-center sticky-top">
    <div class="container-fluid container-xl position-relative d-flex align-items-center">

      <a href="../index.php" class="logo d-flex align-items-center me-auto">
        <!-- Uncomment the line below if you also wish to use an image logo -->
        <!-- <img src="assets/img/logo.png" alt=""> -->
        <h1 class="sitename">HMS</h1>
      </a>

      <nav id="navmenu" class="navmenu">
        <ul>
          <li><a href="../index.php" >Home</a></li>
          <li class="dropdown"><a href="#"><span>Rooms</span> <i class="bi bi-chevron-down toggle-dropdown"></i></a>
            <ul>
              <li><a href="basicRoomDetails.php">Room Shares</a></li>
              <li><a href="viewRoomDetails.php">View Rooms</a></li>
              <li><a href="../Student/viewAllocatedRoom.php">Your Room Preference</a></li>
            </ul>
          </li>
          <li><a href="../Student/view_add_MessPreference.php">Mess</a></li>
          <li><a href="../Student/viewAttendance.php">Attendance</a></li>
          <li class="dropdown"><a href="#"><span>Movement Log</span> <i class="bi bi-chevron-down toggle-dropdown"></i></a>
            <ul>
              <li><a href="../Student/markMovementLog.php">Movement Register</a></li>
              <li><a href="../Student/viewMovementLog.php">Movement Log</a></li>
            </ul>
          </li>
          <li class="dropdown"><a href="#"><span>Requests</span> <i class="bi bi-chevron-down toggle-dropdown"></i></a>
            <ul>
              <li><a href="../Student/leaveRequest.php">Leave Requests</a></li>
              <li><a href="../Student/roomChangeRequest.php">Room Change Request</a></li>
            </ul>
          </li>
          <li class="dropdown"><a href="#"><span>Fees</span> <i class="bi bi-chevron-down toggle-dropdown"></i></a>
            <ul>
              <li><a href="../Student/billSummary.php">For This Month</a></li>
              <li><a href="../Student/viewPreviousBills.php">Previous Bills</a></li>
            </ul>
          </li>
          <li><a href="../Student/complaint.php">Complaint</a></li>
          <li class="dropdown"><a href="#"><span>Profile</span> <i class="bi bi-chevron-down toggle-dropdown"></i></a>
            <ul>
              <li><a href="../Student/myProfile.php">My Profile</a></li>
              <li><a href="#">Change Password</a></li>
            </ul>
          </li>
        </ul>
        <i class="mobile-nav-toggle d-xl-none bi bi-list"></i>
      </nav>

      <a class="btn-getstarted" href="../Logout.php">Logout</a>

    </div>
  </header>
    <?php
  }else{
    ?>
      <header id="header" class="header d-flex align-items-center sticky-top">
    <div class="container-fluid container-xl position-relative d-flex align-items-center">

      <a href="../index.php" class="logo d-flex align-items-center me-auto">
        <!-- Uncomment the line below if you also wish to use an image logo -->
        <!-- <img src="assets/img/logo.png" alt=""> -->
        <h1 class="sitename">HMS</h1>
      </a>

      <nav id="navmenu" class="navmenu">
        <ul>
          <li><a href="../index.php" >Home</a></li>
          <li><a href="viewAllocatedRoom.php">View Room Preference</a></li>
          <li><a href="viewAttendance.php">Attendance</a></li>
          <li><a href="viewMovementLog.php">Movement Log</a></li>
          <li><a href="viewLeaveRequest.php">Leaves</a></li>
          
          <li class="dropdown"><a href="#"><span>Fees</span> <i class="bi bi-chevron-down toggle-dropdown"></i></a>
            <ul>
              <li><a href="billSummary.php">For This Month</a></li>
              <li><a href="viewPreviousBills.php">Previous Bills</a></li>
            </ul>
          </li>
          <li><a href="complaint.php">Complaint</a></li>
          <li class="dropdown"><a href="#"><span>Profile</span> <i class="bi bi-chevron-down toggle-dropdown"></i></a>
            <ul>
              <li><a href="Student/myProfile.php">My Profile</a></li>
              <li><a href="#">Change Password</a></li>
            </ul>
          </li>
        </ul>
        <i class="mobile-nav-toggle d-xl-none bi bi-list"></i>
      </nav>

      <a class="btn-getstarted" href="Logout.php">Logout</a>

    </div>
  </header>
    <?php
  }
?>