<?php

require_once 'includes/config_session.inc.php';
require_once 'includes/dbh.inc.php';

$stmt = $pdo->prepare("
    SELECT * FROM rocks
");

$stmt->execute();
$rocks = $stmt->fetchALL(PDO::FETCH_ASSOC);

?>


<!DOCTYPE html>
<html lang = "en">
    <head>
        <meta charset="UTF-8">
        <title> ARRG | Home </title>
        <link rel = "stylesheet" href = "style.css">
    </head>
    <body>
        <header>
            <h1><a href = "index.php">ARRG - A RNG-based rock game:D </a></h1>
            
            <?php if (isset($_SESSION["user_id"])): ?>

            <a href="profile.php?username=<?php echo $_SESSION["username"]?>">
                <img src = 'images/profileIcon.png' width = 30px alt='profile'>
            </a>
            <a href="logout.php">
                <img src = 'images/logoutIcon.png' width = 30px alt = 'logout'>
            </a>

            <?php else: ?>

            <h3><a href="signup.php">Sign up</a></h3>
            <h3><a href="login.php">Log in</a></h3>
            
            <?php endif; ?>
                
            <a href = "messaging.php?chat=home">
                <img src = 'images/chatIcon.png' width = 30px alt = 'chat'>
            </a>
            <a href = "collection.php">
                <img src = 'images/collectionIcon.png' width = 30px alt = 'collection'>
            </a>
            <a href = "leaderboard.php">
                <img src= 'images/leaderboardIcon.png' width = 30px alt = 'leaderboard'>
            </a>
            <a href = "settings.php">
                <img src = 'images/settingsIcon.png' width = 30px alt = 'settings'>
            </a>
            <h3><a href = 'wordley.php'>WORDLEY</a></h3>
            <h3><a href = 'oap.php'>OAP</a></h3>
        </header>
        <div class='wordley-words-header'>
            <a href='wordley.php'>
                <button class='wordley-words-back-button'>back to wordley</button>
            </a>
            <p class="wordley-words-title">WORDLEY WORDS</p>
        </div>
        <ul class='wordley-words-list'>
            <li>poopoo</li>
            <li>peepee</li>
            <li>doiing</li>
            <li>blaarp</li>
            <li>fartsy</li>
            <li>apples</li>
            <li>eminem</li>
            <li>excise</li>
            <li>dihrea</li>
            <li>finger</li>
            <li>nylong</li>
            <li>bahrom</li>
        </ul>
    </body>
</html>