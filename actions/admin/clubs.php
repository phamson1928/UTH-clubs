<?php
session_start();
require_once '../../config/database.php';
header('Content-Type: application/json');

if (!isset($_SESSION['user_id']) || ($_SESSION['user_role'] ?? '') !== 'admin') {
    echo json_encode(['success' => false, 'message' => 'Unauthorized']);
    exit;
}

$method = $_SERVER['REQUEST_METHOD'];
$action = $_GET['action'] ?? $_POST['action'] ?? 'list';

try {
    if ($action === 'list') {
        $stmt = $pdo->query("SELECT c.id, c.name, c.description, c.category, c.schedule_meeting, c.activities, c.club_image, c.leader_id,
                                    u.name AS leader_name,
                                    (SELECT COUNT(*) FROM club_members cm WHERE cm.club_id = c.id) AS member_count
                             FROM clubs c
                             LEFT JOIN users u ON u.id = c.leader_id
                             ORDER BY c.created_at DESC");
        echo json_encode(['success' => true, 'data' => $stmt->fetchAll(PDO::FETCH_ASSOC)]);
        exit;
    }

    if ($action === 'get_users') {
        $stmt = $pdo->query("SELECT id, name, email FROM users WHERE role = 'student' ORDER BY name");
        echo json_encode(['success' => true, 'data' => $stmt->fetchAll(PDO::FETCH_ASSOC)]);
        exit;
    }

    if ($method !== 'POST') {
        echo json_encode(['success' => false, 'message' => 'Invalid method']);
        exit;
    }

    if ($action === 'create') {
        $name = trim($_POST['name'] ?? '');
        $description = $_POST['description'] ?? '';
        $category = $_POST['category'] ?? '';
        $activities = $_POST['activities'] ?? '';
        $leaderId = !empty($_POST['leader_id']) ? (int)$_POST['leader_id'] : null;
        $schedule = $_POST['schedule_meeting'] ?? '';
        if ($name === '') {
            echo json_encode(['success' => false, 'message' => 'Name is required']);
            exit;
        }

        $clubImagePath = null;
        if (!empty($_FILES['club_image']) && $_FILES['club_image']['error'] === UPLOAD_ERR_OK) {
            $uploadDir = __DIR__ . '/../../uploads/clubs/';
            if (!is_dir($uploadDir)) mkdir($uploadDir, 0755, true);
            $tmp = $_FILES['club_image']['tmp_name'];
            $origName = basename($_FILES['club_image']['name']);
            $ext = strtolower(pathinfo($origName, PATHINFO_EXTENSION));
            $allowed = ['jpg','jpeg','png','gif','webp'];
            if (!in_array($ext, $allowed)) {
                echo json_encode(['success' => false, 'message' => 'Invalid image type']);
                exit;
            }
            $newName = uniqid('club_', true) . '.' . $ext;
            $dest = $uploadDir . $newName;
            if (move_uploaded_file($tmp, $dest)) {
                $clubImagePath = 'uploads/clubs/' . $newName;
            }
        }
        
        $stmt = $pdo->prepare('INSERT INTO clubs (name, description, category, leader_id, schedule_meeting) VALUES (?, ?, ?, ?, ?)');
        if ($clubImagePath !== null) {
            $stmt = $pdo->prepare('INSERT INTO clubs (name, description, category, leader_id, activities, schedule_meeting, club_image) VALUES (?, ?, ?, ?, ?, ?, ?)');
            $stmt->execute([$name, $description, $category, $leaderId, $activities, $schedule, $clubImagePath]);
        } else {
            $stmt = $pdo->prepare('INSERT INTO clubs (name, description, category, leader_id, activities, schedule_meeting) VALUES (?, ?, ?, ?, ?, ?)');
            $stmt->execute([$name, $description, $category, $leaderId, $activities, $schedule]);
        }
        echo json_encode(['success' => true, 'id' => (int)$pdo->lastInsertId()]);
        exit;
    }

    if ($action === 'update') {
        $id = (int)($_POST['id'] ?? 0);
        if ($id <= 0) { echo json_encode(['success' => false, 'message' => 'Invalid id']); exit; }
        $name = trim($_POST['name'] ?? '');
        $description = $_POST['description'] ?? '';
        $category = $_POST['category'] ?? '';
        $leaderId = !empty($_POST['leader_id']) ? (int)$_POST['leader_id'] : null;
        $schedule = $_POST['schedule_meeting'] ?? '';
        $activities = $_POST['activities'] ?? '';
        $clubImagePath = null;
        if (!empty($_FILES['club_image']) && $_FILES['club_image']['error'] === UPLOAD_ERR_OK) {
            $uploadDir = __DIR__ . '/../../uploads/clubs/';
            if (!is_dir($uploadDir)) mkdir($uploadDir, 0755, true);
            $tmp = $_FILES['club_image']['tmp_name'];
            $origName = basename($_FILES['club_image']['name']);
            $ext = strtolower(pathinfo($origName, PATHINFO_EXTENSION));
            $allowed = ['jpg','jpeg','png','gif','webp'];
            if (!in_array($ext, $allowed)) {
                echo json_encode(['success' => false, 'message' => 'Invalid image type']);
                exit;
            }
            $newName = uniqid('club_', true) . '.' . $ext;
            $dest = $uploadDir . $newName;
            if (move_uploaded_file($tmp, $dest)) {
                $clubImagePath = 'uploads/clubs/' . $newName;
                $old = $pdo->prepare('SELECT club_image FROM clubs WHERE id = ?');
                $old->execute([$id]);
                $oldPath = $old->fetchColumn();
                if ($oldPath) {
                    $oldFull = __DIR__ . '/../../' . $oldPath;
                    if (is_file($oldFull)) @unlink($oldFull);
                }
            }
        }
        if ($clubImagePath !== null) {
            $stmt = $pdo->prepare('UPDATE clubs SET name=?, description=?, category=?, leader_id=?, activities=?, schedule_meeting=?, club_image=? WHERE id=?');
            $stmt->execute([$name, $description, $category, $leaderId, $activities, $schedule, $clubImagePath, $id]);
        } else {
            $stmt = $pdo->prepare('UPDATE clubs SET name=?, description=?, category=?, leader_id=?, activities=?, schedule_meeting=? WHERE id=?');
            $stmt->execute([$name, $description, $category, $leaderId, $activities, $schedule, $id]);
        }
        
        echo json_encode(['success' => true]);
        exit;
    }

    if ($action === 'delete') {
        $id = (int)($_POST['id'] ?? 0);
        if ($id <= 0) { echo json_encode(['success' => false, 'message' => 'Invalid id']); exit; }
        $old = $pdo->prepare('SELECT club_image FROM clubs WHERE id = ?');
        $old->execute([$id]);
        $oldPath = $old->fetchColumn();
        if ($oldPath) {
            $oldFull = __DIR__ . '/../../' . $oldPath;
            if (is_file($oldFull)) @unlink($oldFull);
        }
        $pdo->prepare('DELETE FROM club_members WHERE club_id = ?')->execute([$id]);
        $pdo->prepare('DELETE FROM events WHERE club_id = ?')->execute([$id]);
        $stmt = $pdo->prepare('DELETE FROM clubs WHERE id = ?');
        $stmt->execute([$id]);
        echo json_encode(['success' => true]);
        exit;
    }

    echo json_encode(['success' => false, 'message' => 'Unknown action']);
} catch (Exception $e) {
    echo json_encode(['success' => false, 'message' => 'Server error']);
}
?>




