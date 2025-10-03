// Modal functions
function showLoginModal() {
  document.getElementById("loginModal").style.display = "block";
}

function showRegisterModal() {
  document.getElementById("registerModal").style.display = "block";
}

function closeModal(modalId) {
  document.getElementById(modalId).style.display = "none";
}

function showAddClubModal() {
  document.getElementById("addClubModal").style.display = "block";
}

function showAddEventModal() {
  document.getElementById("addEventModal").style.display = "block";
}

function showAddMemberModal() {
  document.getElementById("addMemberModal").style.display = "block";
}

// Admin section functions
function showAdminSection(section) {
  const sections = ["clubs", "events", "members", "reports"];
  sections.forEach((s) => {
    const element = document.getElementById(
      "admin" + s.charAt(0).toUpperCase() + s.slice(1)
    );
    if (element) {
      element.style.display = s === section ? "block" : "none";
    }
  });
}

// CRUD functions
function editClub(id) {
  console.log("Edit club:", id);
}

function deleteClub(id) {
  if (confirm("Bạn có chắc chắn muốn xóa club này?")) {
    console.log("Delete club:", id);
  }
}

function editEvent(id) {
  console.log("Edit event:", id);
}

function deleteEvent(id) {
  if (confirm("Bạn có chắc chắn muốn xóa sự kiện này?")) {
    console.log("Delete event:", id);
  }
}

function viewMemberDetails(id) {
  console.log("View member:", id);
}

function editMember(id) {
  console.log("Edit member:", id);
}

function exportToExcel() {
  console.log("Export to Excel");
}

function exportToPDF() {
  console.log("Export to PDF");
}
