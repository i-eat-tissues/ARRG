<?php
require_once 'config_session.inc.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') { //checks if the user has entered legit, through submitting the form.
    $post_id = $_POST['post_id'];
    $user_id = $_SESSION['user_id'];


    try {
        require_once 'dbh.inc.php'; 

        $stmt = $pdo->prepare("
        DELETE FROM oap_posts
        WHERE post_id = :post_id AND poster_id = :user_id"
        );
        $stmt->bindParam(":post_id", $post_id, PDO::PARAM_INT);
        $stmt->bindParam(":user_id", $user_id, PDO::PARAM_INT);

        $stmt->execute();

        $stmt = null;

        $stmt= $pdo->prepare('
        UPDATE users
        SET oap_posts = oap_posts - 1
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
    header('Location: ../oap.php');
    die();
}
