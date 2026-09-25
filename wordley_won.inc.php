<?php

require_once 'config_session.inc.php';
require_once 'dbh.inc.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405);
    exit;
}

if (!isset($_SESSION['user_id'])) {
    http_response_code(401);
    echo 'log in to have your wins saved!';
    exit;
}

try {
    $stmt = $pdo->prepare("
        UPDATE users
        SET wordley_wins = wordley_wins + 1
        WHERE id = ?
    ");
    $stmt->execute([$_SESSION['user_id']]);
    // says nothing on success, so your "you won! congrats" message stays put
} catch (PDOException $e) {
    error_log($e->getMessage());
    http_response_code(500);
    echo 'crumbs :( your win could not be saved';
}