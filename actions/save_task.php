<?php
session_start();
include('connection.php');

header('Content-Type: application/json; charset=utf-8');

if (!isset($_SESSION['user_id'])) {
    echo json_encode(['success' => false, 'message' => 'Usuário não autenticado']);
    exit;
}

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    echo json_encode(['success' => false, 'message' => 'Método inválido']);
    exit;
}

$userId = $_SESSION['user_id'];
$task_text = $_POST['task'] ?? '';
$day_index = intval($_POST['day'] ?? -1);
$hour = intval($_POST['hour'] ?? -1);


if ($task_text === '' || $day_index < 0 || $hour < 0) {
    echo json_encode(['success' => false, 'message' => 'Dados incompletos']);
    exit;
}

$stmt = $conn->prepare("INSERT INTO tasks (user_id, task_text, day_index, hour) VALUES (?, ?, ?, ?)");
if (!$stmt) {
    echo json_encode(['success' => false, 'message' => $conn->error]);
    exit;
}
$stmt->bind_param("isii", $userId, $task_text, $day_index, $hour);

if ($stmt->execute()) {
    $insertId = $stmt->insert_id;
    echo json_encode(['success' => true, 'id' => $insertId]);
} else {
    echo json_encode(['success' => false, 'message' => $stmt->error]);
}

$stmt->close();
$conn->close();
