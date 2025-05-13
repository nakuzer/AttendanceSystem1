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
    $email = $_SESSION['email'];
    $schoolID = $_SESSION['schoolID'];
    $course = $_SESSION['course'];

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>CheckLY - Your QR Code</title>
  <link rel="stylesheet" href="../style/qr-card.css">
  <!-- <link rel="stylesheet" href="../style/nav-bar.css"> -->
</head>
<style>
  #logout{
  position: fixed;
  top: 15px;
  right: 15px;
  border: none;
  box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
  padding: 15px 20px;
  width: 80px;
  border-radius: 15px;
  background-color: #175873;
  color: aliceblue;
  font-weight: 600;
  font-size: 1rem;
  display: flex;
  justify-content: center;
}

#logout:hover {
  background-color: #29A0B1;
}

.logout-modal-overlay {
  position: fixed;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  background-color: rgba(0, 0, 0, 0.5);
  display: none;
  /* Higher than create class modal */
}

.logout-modal-overlay.active {
  display: flex;
  justify-content: center;
  align-items: center;
}

.logout-modal {
  background-color: white;
  padding: 20px;
  border-radius: 10px;
  box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.5);
  width: 80%;
  max-width: 400px;
  text-align: center;
}

.logout-modal h2 {
  font-size: 2rem;
  margin-bottom: 10px;
}

.logout-modal p {
  margin-bottom: 20px;
}

.logout-btns {
  display: flex;
  justify-content: center;
  gap: 10px;
}

.logout-btns button {
  padding: 8px 20px;
  border-radius: 20px;
  cursor: pointer;
  box-shadow: 0px 0px 5px rgba(0, 0, 0, 0.5);
  border: none;

}

#logout-no {
  background-color: #f0f0f0;
  color: #333;
}

#logout-yes {
  background-color: #175873;
  color: white;
}

#logout-yes:hover,
#logout-no:hover {
  cursor: pointer;
  opacity: 0.7;
}

.modal-overlay {
  position: fixed;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  background-color: rgba(0, 0, 0, 0.5);
  display: none;
}

.modal-overlay.active {
  display: block;
}

.modal {
  display: flex;
  align-items: center;
  justify-content: space-evenly;
  flex-direction: column;
  position: fixed;
  top: 50%;
  left: 50%;
  transform: translate(-50%, -50%);
  background-color: white;
  padding: 20px;
  border-radius: 10px;
  box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.5);
  width: 80%;
  max-width: 700px;
  height: 300px;
}

.modal h2 {
  font-size: 2rem;
  margin-bottom: 20px;
  font-weight: 300;
  color: #191D23;
}

.modal button {
  background-color: #175873;
  color: white;
  border: none;
  padding: 10px 20px;
  border-radius: 20px;
  cursor: pointer;
}

#logout:hover {
  cursor: pointer;
}

.logout-btns {
  display: flex;
  justify-content: space-evenly;
  width: 100%;
}

