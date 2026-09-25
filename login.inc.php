<?php

require_once 'config_session.inc.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $user = $_POST['username'];
    $pwd = $_POST['pwd'];
    $redirect = $_POST['redirect'];

    try {
        require_once 'dbh.inc.php'; // loads the DataBase Handler file, basically avoids a massive chunk of code here.

        // Lookup the user by username and get their id and stored password
        $query = 'SELECT id, pwd FROM users WHERE username = ? LIMIT 1;';
        $stmt = $pdo->prepare($query);
        $stmt->execute([$user]);
        $userRow = $stmt->fetch(PDO::FETCH_ASSOC);

        // successful login — store user id and username in session
        $userId = $userRow['id'];
        $_SESSION["user_id"] = $userId;
        $_SESSION["username"] = $user;

        // clean up
        $pdo = null; //closes off the connection, sets everything to nothing
        $stmt = null;

        header('Location: ../' . $redirect . '.php');

        die();
    } catch (PDOException $e) {
        die("crumbs:(( something went wrong... here's what: ". $e);
    }
}else {
    header('Location: ../login.php');
}