<?php
header('Content-Type: application/json');
session_start();

if (isset($_SESSION['user_id']) && isset($_SESSION['user_name']) && isset($_SESSION['user_role'])) {
    $_SESSION['last_activity'] = time();
    
    echo json_encode([
        'logged_in' => true,
        'user' => [
            'id' => $_SESSION['user_id'],
            'name' => $_SESSION['user_name'],
            'role' => $_SESSION['user_role']
        ]
    ]);
} else {
    echo json_encode(['logged_in' => false]);
}
?>