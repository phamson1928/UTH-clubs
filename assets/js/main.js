// Global state
let currentUser = null;
let currentSection = 'home';

// Navigation
function showSection(sectionName) {
    // Hide all sections
    document.querySelectorAll('.section').forEach(section => {
        section.classList.remove('active');
    });
    
    // Show selected section
    document.getElementById(sectionName).classList.add('active');
    
    // Update navigation
    document.querySelectorAll('.nav-links a').forEach(link => {
        link.classList.remove('active');
    });
    
    event.target.classList.add('active');
    currentSection = sectionName;
}

// Club functions
function joinClub(clubId) {
    if (!currentUser) {
        showNotification('Please login to join clubs!', 'error');
        showLoginModal();
        return;
    }
    
    showNotification('Successfully joined the club!', 'success');
}

function viewClubDetails(clubId) {
    // Sample club data - in a real app, this would come from a database
    const clubData = {
        1: {
            name: '💻 Tech Club',
            leader: 'Sarah Johnson',
            category: 'Technology',
            memberCount: '45 Members',
            schedule: 'Every Tuesday, 6:00 PM',
            description: 'The Tech Club is a vibrant community of technology enthusiasts dedicated to exploring the latest innovations in software development, artificial intelligence, and emerging technologies. We organize workshops, hackathons, and tech talks featuring industry professionals.',
            activities: [
                { title: '💻 Weekly Coding Sessions', desc: 'Collaborative programming sessions where members work on projects together and learn new technologies.' },
                { title: '🏆 Monthly Hackathons', desc: '24-hour coding competitions with exciting themes and prizes for innovative solutions.' },
                { title: '🎤 Tech Talks', desc: 'Guest speakers from leading tech companies share insights about industry trends and career opportunities.' },
                { title: '🚀 Startup Incubator', desc: 'Support and mentorship for members interested in launching their own tech startups.' }
            ]
        }
    };

    const club = clubData[clubId];
    if (!club) return;

    // Update club details
    document.getElementById('clubDetailName').textContent = club.name;
    document.getElementById('clubDetailCategory').textContent = club.category;
    document.getElementById('clubDetailMemberCount').textContent = club.memberCount;
    document.getElementById('clubDetailLeader').textContent = club.leader;
    document.getElementById('clubDetailSchedule').textContent = club.schedule;
    document.getElementById('clubDetailDescription').textContent = club.description;

    // Update activities
    const activitiesContainer = document.getElementById('clubActivities');
    activitiesContainer.innerHTML = club.activities.map(activity => `
        <div style="padding: 1rem; border: 1px solid #e5e7eb; border-radius: 8px;">
            <h5 style="color: #008689; margin-bottom: 0.5rem;">${activity.title}</h5>
            <p style="margin: 0; font-size: 0.9rem; color: #6b7280;">${activity.desc}</p>
        </div>
    `).join('');

    // Store current club ID for join functionality
    window.currentClubId = clubId;

    // Show club details section
    showSection('clubDetails');
}

function filterClubs() {
    const searchTerm = document.getElementById('clubSearch').value.toLowerCase();
    const category = document.getElementById('clubCategory').value;
    const clubs = document.querySelectorAll('#clubsList .card');
    
    clubs.forEach(club => {
        const title = club.querySelector('.card-title').textContent.toLowerCase();
        const clubCategory = club.getAttribute('data-category');
        
        const matchesSearch = title.includes(searchTerm);
        const matchesCategory = !category || clubCategory === category;
        
        if (matchesSearch && matchesCategory) {
            club.style.display = 'block';
        } else {
            club.style.display = 'none';
        }
    });
}

// Event functions
function registerForEvent(eventId) {
    if (!currentUser) {
        document.getElementById('eventRegisterContent').innerHTML = `
            <p>Please login to register for events.</p>
            <button class="btn btn-primary" onclick="showLoginModal(); closeModal('eventRegisterModal');">Login</button>
        `;
        document.getElementById('eventRegisterModal').style.display = 'block';
        return;
    }
    
    // Update available seats
    const eventCards = document.querySelectorAll('.card');
    eventCards.forEach(card => {
        const seatsElement = card.querySelector('.seats-available');
        if (seatsElement) {
            let currentSeats = parseInt(seatsElement.textContent);
            if (currentSeats > 0) {
                seatsElement.textContent = currentSeats - 1;
            }
        }
    });
    
    showNotification('Successfully registered for the event!', 'success');
}

function filterEvents() {
    const searchTerm = document.getElementById('eventSearch').value.toLowerCase();
    const club = document.getElementById('eventClub').value;
    const dateFrom = document.getElementById('eventDateFrom').value;
    const dateTo = document.getElementById('eventDateTo').value;
    const events = document.querySelectorAll('#eventsList .card');
    
    events.forEach(event => {
        const title = event.querySelector('.card-title').textContent.toLowerCase();
        const eventClub = event.getAttribute('data-club');
        const eventDate = event.getAttribute('data-date');
        
        const matchesSearch = title.includes(searchTerm);
        const matchesClub = !club || eventClub === club;
        const matchesDateFrom = !dateFrom || eventDate >= dateFrom;
        const matchesDateTo = !dateTo || eventDate <= dateTo;
        
        if (matchesSearch && matchesClub && matchesDateFrom && matchesDateTo) {
            event.style.display = 'block';
        } else {
            event.style.display = 'none';
        }
    });
}

// Notification system
function showNotification(message, type = 'success') {
    const notification = document.getElementById('notification');
    notification.textContent = message;
    notification.className = `notification ${type === 'error' ? 'error' : ''}`;
    notification.classList.add('show');
    
    setTimeout(() => {
        notification.classList.remove('show');
    }, 3000);
}

// Close modals when clicking outside
window.onclick = function(event) {
    const modals = document.querySelectorAll('.modal');
    modals.forEach(modal => {
        if (event.target === modal) {
            modal.style.display = 'none';
        }
    });
}

// Navigation functions for club details
function goBackToClubs() {
    showSection('clubs');
}

function joinClubFromDetails() {
    if (!currentUser) {
        showNotification('Please login to join clubs!', 'error');
        showLoginModal();
        return;
    }
    
    showNotification('Successfully joined the club!', 'success');
    
    // Update button text
    const joinBtn = document.getElementById('joinClubBtn');
    joinBtn.textContent = 'Already Joined';
    joinBtn.disabled = true;
    joinBtn.classList.remove('btn-success');
    joinBtn.classList.add('btn-secondary');
}

// Initialize
document.addEventListener('DOMContentLoaded', function() {
    updateAuthUI();
    
    // Set default dates for event filters
    const today = new Date();
    const nextMonth = new Date(today.getFullYear(), today.getMonth() + 1, today.getDate());
    
    if (document.getElementById('eventDateFrom')) {
        document.getElementById('eventDateFrom').value = today.toISOString().split('T')[0];
    }
    if (document.getElementById('eventDateTo')) {
        document.getElementById('eventDateTo').value = nextMonth.toISOString().split('T')[0];
    }
});