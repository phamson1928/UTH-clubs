<?php
session_start();
require_once '../config/database.php';

header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    echo json_encode(['success' => false, 'message' => 'Invalid request method']);
    exit;
}

if (!isset($_SESSION['user_id'])) {
    echo json_encode(['success' => false, 'message' => 'Not authenticated']);
    exit;
}

$userId = (int)$_SESSION['user_id'];
$clubId = isset($_POST['club_id']) ? (int)$_POST['club_id'] : 0;

if ($clubId <= 0) {
    echo json_encode(['success' => false, 'message' => 'Invalid club']);
    exit;
}

try {
    // Ensure the status column exists (older DBs may not have it)
    try {
        $colCheck = $pdo->query("SHOW COLUMNS FROM club_members LIKE 'status'")->fetch();
        if (!$colCheck) {
            // If column missing, return an informative error for setup
            echo json_encode(['success' => false, 'message' => 'Database not configured for join requests: missing status column. Run update_club_members.sql']);
            exit;
        }
    } catch (Exception $e) {
        // If SHOW COLUMNS fails, fall back to generic message
        echo json_encode(['success' => false, 'message' => 'Database error checking schema']);
        exit;
    }
    // Check if already a member or has pending/rejected request
    $check = $pdo->prepare('SELECT id, status FROM club_members WHERE club_id = ? AND user_id = ?');
    $check->execute([$clubId, $userId]);
    $existing = $check->fetch();
    
    if ($existing) {
        if ($existing['status'] === 'approved') {
            echo json_encode(['success' => false, 'message' => 'Already a member']);
            exit;
        } elseif ($existing['status'] === 'pending') {
            echo json_encode(['success' => false, 'message' => 'Request already pending']);
            exit;
        } elseif ($existing['status'] === 'rejected') {
            // Update rejected request to pending
            $update = $pdo->prepare('UPDATE club_members SET status = "pending", joined_date = CURDATE() WHERE id = ?');
            $update->execute([$existing['id']]);
            echo json_encode(['success' => true, 'message' => 'Join request sent, waiting for admin approval']);
            exit;
        }
    }

    // Create new join request
    $ins = $pdo->prepare('INSERT INTO club_members (club_id, user_id, joined_date, status) VALUES (?, ?, CURDATE(), "pending")');
    $ins->execute([$clubId, $userId]);

    echo json_encode(['success' => true, 'message' => 'Join request sent, waiting for admin approval']);
} catch (Exception $e) {
    // Return error message to help debugging in development. In production you may hide this.
    $msg = getenv('APP_ENV') === 'production' ? 'Server error' : ('Server error: ' . $e->getMessage());
    echo json_encode(['success' => false, 'message' => $msg]);
}
?>


