document.getElementById('createClassButton').addEventListener('click', function () {
  // Get input values from the form
  const subjectName = document.getElementById('subjectName').value;
  const subjectCode = document.getElementById('subjectCode').value;
  const section = document.getElementById('section').value;
  const startTime = document.getElementById('startTime').value;
  const endTime = document.getElementById('endTime').value;

  // Get selected days from checkboxes
  const selectedDays = Array.from(document.querySelectorAll('.day:checked')).map(day => day.value);

  // Prepare the payload to send
  const payload = {
    subjectName: subjectName,
    subjectCode: subjectCode,
    section: section,
    startTime: startTime,
    endTime: endTime,
    days: selectedDays.join(",")  // Convert the array to a comma-separated string
  };

  // Make the POST request to the PHP API
  fetch('/attendancesystem/Class/create_class_api.php', {
    method: 'POST',
    headers: {
      'Content-Type': 'application/json'
    },
    body: JSON.stringify(payload)  // Send payload as JSON
  })
    .then(response => response.json())
    .then(data => {
      // Check if the API response was successful
      if (data.status === 'success') {
        alert(data.message);  // Show success message from the PHP API
      } else {
        alert("Error: " + data.message);  // Show error message
      }
    })
    .catch(error => {
      console.error('Error:', error);
      alert("An error occurred while creating the class.");
    });
});