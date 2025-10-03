// Kiểm tra trạng thái đăng nhập khi trang load
document.addEventListener("DOMContentLoaded", function () {
  checkAuthStatus();
});

function checkAuthStatus() {
  fetch("../api/check_auth.php")
    .then((response) => response.json())
    .then((data) => {
      if (data.logged_in) {
        // Hiển thị dashboard phù hợp với role
        if (data.role === "admin") {
          document.getElementById("adminDashboard").style.display = "block";
          document.getElementById("studentDashboard").style.display = "none";
        } else {
          document.getElementById("adminDashboard").style.display = "none";
          document.getElementById("studentDashboard").style.display = "block";
        }

        // Cập nhật thông tin user
        updateUserInfo(data);
      } else {
        // Chuyển hướng về trang login
        window.location.href = "login.php";
      }
    })
    .catch((error) => {
      console.error("Error checking auth status:", error);
      window.location.href = "login.php";
    });
}

function updateUserInfo(userData) {
  // Cập nhật tên user trên giao diện
  const userElements = document.querySelectorAll(".user-name");
  userElements.forEach((element) => {
    element.textContent = userData.username;
  });
}

function logout() {
  if (confirm("Bạn có chắc chắn muốn đăng xuất?")) {
    fetch("../api/logout.php", {
      method: "POST",
    })
      .then((response) => response.json())
      .then((data) => {
        if (data.success) {
          window.location.href = "login.php";
        }
      })
      .catch((error) => {
        console.error("Logout error:", error);
        window.location.href = "login.php";
      });
  }
}

// Tự động refresh token mỗi 15 phút
setInterval(function () {
  fetch("../api/refresh_session.php", {
    method: "POST",
  });
}, 15 * 60 * 1000);
