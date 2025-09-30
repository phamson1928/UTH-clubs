<!-- Clubs Section -->
<div id="clubs" class="section">
    <div class="container">
        <h1 style="text-align: center; margin-bottom: 2rem; color: #1f2937;">Student Clubs</h1>
        
        <div class="filters">
            <div class="filter-group">
                <label>Search Clubs</label>
                <input type="text" id="clubSearch" placeholder="Search by name..." onkeyup="filterClubs()">
            </div>
            <div class="filter-group">
                <label>Category</label>
                <select id="clubCategory" onchange="filterClubs()">
                    <option value="">All Categories</option>
                    <option value="technology">Technology</option>
                    <option value="arts">Arts</option>
                    <option value="sports">Sports</option>
                    <option value="academic">Academic</option>
                </select>
            </div>
        </div>

        <div class="card-grid" id="clubsList">
            <div class="card" data-category="technology">
                <div class="card-header">
                    <div class="card-title">💻 Tech Club</div>
                    <span class="badge badge-info">45 Members</span>
                </div>
                <div class="card-content">
                    <p><strong>Leader:</strong> Sarah Johnson</p>
                    <p><strong>Category:</strong> Technology</p>
                    <p>Explore the world of technology, programming, and innovation. Join us for workshops, hackathons, and tech talks.</p>
                    <p><strong>Meeting Schedule:</strong> Every Tuesday, 6:00 PM</p>
                    <button class="btn btn-success" onclick="joinClub(1)">Join Club</button>
                    <button class="btn btn-secondary" onclick="viewClubDetails(1)">View Details</button>
                </div>
            </div>

            <div class="card" data-category="arts">
                <div class="card-header">
                    <div class="card-title">🎨 Art Club</div>
                    <span class="badge badge-success">32 Members</span>
                </div>
                <div class="card-content">
                    <p><strong>Leader:</strong> Michael Chen</p>
                    <p><strong>Category:</strong> Arts</p>
                    <p>Express your creativity through various art forms. From painting to digital art, we welcome all artists.</p>
                    <p><strong>Meeting Schedule:</strong> Every Friday, 4:00 PM</p>
                    <button class="btn btn-success" onclick="joinClub(2)">Join Club</button>
                    <button class="btn btn-secondary" onclick="viewClubDetails(2)">View Details</button>
                </div>
            </div>

            <div class="card" data-category="academic">
                <div class="card-header">
                    <div class="card-title">🗣️ Debate Society</div>
                    <span class="badge badge-warning">28 Members</span>
                </div>
                <div class="card-content">
                    <p><strong>Leader:</strong> Emma Davis</p>
                    <p><strong>Category:</strong> Academic</p>
                    <p>Sharpen your public speaking and critical thinking skills through engaging debates and discussions.</p>
                    <p><strong>Meeting Schedule:</strong> Every Wednesday, 7:00 PM</p>
                    <button class="btn btn-success" onclick="joinClub(3)">Join Club</button>
                    <button class="btn btn-secondary" onclick="viewClubDetails(3)">View Details</button>
                </div>
            </div>

            <div class="card" data-category="sports">
                <div class="card-header">
                    <div class="card-title">⚽ Soccer Club</div>
                    <span class="badge badge-info">52 Members</span>
                </div>
                <div class="card-content">
                    <p><strong>Leader:</strong> David Wilson</p>
                    <p><strong>Category:</strong> Sports</p>
                    <p>Join our soccer team for regular practice sessions, friendly matches, and tournaments.</p>
                    <p><strong>Meeting Schedule:</strong> Every Monday & Thursday, 5:00 PM</p>
                    <button class="btn btn-success" onclick="joinClub(4)">Join Club</button>
                    <button class="btn btn-secondary" onclick="viewClubDetails(4)">View Details</button>
                </div>
            </div>

            <div class="card" data-category="academic">
                <div class="card-header">
                    <div class="card-title">🧪 Science Society</div>
                    <span class="badge badge-success">38 Members</span>
                </div>
                <div class="card-content">
                    <p><strong>Leader:</strong> Dr. Lisa Park</p>
                    <p><strong>Category:</strong> Academic</p>
                    <p>Explore scientific discoveries, conduct experiments, and participate in science fairs and competitions.</p>
                    <p><strong>Meeting Schedule:</strong> Every Saturday, 2:00 PM</p>
                    <button class="btn btn-success" onclick="joinClub(5)">Join Club</button>
                    <button class="btn btn-secondary" onclick="viewClubDetails(5)">View Details</button>
                </div>
            </div>

            <div class="card" data-category="arts">
                <div class="card-header">
                    <div class="card-title">🎵 Music Club</div>
                    <span class="badge badge-warning">41 Members</span>
                </div>
                <div class="card-content">
                    <p><strong>Leader:</strong> Alex Rodriguez</p>
                    <p><strong>Category:</strong> Arts</p>
                    <p>Share your love for music through performances, jam sessions, and music appreciation events.</p>
                    <p><strong>Meeting Schedule:</strong> Every Sunday, 3:00 PM</p>
                    <button class="btn btn-success" onclick="joinClub(6)">Join Club</button>
                    <button class="btn btn-secondary" onclick="viewClubDetails(6)">View Details</button>
                </div>
            </div>
        </div>
    </div>
</div>