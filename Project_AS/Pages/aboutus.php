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
    <title>About Page</title>
    <link rel="stylesheet" href="../style/nav-bar.css">
    <link rel="stylesheet" href="../style/aboutus.css">
</head>

<body>
    <?php include 'template.php'?>

    <div class="container">
        <h1 class="about-header">ABOUT PAGE</h1>

        <div class="team-grid row">
            <div class="team-member">
                <img src="../images/DannyJunior.jpg" alt="Danny D. Dinglasa Jr." class="profile-pic">
                <a href="#" class="member-name">Danny D. Dinglasa Jr.</a>
                <div class="member-title">Back & Frontend Programmer</div>
            </div>

            <div class="team-member">
                <img src="/api/placeholder/180/180" alt="Mathew T. Angeles" class="profile-pic">
                <a href="#" class="member-name">Mathew T. Angeles</a>
                <div class="member-title">UI/UX Designer</div>
            </div>

            <div class="team-member">
                <img src="/api/placeholder/180/180" alt="Pheinz T. Magnun" class="profile-pic">
                <a href="#" class="member-name">Pheinz T. Magnun</a>
                <div class="member-title">Back & Frontend Programmer</div>
            </div>
        </div>

        <div class="team-grid">
            <div class="team-member">
                <img src="/api/placeholder/180/180" alt="Matt Axell T. Beltran" class="profile-pic">
                <a href="#" class="member-name">Matt Axell T. Beltran</a>
                <div class="member-title">UI/UX Designer</div>
            </div>

            <div class="team-member">
                <img src="/api/placeholder/180/180" alt="John Laurence M. Solijon" class="profile-pic">
                <a href="#" class="member-name">John Laurence M. Solijon</a>
                <div class="member-title">UI/UX Designer</div>
            </div>

            <div class="team-member">
                <img src="/api/placeholder/180/180" alt="Charles M. Morgan" class="profile-pic">
                <a href="#" class="member-name">Charles M. Morgan</a>
                <div class="member-title">Programmer</div>
            </div>
        </div>
    </div>
    <script src="../JavaScript/logout-modal.js"></script>
    <script src="../JavaScript/aboutus.js"></script>

</html>