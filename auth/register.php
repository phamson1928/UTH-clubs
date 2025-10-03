<?php
session_start();
require_once '../config/database.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $student_id = $_POST['student_id'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
    
    if (!str_ends_with($email, '@ut.edu.vn')) {
        echo json_encode(['success' => false, 'message' => 'Email must be @ut.edu.vn domain']);
        exit;
    }
    
    $stmt = $pdo->prepare("SELECT id FROM users WHERE email = ?");
    $stmt->execute([$email]);
    
    if ($stmt->fetch()) {
        echo json_encode(['success' => false, 'message' => 'Email already exists']);
        exit;
    }
    
    $stmt = $pdo->prepare("INSERT INTO users (name, email, student_id, password, role) VALUES (?, ?, ?, ?, 'student')");
    
    if ($stmt->execute([$name, $email, $student_id, $password])) {
        $_SESSION['user_id'] = $pdo->lastInsertId();
        $_SESSION['user_name'] = $name;
        $_SESSION['user_role'] = 'student';
        
        echo json_encode(['success' => true, 'user' => [
            'name' => $name,
            'email' => $email,
            'role' => 'student'
        ]]);
    } else {
        echo json_encode(['success' => false, 'message' => 'Registration failed']);
    }
}
?>