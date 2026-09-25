<?php

// Set the response header to JSON
header('Content-Type: application/json');

ob_start();
require_once __DIR__ . '/dbh.inc.php';
require_once __DIR__ . '/config_session.inc.php';
ob_clean();

$rockId = $_GET['rockId'] ?? '';
$userId = $_SESSION['user_id'] ?? null;

if (!$userId) {
    echo json_encode(['error' => 'not logged in']);
    exit;
}

function insertRock(object $pdo, string $rockId, string $userId): void {
    if (!$rockId || !$userId) {
        echo json_encode(['error' => 'missing rock data or user session']);
        exit;
    }

    $check = 'SELECT quantity FROM users_rocks WHERE rockId = ? AND userId = ?;';
    $checkStmt = $pdo->prepare($check);
    $checkStmt->execute([$rockId, $userId]);

    if ($checkStmt->fetch(PDO::FETCH_ASSOC)) {
        $query = "UPDATE users_rocks SET quantity = quantity + 1 WHERE rockId = ? AND userId = ?";
        $stmt = $pdo->prepare($query);
        $stmt->execute([$rockId, $userId]);
        echo json_encode(['newRock' => false]);
        exit;
    }

    $query = "INSERT INTO users_rocks (rockId, userId, quantity) VALUES (?, ?, ?);";
    $stmt = $pdo->prepare($query);
    $stmt->execute([$rockId, $userId, 1]);
    echo json_encode(['newRock' => true]);

    $updtotal = "UPDATE users SET total_rocks = total_rocks + 1 WHERE id = ?";
    $updTotalStmt = $pdo->prepare($updtotal);
    $updTotalStmt->execute([$userId]);

    exit;
}

try {
    insertRock($pdo, $rockId, $userId);
} catch (PDOException $e) {
    http_response_code(500);
    echo json_encode([
        'error' => $e->getMessage()
    ]);
}