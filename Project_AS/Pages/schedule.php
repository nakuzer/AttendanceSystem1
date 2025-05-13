<?php
  session_start();
  if( !isset($_SESSION['email']) ||
      !isset($_SESSION['role']) ||
      !isset($_SESSION['user_id'])
      ){
    header("Location: login.php");
    exit;
  }
    $firstName = $_SESSION['firstName'];
    $lastName = $_SESSION['lastName'];
    $user_id = $_SESSION['user_id'];
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CheckLY Schedule</title>
    <link rel="stylesheet" href="../style/nav-bar.css">
    <link rel="stylesheet" href="../style/schedule_sketch.css">
</head>

<body>
    <?php include 'template.php' ?>
    <div class="schedule-container">
        <div class="schedule-table">
            <!-- Monday -->
            <div class="schedule-column">
                <div class="day-header">Mon</div>
                <div class="class-card monday" onclick="showModal('Monday')">
                    <div class="class-code">CC100</div>
                    <div class="class-section">BSIT-1A</div>
                    <div class="class-time">8:00 - 10:00 AM</div>
                </div>
            </div>

            <!-- Tuesday -->
            <div class="schedule-column">
                <div class="day-header">Tue</div>
                <div class="class-card tuesday" onclick="showModal('Tuesday')">
                    <div class="class-code">CC100</div>
                    <div class="class-section">BSIT-1A</div>
                    <div class="class-time">8:00 - 10:00 AM</div>
                </div>
            </div>

            <!-- Wednesday -->
            <div class="schedule-column">
                <div class="day-header">Wed</div>
                <div class="class-card wednesday" onclick="showModal('Wednesday')">
                    <div class="class-code">CC100</div>
                    <div class="class-section">BSIT-1A</div>
                    <div class="class-time">8:00 - 10:00 AM</div>
                </div>
            </div>

            <!-- Thursday -->
            <div class="schedule-column">
                <div class="day-header">Thu</div>
                <div class="class-card thursday" onclick="showModal('Thursday')">
                    <div class="class-code">CC100</div>
                    <div class="class-section">BSIT-1A</div>
                    <div class="class-time">8:00 - 10:00 AM</div>
                </div>
            </div>

            <!-- Friday -->
            <div class="schedule-column">
                <div class="day-header">Fri</div>
                <div class="class-card friday" onclick="showModal('Friday')">
                    <div class="class-code">CC100</div>
                    <div class="class-section">BSIT-1A</div>
                    <div class="class-time">8:00 - 10:00 AM</div>
                </div>
            </div>

            <!-- Saturday (Example of extending to more days) -->
            <div class="schedule-column">
                <div class="day-header">Sat</div>
                <div class="class-card saturday" onclick="showModal('Saturday')">
                    <div class="class-code">IT101</div>
                    <div class="class-section">BSIT-1A</div>
                    <div class="class-time">10:30 - 12:30 PM</div>
                </div>
                <!-- Example of stacked classes on same day -->
                <div class="class-card saturday" onclick="showModal('Saturday')">
                    <div class="class-code">CS204</div>
                    <div class="class-section">BSIT-1A</div>
                    <div class="class-time">1:00 - 3:00 PM</div>
                </div>
            </div>

            <!-- Sunday (Example of extending to more days) -->
            <div class="schedule-column">
                <div class="day-header">Sun</div>
                <div class="class-card sunday" onclick="showModal('Sunday')">
                    <div class="class-code">MATH101</div>
                    <div class="class-section">BSIT-1A</div>
                    <div class="class-time">9:00 - 11:00 AM</div>
                </div>
            </div>
        </div>
    </div>
    
    <div class="modal-overlay" id="scheduleModal">
    <div class="modal-container">
        <div class="modal-header">
            <h2 class="modal-title">Class Information</h2>
            <button class="close-button" id="closeModalBtn">&times;</button>
        </div>
        
        <div class="modal-content">
            <div class="section">
                <h3 class="section-title">Class Information</h3>
                <div class="info-card">
                    <!-- Will be populated by JavaScript -->
                </div>
            </div>
            
            <div class="section">
                <h3 class="section-title">Schedule</h3>
                <!-- Will be populated by JavaScript -->
            </div>
        </div>
        
        <div class="modal-footer">
            <button class="close-btn" id="footerCloseBtn">Close</button>
        </div>
    </div>
</div>

    <div class="progress-container">
        <div class="progress-bar"></div>
    </div>

    <script src="../JavaScript/schedule.js"></script>
    <script src="../JavaScript/logout-modalclasses.js"></script>
</body>
</html>