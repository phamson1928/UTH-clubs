<!-- Login Modal -->
<div id="loginModal" class="modal">
    <div class="modal-content">
        <button class="modal-close" onclick="closeModal('loginModal')">&times;</button>
        <h2 style="margin-bottom: 1.5rem;">Login</h2>
        <form onsubmit="handleLogin(event)">
            <div class="form-group">
                <label class="form-label">Email</label>
                <input type="email" class="form-input" id="loginEmail" placeholder="example@ut.edu.vn" required>
            </div>
            <div class="form-group">
                <label class="form-label">Password</label>
                <input type="password" class="form-input" id="loginPassword" required>
            </div>
            <button type="submit" class="btn btn-primary" style="width: 100%;">Login</button>
        </form>
    </div>
</div>

<!-- Register Modal -->
<div id="registerModal" class="modal">
    <div class="modal-content">
        <button class="modal-close" onclick="closeModal('registerModal')">&times;</button>
        <h2 style="margin-bottom: 1.5rem;">Register</h2>
        <form onsubmit="handleRegister(event)">
            <div class="form-group">
                <label class="form-label">Full Name</label>
                <input type="text" class="form-input" id="registerName" required>
            </div>
            <div class="form-group">
                <label class="form-label">Email</label>
                <input type="email" class="form-input" id="registerEmail" placeholder="example@ut.edu.vn" required>
            </div>
            <div class="form-group">
                <label class="form-label">Student ID</label>
                <input type="text" class="form-input" id="registerStudentId" required>
            </div>
            <div class="form-group">
                <label class="form-label">Password</label>
                <input type="password" class="form-input" id="registerPassword" required>
            </div>
            <div class="form-group">
                <label class="form-label">Confirm Password</label>
                <input type="password" class="form-input" id="registerConfirmPassword" required>
            </div>
            <button type="submit" class="btn btn-primary" style="width: 100%;">Register</button>
        </form>
    </div>
</div>

<!-- Event Registration Modal -->
<div id="eventRegisterModal" class="modal">
    <div class="modal-content">
        <button class="modal-close" onclick="closeModal('eventRegisterModal')">&times;</button>
        <h2 style="margin-bottom: 1.5rem;">Event Registration</h2>
        <div id="eventRegisterContent">
            <p>Please login to register for events.</p>
            <button class="btn btn-primary" onclick="showLoginModal()">Login</button>
        </div>
    </div>
</div>

<!-- Add Club Modal -->
<div id="addClubModal" class="modal">
    <div class="modal-content">
        <button class="modal-close" onclick="closeModal('addClubModal')">&times;</button>
        <h2 style="margin-bottom: 1.5rem;">Add New Club</h2>
        <form onsubmit="handleAddClub(event)">
            <div class="form-group">
                <label class="form-label">Club Name</label>
                <input type="text" class="form-input" id="clubName" required>
            </div>
            <div class="form-group">
                <label class="form-label">Description</label>
                <textarea class="form-input" id="clubDescription" rows="3" required></textarea>
            </div>
            <div class="form-group">
                <label class="form-label">Category</label>
                <input type="text" class="form-input" id="clubCategoryInput" placeholder="Enter category" required>
            </div>
            <div class="form-group">
                <label class="form-label">Leader</label>
                <select class="form-input" id="clubLeader">
                    <option value="">Select Leader (Optional)</option>
                </select>
            </div>
            <div class="form-group">
                <label class="form-label">Meeting Schedule</label>
                <input type="text" class="form-input" id="clubSchedule" placeholder="e.g., Every Monday 6PM">
            </div>
            <div class="form-group">
                <label class="form-label">Activities (comma separated)</label>
                <input type="text" class="form-input" id="clubActivitiesInput" placeholder="e.g., Workshops, Mentoring, Competitions">
            </div>
            <div class="form-group">
                <label class="form-label">Club Image</label>
                <input type="file" class="form-input" id="clubImageInput" accept="image/*">
            </div>
            <button type="submit" class="btn btn-primary" style="width: 100%;">Add Club</button>
        </form>
    </div>
</div>

<!-- Add Member Modal -->

<!-- Image Modal -->
<div id="imageModal" class="modal">
    <div class="modal-content">
        <button class="modal-close" onclick="closeModal('imageModal')">&times;</button>
        <div style="text-align:center;">
            <img id="modalImage" src="" alt="" style="max-width:100%; max-height:80vh; border-radius:6px;">
            <div id="modalImageCaption" style="margin-top:0.5rem; color:#6b7280;"></div>
        </div>
    </div>
