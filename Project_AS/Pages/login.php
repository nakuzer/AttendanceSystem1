<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>checkLY</title>
  <link rel="stylesheet" href="../style/login.css">
</head>

<body>
  <h1 class="checkLY">
    check<span>LY</span>
  </h1>
  <form id="login-form" class="login-form">
    <input type="hidden" id="selectedRole" name="role" value="" required>
    <div class="choice">
      <div class="role-option student" data-role="student">
        STUDENT
      </div>
      <div class="role-option teacher" data-role="teacher">
        TEACHER
      </div>
    </div>
    <h1>
      Log In
    </h1>
    <p>
      <span id="message">Welcome!</span> Please enter the required information to proceed. Thank You!
    </p>
    <div class="input-group">
      <input type="text" id="email" name="email" placeholder="Email" required>
    </div>
    <div class="input-group">
      <input type="password" id="password" name="password" placeholder="Password" required>
    </div>
    <a href="#" class="forgot-pass">
      Forgot Password?
    </a>

    <input class="login-btn" type="submit" value="Log In">

    <p class="signUp-form-btn">Don't have an Account? <a href="signUp.php">Sign Up</a></p>
  </form>

  <script src="../JavaScript/login.js"></script>
</body>

</html>