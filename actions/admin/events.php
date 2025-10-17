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
        $stmt = $pdo->query("SELECT e.id, e.name, e.date, e.location, e.max_participants, e.description, e.club_id, e.event_image, c.name AS club_name,
                                    (SELECT COUNT(*) FROM event_registrations er WHERE er.event_id = e.id) AS registration_count
                             FROM events e LEFT JOIN clubs c ON c.id = e.club_id
                             ORDER BY e.date DESC");
        echo json_encode(['success' => true, 'data' => $stmt->fetchAll(PDO::FETCH_ASSOC)]);
        exit;
    }

    if ($method !== 'POST') {
        echo json_encode(['success' => false, 'message' => 'Invalid method']);
        exit;
    }

    if ($action === 'create') {
        $name = trim($_POST['name'] ?? '');
        $clubId = (int)($_POST['club_id'] ?? 0);
        $date = $_POST['date'] ?? '';
        $location = $_POST['location'] ?? '';
        $max = (int)($_POST['max_participants'] ?? 0);
        $description = $_POST['description'] ?? '';
        if ($name === '' || $clubId <= 0) { echo json_encode(['success' => false, 'message' => 'Missing fields']); exit; }
        $eventImagePath = null;
        if (!empty($_FILES['event_image']['name'])) {
            $uploadDir = __DIR__ . '/../../uploads/events/';
            if (!is_dir($uploadDir)) @mkdir($uploadDir, 0755, true);
            $tmp = $_FILES['event_image']['tmp_name'];
            $ext = pathinfo($_FILES['event_image']['name'], PATHINFO_EXTENSION);
            $filename = 'event_' . bin2hex(random_bytes(8)) . '.' . $ext;
            $dest = $uploadDir . $filename;
            if (move_uploaded_file($tmp, $dest)) {
                $eventImagePath = 'uploads/events/' . $filename;
            }
        }
        $stmt = $pdo->prepare('INSERT INTO events (club_id, name, date, location, max_participants, description, event_image) VALUES (?, ?, ?, ?, ?, ?, ?)');
        $stmt->execute([$clubId, $name, $date, $location, $max, $description, $eventImagePath]);
        echo json_encode(['success' => true, 'id' => (int)$pdo->lastInsertId()]);
        exit;
    }

    if ($action === 'update') {
        $id = (int)($_POST['id'] ?? 0);
        if ($id <= 0) { echo json_encode(['success' => false, 'message' => 'Invalid id']); exit; }
        $name = trim($_POST['name'] ?? '');
        $clubId = (int)($_POST['club_id'] ?? 0);
        $date = $_POST['date'] ?? '';
        $location = $_POST['location'] ?? '';
        $max = (int)($_POST['max_participants'] ?? 0);
        $description = $_POST['description'] ?? '';
        // handle optional new image
        $eventImagePath = null;
        if (!empty($_FILES['event_image']['name'])) {
            // fetch existing image to remove
            $old = $pdo->prepare('SELECT event_image FROM events WHERE id = ?');
            $old->execute([$id]);
            $oldRow = $old->fetch(PDO::FETCH_ASSOC);
            if ($oldRow && !empty($oldRow['event_image'])) {
                $oldPath = __DIR__ . '/../../' . $oldRow['event_image'];
                if (file_exists($oldPath)) @unlink($oldPath);
            }
            $uploadDir = __DIR__ . '/../../uploads/events/';
            if (!is_dir($uploadDir)) @mkdir($uploadDir, 0755, true);
            $tmp = $_FILES['event_image']['tmp_name'];
            $ext = pathinfo($_FILES['event_image']['name'], PATHINFO_EXTENSION);
            $filename = 'event_' . bin2hex(random_bytes(8)) . '.' . $ext;
            $dest = $uploadDir . $filename;
            if (move_uploaded_file($tmp, $dest)) {
                $eventImagePath = 'uploads/events/' . $filename;
            }
        }
        if ($eventImagePath !== null) {
            $stmt = $pdo->prepare('UPDATE events SET club_id=?, name=?, date=?, location=?, max_participants=?, description=?, event_image=? WHERE id=?');
            $stmt->execute([$clubId, $name, $date, $location, $max, $description, $eventImagePath, $id]);
        } else {
            $stmt = $pdo->prepare('UPDATE events SET club_id=?, name=?, date=?, location=?, max_participants=?, description=? WHERE id=?');
            $stmt->execute([$clubId, $name, $date, $location, $max, $description, $id]);
        }
        echo json_encode(['success' => true]);
        exit;
    }

    if ($action === 'delete') {
        $id = (int)($_POST['id'] ?? 0);
        if ($id <= 0) { echo json_encode(['success' => false, 'message' => 'Invalid id']); exit; }
        // delete event image file if exists
        $old = $pdo->prepare('SELECT event_image FROM events WHERE id = ?');
        $old->execute([$id]);
        $oldRow = $old->fetch(PDO::FETCH_ASSOC);
        if ($oldRow && !empty($oldRow['event_image'])) {
            $oldPath = __DIR__ . '/../../' . $oldRow['event_image'];
            if (file_exists($oldPath)) @unlink($oldPath);
        }
        $pdo->prepare('DELETE FROM event_registrations WHERE event_id = ?')->execute([$id]);
        $pdo->prepare('DELETE FROM events WHERE id = ?')->execute([$id]);
        echo json_encode(['success' => true]);
        exit;
    }

    echo json_encode(['success' => false, 'message' => 'Unknown action']);
} catch (Exception $e) {
    error_log('Events.php error: ' . $e->getMessage());
    echo json_encode(['success' => false, 'message' => 'Server error: ' . $e->getMessage()]);
}
?>




