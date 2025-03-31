<nav class="sidebar sidebar-offcanvas" id="sidebar">
          <ul class="nav">
            <li class="nav-item nav-category">Main</li>
            <li class="nav-item">
              <a class="nav-link" href="index.php">
                <span class="icon-bg"><i class="mdi mdi-cube menu-icon"></i></span>
                <span class="menu-title">Dashboard</span>
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="basicLayout.php">
                <span class="menu-title">Basic Details</span>
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" data-toggle="collapse" href="#ui-room" aria-expanded="false" aria-controls="ui-room">
                <span class="menu-title">Rooms</span>
                <i class="menu-arrow"></i>
              </a>
              <div class="collapse" id="ui-room">
                <ul class="nav flex-column sub-menu">    
                <li class="nav-item"> <a class="nav-link" href="addRoomType.php">Add Room Type</a></li>
                  <li class="nav-item"> <a class="nav-link" href="addRoomDetails.php">Add Rooms</a></li>
                  <li class="nav-item"> <a class="nav-link" href="viewRoomDetails.php">View Rooms</a></li>
                  <li class="nav-item"> <a class="nav-link" href="viewRoompreference.php">Room Preference</a></li>
                </ul>
              </div>
            </li>
            <li class="nav-item">
              <a class="nav-link" data-toggle="collapse" href="#ui-mess" aria-expanded="false" aria-controls="ui-mess">
                <span class="menu-title">Mess</span>
                <i class="menu-arrow"></i>
              </a>
              <div class="collapse" id="ui-mess">
                <ul class="nav flex-column sub-menu">
                  <li class="nav-item"> <a class="nav-link" href="addMessItems.php">Add Mess</a></li>
                  <li class="nav-item"> <a class="nav-link" href="viewMessItems.php">View Mess</a></li>
                </ul>
              </div>
            </li>
            <li class="nav-item">
              <a class="nav-link" data-toggle="collapse" href="#ui-request" aria-expanded="false" aria-controls="ui-request">
                <span class="menu-title">Requests</span>
                <i class="menu-arrow"></i>
              </a>
              <div class="collapse" id="ui-request">
                <ul class="nav flex-column sub-menu">
                  <li class="nav-item"> <a class="nav-link" href="viewRoomChangeRequest.php">Room Change Request</a></li>
                  <li class="nav-item"> <a class="nav-link" href="viewLeaveRequest.php">Leave Request</a></li>
                </ul>
              </div>
            </li>
            <li class="nav-item">
              <a class="nav-link" data-toggle="collapse" href="#ui-student" aria-expanded="false" aria-controls="ui-student">
                <span class="menu-title">Student</span>
                <i class="menu-arrow"></i>
              </a>
              <div class="collapse" id="ui-student">
                <ul class="nav flex-column sub-menu">
                  <li class="nav-item"> <a class="nav-link" href="studentList.php">Student List</a></li>
                  <li class="nav-item"> <a class="nav-link" href="viewRoomPreference.php">Room Preference</a></li>
                </ul>
              </div>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="viewGuardianList.php">
                <span class="menu-title">Guardian</span>
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" data-toggle="collapse" href="#ui-attendance" aria-expanded="false" aria-controls="ui-attendance">
                <span class="menu-title">Attendance</span>
                <i class="menu-arrow"></i>
              </a>
              <div class="collapse" id="ui-attendance">
                <ul class="nav flex-column sub-menu">
                  <li class="nav-item"> <a class="nav-link" href="markAttendance.php">Mark Attendance</a></li>
                  <li class="nav-item"> <a class="nav-link" href="viewAttendance.php">View Attendance</a></li>
                </ul>
              </div>
            </li>

            <li class="nav-item">
              <a class="nav-link" href="viewMovementLog.php">
                <span class="menu-title">Movement Log</span>
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" data-toggle="collapse" href="#ui-fees" aria-expanded="false" aria-controls="ui-fees">
                <span class="menu-title">Fees</span>
                <i class="menu-arrow"></i>
              </a>
              <div class="collapse" id="ui-fees">
                <ul class="nav flex-column sub-menu">
                  <li class="nav-item"> <a class="nav-link" href="addMessFee.php">Add MessFee</a></li>
                  <li class="nav-item"> <a class="nav-link" href="viewHostelRent.php">Assign Hostel Rent</a></li>
                  <li class="nav-item"> <a class="nav-link" href="viewFees.php">View Payments</a></li>
                  <li class="nav-item"> <a class="nav-link" href="viewCautionDeposits.php">View Caution Deposits</a></li>
                </ul>
              </div>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="viewComplaint.php">
                <span class="menu-title">Complaint</span>
              </a>
            </li>

            <li class="nav-item">
              <a class="nav-link" data-toggle="collapse" href="#ui-vacate" aria-expanded="false" aria-controls="ui-vacate">
                <span class="menu-title">Vacate</span>
                <i class="menu-arrow"></i>
              </a>
              <div class="collapse" id="ui-vacate">
                <ul class="nav flex-column sub-menu">
                  <li class="nav-item"> <a class="nav-link" href="removeStudent.php">Remove Student</a></li>
                  <li class="nav-item"> <a class="nav-link" href="viewVacatedStudentList.php">Vacated Students</a></li>
                </ul>
              </div>
            </li>     
          
            <li class="nav-item sidebar-user-actions">
              <div class="user-details">
                <div class="d-flex justify-content-between align-items-center">
                  <div>
                    <div class="d-flex align-items-center">
                      
                     
                    </div>
                  </div>
                </div>
              </div>
            </li>

            <li class="nav-item sidebar-user-actions">
              <div class="sidebar-user-menu">
                <a href="../Logout.php" class="nav-link"><i class="mdi mdi-logout menu-icon"></i>
                  <span class="menu-title">Log Out</span></a>
              </div>
            </li>
          </ul>
        </nav>