<!-- Dashboard Section (Admin/Student) -->
<div id="dashboard" class="section">
    <div class="container">
        <h1 style="text-align: center; margin-bottom: 2rem; color: #1f2937;">Dashboard</h1>
        
        <!-- Admin Dashboard -->
        <div id="adminDashboard" style="display: none;">
            <div class="stats-grid" id="adminStats"></div>

            <div style="display: flex; gap: 1rem; margin-bottom: 2rem; flex-wrap: wrap;">
                <button class="btn btn-primary" onclick="showAdminSection('users')">Manage Users</button>
                <button class="btn btn-primary" onclick="showAdminSection('clubs')">Manage Clubs</button>
                <button class="btn btn-primary" onclick="showAdminSection('events')">Manage Events</button>
                <button class="btn btn-primary" onclick="showAdminSection('requests')">Join Requests</button>
                <button class="btn btn-primary" onclick="showAdminSection('reports')">View Reports</button>
            </div>

            <!-- Admin Users Management -->
            <div id="adminUsers" class="admin-section" style="display: none;">
                <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 2rem;">
                    <h2>Manage Users</h2>
                    <button class="btn btn-success" onclick="showAddUserModal()">Add User</button>
                </div>
                <div class="table-container">
                    <table>
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Student ID</th>
                                <th>Role</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody id="usersTableBody"></tbody>
                    </table>
                </div>
            </div>

            <!-- Admin Clubs Management -->
            <div id="adminClubs" class="admin-section" style="display: none;">
                <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 2rem;">
                    <h2>Manage Clubs</h2>
                    <button class="btn btn-success" onclick="showAddClubModal()">Add New Club</button>
                </div>
                
                <div class="table-container">
                    <table>
                        <thead>
                            <tr>
                                <th>Club Name</th>
                                <th>Leader</th>
                                <th>Members</th>
                                <th>Category</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody id="clubsTableBody"></tbody>
                    </table>
                </div>
            </div>

            <!-- Admin Events Management -->
            <div id="adminEvents" class="admin-section" style="display: none;">
                <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 2rem;">
                    <h2>Manage Events</h2>
                    <button class="btn btn-success" onclick="showAddEventModal()">Add New Event</button>
                </div>
                
                <div class="table-container">
                    <table>
                        <thead>
                            <tr>
                                <th>Event Name</th>
                                <th>Club</th>
                                <th>Date</th>
                                <th>Location</th>
                                <th>Registrations</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody id="eventsTableBody"></tbody>
                    </table>
                </div>
            </div>



            <!-- Admin Join Requests -->
            <div id="adminRequests" class="admin-section" style="display: none;">
                <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 2rem;">
                    <h2>Club Join Requests</h2>
                </div>
                
                <div class="table-container">
                    <table>
                        <thead>
                            <tr>
                                <th>Student Name</th>
                                <th>Club</th>
                                <th>Request Date</th>
                                <th>Status</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody id="requestsTableBody"></tbody>
                    </table>
                </div>
            </div>

            <!-- Admin Reports -->
            <div id="adminReports" class="admin-section" style="display: none;">
                <h2 style="margin-bottom: 2rem;">Reports & Analytics</h2>
                
                <div style="display: flex; gap: 1rem; margin-bottom: 2rem; flex-wrap: wrap;">
                    <button class="btn btn-success" onclick="exportToExcel()">📊 Export to Excel</button>
                    <button class="btn btn-danger" onclick="exportToPDF()">📄 Export to PDF</button>
                </div>

                <div class="card-grid">
                    <div class="card">
                        <div class="card-header">
                            <div class="card-title">Club Membership Statistics</div>
                        </div>
                        <div class="card-content">
                            <div style="margin-bottom: 1rem;">
                                <strong>Tech Club:</strong> 45 members<br>
                                <strong>Soccer Club:</strong> 52 members<br>
                                <strong>Music Club:</strong> 41 members<br>
                                <strong>Art Club:</strong> 32 members<br>
                                <strong>Science Society:</strong> 38 members
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Student Dashboard -->
        <div id="studentDashboard" style="display: none;">
            <h2 style="margin-bottom: 2rem;">My Dashboard</h2>
            
            <div class="card-grid">
                <div class="card">
                    <div class="card-header">
                        <div class="card-title">My Clubs</div>
                    </div>
                    <div class="card-content">
                        <p><strong>Tech Club</strong> - Member since Jan 2024</p>
                        <p><strong>Art Club</strong> - Member since Feb 2024</p>
                        <button class="btn btn-primary" onclick="showSection('clubs')">Browse More Clubs</button>
                    </div>
                </div>

                <div class="card">
                    <div class="card-header">
                        <div class="card-title">My Event Registrations</div>
                    </div>
                    <div class="card-content">
                        <p><strong>Tech Innovation Workshop</strong> - March 25, 2024</p>
                        <p><strong>Photography Exhibition</strong> - March 28, 2024</p>
                        <button class="btn btn-primary" onclick="showSection('events')">Browse More Events</button>
                    </div>
                </div>

                <div class="card">
                    <div class="card-header">
                        <div class="card-title">Participation History</div>
                    </div>
                    <div class="card-content">
                        <p><strong>Winter Art Show</strong> - Attended (Feb 2024)</p>
                        <p><strong>Coding Bootcamp</strong> - Attended (Jan 2024)</p>
                        <p><strong>Debate Workshop</strong> - Attended (Dec 2023)</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>