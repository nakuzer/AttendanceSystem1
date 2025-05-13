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
  <title>checkLY - Classes</title>
  <link rel="stylesheet" href="../style/nav-bar.css">
  <link rel="stylesheet" href="../style/classes.css ">
  <link rel="stylesheet" href="../style/create-class-modal.css">
</head>

<body>
  <nav class="nav-bar">
    <div class="checkLY">
      check<span>LY</span>
      <div>

        <div class="profile">
          <div>
            <h3><?php echo htmlspecialchars($firstName . ' ' . $lastName) ?> </h3>
            <h4>Teacher</h4>
          </div>
          <img src="../images/Profilepic.png" alt="" height="35">
        </div>
  </nav>
  <aside class="sidebar-menu">
    <ul class="main-btns">
      <li>
        <a href="dashboard.php"><img src="../images/dashboardIcon.png" alt="" height="20"> Dashboard</a>
      </li>
    </ul>
    <div class="work-btns">
      <h3>
        Work
      </h3>
      <ul>
        <li>
          <a href="classes.php"><img src="../images/classesIcon.png" alt="" height="25">
            <div>Classes</div>
          </a>
        </li>
        <li>
          <a href="schedule.php"><img src="../images/scheduleIcon.png" alt="" height="25">
            <div>Schedule</div>
          </a>
        </li>
      </ul>
    </div>
    <ul class="util-btns">
      <li>
        <!-- THIS ONE, DONT FORGET
        <a href="#"><img src="../images/settings.png" alt="" height="18">
          Settings
        </a>
      </li>
      <li> -->
        <a id="logout"><img src="../images/Logout.png" alt="" height="18">
          Log Out
        </a>
      </li>
    </ul>
  </aside>
  <div class="logout-modal-overlay">
    <div class="logout-modal">
      <h2>Log Out</h2>
      <p>Are you sure you want to log out?</p>
      <div class="logout-btns">
        <button id="logout-no">No</button>
        <button id="logout-yes">Yes</button>
      </div>
    </div>
  </div>

  <div class="classes-content">
    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px;">
      <h2>CLASSES</h2>
      <button class="add-button">
        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
          <line x1="12" y1="5" x2="12" y2="19"></line>
          <line x1="5" y1="12" x2="19" y2="12"></line>
        </svg>
        Add
      </button>
    </div>
    <table class="classes-table">
      <thead>
        <tr>
          <th>Section</th>
          <th>Subject Name</th>
          <th>Subject Code</th>
          <th>Time</th>
          <th>Days</th>
          <th>Students</th>
        </tr>
      </thead>
      <tbody id="classes-list">
        <!-- Dynamic content will go here -->
      </tbody>
    </table>
  </div>

  <div class="modal-overlay">
    <div class="modal">
      <div class="modal-header">
        <h2 class="modal-title">Create Class</h2>
        <button class="close-button">✕</button>
      </div>

      <form id="create-class-form">
        <div class="form-group">
          <input type="text" class="form-control" id="subjectName" placeholder="Subject Name">
        </div>

        <div class="form-group">
          <input type="text" class="form-control" id="subjectCode" placeholder="Subject Code">
        </div>

        <div class="form-group">
          <input type="text" class="form-control" id="section" placeholder="Section">
        </div>

        <div class="form-group">
          <label class="schedule-label">Schedule</label>
          <div class="time-selector">
            <div class="time-container">
              <input type="time" class="time-input" id="startTime" placeholder="--:-- --">
            </div>
            <span class="arrow">→</span>
            <div class="time-container">
              <input type="time" class="time-input" id="endTime" value="">
            </div>
          </div>
        </div>

        <div class="days">
          <!-- Use checkboxes or hidden inputs updated via JS -->
          <input type="hidden" name="days" id="selected-days">
          <button type="button" data-day="MON" class="day-button">MON</button>
          <button type="button" data-day="TUE" class="day-button">TUE</button>
          <button type="button" data-day="WED" class="day-button">WED</button>
          <button type="button" data-day="THU" class="day-button">THU</button>
          <button type="button" data-day="FRI" class="day-button">FRI</button>
          <button type="button" data-day="SAT" class="day-button">SAT</button>
          <button type="button" data-day="SUN" class="day-button">SUN</button>
        </div>

        <div class="create-button-container">
          <button type="submit" class="create-button">Create</button>
        </div>
      </form>
    </div>
  </div>

  <script src="../JavaScript/createclass_modal.js"></script>
  <script src="../JavaScript/class_render.js"> </script>
  <script src="../JavaScript/logout-modalclasses.js"></script>
</body>

</html>