<?php
// No need for session_start() here, as it was already called in dashboard.php
$firstName = isset($_SESSION['firstName']) ? $_SESSION['firstName'] : 'Guest';
$lastName = isset($_SESSION['lastName']) ? $_SESSION['lastName'] : '';
$user_id = isset($_SESSION['user_id']) ? $_SESSION['user_id'] : '';
// Now you can use $firstName and $lastName in your template
?>

<nav class="nav-bar">
  <div class="checkLY">
    check<span>LY</span>
    <div>

      <div class="profile">
        <div>
          <h3><?php echo htmlspecialchars($firstName . ' ' . $lastName);?> </h3>
          <h4>Teacher</h4>
        </div>
        <img src="../images/DannyJunior.jpg" alt="" height="35" style="border-radius: 20px;">
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
    <!-- <li>
        <a href=""><img src="../images/settings.png" alt="" height="18">
          Settings
        </a>
      </li>  -->

    <li>
      <a href="aboutus.php?id=<?php echo $user_id?>"><img src="../images/settings.png" alt="" height="18">
        About
      </a>
    </li>
    <li>
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