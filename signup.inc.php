<?php

require_once 'config_session.inc.php';
require_once "../vendor/autoload.php";

use GeoIp2\Database\Reader;


if ($_SERVER['REQUEST_METHOD'] == 'POST') { //checks if the user has entered legit, through submitting the form.
    $username = $_POST['username'];
    $pwd = $_POST['pwd'];
    $redirect = $_POST['redirect'];

    try { //trycatch's function is in the name, if an error comes up the code catches it.
        require_once 'dbh.inc.php'; // loads the DataBase Handler file, basically avoids a massive chunk of code here.
        //view would usually go here, but it is not needed here.
        
        /*using the required attribute in html is sometimes not enough, as this is client side, meaning a client 
        can easily inspect and remove this, while if we do this server side, a client cannot modify this.*/

        require_once 'config_session.inc.php'; //this script has a session started in it

        $ip = $_SERVER["REMOTE_ADDR"];

        if ($ip === "::1" || $ip === "127.0.0.1") { // THESENEXT TWO LINES ARE USELESS WHEN I PUT THIS ON A DOMAIN
        $ip = "8.8.8.8";  //they're just cuz im stubborn and don't want to move to a domain YET
        }

        $reader = new Reader(__DIR__ . "/../geoip/GeoLite2-Country.mmdb");
        $record = $reader->country($ip);

        $country = $record->country->name;


        $query = 'INSERT INTO users (username, pwd, country) VALUES  
        (?, ?, ?);'; 

        $stmt = $pdo->prepare($query); //submits the query mentioned above to the database.
        // two semicolons, there is a line in SQL and then the rest is in PHP, so the first line is closed THEN the second.
        
        $stmt->execute([$username, $pwd, $country]);


        //gives the session the user's newly created user id and username, so that the user can be logged in automatically after signing up.
        $userId = $pdo->lastInsertId();
        $_SESSION["user_id"] = $userId;
        $_SESSION["username"] = $username;

        $pdo = null; //closes off the connection, sets everything to nothing
        $stmt = null;

        header('Location: ../' . $redirect . '.php'); //sends the user back to the homepage before killing the script.

        die();
    } catch (PDOException $e) {
        die("crumbs:( something unexpected went extremely wrong. here's a hint as to what: " . $e);
    }
}else { //if the user entered inlegitamately, they are put back to the signup page.
    header('Location: ../signup.php');
}