</div>
<div id="addMemberModal" class="modal">
    <div class="modal-content">
        <button class="modal-close" onclick="closeModal('addMemberModal')">&times;</button>
        <h2 style="margin-bottom: 1.5rem;">Add New Member</h2>
        <form onsubmit="handleAddMember(event)">
            <div class="form-group">
                <label class="form-label">Full Name</label>
                <input type="text" class="form-input" id="memberName" required>
            </div>
            <div class="form-group">
                <label class="form-label">Student ID</label>
                <input type="text" class="form-input" id="memberStudentId" required>
            </div>
            <div class="form-group">
                <label class="form-label">Email</label>
                <input type="email" class="form-input" id="memberEmail" required>
            </div>
            <div class="form-group">
                <label class="form-label">Department</label>
                <select class="form-input" id="memberDepartment" required>
                    <option value="">Select Department</option>
                    <option value="Computer Science">Computer Science</option>
                    <option value="Software Engineering">Software Engineering</option>
                    <option value="Information Technology">Information Technology</option>
                    <option value="Data Science">Data Science</option>
                    <option value="Cybersecurity">Cybersecurity</option>
                    <option value="Business Administration">Business Administration</option>
                    <option value="Mechanical Engineering">Mechanical Engineering</option>
                    <option value="Civil Engineering">Civil Engineering</option>
                </select>
            </div>
            <div class="form-group">
                <label class="form-label">Year</label>
                <select class="form-input" id="memberYear" required>
                    <option value="">Select Year</option>
                    <option value="1st Year">1st Year</option>
                    <option value="2nd Year">2nd Year</option>
                    <option value="3rd Year">3rd Year</option>
                    <option value="4th Year">4th Year</option>
                </select>
            </div>
            <div class="form-group">
                <label class="form-label">Phone Number</label>
                <input type="tel" class="form-input" id="memberPhone">
            </div>
            <button type="submit" class="btn btn-primary" style="width: 100%;">Add Member</button>
        </form>
    </div>
</div>

<!-- Add User Modal -->
<div id="addUserModal" class="modal">
    <div class="modal-content">
        <button class="modal-close" onclick="closeModal('addUserModal')">&times;</button>
        <h2 style="margin-bottom: 1.5rem;">Add User</h2>
        <form id="addUserForm" onsubmit="handleAddUser(event)">
            <div class="form-group">
                <label class="form-label">Name</label>
                <input type="text" class="form-input" id="userName" required>
            </div>
            <div class="form-group">
                <label class="form-label">Email</label>
                <input type="email" class="form-input" id="userEmail" required>
            </div>
            <div class="form-group">
                <label class="form-label">Student ID</label>
                <input type="text" class="form-input" id="userStudentId">
            </div>
            <div class="form-group">
                <label class="form-label">Role</label>
                <select class="form-input" id="userRole">
                    <option value="student">Student</option>
                    <option value="admin">Admin</option>
                </select>
            </div>
            <div class="form-group">
                <label class="form-label">Password</label>
                <input type="password" class="form-input" id="userPassword" placeholder="Default 123456 if empty">
            </div>
            <button type="submit" class="btn btn-primary" style="width: 100%;">Add</button>
        </form>
    </div>
</div>

<!-- Add Event Modal -->
<div id="addEventModal" class="modal">
    <div class="modal-content">
        <button class="modal-close" onclick="closeModal('addEventModal')">&times;</button>
        <h2 style="margin-bottom: 1.5rem;">Add New Event</h2>
        <form onsubmit="handleAddEvent(event)">
            <div class="form-group">
                <label class="form-label">Event Name</label>
                <input type="text" class="form-input" id="eventName" required>
            </div>
            <div class="form-group">
                <label class="form-label">Club</label>
                <select class="form-input" id="addEventClub" required>
                    <option value="">Select Club</option>
                </select>
            </div>
            <div class="form-group">
                <label class="form-label">Date & Time</label>
                <input type="datetime-local" class="form-input" id="eventDate" required>
            </div>
            <div class="form-group">
                <label class="form-label">Location</label>
                <input type="text" class="form-input" id="eventLocation" required>
            </div>
            <div class="form-group">
                <label class="form-label">Max Participants</label>
                <input type="number" class="form-input" id="eventMaxParticipants" min="1" value="50">
            </div>
            <div class="form-group">
                <label class="form-label">Description</label>
                <textarea class="form-input" id="eventDescription" rows="3"></textarea>
            </div>
            <div class="form-group">
                <label class="form-label">Event Image</label>
                <input type="file" class="form-input" id="eventImageInput" accept="image/*">
            </div>
            <button type="submit" class="btn btn-primary" style="width: 100%;">Add Event</button>
        </form>
    </div>
