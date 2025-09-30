// Admin functions

function showAdminSection(sectionName) {
    document.querySelectorAll('.admin-section').forEach(section => {
        section.style.display = 'none';
    });
    
    document.getElementById('admin' + sectionName.charAt(0).toUpperCase() + sectionName.slice(1)).style.display = 'block';
}

function showAddClubModal() {
    document.getElementById('addClubModal').style.display = 'block';
}

function showAddEventModal() {
    showNotification('Add Event modal would open here!', 'success');
}

function handleAddClub(event) {
    event.preventDefault();
    
    const name = document.getElementById('clubName').value;
    const description = document.getElementById('clubDescription').value;
    const category = document.getElementById('clubCategorySelect').value;
    const leader = document.getElementById('clubLeader').value;
    
    showNotification('Club added successfully!', 'success');
    closeModal('addClubModal');
    
    // Reset form
    event.target.reset();
}

function editClub(clubId) {
    showNotification('Edit club functionality would be implemented here!', 'success');
}

function deleteClub(clubId) {
    if (confirm('Are you sure you want to delete this club?')) {
        showNotification('Club deleted successfully!', 'success');
    }
}

function editEvent(eventId) {
    showNotification('Edit event functionality would be implemented here!', 'success');
}

function deleteEvent(eventId) {
    if (confirm('Are you sure you want to delete this event?')) {
        showNotification('Event deleted successfully!', 'success');
    }
}

function exportToExcel() {
    showNotification('Exporting to Excel... (Demo)', 'success');
}

function exportToPDF() {
    showNotification('Exporting to PDF... (Demo)', 'success');
}

// Member management functions
function showAddMemberModal() {
    document.getElementById('addMemberModal').style.display = 'block';
}

function handleAddMember(event) {
    event.preventDefault();
    
    const name = document.getElementById('memberName').value;
    const studentId = document.getElementById('memberStudentId').value;
    const email = document.getElementById('memberEmail').value;
    const department = document.getElementById('memberDepartment').value;
    const year = document.getElementById('memberYear').value;
    const phone = document.getElementById('memberPhone').value;
    
    showNotification('Member added successfully!', 'success');
    closeModal('addMemberModal');
    
    // Reset form
    event.target.reset();
}

function viewMemberDetails(memberId) {
    // Sample member data - in a real app, this would come from a database
    const memberData = {
        1: {
            name: 'Sarah Johnson',
            studentId: 'CS2021001',
            email: 'sarah.johnson@uth.edu',
            department: 'Computer Science',
            year: '3rd Year',
            phone: '+1 (555) 123-4567',
            joinDate: 'Sep 15, 2023',
            status: 'Active',
            clubs: ['Tech Club (Leader)'],
            events: ['Tech Innovation Workshop', 'AI & Machine Learning Seminar'],
            gpa: '3.85',
            address: '123 University Ave, Campus Housing'
        }
    };

    const member = memberData[memberId] || memberData[1];

    const content = `
        <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 2rem; margin-bottom: 2rem;">
            <div>
                <h4 style="color: #008689; margin-bottom: 1rem;">📋 Personal Information</h4>
                <p><strong>Name:</strong> ${member.name}</p>
                <p><strong>Student ID:</strong> ${member.studentId}</p>
                <p><strong>Email:</strong> ${member.email}</p>
                <p><strong>Phone:</strong> ${member.phone}</p>
                <p><strong>Address:</strong> ${member.address}</p>
            </div>
            <div>
                <h4 style="color: #008689; margin-bottom: 1rem;">🎓 Academic Information</h4>
                <p><strong>Department:</strong> ${member.department}</p>
                <p><strong>Year:</strong> ${member.year}</p>
                <p><strong>GPA:</strong> ${member.gpa}</p>
                <p><strong>Join Date:</strong> ${member.joinDate}</p>
                <p><strong>Status:</strong> <span class="badge badge-success">${member.status}</span></p>
            </div>
        </div>
        
        <div style="margin-bottom: 2rem;">
            <h4 style="color: #008689; margin-bottom: 1rem;">🏛️ Club Memberships</h4>
            <div style="display: flex; gap: 0.5rem; flex-wrap: wrap;">
                ${member.clubs.map(club => `<span class="badge badge-info">${club}</span>`).join('')}
            </div>
        </div>
        
        <div>
            <h4 style="color: #008689; margin-bottom: 1rem;">📅 Event Participation</h4>
            <ul style="margin: 0; padding-left: 1.5rem;">
                ${member.events.map(event => `<li>${event}</li>`).join('')}
            </ul>
        </div>
        
        <div style="margin-top: 2rem; display: flex; gap: 1rem; justify-content: flex-end;">
            <button class="btn btn-primary" onclick="editMember(${memberId}); closeModal('memberDetailsModal');">Edit Member</button>
            <button class="btn btn-secondary" onclick="closeModal('memberDetailsModal')">Close</button>
        </div>
    `;

    document.getElementById('memberDetailsContent').innerHTML = content;
    document.getElementById('memberDetailsModal').style.display = 'block';
}

