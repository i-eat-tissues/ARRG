<?php

header('Content-Type: application/json');
error_reporting(0);
ini_set('display_errors', '0');

ob_start();
require_once 'dbh.inc.php';
ob_clean();

$rockId = $_GET['rockId'] ?? ''; //?? '' means if there is no user, set to empty string.
if (!$rockId) {
    echo json_encode(['error' => 'missing rockId']);
    exit;
}

function get_rockById(object $pdo, string $rockId) { //creates a function which will be called on. $pdo is an object.
    $query = "SELECT * FROM rocks WHERE rockId = :rockId;"; //queries the data using sql. sql keywords are pretty straightforawrd.
    $stmt = $pdo->prepare($query);//seperates the data from the query, PREVENTING SQL INJECTION 
    $stmt->bindParam(":rockId", $rockId); //binds parameters
    $stmt->execute(); // self explanatory

    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    return $result; //returns the existence of $result (can be false or the result it got)
}

$rock = get_rockById($pdo, $rockId);

if (!$rock) {
    echo json_encode(['error' => 'rock not found']);
    exit;
}

echo json_encode(['rockName' => $rock['rockName'] ?? '']);
