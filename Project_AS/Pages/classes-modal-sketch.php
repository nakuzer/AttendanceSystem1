<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>checkLY Schedule Modal</title>
    
</head>
<body>
    <!-- Modal Overlay -->
    <div class="modal-overlay" id="scheduleModal">
        <div class="modal-container">
            <!-- Modal Header -->
            <div class="modal-header">
                <h2 class="modal-title">CC100: Introduction to Computer Science</h2>
                <button class="close-button" id="closeModalBtn">&times;</button>
            </div>
            
            <!-- Modal Content -->
            <div class="modal-content">
                <!-- Class Information Section -->
                <div class="section">
                    <h3 class="section-title">Class Information</h3>
                    <div class="info-card">
                        <div class="info-row">
                            <span class="info-label">Class Code:</span> BSIT-1A
                        </div>
                        <div class="info-row">
                            <span class="info-label">Students Enrolled:</span> 35
                        </div>
                    </div>
                </div>
                
                <!-- Schedule Section -->
                <div class="section">
                    <h3 class="section-title">Schedule</h3>
                    
                    <!-- Monday Schedule -->
                    <div class="schedule-item">
                        <div class="day-indicator monday">Mon</div>
                        <div>
                            <div class="time-info">8:00 AM - 10:00 AM</div>
                            <div class="class-code">BSIT-1A</div>
                        </div>
                    </div>
                    
                    <!-- Tuesday Schedule -->
                    <div class="schedule-item">
                        <div class="day-indicator tuesday">Tue</div>
                        <div>
                            <div class="time-info">8:00 AM - 10:00 AM</div>
                            <div class="class-code">BSIT-1A</div>
                        </div>
                    </div>
                    
                    <!-- Wednesday Schedule -->
                    <div class="schedule-item">
                        <div class="day-indicator wednesday">Wed</div>
                        <div>
                            <div class="time-info">8:00 AM - 10:00 AM</div>
                            <div class="class-code">BSIT-1A</div>
                        </div>
                    </div>
                    
                    <!-- Thursday Schedule -->
                    <div class="schedule-item">
                        <div class="day-indicator thursday">Thu</div>
                        <div>
                            <div class="time-info">8:00 AM - 10:00 AM</div>
                            <div class="class-code">BSIT-1A</div>
                        </div>
                    </div>
                    
                    <!-- Friday Schedule -->
                    <div class="schedule-item">
                        <div class="day-indicator friday">Fri</div>
                        <div>
                            <div class="time-info">8:00 AM - 10:00 AM</div>
                            <div class="class-code">BSIT-1A</div>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Modal Footer -->
            <div class="modal-footer">
                <button class="close-btn" id="footerCloseBtn">Close</button>
            </div>
        </div>
    </div>

    <script>
        // Get modal and close buttons
        const modal = document.getElementById('scheduleModal');
        const closeModalBtn = document.getElementById('closeModalBtn');
        const footerCloseBtn = document.getElementById('footerCloseBtn');
        
        // Function to close the modal
        function closeModal() {
            modal.style.display = 'none';
        }
        
        // Add click event listeners to close buttons
        closeModalBtn.addEventListener('click', closeModal);
        footerCloseBtn.addEventListener('click', closeModal);
        
        // Close modal if user clicks outside the modal content
        window.addEventListener('click', function(event) {
            if (event.target === modal) {
                closeModal();
            }
        });
        
        // Function to open the modal (can be triggered by clicking on a schedule item)
        function openModal() {
            modal.style.display = 'flex';
        }
        
        // Optional: Automatically open the modal when the page loads
        // Comment this out if you want to trigger it by a button click instead
        document.addEventListener('DOMContentLoaded', openModal);
        
        // Example of how to trigger the modal from another element:
        // const triggerBtn = document.getElementById('openModalBtn');
        // triggerBtn.addEventListener('click', openModal);
    </script>
</body>
</html>