</style>
<body>
  <div class="container">
    <h1 class="logo">
      check<span>LY</span>
    </h1>

    <div class="card">
      <h2 class="title">Your QR Code is Ready!</h2>
      <p class="subtitle">
        Use this QR code for quick attendance and access to your CheckLY account.
      </p>

      <!-- QR Code Card -->
      <div class="qr-card" id="qr-card">
        <div class="card-header">
          <h3 class="user-name" id="user-name"><?php echo htmlspecialchars($firstName . ' ' . $lastName); ?></h3>
          <p class="user-email" id="user-email"><?php echo htmlspecialchars($email);?></p>
        </div>

        <div class="card-body">
          <!-- QR Code Placeholder -->
          <div class="qr-code-placeholder">
            <!-- QR code will be generated here -->
            <svg class="qr-image" id="qr-code" viewBox="0 0 100 100" xmlns="http://www.w3.org/2000/svg">
              <!-- Simple placeholder for QR code -->
              <rect x="10" y="10" width="80" height="80" fill="#ffffff" stroke="#000000" stroke-width="1" />
              <rect x="20" y="20" width="60" height="60" fill="#000000" />
              <rect x="30" y="30" width="40" height="40" fill="#ffffff" />
              <rect x="40" y="40" width="20" height="20" fill="#000000" />
            </svg>
          </div>

          <div class="course-info">
            <p class="course-name" id="course-name"><?php echo htmlspecialchars($course)?></p>
            <p class="student-id" id="student-id">ID: <?php echo htmlspecialchars($schoolID)?></p>
          </div>
        </div>
      </div>

      <!-- Action Buttons -->
      <div class="button-container">
        <button id="download-button" class="button download-button">
          <!-- Download Icon -->
          <svg class="icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
            <path d="M21 15v4a2 2 0 01-2 2H5a2 2 0 01-2-2v-4"></path>
            <polyline points="7 10 12 15 17 10"></polyline>
            <line x1="12" y1="15" x2="12" y2="3"></line>
          </svg>
          Download Card
        </button>

        <button id="share-button" class="button share-button">
          <!-- Share Icon -->
          <svg class="icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
            <circle cx="18" cy="5" r="3"></circle>
            <circle cx="6" cy="12" r="3"></circle>
            <circle cx="18" cy="19" r="3"></circle>
            <line x1="8.59" y1="13.51" x2="15.42" y2="17.49"></line>
            <line x1="15.41" y1="6.51" x2="8.59" y2="10.49"></line>
          </svg>
          Share
        </button>
      </div>
    </div>

    <div class="card">
      <h3 class="next-steps-heading">Next Steps</h3>
      <div class="steps-list">
        <div class="step-item">
          <div class="step-number">1</div>
          <p>Download your QR code card for easy access</p>
        </div>
        <div class="step-item">
          <div class="step-number">2</div>
          <p>Share your QR code with your instructor if needed</p>
        </div>
        <div class="step-item">
          <div class="step-number">3</div>
          <p>Check your email for login details and additional instructions</p>
        </div>
      </div>
    </div>
  </div>
  

  <button id="logout">logout</button>
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
  <script>
    const openModal = document.getElementById('logout');
    const modal = document.querySelector('.logout-modal-overlay');
    const closeModal = document.getElementById('logout-no');
    const logout = document.getElementById('logout-yes');

    openModal.addEventListener('click', () => {
      modal.classList.add('active');
    });

    closeModal.addEventListener('click', () => {
      modal.classList.remove('active');
    });

    logout.addEventListener('click', () => {
      window.location.href = '../Class/logout_api.php';
    });

    // User data - in a real application, this would be fetched from a server
    

    // Populate user data in the QR card
    // document.getElementById('user-name').textContent = `${userData.firstName} ${userData.lastName}`;
    // document.getElementById('user-email').textContent = userData.email;
    // document.getElementById('course-name').textContent = userData.course;
    // document.getElementById('student-id').textContent = `ID: ${userData.studentId}`;

    // Download button functionality
    document.getElementById('download-button').addEventListener('click', function() {
      // In a real implementation, this would use html2canvas or a similar approach
      // to convert the card to an image and download it
      this.textContent = 'Downloading...';
      const button = this;

      setTimeout(function() {
        button.innerHTML = `
          <svg class="icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
            <path d="M21 15v4a2 2 0 01-2 2H5a2 2 0 01-2-2v-4"></path>
            <polyline points="7 10 12 15 17 10"></polyline>
            <line x1="12" y1="15" x2="12" y2="3"></line>
          </svg>
          Download Card
        `;
        alert('Card downloaded successfully!');
      }, 1000);
    });

    // Share button functionality
    document.getElementById('share-button').addEventListener('click', function() {
      // In a real implementation, this would use the Web Share API or a custom share modal
      alert('Sharing functionality would be implemented here.');
    });

    // In a real application, this would generate a proper QR code based on user data
    // For example, using a library like qrcode.js
    function generateQRCode() {
      // This is just a placeholder - in a real app, this would generate an actual QR code
      console.log('QR code would be generated here with data:', userData);
    }

    // Call this function when the page loads
    generateQRCode();
  </script>
</body>

</html>