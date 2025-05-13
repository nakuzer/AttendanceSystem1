// Function to fetch and render created classes
async function fetchAndRenderClasses() {
  try {
    const response = await fetch('/attendancesystem/Project_AS/Class/get_classes_api.php');

    if (!response.ok) {
      throw new Error(`Server returned status ${response.status}`);
    }

    const data = await response.json();

    if (data.status === 'success') {
      renderClasses(data.data);
    } else {
      console.log('Error fetching classes:', data.message);
      throw new Error(data.message);
    }
  } catch (error) {
    console.log('Error:', error.message);
    alert('Error fetching classes: ' + error.message);
  }
}

// Function to render classes dynamically in the table
function renderClasses(classes) {
  const classesList = document.getElementById('classes-list'); // tbody element
  classesList.innerHTML = ''; // Clear previous entries

  classes.forEach((classData) => {
    const classRow = document.createElement('tr');
    classRow.style.cursor = 'pointer'; // Show pointer on hover
    classRow.setAttribute('data-id', classData.id); // Store class ID

    classRow.innerHTML = `
      <td>${classData.section}</td>
      <td>${classData.subject_name}</td>
      <td>${classData.subject_code}</td>
      <td>${classData.start_time} - ${classData.end_time}</td>
      <td>${classData.days}</td>
      <td>35</td>
    `;

    // Add click event to redirect to class.php?id=<class_id>
    classRow.addEventListener('click', () => {
      window.location.href = `class.php?id=${classData.id}`;
    });

    classesList.appendChild(classRow);
  });
}


// Call this function to fetch and render classes when the page loads
document.addEventListener('DOMContentLoaded', fetchAndRenderClasses);
