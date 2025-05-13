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
  <title>checkLY Teacher Dashboard</title>
  <link rel="stylesheet" href="../style/nav-bar.css">
  <link rel="stylesheet" href="../style/dashboard.css">

</head>

<body>
  <?php include 'template.php' ?>

  <div class="content-area">
    <h1 class="welcome-header">Welcome, Professor Danny!</h1>

    <div class="dashboard-grid">
      <div class="main-column">
        <!-- Weekly Schedule Card -->
        <div class="card">
          <div class="schedule-container">
            <div class="day-column">
              <div class="day-header">
                <span class="day-name">Monday</span>
                <span>MON</span>
              </div>
              <div class="class-pill">IT 221</div>
            </div>

            <div class="day-column">
              <div class="day-header">
                <span class="day-name">Tuesday</span>
                <span>TUE</span>
              </div>
              <div class="class-pill">IT 221</div>
              <div class="class-pill">IT 221</div>
              <div class="class-pill">IT 221</div>
              <div class="class-pill">IT 221</div>
            </div>

            <div class="day-column">
              <div class="day-header">
                <span class="day-name">Wednesday</span>
                <span>WED</span>
              </div>
              <div class="class-pill">IT 221</div>
            </div>

            <div class="day-column">
              <div class="day-header">
                <span class="day-name">Thursday</span>
                <span>THU</span>
              </div>
              <div class="class-pill">IT 221</div>
              <div class="class-pill">IT 221</div>
            </div>

            <div class="day-column">
              <div class="day-header">
                <span class="day-name">Friday</span>
                <span>FRI</span>
              </div>
              <div class="class-pill">IT 221</div>
            </div>

            <div class="day-column">
              <div class="day-header">
                <span class="day-name">Saturday</span>
                <span>SAT</span>
              </div>
              <div class="class-pill">IT 221</div>
            </div>

            <div class="day-column">
              <div class="day-header">
                <span class="day-name">Sunday</span>
                <span>SUN</span>
              </div>
              <div class="class-pill">IT 221</div>
            </div>
          </div>
        </div>

        <!-- Classes Card -->
        <div class="card">
          <div class="card-header">
            <h2 class="card-title">Classes</h2>
            <span class="see-all">&#10095;</span>
          </div>
          <p class="subtitle">Here are your classes for the day</p>

          <table class="classes-table">
            <thead>
              <tr>
                <th>Subject Code</th>
                <th>Subject Name</th>
                <th>Section</th>
                <th>Time</th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <td>IT 221</td>
                <td>Integrative Programming</td>
                <td>BSIT-2A</td>
                <td>8:00 - 10:00 AM</td>
              </tr>
              <tr>
                <td>IT 225</td>
                <td>Application Development and Emerging Technologies</td>
                <td>BSIT-2A</td>
                <td>1:00 - 5:00 PM</td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>

      <div class="side-column">
        <!-- Calendar Card -->
        <div class="card">
          <div class="calendar-header">
            <div class="month-title">June 2021</div>
            <div class="calendar-nav">
              <span class="nav-btn">&#10094;</span>
              <span class="nav-btn">&#10095;</span>
            </div>
          </div>

          <div class="calendar-grid">
            <div class="calendar-day-header">SUN</div>
            <div class="calendar-day-header">MON</div>
            <div class="calendar-day-header">TUE</div>
            <div class="calendar-day-header">WED</div>
            <div class="calendar-day-header">THU</div>
            <div class="calendar-day-header">FRI</div>
            <div class="calendar-day-header">SAT</div>

            <!-- Week 1 -->
            <div class="calendar-day">1</div>
            <div class="calendar-day">2</div>
            <div class="calendar-day">3</div>
            <div class="calendar-day">4</div>
            <div class="calendar-day">5</div>
            <div class="calendar-day">6</div>
            <div class="calendar-day current-day">7</div>

            <!-- Week 2 -->
            <div class="calendar-day">8</div>
            <div class="calendar-day">9</div>
            <div class="calendar-day">10</div>
            <div class="calendar-day">11</div>
            <div class="calendar-day">12</div>
            <div class="calendar-day">13</div>
            <div class="calendar-day">14</div>

            <!-- Week 3 -->
            <div class="calendar-day">15</div>
            <div class="calendar-day">16</div>
            <div class="calendar-day">17</div>
            <div class="calendar-day">18</div>
            <div class="calendar-day">19</div>
            <div class="calendar-day">20</div>
            <div class="calendar-day">21</div>

            <!-- Week 4 -->
            <div class="calendar-day">22</div>
            <div class="calendar-day">23</div>
            <div class="calendar-day">24</div>
            <div class="calendar-day">25</div>
            <div class="calendar-day">26</div>
            <div class="calendar-day">27</div>
            <div class="calendar-day">28</div>

            <!-- Week 5 -->
            <div class="calendar-day">29</div>
            <div class="calendar-day">30</div>
            <div class="calendar-day"></div>
            <div class="calendar-day"></div>
            <div class="calendar-day"></div>
            <div class="calendar-day"></div>
            <div class="calendar-day"></div>
          </div>
        </div>

        <!-- Invisibles Card -->
        <div class="card" id="invisible">
          <div class="card-header">
            <h2 class="card-title">The Invisibles</h2>
          </div>
          <p class="subtitle">Student Ranking of absents</p>

          <div class="student-list">
            <div class="student-item">
              <div class="student-avatar">P</div>
              <div class="student-info">
                <div class="student-name">Pheinz Magnun</div>
                <div class="student-email">w.lawson@example.com</div>
              </div>
              <div class="absence-count">5</div>
            </div>

            <div class="student-item">
              <div class="student-avatar">M</div>
              <div class="student-info">
                <div class="student-name">Matt Axell Beltran</div>
                <div class="student-email">dat.roberts@example.com</div>
              </div>
              <div class="absence-count">5</div>
            </div>

            <div class="student-item">
              <div class="student-avatar">J</div>
              <div class="student-info">
                <div class="student-name">John Laurence Solijon</div>
                <div class="student-email">jgraham@example.com</div>
              </div>
              <div class="absence-count">3</div>
            </div>

            <div class="student-item">
              <div class="student-avatar">D</div>
              <div class="student-info">
                <div class="student-name">Dianne Russell</div>
                <div class="student-email">curtis.d@example.com</div>
              </div>
              <div class="absence-count">2</div>
            </div>

            <div class="student-item">
              <div class="student-avatar">P</div>
              <div class="student-info">
                <div class="student-name">Pheinz Magnun</div>
                <div class="student-email">w.lawson@example.com</div>
              </div>
              <div class="absence-count">5</div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <script src="../JavaScript/logout-modalclasses.js"></script>
</body>

</html>