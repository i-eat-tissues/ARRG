<?php

require_once 'includes/config_session.inc.php';
require_once 'includes/dbh.inc.php';

$username = $_GET['username'];


try {
    $stmt = $pdo->prepare("
    SELECT rock_totals, wordley_wins, oap_posts
    FROM users
    WHERE username = ?"
);
    $stmt->execute([$username]);
    $stats = $stmt->fetch(PDO::FETCH_ASSOC);
}catch (PDOException $e){
    echo ("ohno something went wrong fetching some statistics data. here is the issue:" . $e->getMessage());
}

try{
    $stmt = $pdo->prepare("
    SELECT rockId 
    FROM users_rocks
    WHERE userId = (SELECT id FROM users WHERE username = ?)"
    );
    $stmt->execute([$username]);
    $unique_rock_types = $stmt->fetchAll(PDO::FETCH_ASSOC);
    $unique_rock_types_count = count($unique_rock_types);
}catch (PDOException $e) {
    echo ("ohno something went wrong again when fetching stats. here is the annoying issue:" . $e->getMessage());
}
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
        </header>
        <p class='stats-header'><a href='profile.php?username=<?=$username?>'><?=$username?></a></p>
        <div class='stats-sub-header'>
            <div class='stats-sub-header-left'>
                <p>total non unique rocks: <?=$stats['rock_totals']?></p>
                <p>total unique rocks: <?=$unique_rock_types_count?></p>
                <p>percentage of all rocks unlocked (unobtainable inc): <?= ($unique_rock_types_count / 20) * 100?>% </p>
            </div>
            <div class = 'stats-sub-header-right'>
                <p>wordley wins: <?=$stats['wordley_wins']?></p>
                <p>oap posts: <?=$stats['oap_posts']?></p>
                <p>empty stats sub header statistic</p>
            </div>
        </div>
        <div class='stats-body'>
            <div class='stats-body-left'>
                <div class = 'stats-body-left-top'>
                    <p>left top</p>
                </div>
                <div class = 'stats-body-left-bottom'>
                    <p>left bottom</p>
                </div>
            </div>
            <div class='stats-body-right'>
                <div class = 'stats-body-right-top'>
                    <p>right top</p>
                </div>
                <div class = 'stats-body-right-bottom'>
                    <p>right bottom</p>
                </div>
            </div>
        </div>
    </body>
</html>