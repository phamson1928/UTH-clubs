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
        $stmt = $pdo->query("SELECT id, name, email, student_id, role, created_at FROM users ORDER BY created_at DESC");
        echo json_encode(['success' => true, 'data' => $stmt->fetchAll(PDO::FETCH_ASSOC)]);
        exit;
    }

    if ($method !== 'POST') {
        echo json_encode(['success' => false, 'message' => 'Invalid method']);
        exit;
    }

    if ($action === 'create') {
        $name = trim($_POST['name'] ?? '');
        $email = trim($_POST['email'] ?? '');
        $studentId = trim($_POST['student_id'] ?? '');
        $role = $_POST['role'] ?? 'student';
        $password = password_hash($_POST['password'] ?? '123456', PASSWORD_DEFAULT);
        if ($name === '' || $email === '') { echo json_encode(['success' => false, 'message' => 'Missing fields']); exit; }
        $stmt = $pdo->prepare('INSERT INTO users (name, email, student_id, password, role) VALUES (?, ?, ?, ?, ?)');
        $stmt->execute([$name, $email, $studentId, $password, $role]);
        echo json_encode(['success' => true, 'id' => (int)$pdo->lastInsertId()]);
        exit;
    }

    if ($action === 'update') {
        $id = (int)($_POST['id'] ?? 0);
        if ($id <= 0) { echo json_encode(['success' => false, 'message' => 'Invalid id']); exit; }
        $name = trim($_POST['name'] ?? '');
        $email = trim($_POST['email'] ?? '');
        $studentId = trim($_POST['student_id'] ?? '');
        $role = $_POST['role'] ?? 'student';
        $stmt = $pdo->prepare('UPDATE users SET name=?, email=?, student_id=?, role=? WHERE id=?');
        $stmt->execute([$name, $email, $studentId, $role, $id]);
        echo json_encode(['success' => true]);
        exit;
    }

    if ($action === 'delete') {
        $id = (int)($_POST['id'] ?? 0);
        if ($id <= 0) { echo json_encode(['success' => false, 'message' => 'Invalid id']); exit; }
        // Optional: cascade delete memberships and registrations
        $pdo->prepare('DELETE FROM club_members WHERE user_id = ?')->execute([$id]);
        $pdo->prepare('DELETE FROM event_registrations WHERE user_id = ?')->execute([$id]);
        $stmt = $pdo->prepare('DELETE FROM users WHERE id = ?');
        $stmt->execute([$id]);
        echo json_encode(['success' => true]);
        exit;
    }

    echo json_encode(['success' => false, 'message' => 'Unknown action']);
} catch (Exception $e) {
    error_log('Users.php error: ' . $e->getMessage());
    echo json_encode(['success' => false, 'message' => 'Server error: ' . $e->getMessage()]);
}
?>




