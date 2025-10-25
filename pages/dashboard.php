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


        </div>
    </div>
</div>