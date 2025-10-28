// Global state
let currentUser = null;
let currentSection = "home";

// Navigation
function showSection(sectionName) {
  // Prevent non-admin users from accessing dashboard
  if (
    sectionName === "dashboard" &&
    (!currentUser || currentUser.role !== "admin")
  ) {
    showNotification("Dashboard is for admin only", "error");
    return;
  }
  // Hide all sections
  document.querySelectorAll(".section").forEach((section) => {
    section.classList.remove("active");
  });

  // Show selected section
  document.getElementById(sectionName).classList.add("active");

  // Update navigation
  document.querySelectorAll(".nav-links a").forEach((link) => {
    link.classList.remove("active");
  });

  // Find and activate the corresponding nav link
  const targetLink = document.querySelector(
    `a[onclick*="showSection('${sectionName}')"]`
  );
  if (targetLink) {
    targetLink.classList.add("active");
  }

  currentSection = sectionName;

  // Update URL without page reload (only if not called from popstate)
  if (history.pushState && !window.isPopstateNavigation) {
    const newUrl =
      sectionName === "home"
        ? window.location.pathname
        : `${window.location.pathname}?section=${sectionName}`;
    history.pushState({ section: sectionName }, "", newUrl);
  }
  window.isPopstateNavigation = false;

  // Load dashboard data when showing dashboard
  if (sectionName === "dashboard") {
    checkSession().then(() => {
      initializeDashboard();
    });
  }

  // Re-initialize admin event listeners when switching to dashboard
  if (
    sectionName === "dashboard" &&
    currentUser &&
    currentUser.role === "admin"
  ) {
    setTimeout(() => {
      initializeAdminEventListeners();
    }, 200);
  }
}

// Club functions
function joinClub(clubId) {
  if (!currentUser) {
    showNotification("Please login to join clubs!", "error");
    showLoginModal();
    return;
  }

  const formData = new FormData();
  formData.append("club_id", clubId);
  fetch("actions/join_club.php", {
    method: "POST",
    body: formData,
  })
    .then((res) => res.json())
    .then((data) => {
      if (data.success) {
        showNotification(
          data.message || "Successfully joined the club!",
          "success"
        );
        // Update member badge on the card if present
        try {
          const card = Array.from(
            document.querySelectorAll("#clubsList .card")
          ).find((el) =>
            el
              .querySelector("button.btn.btn-success")
              ?.getAttribute("onclick")
              ?.includes(`joinClub(${clubId})`)
          );
          if (card && data.member_count !== undefined) {
            const badge = card.querySelector(".badge");
            if (badge) badge.textContent = `${data.member_count} Members`;
          }
        } catch (e) {}
      } else {
        showNotification(data.message || "Failed to join club", "error");
      }
    })
    .catch(() => showNotification("Failed to join club", "error"));
}

function filterClubs() {
  const searchTerm = document.getElementById("clubSearch").value.toLowerCase();
  const category = (
    document.getElementById("clubCategory").value || ""
  ).toLowerCase();
  const clubs = document.querySelectorAll("#clubsList .card");

  clubs.forEach((club) => {
    const title = club.querySelector(".card-title").textContent.toLowerCase();
    const clubCategory = club.getAttribute("data-category");

    const matchesSearch = title.includes(searchTerm);
    const matchesCategory =
      !category || (clubCategory || "").includes(category);

    if (matchesSearch && matchesCategory) {
      club.style.display = "block";
    } else {
      club.style.display = "none";
    }
  });
}

