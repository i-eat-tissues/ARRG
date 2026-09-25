<?php

require_once 'config_session.inc.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') { //checks if the user has entered legit, through submitting the form.
    $post_title = $_POST['title'];
    $post_content = $_POST['post_content'];
    $user_id = $_SESSION['user_id'];
    $username = $_SESSION['username'];

    try { //trycatch's function is in the name, if an error comes up the code catches it.
        require_once 'dbh.inc.php'; // loads the DataBase Handler file, basically avoids a massive chunk of code here.
        //view would usually go here, but it is not needed here.
        
        /*using the required attribute in html is sometimes not enough, as this is client side, meaning a client 
        can easily inspect and remove this, while if we do this server side, a client cannot modify this.*/

        require_once 'config_session.inc.php'; //this script has a session started in it

        $query = 'INSERT INTO oap_posts (post_title, post, poster_id, poster_username) VALUES  
        (?, ?, ?, ?);'; 

        $stmt = $pdo->prepare($query); //submits the query mentioned above to the database.
        // two semicolons, there is a line in SQL and then the rest is in PHP, so the first line is closed THEN the second.
        
        $stmt->execute([$post_title, $post_content, $user_id, $username]);

        $stmt = null;

        $stmt= $pdo->prepare('
        UPDATE users
        SET oap_posts = oap_posts + 1
        WHERE id = ?');
        $stmt->execute([$user_id]);
        
        $stmt = null;
        $pdo = null;

        header('Location: ../oap.php'); //sends the user back to the homepage before killing the script.

        die();
    } catch (PDOException $e) {
        die("crumbs:( something unexpected went extremely wrong. here's a hint as to what: " . $e);
    }
}else { //if the user entered inlegitamately, they are put back to the signup page.
    header('Location: ../signup.php');
    die();
}