</div>

<!-- Edit User Modal -->
<div id="editUserModal" class="modal">
    <div class="modal-content">
        <button class="modal-close" onclick="closeModal('editUserModal')">&times;</button>
        <h2 style="margin-bottom: 1.5rem;">Edit User</h2>
        <form onsubmit="handleEditUser(event)">
            <input type="hidden" id="editUserId">
            <div class="form-group">
                <label class="form-label">Name</label>
                <input type="text" class="form-input" id="editUserName" required>
            </div>
            <div class="form-group">
                <label class="form-label">Email</label>
                <input type="email" class="form-input" id="editUserEmail" required>
            </div>
            <div class="form-group">
                <label class="form-label">Student ID</label>
                <input type="text" class="form-input" id="editUserStudentId">
            </div>
            <div class="form-group">
                <label class="form-label">Role</label>
                <select class="form-input" id="editUserRole">
                    <option value="student">Student</option>
                    <option value="admin">Admin</option>
                </select>
            </div>
            <button type="submit" class="btn btn-primary" style="width: 100%;">Update User</button>
        </form>
    </div>
</div>

<!-- Edit Club Modal -->
<div id="editClubModal" class="modal">
    <div class="modal-content">
        <button class="modal-close" onclick="closeModal('editClubModal')">&times;</button>
        <h2 style="margin-bottom: 1.5rem;">Edit Club</h2>
        <form onsubmit="handleEditClub(event)">
            <input type="hidden" id="editClubId">
            <div class="form-group">
                <label class="form-label">Club Name</label>
                <input type="text" class="form-input" id="editClubName" required>
            </div>
            <div class="form-group">
                <label class="form-label">Description</label>
                <textarea class="form-input" id="editClubDescription" rows="3" required></textarea>
            </div>
            <div class="form-group">
                <label class="form-label">Category</label>
                <input type="text" class="form-input" id="editClubCategoryInput" placeholder="Enter category" required>
            </div>
            <div class="form-group">
                <label class="form-label">Leader</label>
                <select class="form-input" id="editClubLeader">
                    <option value="">Select Leader (Optional)</option>
                </select>
            </div>
            <div class="form-group">
                <label class="form-label">Meeting Schedule</label>
                <input type="text" class="form-input" id="editClubSchedule" placeholder="e.g., Every Monday 6PM">
            </div>
            <div class="form-group">
                <label class="form-label">Activities (comma separated)</label>
                <input type="text" class="form-input" id="editClubActivitiesInput" placeholder="e.g., Workshops, Mentoring, Competitions">
            </div>
            <div class="form-group">
                <label class="form-label">Club Image</label>
                <input type="file" class="form-input" id="editClubImageInput" accept="image/*">
                <div id="editClubImagePreview" style="margin-top: .5rem;"></div>
            </div>
            <button type="submit" class="btn btn-primary" style="width: 100%;">Update Club</button>
        </form>
    </div>
</div>

<!-- Edit Event Modal -->
<div id="editEventModal" class="modal">
    <div class="modal-content">
        <button class="modal-close" onclick="closeModal('editEventModal')">&times;</button>
        <h2 style="margin-bottom: 1.5rem;">Edit Event</h2>
        <form onsubmit="handleEditEvent(event)">
            <input type="hidden" id="editEventId">
            <div class="form-group">
                <label class="form-label">Event Name</label>
                <input type="text" class="form-input" id="editEventName" required>
            </div>
            <div class="form-group">
                <label class="form-label">Club</label>
                <select class="form-input" id="editEventClub" required>
                    <option value="">Select Club</option>
                </select>
            </div>
            <div class="form-group">
                <label class="form-label">Date & Time</label>
                <input type="datetime-local" class="form-input" id="editEventDate" required>
            </div>
            <div class="form-group">
                <label class="form-label">Location</label>
                <input type="text" class="form-input" id="editEventLocation" required>
            </div>
            <div class="form-group">
                <label class="form-label">Max Participants</label>
                <input type="number" class="form-input" id="editEventMaxParticipants" min="1">
            </div>
            <div class="form-group">
                <label class="form-label">Description</label>
                <textarea class="form-input" id="editEventDescription" rows="3"></textarea>
            </div>
            <div class="form-group">
                <label class="form-label">Event Image</label>
                <input type="file" class="form-input" id="editEventImageInput" accept="image/*">
                <div id="editEventImagePreview" style="margin-top: .5rem;"></div>
            </div>
            <button type="submit" class="btn btn-primary" style="width: 100%;">Update Event</button>
        </form>
    </div>
</div>

