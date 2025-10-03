<?php
header('Content-Type: application/json');
session_start();

// Check if session is valid and not expired
if (isset($_SESSION['user_id']) && isset($_SESSION['user_name']) && isset($_SESSION['user_role'])) {
    // Optional: Check session timeout (uncomment if needed)
    // if (isset($_SESSION['last_activity']) && (time() - $_SESSION['last_activity'] > 3600)) {
    //     session_destroy();
    //     echo json_encode(['logged_in' => false, 'message' => 'Session expired']);
    //     exit;
    // }
    
    // Update last activity time
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