<!-- Club Details Section -->
<div id="clubDetails" class="section">
    <div class="container">
        <div style="display: flex; align-items: center; gap: 1rem; margin-bottom: 2rem;">
            <button class="btn btn-secondary" onclick="goBackToClubs()">← Back to Clubs</button>
            <h1 id="clubDetailsTitle" style="margin: 0; color: #1f2937;">Club Details</h1>
        </div>

        <div id="clubDetailsContent">
            <!-- Club header info -->
            <div class="card" style="margin-bottom: 2rem;">
                <div class="card-header">
                    <div style="display: flex; justify-content: space-between; align-items: center; width: 100%;">
                        <div>
                            <div class="card-title" id="clubDetailName" style="font-size: 2rem; margin-bottom: 0.5rem;">Tech Club</div>
                            <div style="display: flex; gap: 1rem; align-items: center;">
                                <span class="badge badge-info" id="clubDetailCategory">Technology</span>
                                <span class="badge badge-success" id="clubDetailMemberCount">45 Members</span>
                            </div>
                        </div>
                        <button class="btn btn-success" onclick="joinClubFromDetails()" id="joinClubBtn">Join Club</button>
                    </div>
                </div>
                <div class="card-content">
                    <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(250px, 1fr)); gap: 2rem; margin-bottom: 1.5rem;">
                        <div>
                            <h4 style="color: #008689; margin-bottom: 0.5rem;">👤 Club Leader</h4>
                            <p id="clubDetailLeader" style="margin: 0; font-weight: 500;">Sarah Johnson</p>
                            <p style="margin: 0; color: #6b7280; font-size: 0.9rem;">Computer Science, 3rd Year</p>
                        </div>
                        <div>
                            <h4 style="color: #008689; margin-bottom: 0.5rem;">📅 Meeting Schedule</h4>
                            <p id="clubDetailSchedule" style="margin: 0;">Every Tuesday, 6:00 PM</p>
                            <p style="margin: 0; color: #6b7280; font-size: 0.9rem;">Engineering Building, Room 205</p>
                        </div>
                        <div>
                            <h4 style="color: #008689; margin-bottom: 0.5rem;">📧 Contact</h4>
                            <p style="margin: 0;">techclub@uth.edu</p>
                            <p style="margin: 0; color: #6b7280; font-size: 0.9rem;">+1 (555) 123-4567</p>
                        </div>
                    </div>
                    
                    <div>
                        <h4 style="color: #008689; margin-bottom: 1rem;">📝 About This Club</h4>
                        <p id="clubDetailDescription" style="line-height: 1.6; color: #374151;">
                            The Tech Club is a vibrant community of technology enthusiasts dedicated to exploring the latest innovations in software development, artificial intelligence, and emerging technologies. We organize workshops, hackathons, and tech talks featuring industry professionals.
                        </p>
                    </div>
                </div>
            </div>

            <!-- Club Activities -->
            <div class="card" style="margin-bottom: 2rem;">
                <div class="card-header">
                    <div class="card-title">🎯 Club Activities & Programs</div>
                </div>
                <div class="card-content">
                    <div class="card-grid" id="clubActivities">
                        <div style="padding: 1rem; border: 1px solid #e5e7eb; border-radius: 8px;">
                            <h5 style="color: #008689; margin-bottom: 0.5rem;">💻 Weekly Coding Sessions</h5>
                            <p style="margin: 0; font-size: 0.9rem; color: #6b7280;">Collaborative programming sessions where members work on projects together and learn new technologies.</p>
                        </div>
                        <div style="padding: 1rem; border: 1px solid #e5e7eb; border-radius: 8px;">
                            <h5 style="color: #008689; margin-bottom: 0.5rem;">🏆 Monthly Hackathons</h5>
                            <p style="margin: 0; font-size: 0.9rem; color: #6b7280;">24-hour coding competitions with exciting themes and prizes for innovative solutions.</p>
                        </div>
                        <div style="padding: 1rem; border: 1px solid #e5e7eb; border-radius: 8px;">
                            <h5 style="color: #008689; margin-bottom: 0.5rem;">🎤 Tech Talks</h5>
                            <p style="margin: 0; font-size: 0.9rem; color: #6b7280;">Guest speakers from leading tech companies share insights about industry trends and career opportunities.</p>
                        </div>
                        <div style="padding: 1rem; border: 1px solid #e5e7eb; border-radius: 8px;">
                            <h5 style="color: #008689; margin-bottom: 0.5rem;">🚀 Startup Incubator</h5>
                            <p style="margin: 0; font-size: 0.9rem; color: #6b7280;">Support and mentorship for members interested in launching their own tech startups.</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Recent Events -->
            <div class="card" style="margin-bottom: 2rem;">
                <div class="card-header">
                    <div class="card-title">📅 Recent & Upcoming Events</div>
                </div>
                <div class="card-content">
                    <div id="clubEvents">
                        <div style="display: flex; justify-content: space-between; align-items: center; padding: 1rem; border: 1px solid #e5e7eb; border-radius: 8px; margin-bottom: 1rem;">
                            <div>
                                <h5 style="margin: 0 0 0.5rem 0; color: #1f2937;">Tech Innovation Workshop</h5>
                                <p style="margin: 0; color: #6b7280; font-size: 0.9rem;">March 25, 2024 • Engineering Building, Room 101</p>
                            </div>
                            <span class="badge badge-info">Upcoming</span>
                        </div>
                        <div style="display: flex; justify-content: space-between; align-items: center; padding: 1rem; border: 1px solid #e5e7eb; border-radius: 8px; margin-bottom: 1rem;">
                            <div>
                                <h5 style="margin: 0 0 0.5rem 0; color: #1f2937;">AI & Machine Learning Seminar</h5>
                                <p style="margin: 0; color: #6b7280; font-size: 0.9rem;">March 15, 2024 • Online Event</p>
                            </div>
                            <span class="badge badge-success">Completed</span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Members List -->
            <div class="card">
                <div class="card-header">
                    <div style="display: flex; justify-content: space-between; align-items: center; width: 100%;">
                        <div class="card-title">👥 Club Members</div>
                        <div style="display: flex; gap: 1rem; align-items: center;">
                            <input type="text" placeholder="Search members..." id="memberSearch" onkeyup="filterMembers()" style="padding: 0.5rem; border: 1px solid #d1d5db; border-radius: 5px; font-size: 0.9rem;">
                            <span class="badge badge-info" id="memberCountBadge">45 Total</span>
                        </div>
                    </div>
                </div>
                <div class="card-content">
                    <div class="table-container">
                        <table>
                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Year</th>
                                    <th>Department</th>
                                    <th>Role</th>
                                    <th>Joined Date</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody id="membersTableBody">
                                <tr>
                                    <td><strong>Sarah Johnson</strong></td>
                                    <td>3rd Year</td>
                                    <td>Computer Science</td>
                                    <td><span class="badge badge-warning">Leader</span></td>
                                    <td>Sep 2023</td>
                                    <td><span class="badge badge-success">Active</span></td>
                                </tr>
                                <tr>
                                    <td>Michael Chen</td>
                                    <td>2nd Year</td>
                                    <td>Software Engineering</td>
                                    <td><span class="badge badge-info">Vice President</span></td>
                                    <td>Oct 2023</td>
                                    <td><span class="badge badge-success">Active</span></td>
                                </tr>
                                <tr>
                                    <td>Emma Davis</td>
                                    <td>4th Year</td>
                                    <td>Information Technology</td>
                                    <td><span class="badge badge-info">Secretary</span></td>
                                    <td>Sep 2023</td>
                                    <td><span class="badge badge-success">Active</span></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>