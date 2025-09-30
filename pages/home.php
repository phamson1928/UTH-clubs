<!-- Home Section -->
<div id="home" class="section active">
    <div class="hero">
        <h1>Welcome to UTH Clubs</h1>
        <p>Discover clubs, join events, and connect with your university community</p>
        <div style="display: flex; gap: 1rem; justify-content: center; flex-wrap: wrap;">
            <a href="#" class="btn btn-primary" onclick="showSection('clubs')">Explore Clubs</a>
            <a href="#" class="btn btn-secondary" onclick="showSection('events')">View Events</a>
        </div>
    </div>

    <div class="container">
        <h2 style="text-align: center; margin-bottom: 2rem; color: #1f2937;">Upcoming Events</h2>
        <div class="card-grid" id="upcomingEvents">
            <div class="card">
                <div class="card-header">
                    <div class="card-title">Tech Innovation Workshop</div>
                    <span class="badge badge-info">Tech Club</span>
                </div>
                <div class="card-content">
                    <p><strong>📅 Date:</strong> March 25, 2024</p>
                    <p><strong>📍 Location:</strong> Engineering Building, Room 101</p>
                    <p><strong>👥 Available Seats:</strong> 15/50</p>
                    <p>Learn about the latest trends in technology and innovation. Perfect for aspiring entrepreneurs!</p>
                    <button class="btn btn-primary" onclick="registerForEvent(1)">Register Now</button>
                </div>
            </div>

            <div class="card">
                <div class="card-header">
                    <div class="card-title">Photography Exhibition</div>
                    <span class="badge badge-success">Art Club</span>
                </div>
                <div class="card-content">
                    <p><strong>📅 Date:</strong> March 28, 2024</p>
                    <p><strong>📍 Location:</strong> Student Center Gallery</p>
                    <p><strong>👥 Available Seats:</strong> 8/30</p>
                    <p>Showcase your photography skills and view amazing works from fellow students.</p>
                    <button class="btn btn-primary" onclick="registerForEvent(2)">Register Now</button>
                </div>
            </div>

            <div class="card">
                <div class="card-header">
                    <div class="card-title">Debate Championship</div>
                    <span class="badge badge-warning">Debate Society</span>
                </div>
                <div class="card-content">
                    <p><strong>📅 Date:</strong> April 2, 2024</p>
                    <p><strong>📍 Location:</strong> Main Auditorium</p>
                    <p><strong>👥 Available Seats:</strong> 25/100</p>
                    <p>Annual inter-college debate championship. Come support our debaters!</p>
                    <button class="btn btn-primary" onclick="registerForEvent(3)">Register Now</button>
                </div>
            </div>
        </div>

        <h2 style="text-align: center; margin-bottom: 2rem; color: #1f2937;">Featured Clubs</h2>
        <div class="card-grid">
            <div class="card">
                <div class="card-header">
                    <div class="card-title">💻 Tech Club</div>
                    <span class="badge badge-info">45 Members</span>
                </div>
                <div class="card-content">
                    <p><strong>Leader:</strong> Sarah Johnson</p>
                    <p>Explore the world of technology, programming, and innovation. Join us for workshops, hackathons, and tech talks.</p>
                    <button class="btn btn-success" onclick="joinClub(1)">Join Club</button>
                </div>
            </div>

            <div class="card">
                <div class="card-header">
                    <div class="card-title">🎨 Art Club</div>
                    <span class="badge badge-success">32 Members</span>
                </div>
                <div class="card-content">
                    <p><strong>Leader:</strong> Michael Chen</p>
                    <p>Express your creativity through various art forms. From painting to digital art, we welcome all artists.</p>
                    <button class="btn btn-success" onclick="joinClub(2)">Join Club</button>
                </div>
            </div>

            <div class="card">
                <div class="card-header">
                    <div class="card-title">🗣️ Debate Society</div>
                    <span class="badge badge-warning">28 Members</span>
                </div>
                <div class="card-content">
                    <p><strong>Leader:</strong> Emma Davis</p>
                    <p>Sharpen your public speaking and critical thinking skills through engaging debates and discussions.</p>
                    <button class="btn btn-success" onclick="joinClub(3)">Join Club</button>
                </div>
            </div>
        </div>
    </div>
</div>