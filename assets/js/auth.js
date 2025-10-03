// Authentication functions

// Check session on page load
window.addEventListener("DOMContentLoaded", function () {
  checkSession();
  
  // Check session every 5 minutes
  setInterval(() => {
    checkSession().then((data) => {
      if (!data && currentSection === 'dashboard') {
        showNotification('Session expired. Please login again.', 'error');
        showSection('home');
      }
    });
  }, 300000); // 5 minutes
});

function checkSession() {
  return fetch("auth/check_session.php")
    .then((response) => response.json())
    .then((data) => {
      if (data.logged_in) {
        currentUser = data.user;
        updateAuthUI();
        
        // If on dashboard page, ensure proper dashboard is shown
        if (currentSection === 'dashboard' || document.getElementById('dashboard').classList.contains('active')) {
          if (typeof initializeDashboard === 'function') {
            initializeDashboard();
          }
        }
        
        return data;
      } else {
        // Session expired or not logged in
        currentUser = null;
        updateAuthUI();
        
        // Hide dashboards if session expired
        if (document.getElementById('adminDashboard')) {
          document.getElementById('adminDashboard').style.display = 'none';
        }
        if (document.getElementById('studentDashboard')) {
          document.getElementById('studentDashboard').style.display = 'none';
        }
        
        return null;
      }
    })
    .catch((error) => {
      console.log("Session check failed:", error);
      currentUser = null;
      updateAuthUI();
      return null;
    });
}

function showLoginModal() {
  document.getElementById("loginModal").style.display = "block";
}

function showRegisterModal() {
  document.getElementById("registerModal").style.display = "block";
}

function closeModal(modalId) {
  document.getElementById(modalId).style.display = "none";
}

function handleLogin(event) {
  event.preventDefault();

  const email = document.getElementById("loginEmail").value;

  if (!email.endsWith("@ut.edu.vn")) {
    showNotification("Email must be @ut.edu.vn domain!", "error");
    return;
  }

  const formData = new FormData();
  formData.append("email", email);
  formData.append("password", document.getElementById("loginPassword").value);

  fetch("auth/login.php", {
    method: "POST",
    body: formData,
  })
    .then((response) => {
      console.log("Response status:", response.status);
      return response.json();
    })
    .then((data) => {
      console.log("Login response:", data);
      if (data.success) {
        currentUser = data.user;
        updateAuthUI();
        closeModal("loginModal");
        showNotification("Login successful!", "success");

        try {
          showSection("dashboard");
          // Dashboard initialization will be handled by showSection -> initializeDashboard
        } catch (sectionError) {
          console.error("Section error:", sectionError);
        }
      } else {
        showNotification(data.message || "Login failed", "error");
      }
    })
    .catch((error) => {
      console.error("Login error:", error);
      showNotification("Login failed!", "error");
    });
}

function handleRegister(event) {
  event.preventDefault();

  const email = document.getElementById("registerEmail").value;
  const password = document.getElementById("registerPassword").value;
  const confirmPassword = document.getElementById(
    "registerConfirmPassword"
  ).value;

  if (!email.endsWith("@ut.edu.vn")) {
    showNotification("Email must be @ut.edu.vn domain!", "error");
    return;
  }

  if (password !== confirmPassword) {
    showNotification("Passwords do not match!", "error");
    return;
  }

  const formData = new FormData();
  formData.append("name", document.getElementById("registerName").value);
  formData.append("email", email);
  formData.append(
    "student_id",
    document.getElementById("registerStudentId").value
  );
  formData.append("password", password);

  fetch("auth/register.php", {
    method: "POST",
    body: formData,
  })
    .then((response) => response.json())
    .then((data) => {
      if (data.success) {
        currentUser = data.user;
        updateAuthUI();
        closeModal("registerModal");
        showNotification("Registration successful!", "success");
      } else {
        showNotification(data.message, "error");
      }
    })
    .catch((error) => {
      showNotification("Registration failed!", "error");
    });
}

function logout() {
  fetch("auth/logout.php")
    .then((response) => response.json())
    .then((data) => {
      currentUser = null;
      updateAuthUI();
      showSection("home");
      showNotification("Logged out successfully!", "success");
    });
}