// Event functions
function registerForEvent(eventId) {
  if (!currentUser) {
    document.getElementById("eventRegisterContent").innerHTML = `
            <p>Please login to register for events.</p>
            <button class="btn btn-primary" onclick="showLoginModal(); closeModal('eventRegisterModal');">Login</button>
        `;
    document.getElementById("eventRegisterModal").style.display = "block";
    return;
  }

  const formData = new FormData();
  formData.append("event_id", eventId);
  fetch("actions/register_event.php", {
    method: "POST",
    body: formData,
  })
    .then((res) => res.json())
    .then((data) => {
      if (data.success) {
        showNotification("Successfully registered for the event!", "success");
        // Update UI for successful registration
        try {
          // Update events page
          const eventCard = Array.from(
            document.querySelectorAll("#eventsList .card")
          ).find((el) =>
            el
              .querySelector("button.btn.btn-primary")
              ?.getAttribute("onclick")
              ?.includes(`registerForEvent(${eventId})`)
          );
          if (eventCard) {
            // Update seats available
            if (data.seats_left !== undefined) {
              const seatsElement = eventCard.querySelector(".seats-available");
              if (seatsElement) seatsElement.textContent = data.seats_left;
            }
            // Update button to show registered state
            const button = eventCard.querySelector("button.btn.btn-primary");
            if (button) {
              button.textContent = "Already Registered";
              button.className = "btn btn-secondary";
              button.disabled = true;
              button.removeAttribute("onclick");
            }
          }

          // Update home page featured events
          const homeCard = Array.from(
            document.querySelectorAll("#upcomingEvents .card")
          ).find((el) =>
            el
              .querySelector("button.btn.btn-primary")
              ?.getAttribute("onclick")
              ?.includes(`registerForEvent(${eventId})`)
          );
          if (homeCard) {
            // Update seats available
            if (data.seats_left !== undefined) {
              const seatsElement = homeCard.querySelector(".seats-available");
              if (seatsElement) seatsElement.textContent = data.seats_left;
            }
            // Update button to show registered state
            const button = homeCard.querySelector("button.btn.btn-primary");
            if (button) {
              button.textContent = "Already Registered";
              button.className = "btn btn-secondary";
              button.disabled = true;
              button.removeAttribute("onclick");
            }
          }
        } catch (e) {}
      } else {
        showNotification(data.message || "Registration failed", "error");
      }
    })
    .catch(() => showNotification("Registration failed", "error"));
}

function filterEvents() {
  const searchTerm = document.getElementById("eventSearch").value.toLowerCase();
  const club = document.getElementById("eventClub").value;
  const dateFrom = document.getElementById("eventDateFrom").value;
  const dateTo = document.getElementById("eventDateTo").value;
  const events = document.querySelectorAll("#eventsList .card");

  events.forEach((event) => {
    const title = event.querySelector(".card-title").textContent.toLowerCase();
    const eventClub = event.getAttribute("data-club");
    const eventDate = event.getAttribute("data-date");

    const matchesSearch = title.includes(searchTerm);
    const matchesClub = !club || eventClub === club;
    const matchesDateFrom = !dateFrom || eventDate >= dateFrom;
    const matchesDateTo = !dateTo || eventDate <= dateTo;

    if (matchesSearch && matchesClub && matchesDateFrom && matchesDateTo) {
      event.style.display = "block";
    } else {
      event.style.display = "none";
    }
  });
}

// Notification system
function showNotification(message, type = "success") {
  const notification = document.getElementById("notification");
  notification.textContent = message;
  notification.className = `notification ${type === "error" ? "error" : ""}`;
  notification.classList.add("show");

  setTimeout(() => {
    notification.classList.remove("show");
  }, 3000);
}

// Show image in modal (used for event thumbnails)
function showImageModal(src, caption) {
  const img = document.getElementById("modalImage");
  const cap = document.getElementById("modalImageCaption");
  if (img) img.src = src || "";
  if (cap) cap.textContent = caption || "";
  document.getElementById("imageModal").style.display = "block";
}

window.showImageModal = showImageModal;

// Close modals when clicking outside
window.onclick = function (event) {
  const modals = document.querySelectorAll(".modal");
  modals.forEach((modal) => {
    if (event.target === modal) {
      modal.style.display = "none";
    }
  });
};

