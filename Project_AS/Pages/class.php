<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>checkLY</title>
    <link rel="stylesheet" href="../style/nav-bar.css">
    <link rel="stylesheet" href="../style/class.css">

</head>

<body>
    <?php include 'template.php' ?>

    <div class="container">
        <div class="class-header">
            <div class="header-section">
                <div class="class-details">
                    <div class="class-id">IT 221</div>
                    <div class="class-section">BSIT - 2C</div>
                </div>

                <div class="class-divider"></div>

                <div class="class-info">
                    <h2>Application Development</h2>
                    <div class="class-schedule">
                        11:30 AM <span class="arrow-icon">→</span> 1:00 PM
                    </div>
                    <div class="class-days">MON/TUE/WED</div>
                </div>
            </div>

            <div class="header-section">
                <div class="class-code">
                    <h2>Class Code</h2>
                    <a href="#" class="code-link">2xc456</a>
                </div>

                <div style="margin-left: 20px;">
                    <div class="menu-dots">
                        <div class="dot"></div>
                        <div class="dot"></div>
                        <div class="dot"></div>
                    </div>
                </div>
            </div>
        </div>

        <div class="content-section">
            <div class="search-bar">
                <button id="saveBtn" class="save-btn">SAVE</button>

                <div class="search-input">
                    <span class="search-icon">
                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <circle cx="11" cy="11" r="8" stroke="currentColor" stroke-width="2" />
                            <path d="M21 21l-4.35-4.35" stroke="currentColor" stroke-width="2" stroke-linecap="round" />
                        </svg>
                    </span>
                    <input type="text" placeholder="Type to search">
                </div>

                <div class="info-icon">i</div>
            </div>

            <table class="student-table">
                <thead>
                    <tr>
                        <th style="width: 30%;">Name</th>
                        <th style="width: 20%;">Student ID</th>
                        <th style="width: 40%;">Email</th>
                        <th style="width: 10%;">Status</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>Angeles, Mathew T.</td>
                        <td>2023-00218</td>
                        <td>hz202300218@wmsuedu.ph</td>
                        <td>
                            <div class="status-indicator status-absent"></div>
                        </td>
                    </tr>
                    <tr>
                        <td>Balimbingan, Hannah Jean T.</td>
                        <td>2023-00218</td>
                        <td>hz202300218@wmsuedu.ph</td>
                        <td>
                            <div class="status-indicator status-present"></div>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
    <script src="../JavaScript/logout-modalclasses.js"></script>
    <script src="../JavaScript/class.js"></script>
</body>

</html>