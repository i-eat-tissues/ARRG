<?php

header('Content-Type: application/json');
error_reporting(0);
ini_set('display_errors', '0');

ob_start();
require_once 'dbh.inc.php';
ob_clean();

$username = $_GET['username'] ?? ''; //?? '' means if there is no user, set to empty string.
if (!$username) {
    echo json_encode(['error' => 'missing username']);
    exit;
}

function get_username(object $pdo, string $username) { //creates a function which will be called on. $pdo is an object.
    $query = "SELECT username FROM users WHERE username = :username;"; //queries the data using sql. sql keywords are pretty straightforawrd.
    $stmt = $pdo->prepare($query);//seperates the data from the query, PREVENTING SQL INJECTION 
    $stmt->bindParam(":username", $username); //binds parameters
    $stmt->execute(); // self explanatory

    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    return $result; //returns the existence of $result (can be false or the result it got)
}

function is_username_invalid(object $pdo, string $username) { //function where the paramaters is what another function will return in signupmodel
    if (get_username($pdo, $username)) {
        return true;
    } else {
        return false;
    }
}

$usernameTaken = is_username_invalid($pdo, $username);

echo json_encode(['usernameTaken' => $usernameTaken]);