function joinClubFromDetails() {
  if (!currentUser) {
    showNotification("Please login to join clubs!", "error");
    showLoginModal();
    return;
  }

  showNotification("Successfully joined the club!", "success");

  // Update button text
  const joinBtn = document.getElementById("joinClubBtn");
  joinBtn.textContent = "Already Joined";
  joinBtn.disabled = true;
  joinBtn.classList.remove("btn-success");
  joinBtn.classList.add("btn-secondary");
}

function updateAuthUI() {
  const authSection = document.getElementById("authSection");
  const navLinks = document.getElementById("navLinks");

  if (currentUser) {
    authSection.innerHTML = `
      <div class="user-info">
        <div class="user-avatar">${currentUser.name.charAt(0)}</div>
        <span>${currentUser.name}</span>
        <button class="btn btn-secondary" onclick="logout(); return false;">Logout</button>
      </div>
    `;

    // Add dashboard link only for admins; remove if not admin
    const existingDashboardLink = document.querySelector(
      'a[onclick*="dashboard"]'
    );
    if (currentUser.role === "admin") {
      if (!existingDashboardLink) {
        const dashboardLi = document.createElement("li");
        dashboardLi.innerHTML =
          '<a href="#" onclick="showSection(\'dashboard\'); return false;">Dashboard</a>';
        navLinks.appendChild(dashboardLi);
      }
    } else if (existingDashboardLink) {
      existingDashboardLink.parentElement.remove();
    }
  } else {
    authSection.innerHTML = `
      <div class="auth-buttons">
        <a href="#" class="btn btn-secondary" onclick="showLoginModal(); return false;">Login</a>
        <a href="#" class="btn btn-primary" onclick="showRegisterModal(); return false;">Register</a>
      </div>
    `;

    // Remove dashboard link
    const dashboardLink = document.querySelector('a[onclick*="dashboard"]');
    if (dashboardLink) {
      dashboardLink.parentElement.remove();
    }
  }
}

// Wait for all admin functions to be available
function waitForAdminFunctions() {
  return new Promise((resolve) => {
    const checkFunctions = () => {
      if (
        typeof loadStats === "function" &&
        typeof loadUsers === "function" &&
        typeof loadClubs === "function" &&
        typeof loadEvents === "function" &&
        typeof loadRequests === "function"
      ) {
        resolve();
      } else {
        setTimeout(checkFunctions, 100);
      }
    };
    checkFunctions();
  });
}

// Initialize dashboard data after session check
function initializeDashboard() {
  if (currentUser && currentUser.role === "admin") {
    // Show admin dashboard
    const adminDashboard = document.getElementById("adminDashboard");
    if (adminDashboard) adminDashboard.style.display = "block";
    const studentDashboard = document.getElementById("studentDashboard");
    if (studentDashboard) studentDashboard.style.display = "none";

    // Wait for admin functions to be available, then load data
    waitForAdminFunctions().then(() => {
      try {
        loadStats();
        loadUsers();
        loadClubs();
        loadEvents();
        loadRequests();
        showAdminSection("users"); // Show users section by default

        // Re-initialize admin event listeners after loading
        setTimeout(() => {
          initializeAdminEventListeners();
        }, 100);

        console.log("Dashboard data loaded successfully");
      } catch (error) {
        console.error("Error loading dashboard data:", error);
        showNotification("Error loading dashboard data", "error");
      }
    });
  } else if (currentUser) {
    // Non-admin users should not see any dashboard
    document.getElementById("adminDashboard").style.display = "none";
    const studentDash = document.getElementById("studentDashboard");
    if (studentDash) studentDash.style.display = "none";
    // Redirect to home if somehow invoked
    showSection("home");
  }
}

