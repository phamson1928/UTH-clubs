<?php
require_once 'config/database.php';

// Create admin account
$email = 'admin@ut.edu.vn';
$password = password_hash('admin123', PASSWORD_DEFAULT);
$name = 'Admin User';

try {
    // Check if admin exists
    $stmt = $pdo->prepare("SELECT id FROM users WHERE email = ?");
    $stmt->execute([$email]);
    
    if ($stmt->fetch()) {
        echo "Admin account already exists!<br>";
        echo "Email: admin@ut.edu.vn<br>";
        echo "Password: admin123<br>";
    } else {
        // Create admin
        $stmt = $pdo->prepare("INSERT INTO users (name, email, password, role) VALUES (?, ?, ?, 'admin')");
        $stmt->execute([$name, $email, $password]);
        
        echo "✅ Admin account created successfully!<br>";
        echo "Email: admin@ut.edu.vn<br>";
        echo "Password: admin123<br>";
    }
    
    // Also update existing admin if exists
    $stmt = $pdo->prepare("UPDATE users SET password = ? WHERE email = ?");
    $stmt->execute([$password, $email]);
    
    echo "<br><a href='index.php'>Go to main site</a>";
    
} catch (Exception $e) {
    echo "Error: " . $e->getMessage();
}
?>