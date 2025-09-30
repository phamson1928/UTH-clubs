// Authentication functions

function showLoginModal() {
    document.getElementById('loginModal').style.display = 'block';
}

function showRegisterModal() {
    document.getElementById('registerModal').style.display = 'block';
}

function closeModal(modalId) {
    document.getElementById(modalId).style.display = 'none';
}

function handleLogin(event) {
    event.preventDefault();
    
    const email = document.getElementById('loginEmail').value;
    
    if (!email.endsWith('@ut.edu.vn')) {
        showNotification('Email must be @ut.edu.vn domain!', 'error');
        return;
    }
    
    const formData = new FormData();
    formData.append('email', email);
    formData.append('password', document.getElementById('loginPassword').value);

    
    fetch('auth/login.php', {
        method: 'POST',
        body: formData
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            currentUser = data.user;
            updateAuthUI();
            closeModal('loginModal');
            showNotification('Login successful!', 'success');
            
            showSection('dashboard');
            if (data.user.role === 'admin') {
                document.getElementById('adminDashboard').style.display = 'block';
                document.getElementById('studentDashboard').style.display = 'none';
            } else {
                document.getElementById('adminDashboard').style.display = 'none';
                document.getElementById('studentDashboard').style.display = 'block';
            }
        } else {
            showNotification(data.message, 'error');
        }
    })
    .catch(error => {
        showNotification('Login failed!', 'error');
    });
}

function handleRegister(event) {
    event.preventDefault();
    
    const email = document.getElementById('registerEmail').value;
    const password = document.getElementById('registerPassword').value;
    const confirmPassword = document.getElementById('registerConfirmPassword').value;
    
    if (!email.endsWith('@ut.edu.vn')) {
        showNotification('Email must be @ut.edu.vn domain!', 'error');
        return;
    }
    
    if (password !== confirmPassword) {
        showNotification('Passwords do not match!', 'error');
        return;
    }
    
    const formData = new FormData();
    formData.append('name', document.getElementById('registerName').value);
    formData.append('email', email);
    formData.append('student_id', document.getElementById('registerStudentId').value);
    formData.append('password', password);
    
    fetch('auth/register.php', {
        method: 'POST',
        body: formData
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            currentUser = data.user;
            updateAuthUI();
            closeModal('registerModal');
            showNotification('Registration successful!', 'success');
        } else {
            showNotification(data.message, 'error');
        }
    })
    .catch(error => {
        showNotification('Registration failed!', 'error');
    });
}

function logout() {
    fetch('auth/logout.php')
    .then(response => response.json())
    .then(data => {
        currentUser = null;
        updateAuthUI();
        showSection('home');
        showNotification('Logged out successfully!', 'success');
    });
}

function updateAuthUI() {
    const authSection = document.getElementById('authSection');
    const navLinks = document.getElementById('navLinks');
    
    if (currentUser) {
        authSection.innerHTML = `
            <div class="user-info">
                <div class="user-avatar">${currentUser.name.charAt(0)}</div>
                <span>${currentUser.name}</span>
                <button class="btn btn-secondary" onclick="logout()">Logout</button>
            </div>
        `;
        
        // Add dashboard link
        if (!document.querySelector('a[onclick*="dashboard"]')) {
            const dashboardLi = document.createElement('li');
            dashboardLi.innerHTML = '<a href="#" onclick="showSection(\'dashboard\')">Dashboard</a>';
            navLinks.appendChild(dashboardLi);
        }
    } else {
        authSection.innerHTML = `
            <div class="auth-buttons">
                <a href="#" class="btn btn-secondary" onclick="showLoginModal()">Login</a>
                <a href="#" class="btn btn-primary" onclick="showRegisterModal()">Register</a>
            </div>
        `;
        
        // Remove dashboard link
        const dashboardLink = document.querySelector('a[onclick*="dashboard"]');
        if (dashboardLink) {
            dashboardLink.parentElement.remove();
        }
    }
}