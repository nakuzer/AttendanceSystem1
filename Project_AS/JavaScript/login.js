document.addEventListener("DOMContentLoaded", () => {
  const roleOption = document.querySelectorAll('.role-option');
  const selectedRoleInput = document.getElementById('selectedRole');
  const welcomeMessage = document.getElementById('message');

  function clearActiveRoles() {
    roleOption.forEach(role => role.classList.remove('active'));
  }

  function setRoleUI(role) {
    selectedRoleInput.value = role;

    if (role === 'student') {
      welcomeMessage.innerText = 'Welcome Student!';
    } else if (role === 'teacher') {
      welcomeMessage.innerText = 'Welcome Teacher!';
    }

  }

  roleOption.forEach(option => {
    option.addEventListener('click', () => {
      clearActiveRoles();
      option.classList.add('active');
      setRoleUI(option.dataset.role);
    });
  });

  const form = document.getElementById('login-form');

  form.addEventListener('submit', async function (event) {
    event.preventDefault();

    const role = selectedRoleInput.value;
    const email = document.getElementById('email').value;
    const password = document.getElementById('password').value;
    const payload = {
      email: email,
      password: password,
      role: role
    };

    if (!role) {
      alert("Please select a role before logging in.");
      return;
    }

    try {
      const response = await fetch('../Class/login_api.php', {
        method: 'POST',
         headers: {
          'Content-Type': 'application/json', // Add the content type header
        },
        body: JSON.stringify(payload),
      });
      
      const data = await response.json();

      if (data.status === 'success') {
        alert(data.message);
        window.location.href = data.redirect;
      }else{
         throw new Error(data.message);
      }

    } catch (error) {
      console.error('Error: ', error.message);
      alert(error.message);
    }
  });

});
