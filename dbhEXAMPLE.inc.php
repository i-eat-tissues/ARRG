<?php // no closing off this bc this is a pure php file!! meaning the whole file wil be written in php:D
//this is code for a DataBase Handler, hence the name.

$dsn = ""; 
$dbusername = "";
$dbpassword = ""; 

try {
    $pdo = new PDO($dsn, $dbusername, $dbpassword);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

}catch (PDOException $e) {
    echo "crumbs:( something bwoke : " . $e->getMessage();
}
