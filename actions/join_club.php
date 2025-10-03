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
    // Check if already a member
    $check = $pdo->prepare('SELECT id FROM club_members WHERE club_id = ? AND user_id = ?');
    $check->execute([$clubId, $userId]);
    if ($check->fetch()) {
        echo json_encode(['success' => true, 'message' => 'Already a member']);
        exit;
    }

    // Insert membership
    $ins = $pdo->prepare('INSERT INTO club_members (club_id, user_id, joined_date) VALUES (?, ?, CURRENT_DATE)');
    $ins->execute([$clubId, $userId]);

    // Return updated count
    $cnt = $pdo->prepare('SELECT COUNT(*) AS member_count FROM club_members WHERE club_id = ?');
    $cnt->execute([$clubId]);
    $row = $cnt->fetch(PDO::FETCH_ASSOC);

    echo json_encode(['success' => true, 'member_count' => (int)$row['member_count']]);
} catch (Exception $e) {
    echo json_encode(['success' => false, 'message' => 'Server error']);
}
?>


