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
            <span class='hamberger-menu-thing-i-think' onclick='openNav()'>&#9776;</span>
        </header>
        <div class = sidenav id = 'sidenav'>
            <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>

            <?php if (isset($_SESSION["user_id"])): ?>

            <a href="profile.php?username=<?php echo $_SESSION["username"]?>">PROFILE</a>
            <a href="logout.php">LOG OUT</a>

            <?php else: ?>

            <a href="signup.php?redirect=index">SIGN UP</a>
            <a href="login.php?redirect=index">LOG IN</a>

            <?php endif; ?>
                
            <a href = "messaging.php?chat=home">CHAT</a>
            <a href = "collection.php">COLLECTION</a>

            <a href = "leaderboard.php">LEADERBOARD</a>
            <a href = "settings.php">SETTINGS</a>

            <a href = 'wordley.php'>WORDLEY</a>
            <a href = 'oap.php'>OAP</a>
        </div>
        <div id = 'main'>
            <p id = "rockMessage" class = "rock-message"> click reroll to get a rock!</p>
            <p id = "unlocked" class = 'unlocked-message'></p>
            <div class = "flex">
                <button id="reroll">reroll</button>
            </div>
        </div>
        <script src = "rolling.js"></script>
        <script src='sidenav.js'></script>
    </body>
</html>