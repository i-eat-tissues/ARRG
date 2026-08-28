<?php

require_once 'includes/config_session.inc.php';
require_once 'includes/dbh.inc.php';

$username = $_GET['username'];

try {
    $stmt = $pdo->prepare("
SELECT joined_at
FROM users
WHERE username = ?
");
    $stmt->execute([$username]);
    $join_date = $stmt->fetch(PDO::FETCH_ASSOC); //don't use fetchAll as that returns an array of information. only use fetchAll when fetching multiple pieces of information.

} catch (PDOException $e) {
    $dbError = $e->getMessage();
}
try {
    $stmt = $pdo->prepare("
SELECT country
FROM users
WHERE username = ?
");
    $stmt->execute([$username]);
    $country = $stmt->fetch(PDO::FETCH_ASSOC); //don't use fetchAll as that returns an array of information. only use fetchAll when fetching multiple pieces of information.

} catch (PDOException $e) {
    $dbError = $e->getMessage();
}

?>

<!DOCTYPE html>
<html lang = "en">
    <head>
        <meta charset="UTF-8">
        <title> ARRG | Profile </title>
        <link rel = "stylesheet" href = "style.css">
    </head>
    <body>
        <header>
            <h1><a href = "index.php">ARRG - A RNG-based rock game:D </a></h1>
            
            <?php if (isset($_SESSION["user_id"])): ?>

            <h3><a href="profile.php?username=<?php echo $_SESSION["username"]?>">Profile</a></h3>
            <h3><a href="logout.php">Log out</a></h3>

            <?php else: ?>

            <h3><a href="signup.php">Sign up</a></h3>
            <h3><a href="login.php">Log in</a></h3>
            
            <?php endif; ?>
                
            <h3><a href = "collection.php">COLLECTION</a></h3>
            <h3><a href = "leaderboard.php">LEADERBOARD</a></h3>
            <h3><a href = "settings.php">SETTINGS</a></h3>
        </header>
        <p><?php if (isset($_SESSION["user_id"]) && $username === $_SESSION['username']) {
            echo "Welcome back, " . $username . "!";
            }else {
            echo "username: " . $username; };?></p>
        <p><?php echo "join date: ". $join_date["joined_at"]; ?> </p>
        <p><?php echo "country: " . $country['country'];?></p>
        <figure>
            <button class = "countryRock">
                <img src="images/countries/<?php echo $country['country']; ?>.png" alt="image of user's country" width = "200" class = "countryRockImage">
            </button>
        </figure>
        <script src = "rockPetting.js"></script>
    </body>
</html>