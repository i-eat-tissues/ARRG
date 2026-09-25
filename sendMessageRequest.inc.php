<?php

require_once 'dbh.inc.php';
require_once 'config_session.inc.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    //check if this messagae thread already exists. if so, redirect to this chat using chat id.
    try {
        $user_id = $_SESSION['user_id'];
        $target_id = $_POST['target_id'];
        $target_username = $_POST['target_username'];

        $stmt = $pdo->prepare("
        SELECT chat_id 
        FROM chats 
        WHERE (user_id_1 = ? AND user_id_2 = ?)
        OR (user_id_1 = ? AND user_id_2 = ?)
        ");
        $stmt->execute([$user_id, $target_id, $target_id, $user_id]);

        $chat_id = $stmt->fetchColumn();

        if ($chat_id) {
            //if the chat_id is already found in the database (means chat already exists.)
            header('Location: ../messaging.php?chat=' . $chat_id);
        }else {
            //create new chat (change in the future to send a request/check for already existing request)
            $stmt = $pdo->prepare("
            INSERT INTO chats (user_id_1, user_id_2) VALUES(?, ?)
            ");
            $stmt->execute([$user_id, $target_id]);

            $stmt = null;
            $pdo = null;

            header('Location: ../profile.php?username=' . $target_username);

            die();
        }
    }catch (PDOException $e) {
        die('oh no, something went really wrong sending your message request! heres what:' . $e);
    }

} else {
    header('Location: ../profile.php');
}