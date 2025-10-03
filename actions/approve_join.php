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

$adminId = (int)$_SESSION['user_id'];
$requestId = isset($_POST['request_id']) ? (int)$_POST['request_id'] : 0;
$action = isset($_POST['action']) ? $_POST['action'] : '';

if ($requestId <= 0 || !in_array($action, ['approve', 'reject'])) {
    echo json_encode(['success' => false, 'message' => 'Invalid parameters']);
    exit;
}

try {
    // Check if user is admin of the club
    $checkAdmin = $pdo->prepare('
        SELECT jr.club_id, jr.user_id 
        FROM join_requests jr 
        JOIN club_members cm ON jr.club_id = cm.club_id 
        WHERE jr.id = ? AND cm.user_id = ? AND cm.role = "admin" AND jr.status = "pending"
    ');
    $checkAdmin->execute([$requestId, $adminId]);
    $request = $checkAdmin->fetch(PDO::FETCH_ASSOC);
    
    if (!$request) {
        echo json_encode(['success' => false, 'message' => 'Unauthorized or request not found']);
        exit;
    }

    $status = $action === 'approve' ? 'approved' : 'rejected';
    
    // Update request status
    $update = $pdo->prepare('UPDATE join_requests SET status = ?, processed_by = ?, processed_date = NOW() WHERE id = ?');
    $update->execute([$status, $adminId, $requestId]);
    
    // If approved, add to club_members
    if ($action === 'approve') {
        $addMember = $pdo->prepare('INSERT INTO club_members (club_id, user_id, joined_date) VALUES (?, ?, NOW())');
        $addMember->execute([$request['club_id'], $request['user_id']]);
    }

    echo json_encode(['success' => true, 'message' => 'Request ' . $status]);
} catch (Exception $e) {
    echo json_encode(['success' => false, 'message' => 'Server error: ' . $e->getMessage()]);
}
?>