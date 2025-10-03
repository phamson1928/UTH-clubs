<?php
session_start();
require_once '../../config/database.php';

header('Content-Type: application/json');

if (!isset($_SESSION['user_id']) || $_SESSION['user_role'] !== 'admin') {
    echo json_encode(['success' => false, 'message' => 'Unauthorized']);
    exit;
}

$action = $_GET['action'] ?? $_POST['action'] ?? '';

try {
    // Ensure 'status' column exists in club_members table (join-requests rely on it)
    try {
        $colCheck = $pdo->query("SHOW COLUMNS FROM club_members LIKE 'status'")->fetch();
        if (!$colCheck) {
            echo json_encode(['success' => false, 'message' => 'Database not configured for join requests: missing status column. Run update_club_members.sql']);
            exit;
        }
    } catch (Exception $e) {
        echo json_encode(['success' => false, 'message' => 'Database error checking schema']);
        exit;
    }
    switch ($action) {
        case 'list':
            $stmt = $pdo->query("SELECT cm.id, cm.club_id, cm.user_id, cm.joined_date, cm.status,
                                       u.name as user_name, u.email, u.student_id,
                                       c.name as club_name
                                FROM club_members cm
                                JOIN users u ON cm.user_id = u.id
                                JOIN clubs c ON cm.club_id = c.id
                                WHERE cm.status = 'pending'
                                ORDER BY cm.joined_date DESC");
            $requests = $stmt->fetchAll(PDO::FETCH_ASSOC);
            echo json_encode(['success' => true, 'data' => $requests]);
            break;

        case 'approve':
            $id = (int)$_POST['id'];
            $stmt = $pdo->prepare("UPDATE club_members SET status = 'approved' WHERE id = ?");
            $stmt->execute([$id]);
            echo json_encode(['success' => true, 'message' => 'Request approved']);
            break;

        case 'reject':
            $id = (int)$_POST['id'];
            $stmt = $pdo->prepare("UPDATE club_members SET status = 'rejected' WHERE id = ?");
            $stmt->execute([$id]);
            echo json_encode(['success' => true, 'message' => 'Request rejected']);
            break;

        default:
            echo json_encode(['success' => false, 'message' => 'Invalid action']);
    }
} catch (Exception $e) {
    echo json_encode(['success' => false, 'message' => 'Server error']);
}
?>