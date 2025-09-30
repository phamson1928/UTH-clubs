<!-- Events Section -->
<div id="events" class="section">
    <div class="container">
        <h1 style="text-align: center; margin-bottom: 2rem; color: #1f2937;">Upcoming Events</h1>
        
        <div class="filters">
            <div class="filter-group">
                <label>Search Events</label>
                <input type="text" id="eventSearch" placeholder="Search by name..." onkeyup="filterEvents()">
            </div>
            <div class="filter-group">
                <label>Club</label>
                <select id="eventClub" onchange="filterEvents()">
                    <option value="">All Clubs</option>
                    <option value="tech">Tech Club</option>
                    <option value="art">Art Club</option>
                    <option value="debate">Debate Society</option>
                    <option value="soccer">Soccer Club</option>
                    <option value="science">Science Society</option>
                    <option value="music">Music Club</option>
                </select>
            </div>
            <div class="filter-group">
                <label>Date From</label>
                <input type="date" id="eventDateFrom" onchange="filterEvents()">
            </div>
            <div class="filter-group">
                <label>Date To</label>
                <input type="date" id="eventDateTo" onchange="filterEvents()">
            </div>
        </div>

        <div class="card-grid" id="eventsList">
            <div class="card" data-club="tech" data-date="2024-03-25">
                <div class="card-header">
                    <div class="card-title">Tech Innovation Workshop</div>
                    <span class="badge badge-info">Tech Club</span>
                </div>
                <div class="card-content">
                    <p><strong>📅 Date:</strong> March 25, 2024</p>
                    <p><strong>🕐 Time:</strong> 2:00 PM - 5:00 PM</p>
                    <p><strong>📍 Location:</strong> Engineering Building, Room 101</p>
                    <p><strong>👥 Available Seats:</strong> <span class="seats-available">15</span>/50</p>
                    <p>Learn about the latest trends in technology and innovation. Perfect for aspiring entrepreneurs!</p>
                    <button class="btn btn-primary" onclick="registerForEvent(1)">Register Now</button>
                </div>
            </div>

            <div class="card" data-club="art" data-date="2024-03-28">
                <div class="card-header">
                    <div class="card-title">Photography Exhibition</div>
                    <span class="badge badge-success">Art Club</span>
                </div>
                <div class="card-content">
                    <p><strong>📅 Date:</strong> March 28, 2024</p>
                    <p><strong>🕐 Time:</strong> 10:00 AM - 6:00 PM</p>
                    <p><strong>📍 Location:</strong> Student Center Gallery</p>
                    <p><strong>👥 Available Seats:</strong> <span class="seats-available">8</span>/30</p>
                    <p>Showcase your photography skills and view amazing works from fellow students.</p>
                    <button class="btn btn-primary" onclick="registerForEvent(2)">Register Now</button>
                </div>
            </div>

            <div class="card" data-club="debate" data-date="2024-04-02">
                <div class="card-header">
                    <div class="card-title">Debate Championship</div>
                    <span class="badge badge-warning">Debate Society</span>
                </div>
                <div class="card-content">
                    <p><strong>📅 Date:</strong> April 2, 2024</p>
                    <p><strong>🕐 Time:</strong> 1:00 PM - 8:00 PM</p>
                    <p><strong>📍 Location:</strong> Main Auditorium</p>
                    <p><strong>👥 Available Seats:</strong> <span class="seats-available">25</span>/100</p>
                    <p>Annual inter-college debate championship. Come support our debaters!</p>
                    <button class="btn btn-primary" onclick="registerForEvent(3)">Register Now</button>
                </div>
            </div>

            <div class="card" data-club="soccer" data-date="2024-03-30">
                <div class="card-header">
                    <div class="card-title">Soccer Tournament</div>
                    <span class="badge badge-info">Soccer Club</span>
                </div>
                <div class="card-content">
                    <p><strong>📅 Date:</strong> March 30, 2024</p>
                    <p><strong>🕐 Time:</strong> 9:00 AM - 5:00 PM</p>
                    <p><strong>📍 Location:</strong> University Sports Complex</p>
                    <p><strong>👥 Available Seats:</strong> <span class="seats-available">40</span>/200</p>
                    <p>Annual soccer tournament featuring teams from different departments. Prizes for winners!</p>
                    <button class="btn btn-primary" onclick="registerForEvent(4)">Register Now</button>
                </div>
            </div>

            <div class="card" data-club="science" data-date="2024-04-05">
                <div class="card-header">
                    <div class="card-title">Science Fair</div>
                    <span class="badge badge-success">Science Society</span>
                </div>
                <div class="card-content">
                    <p><strong>📅 Date:</strong> April 5, 2024</p>
                    <p><strong>🕐 Time:</strong> 11:00 AM - 4:00 PM</p>
                    <p><strong>📍 Location:</strong> Science Building Atrium</p>
                    <p><strong>👥 Available Seats:</strong> <span class="seats-available">60</span>/150</p>
                    <p>Present your research projects and explore innovative scientific discoveries from fellow students.</p>
                    <button class="btn btn-primary" onclick="registerForEvent(5)">Register Now</button>
                </div>
            </div>

            <div class="card" data-club="music" data-date="2024-04-08">
                <div class="card-header">
                    <div class="card-title">Spring Concert</div>
                    <span class="badge badge-warning">Music Club</span>
                </div>
                <div class="card-content">
                    <p><strong>📅 Date:</strong> April 8, 2024</p>
                    <p><strong>🕐 Time:</strong> 7:00 PM - 10:00 PM</p>
                    <p><strong>📍 Location:</strong> University Concert Hall</p>
                    <p><strong>👥 Available Seats:</strong> <span class="seats-available">120</span>/300</p>
                    <p>Enjoy an evening of beautiful music performed by talented student musicians.</p>
                    <button class="btn btn-primary" onclick="registerForEvent(6)">Register Now</button>
                </div>
            </div>
        </div>
    </div>
</div>