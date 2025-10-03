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
$eventId = isset($_POST['event_id']) ? (int)$_POST['event_id'] : 0;

if ($eventId <= 0) {
    echo json_encode(['success' => false, 'message' => 'Invalid event']);
    exit;
}

try {
    // Check capacity
    $cap = $pdo->prepare('SELECT max_participants FROM events WHERE id = ?');
    $cap->execute([$eventId]);
    $event = $cap->fetch(PDO::FETCH_ASSOC);
    if (!$event) {
        echo json_encode(['success' => false, 'message' => 'Event not found']);
        exit;
    }

    $cnt = $pdo->prepare('SELECT COUNT(*) AS c FROM event_registrations WHERE event_id = ?');
    $cnt->execute([$eventId]);
    $regCount = (int)$cnt->fetch(PDO::FETCH_ASSOC)['c'];
    if ($regCount >= (int)$event['max_participants']) {
        echo json_encode(['success' => false, 'message' => 'Event is full']);
        exit;
    }

    // Check if already registered
    $check = $pdo->prepare('SELECT id FROM event_registrations WHERE event_id = ? AND user_id = ?');
    $check->execute([$eventId, $userId]);
    if ($check->fetch()) {
        echo json_encode(['success' => false, 'message' => 'You have already registered for this event']);
        exit;
    }

    // Register
    $ins = $pdo->prepare("INSERT INTO event_registrations (event_id, user_id, status) VALUES (?, ?, 'registered')");
    $ins->execute([$eventId, $userId]);

    // Return seats left
    $cnt2 = $pdo->prepare('SELECT COUNT(*) AS c FROM event_registrations WHERE event_id = ?');
    $cnt2->execute([$eventId]);
    $afterCount = (int)$cnt2->fetch(PDO::FETCH_ASSOC)['c'];
    $seatsLeft = max(0, ((int)$event['max_participants']) - $afterCount);

    echo json_encode(['success' => true, 'seats_left' => $seatsLeft]);
} catch (Exception $e) {
    echo json_encode(['success' => false, 'message' => 'Server error']);
}
?>


