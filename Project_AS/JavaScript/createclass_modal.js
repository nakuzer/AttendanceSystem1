const dayButtons = document.querySelectorAll('.day-button');
dayButtons.forEach(button => {
  button.addEventListener('click', () => {
    button.classList.toggle('active');
  });
});

// Modal references
const closeButton = document.querySelector('.close-button');
const modalOverlay = document.querySelector('.modal-overlay');


// Show/hide modal
function showModal() {
  modalOverlay.style.display = 'flex';
}

closeButton.addEventListener('click', () => {
  modalOverlay.style.display = 'none';
});

modalOverlay.addEventListener('click', (e) => {
  if (e.target === modalOverlay) {
    modalOverlay.style.display = 'none';
  }
});

// Auto-show modal on load
document.addEventListener('DOMContentLoaded', () => {
  showModal();
});

// Show modal when clicking the demo button
const createClassButton = document.querySelector(".add-button");
createClassButton.addEventListener('click', showModal);

// Handle class creation with async/await
const createButton = document.querySelector('.create-button');
createButton.addEventListener('click', async () => {
  event.preventDefault();
  // Collect form data
  const subjectName = document.getElementById('subjectName').value;
  const subjectCode = document.getElementById('subjectCode').value;
  const section = document.getElementById('section').value;
  const startTime = document.getElementById('startTime').value;
  const endTime = document.getElementById('endTime').value;
  const selectedDays = Array.from(document.querySelectorAll('.day-button.active')).map(button => button.getAttribute('data-day'));

  // Form validation
  if (
    !subjectName.trim() ||
    !subjectCode.trim() ||
    !section.trim() ||
    !startTime.trim() ||
    !endTime.trim() ||
    selectedDays.length === 0
  ) {
    alert("Please fill in all fields and select at least one day.");
    return;  // Prevent further execution if validation fails
  }

  const payload = {
    subjectName,
    subjectCode,
    section,
    startTime,
    endTime,
    days: selectedDays.join(","),

  };

  try {
    const response = await fetch('/attendancesystem/Project_AS/Class/create_class_api.php', {
      method: 'POST',
      headers: {
        'Content-Type': 'application/json'
      },
      body: JSON.stringify(payload)
    });

    let data;
    try {
      data = await response.json();
    } catch (jsonError) {
      const text = await response.text();
      throw new Error("Invalid JSON response from server: " + text.slice(0, 100));
    }

    if (!response.ok || data.status !== 'success') {
      throw new Error(data.message || 'Something went wrong on the server.');
    }

    alert(data.message);
    modalOverlay.style.display = 'none';
    resetForm();

  } catch (error) {
    console.error('Error:'+ error.message);
    alert("Error: " + error.message);
  }

});

// Function to reset the form after successful class creation
function resetForm() {
  document.getElementById('subjectName').value = '';
  document.getElementById('subjectCode').value = '';
  document.getElementById('section').value = '';
  document.getElementById('startTime').value = '';
  document.getElementById('endTime').value = '';

  // Reset selected days
  document.querySelectorAll('.day-button').forEach(button => {
    button.classList.remove('active');
  });
}
