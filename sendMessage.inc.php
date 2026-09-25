<?php

require_once 'dbh.inc.php';
require_once 'config_session.inc.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $chat_id = $_POST['chat_id'];
    $sender_id = $_SESSION['user_id'];
    $message = $_POST['message'];

    try {
        
        $stmt = $pdo->prepare('
        SELECT 1 FROM chats
        WHERE chat_id = ? AND (user_id_1 = ? OR user_id_2 = ?)
        ');
        $stmt->execute([$chat_id, $sender_id, $sender_id]);

        if (!$stmt->fetch()) {
            http_response_code(403);
            echo json_encode(['success' => false, 'error' => 'not your chat']);
            exit;
        }

        $query = 'INSERT INTO messages (chat_id, sender_id, message) VALUES (?, ?, ?)';
        $stmt = $pdo->prepare($query);
        $stmt->execute([$chat_id, $sender_id, $message]);

        // clean up
        $pdo = null; //closes off the connection, sets everything to nothing
        $stmt = null;

        echo json_encode([
        'success' => true,
        'username' => $_SESSION['username'],
        'message' => $message,
        'sent_at' => date('Y-m-d H:i:s')
        ]);
        die();
    } catch (PDOException $e) {
        die("crumbs:(( something went wrong... here's what: ". $e);
    }
}else {
    header('Location: ../messaging.php');
}