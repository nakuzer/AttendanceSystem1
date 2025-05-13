document.addEventListener('DOMContentLoaded', function() {
    // Initialize modal functionality
    initModal();
    
    // Initialize class cards
    initClassCards();
    
    // Make addClassToDay available globally
    window.addClassToDay = addClassToDay;
});

function initModal() {
    // Get modal elements
    const modal = document.getElementById('scheduleModal');
    const closeModalBtn = document.getElementById('closeModalBtn');
    const footerCloseBtn = document.getElementById('footerCloseBtn');
    
    // Debugging: Check if elements exist
    console.log('Modal elements:', {
        modal: modal,
        closeModalBtn: closeModalBtn,
        footerCloseBtn: footerCloseBtn
    });

    // Single closeModal function
    function closeModal() {
        console.log('Closing modal');
        if (modal) {
            modal.style.display = 'none';
        }
    }

    // Set up event listeners for close buttons
    if (closeModalBtn) {
        closeModalBtn.addEventListener('click', function(e) {
            e.stopPropagation();
            closeModal();
        });
    }

    if (footerCloseBtn) {
        footerCloseBtn.addEventListener('click', function(e) {
            e.stopPropagation();
            closeModal();
        });
    }

    // Close when clicking outside modal content
    window.addEventListener('click', function(event) {
        if (event.target === modal) {
            closeModal();
        }
    });
}

function initClassCards() {
    // Add click handlers to all class cards
    document.querySelectorAll('.class-card').forEach(card => {
        card.addEventListener('click', function(e) {
            e.stopPropagation();
            showModal(this);
        });
    });
}

function showModal(classCard) {
    const modal = document.getElementById('scheduleModal');
    if (!modal) return;
    
    // Get day from class card
    const day = classCard.classList.contains('monday') ? 'Monday' :
               classCard.classList.contains('tuesday') ? 'Tuesday' :
               classCard.classList.contains('wednesday') ? 'Wednesday' :
               classCard.classList.contains('thursday') ? 'Thursday' :
               classCard.classList.contains('friday') ? 'Friday' :
               classCard.classList.contains('saturday') ? 'Saturday' : 'Sunday';
    
    // Get class details from the card
    const classCode = classCard.querySelector('.class-code').textContent;
    const section = classCard.querySelector('.class-section').textContent;
    const time = classCard.querySelector('.class-time').textContent;
    
    // Update modal content
    updateModalContent(classCode, section, time, day);
    
    // Display the modal
    modal.style.display = "block";
}

function updateModalContent(classCode, section, time, day) {
    // Update header
    const modalTitle = document.querySelector('.modal-title');
    if (modalTitle) {
        modalTitle.textContent = `${classCode}: ${getFullClassName(classCode)}`;
    }
    
    // Update class information
    const infoCard = document.querySelector('.info-card');
    if (infoCard) {
        infoCard.innerHTML = `
            <div class="info-row">
                <span class="info-label">Class Code:</span> ${classCode}
            </div>
            <div class="info-row">
                <span class="info-label">Section:</span> ${section}
            </div>
            <div class="info-row">
                <span class="info-label">Students Enrolled:</span> ${getRandomEnrollment()}
            </div>
        `;
    }
    
    // Update schedule section
    const scheduleSection = document.querySelector('.section:last-child');
    if (scheduleSection) {
        scheduleSection.innerHTML = `
            <h3 class="section-title">Schedule</h3>
            <div class="schedule-item">
                <div class="day-indicator ${day.toLowerCase()}">${day.substring(0, 3)}</div>
                <div>
                    <div class="time-info">${time}</div>
                    <div class="class-code">${section}</div>
                </div>
            </div>
        `;
    }
}

function getFullClassName(code) {
    const classNames = {
        'CC100': 'Introduction to Computer Science',
        'IT101': 'Fundamentals of Information Technology',
        'CS204': 'Data Structures and Algorithms',
        'MATH101': 'College Algebra'
    };
    return classNames[code] || code;
}

function getRandomEnrollment() {
    return Math.floor(Math.random() * 20) + 20;
}

function addClassToDay(day, classCode, section, startTime, endTime) {
    const columns = document.querySelectorAll('.schedule-column');
    let targetColumn;

    // Find the column for the specified day
    for (let i = 0; i < columns.length; i++) {
        const dayHeader = columns[i].querySelector('.day-header').textContent;
        if (dayHeader.toLowerCase().includes(day.toLowerCase().substring(0, 3))) {
            targetColumn = columns[i];
            break;
        }
    }

    if (targetColumn) {
        // Create new class card
        const newCard = document.createElement('div');
        newCard.className = `class-card ${day.toLowerCase()}`;
        
        // Add click handler
        newCard.addEventListener('click', function(e) {
            e.stopPropagation();
            showModal(this);
        });

        newCard.innerHTML = `
            <div class="class-code">${classCode}</div>
            <div class="class-section">${section}</div>
            <div class="class-time">${startTime} - ${endTime}</div>
        `;

        targetColumn.appendChild(newCard);
    }
}