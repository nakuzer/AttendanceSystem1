document.addEventListener('DOMContentLoaded', function() {
            console.log('About page loaded');
            
            // Example of how to add interactivity
            const teamMembers = document.querySelectorAll('.team-member');
            
            teamMembers.forEach(member => {
                member.addEventListener('mouseenter', function() {
                    this.style.transform = 'translateY(-5px)';
                    this.style.transition = 'transform 0.3s ease';
                });
                
                member.addEventListener('mouseleave', function() {
                    this.style.transform = 'translateY(0)';
                });
            });
        });