// Initialize admin event listeners
function initializeAdminEventListeners() {
  // Re-attach event listeners for admin section buttons
  const adminButtons = document.querySelectorAll(
    'button[onclick*="showAdminSection"]'
  );
  adminButtons.forEach((button) => {
    // Remove existing onclick to prevent conflicts
    button.removeAttribute("onclick");

    // Get section name from button text or data attribute
    const buttonText = button.textContent.toLowerCase();
    let sectionName = "";

    if (buttonText.includes("users")) sectionName = "users";
    else if (buttonText.includes("clubs")) sectionName = "clubs";
    else if (buttonText.includes("events")) sectionName = "events";
    else if (buttonText.includes("requests")) sectionName = "requests";
    else if (buttonText.includes("reports")) sectionName = "reports";

    if (sectionName) {
      button.addEventListener("click", (e) => {
        e.preventDefault();
        showAdminSection(sectionName);
      });
    }
  });
}

// Initialize
document.addEventListener("DOMContentLoaded", function () {
  // Check session first, then initialize UI
  checkSession().then(() => {
    updateAuthUI();

    // If dashboard is currently active, initialize it
    if (document.getElementById("dashboard").classList.contains("active")) {
      initializeDashboard();
    }
  });

  // Set default dates for event filters
  const today = new Date();
  const nextMonth = new Date(
    today.getFullYear(),
    today.getMonth() + 1,
    today.getDate()
  );

  if (document.getElementById("eventDateFrom")) {
    document.getElementById("eventDateFrom").value = today
      .toISOString()
      .split("T")[0];
  }
  if (document.getElementById("eventDateTo")) {
    document.getElementById("eventDateTo").value = nextMonth
      .toISOString()
      .split("T")[0];
  }

  // Boot initial section from server (if provided via globals injected in header)
  try {
    if (window.__ACTIVE_SECTION__) {
      showSection(window.__ACTIVE_SECTION__);

      // If initial section is dashboard, ensure it's properly initialized
      if (window.__ACTIVE_SECTION__ === "dashboard") {
        // Wait for all scripts to load before initializing
        setTimeout(() => {
          checkSession().then(() => {
            if (currentUser) {
              initializeDashboard();
            }
          });
        }, 500);
      }
    } else {
      // Ensure home section is shown by default
      showSection("home");
    }
  } catch (e) {
    // Fallback to home section
    showSection("home");
  }
});

// Handle browser back/forward buttons
window.addEventListener("popstate", function (event) {
  const urlParams = new URLSearchParams(window.location.search);
  let sectionName = urlParams.get("section") || "home";

  // Guard: prevent non-admins from navigating to dashboard via browser controls
  if (
    sectionName === "dashboard" &&
    (!currentUser || currentUser.role !== "admin")
  ) {
    sectionName = "home";
  }

  window.isPopstateNavigation = true;

  // Update section without adding to history again
  document.querySelectorAll(".section").forEach((section) => {
    section.classList.remove("active");
  });
  document.getElementById(sectionName).classList.add("active");

  // Update navigation
  document.querySelectorAll(".nav-links a").forEach((link) => {
    link.classList.remove("active");
  });
  const targetLink = document.querySelector(
    `a[onclick*="showSection('${sectionName}')"]`
  );
  if (targetLink) {
    targetLink.classList.add("active");
  }

  currentSection = sectionName;

  // Load dashboard data if needed
  if (sectionName === "dashboard") {
    checkSession().then(() => {
      initializeDashboard();
    });
  }
});

// Additional check when window fully loads (for refresh scenarios)
window.addEventListener("load", function () {
  // Double-check dashboard initialization after full page load
  if (document.getElementById("dashboard").classList.contains("active")) {
    setTimeout(() => {
      checkSession().then(() => {
        if (currentUser && currentUser.role === "admin") {
          // Ensure admin dashboard is visible and data is loaded
          const adminDashboard = document.getElementById("adminDashboard");
          const studentDashboard = document.getElementById("studentDashboard");

          if (adminDashboard && adminDashboard.style.display === "none") {
            initializeDashboard();
          }
        }
      });
    }, 200);
  }
});