function editMember(memberId) {
    // Sample data for editing
    const memberData = {
        1: { name: 'Sarah Johnson', studentId: 'CS2021001', email: 'sarah.johnson@uth.edu', department: 'Computer Science', year: '3rd Year', status: 'Active' }
    };

    const member = memberData[memberId];
    if (member) {
        document.getElementById('editMemberId').value = memberId;
        document.getElementById('editMemberName').value = member.name;
        document.getElementById('editMemberStudentId').value = member.studentId;
        document.getElementById('editMemberEmail').value = member.email;
        document.getElementById('editMemberDepartment').value = member.department;
        document.getElementById('editMemberYear').value = member.year;
        document.getElementById('editMemberStatus').value = member.status;
        
        document.getElementById('editMemberModal').style.display = 'block';
    }
}

function handleEditMember(event) {
    event.preventDefault();
    
    const memberId = document.getElementById('editMemberId').value;
    const name = document.getElementById('editMemberName').value;
    
    showNotification(`Member ${name} updated successfully!`, 'success');
    closeModal('editMemberModal');
}

function suspendMember(memberId) {
    if (confirm('Are you sure you want to suspend this member?')) {
        showNotification('Member suspended successfully!', 'success');
    }
}

function activateMember(memberId) {
    showNotification('Member activated successfully!', 'success');
}

function filterAdminMembers() {
    const searchTerm = document.getElementById('adminMemberSearch').value.toLowerCase();
    const department = document.getElementById('adminMemberDepartment').value;
    const year = document.getElementById('adminMemberYear').value;
    const status = document.getElementById('adminMemberStatus').value;
    const club = document.getElementById('adminMemberClub').value;
    
    const rows = document.querySelectorAll('#adminMembersTableBody tr');
    let visibleCount = 0;
    
    rows.forEach(row => {
        const name = row.cells[2].textContent.toLowerCase();
        const email = row.cells[3].textContent.toLowerCase();
        const studentId = row.cells[1].textContent.toLowerCase();
        const rowDepartment = row.getAttribute('data-department');
        const rowYear = row.getAttribute('data-year');
        const rowStatus = row.getAttribute('data-status');
        const rowClubs = row.getAttribute('data-clubs');
        
        const matchesSearch = name.includes(searchTerm) || email.includes(searchTerm) || studentId.includes(searchTerm);
        const matchesDepartment = !department || rowDepartment === department;
        const matchesYear = !year || rowYear === year;
        const matchesStatus = !status || rowStatus === status;
        const matchesClub = !club || rowClubs.includes(club);
        
        if (matchesSearch && matchesDepartment && matchesYear && matchesStatus && matchesClub) {
            row.style.display = '';
            visibleCount++;
        } else {
            row.style.display = 'none';
        }
    });
}

function toggleSelectAllMembers() {
    const selectAll = document.getElementById('selectAllMembers');
    const checkboxes = document.querySelectorAll('.member-checkbox');
    
    checkboxes.forEach(checkbox => {
        checkbox.checked = selectAll.checked;
    });
    
    updateBulkActionsPanel();
}

function updateBulkActionsPanel() {
    const checkboxes = document.querySelectorAll('.member-checkbox:checked');
    const bulkPanel = document.getElementById('bulkActionsPanel');
    const selectedCount = document.getElementById('selectedCount');
    
    if (checkboxes.length > 0) {
        bulkPanel.style.display = 'block';
        selectedCount.textContent = `${checkboxes.length} member(s) selected`;
    } else {
        bulkPanel.style.display = 'none';
    }
}

function bulkEditMembers() {
    const selected = document.querySelectorAll('.member-checkbox:checked');
    if (selected.length === 0) {
        showNotification('Please select members to edit!', 'error');
        return;
    }
    showNotification(`Bulk edit for ${selected.length} members would be implemented here!`, 'success');
}

function bulkActivateMembers() {
    const selected = document.querySelectorAll('.member-checkbox:checked');
    if (selected.length === 0) {
        showNotification('Please select members to activate!', 'error');
        return;
    }
    
    if (confirm(`Are you sure you want to activate ${selected.length} selected members?`)) {
        showNotification(`${selected.length} members activated successfully!`, 'success');
        
        // Clear selections
        selected.forEach(checkbox => checkbox.checked = false);
        document.getElementById('selectAllMembers').checked = false;
        updateBulkActionsPanel();
    }
}

function bulkSuspendMembers() {
    const selected = document.querySelectorAll('.member-checkbox:checked');
    if (selected.length === 0) {
        showNotification('Please select members to suspend!', 'error');
        return;
    }
    
    if (confirm(`Are you sure you want to suspend ${selected.length} selected members?`)) {
        showNotification(`${selected.length} members suspended successfully!`, 'success');
        
        // Clear selections
        selected.forEach(checkbox => checkbox.checked = false);
        document.getElementById('selectAllMembers').checked = false;
        updateBulkActionsPanel();
    }
}

function bulkExportMembers() {
    const selected = document.querySelectorAll('.member-checkbox:checked');
    if (selected.length === 0) {
        showNotification('Please select members to export!', 'error');
        return;
    }
    showNotification(`Exporting ${selected.length} selected members... (Demo)`, 'success');
}

function exportMembersData() {
    showNotification('Exporting all members data... (Demo)', 'success');
}