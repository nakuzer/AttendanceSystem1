document.addEventListener('DOMContentLoaded', () => {
  const roleOptions = document.querySelectorAll('.role-option');
  const selectedRoleInput = document.getElementById('selectedRole');
  const idInput = document.getElementById('idInput');
  const courseInput = document.getElementById('courseInput');
  const fieldInput = document.getElementById('fieldInput');
  const submitBtn = document.getElementById('submit-btn');
  const emailInput = document.getElementById('email');
  const form = document.getElementById('signupForm');

  function clearActiveRoles() {
    roleOptions.forEach(role => role.classList.remove('active'));
  }

  function setRoleUI(role) {
    selectedRoleInput.value = role;

    if (role === 'student') {
      idInput.placeholder = 'Student ID';
      courseInput.placeholder = 'Course';
      submitBtn.innerText = 'Generate QR code!';
      courseInput.style.display = 'block';
      fieldInput.style.display = 'none';
    } else if (role === 'teacher') {
      idInput.placeholder = 'Teacher ID';
      courseInput.placeholder = 'Department';
      submitBtn.innerText = 'Create Account!';
      fieldInput.style.display = 'block';
      courseInput.style.display = 'none';
    }
  }

  roleOptions.forEach(option => {
    option.addEventListener('click', () => {
      clearActiveRoles();
      option.classList.add('active');
      setRoleUI(option.dataset.role);
    });
  });

  form.addEventListener('submit', async (e) => {
    e.preventDefault();

    const role = selectedRoleInput.value;
    const email = document.getElementById('email').value;
    const schoolID = idInput.value;
    const course = courseInput.value;
    const field = fieldInput.value;
    const firstName = document.getElementById('firstName').value;
    const lastName = document.getElementById('lastName').value;
    const password = document.getElementById('password').value;
    const confirmPass = document.getElementById('confirmPassword').value;

    
      const payload = {
        role: role,
        email: email,
        schoolID: schoolID,
        firstName: firstName,
        lastName: lastName,
        password: password,
        confirmPass: confirmPass
      };
    if(role === 'student'){
      payload.course = course;
    }else if(role === 'teacher'){
      payload.field = field;
    }

    try {
      const response = await fetch('/attendancesystem/Project_AS/Class/signup_api.php', {
        method: 'POST',
        headers: {
          'Content-Type': 'application/json'
        },
        body: JSON.stringify(payload),
      });

      const rawText = await response.text();
      console.log("Raw response:", rawText);

      // Check if response is valid JSON
      const data = JSON.parse(rawText);
      alert(data.message);

      if (data.status === 'success') {
        form.reset();
        roleOptions.forEach(opt => opt.classList.remove('active'));
        selectedRoleInput.value = '';
        courseInput.style.display = 'none';
        fieldInput.style.display = 'none';
        window.location.href = '/attendancesystem/Project_AS/Pages/qr-card.php';
      }


    } catch (err) {
      console.error('Form submit error:', err);
      alert('Something went wrong while submitting. Please try again.');
    }
  });
});
