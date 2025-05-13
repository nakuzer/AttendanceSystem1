<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>CheckLY - Create Account</title>
  <link rel="stylesheet" href="../style/signup.css">
</head>

<body>
  <h1 class="checkLY">
    check<span>LY</span>
  </h1>
  <div class="signup-container">
    <h2>Choose Your Role</h2>
    <div class="role-select">
      <div class="role-option student" data-role="student">
        <img src="../images/student1.png" alt="">
        <span>Student</span>
      </div>
      <div class="role-option teacher" data-role="teacher">
        <img src="../images/teacher1.png" alt="">
        <span>Teacher</span>
      </div>
    </div>

    <form class="signup-form" id="signupForm">

      <input type="hidden" id="selectedRole" name="role" value="" required>

      <input type="email" id="email" name="email" placeholder="Email" required>
      <div id="email-error" style="color: red;"></div>

      <input type="text" id="idInput" name="schoolID" placeholder="School ID" required>

      <input list="courseList" id="courseInput" name="course" placeholder="Course">
      <datalist id="courseList">
        <option value="BSIT"></option>
        <option value="BSCS"></option>
        <option value="BACT"></option>
        <option value="BSIS"></option>
      </datalist>
      <input type="text" id="fieldInput" name="field" placeholder="Field of Expertise" style="display: none;">


      <div class="name-inputs">
        <input type="text" id="firstName" name="firstName" placeholder="First Name" required>
        <input type="text" id="lastName" name="lastName" placeholder="Last Name" required>
      </div>

      <input type="password" id="password" name="password" placeholder="Password" required>

      <input type="password" id="confirmPassword" name="confirmPassword" placeholder="Confirm Password" required>

      <button id="submit-btn" type="submit">Create my new account</button>
    </form>
  </div>

  <script src="../JavaScript/signup.js"></script>
</body>

</html>