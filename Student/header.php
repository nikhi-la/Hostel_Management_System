<header id="header" class="header d-flex align-items-center sticky-top">
    <div class="container-fluid container-xl position-relative d-flex align-items-center">

      <a href="index.html" class="logo d-flex align-items-center me-auto">
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
              <li><a href="viewAllocatedRoom.php">Your Room Preference</a></li>
            </ul>
          </li>
          <li><a href="view_add_MessPreference.php">Mess</a></li>
          <li><a href="viewAttendance.php">Attendance</a></li>
          <li class="dropdown"><a href="#"><span>Movement Log</span> <i class="bi bi-chevron-down toggle-dropdown"></i></a>
            <ul>
              <li><a href="markMovementLog.php">Movement Register</a></li>
              <li><a href="viewMovementLog.php">Movement Log</a></li>
            </ul>
          </li>
          <li class="dropdown"><a href="#"><span>Requests</span> <i class="bi bi-chevron-down toggle-dropdown"></i></a>
            <ul>
              <li><a href="leaveRequest.php">Leave Requests</a></li>
              <li><a href="roomChangeRequest.php">Room Change Request</a></li>
            </ul>
          </li>
          <li class="dropdown"><a href="#"><span>Fees</span> <i class="bi bi-chevron-down toggle-dropdown"></i></a>
            <ul>
              <li><a href="viewPreviousBills.php">Bills</a></li>
              <li><a href="payCautionDeposit.php">Caution Deposit</a></li>
            </ul>
          </li>
          <li><a href="complaint.php">Complaint</a></li>
          <li class="dropdown"><a href="#"><span>Profile</span> <i class="bi bi-chevron-down toggle-dropdown"></i></a>
            <ul>
              <li><a href="myProfile.php">My Profile</a></li>
              <li><a href="changePassword.php">Change Password</a></li>
              <li><a href="vacating.php">Vacate</a></li>
            </ul>
          </li>
        </ul>
        <i class="mobile-nav-toggle d-xl-none bi bi-list"></i>
      </nav>

      <a class="btn-getstarted" href="../Logout.php">Logout</a>

    </div>
  </header>