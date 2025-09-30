<!-- Login Modal -->
<div id="loginModal" class="modal">
    <div class="modal-content">
        <button class="modal-close" onclick="closeModal('loginModal')">&times;</button>
        <h2 style="margin-bottom: 1.5rem;">Login</h2>
        <form onsubmit="handleLogin(event)">
            <div class="form-group">
                <label class="form-label">Email</label>
                <input type="email" class="form-input" id="loginEmail" required>
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
                <input type="email" class="form-input" id="registerEmail" required>
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
                <select class="form-input" id="clubCategorySelect" required>
                    <option value="">Select Category</option>
                    <option value="technology">Technology</option>
                    <option value="arts">Arts</option>
                    <option value="sports">Sports</option>
                    <option value="academic">Academic</option>
                </select>
            </div>
            <div class="form-group">
                <label class="form-label">Leader Name</label>
                <input type="text" class="form-input" id="clubLeader" required>
            </div>
            <button type="submit" class="btn btn-primary" style="width: 100%;">Add Club</button>
        </form>
    </div>
</div>

<!-- Add Member Modal -->
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