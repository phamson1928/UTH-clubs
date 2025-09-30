<!-- Dashboard Section (Admin/Student) -->
<div id="dashboard" class="section">
    <div class="container">
        <h1 style="text-align: center; margin-bottom: 2rem; color: #1f2937;">Dashboard</h1>
        
        <!-- Admin Dashboard -->
        <div id="adminDashboard" style="display: none;">
            <div class="stats-grid">
                <div class="stat-card">
                    <div class="stat-number">12</div>
                    <div class="stat-label">Total Clubs</div>
                </div>
                <div class="stat-card">
                    <div class="stat-number">24</div>
                    <div class="stat-label">Active Events</div>
                </div>
                <div class="stat-card">
                    <div class="stat-number">456</div>
                    <div class="stat-label">Registered Students</div>
                </div>
                <div class="stat-card">
                    <div class="stat-number">1,234</div>
                    <div class="stat-label">Event Registrations</div>
                </div>
            </div>

            <div style="display: flex; gap: 1rem; margin-bottom: 2rem; flex-wrap: wrap;">
                <button class="btn btn-primary" onclick="showAdminSection('clubs')">Manage Clubs</button>
                <button class="btn btn-primary" onclick="showAdminSection('events')">Manage Events</button>
                <button class="btn btn-primary" onclick="showAdminSection('members')">Manage Members</button>
                <button class="btn btn-primary" onclick="showAdminSection('reports')">View Reports</button>
            </div>

            <!-- Admin Clubs Management -->
            <div id="adminClubs" class="admin-section">
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
                                <th>Status</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>Tech Club</td>
                                <td>Sarah Johnson</td>
                                <td>45</td>
                                <td>Technology</td>
                                <td><span class="badge badge-success">Active</span></td>
                                <td>
                                    <button class="btn btn-secondary" onclick="editClub(1)">Edit</button>
                                    <button class="btn btn-danger" onclick="deleteClub(1)">Delete</button>
                                </td>
                            </tr>
                        </tbody>
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
                                <th>Status</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>Tech Innovation Workshop</td>
                                <td>Tech Club</td>
                                <td>March 25, 2024</td>
                                <td>Engineering Building</td>
                                <td>35/50</td>
                                <td><span class="badge badge-success">Active</span></td>
                                <td>
                                    <button class="btn btn-secondary" onclick="editEvent(1)">Edit</button>
                                    <button class="btn btn-danger" onclick="deleteEvent(1)">Delete</button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- Admin Members Management -->
            <div id="adminMembers" class="admin-section" style="display: none;">
                <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 2rem;">
                    <h2>Manage Members</h2>
                    <button class="btn btn-success" onclick="showAddMemberModal()">Add New Member</button>
                </div>
                
                <div class="table-container">
                    <table>
                        <thead>
                            <tr>
                                <th>Student ID</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Department</th>
                                <th>Year</th>
                                <th>Status</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>CS2021001</td>
                                <td>Sarah Johnson</td>
                                <td>sarah.johnson@uth.edu</td>
                                <td>Computer Science</td>
                                <td>3rd Year</td>
                                <td><span class="badge badge-success">Active</span></td>
                                <td>
                                    <button class="btn btn-secondary" onclick="viewMemberDetails(1)">View</button>
                                    <button class="btn btn-primary" onclick="editMember(1)">Edit</button>
                                </td>
                            </tr>
                        </tbody>
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