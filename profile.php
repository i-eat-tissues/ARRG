<?php

require_once 'includes/config_session.inc.php';
require_once 'includes/dbh.inc.php';

$username = $_GET['username'];

try {
    $stmt = $pdo->prepare("
    SELECT joined_at, country, id
    FROM users
    WHERE username = ?
    ");
    $stmt->execute([$username]);
    $basic_info = $stmt->fetch(PDO::FETCH_ASSOC); //don't use fetchAll as that returns an array of information. only use fetchAll when fetching multiple pieces of information.

    $stmt = $pdo->prepare("
    SELECT * 
    FROM oap_posts
    WHERE poster_username = ?
    ORDER BY posted_at DESC
    ");

    $stmt->execute([htmlspecialchars($username)]);
    $oap_posts = $stmt->fetchAll(PDO::FETCH_ASSOC);

} catch (PDOException $e) {
    $dbError = $e->getMessage();
}



?>

<!DOCTYPE html>
<html lang = "en">
    <head>
        <meta charset="UTF-8">
        <title> ARRG | <?= $username ?>'s Profile </title>
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
        <div class = 'profile-header'>
            <p><?=$username?></p>
            <figure>
                <button class = "countryRock">
                    <img src="images/countries/<?php echo $basic_info['country']; ?>.png" alt="image of user's country" width = "100" class = "countryRockImage">
                </button>
            </figure>
        </div>
        <div class = 'profile-body'>
            <div class='profile-body-left'>
                <p><?php echo "join date: ". $basic_info["joined_at"]; ?> </p>
                <p><?php echo "country: " . $basic_info['country'];?></p>
            </div>
            <div class='profile-body-right'>
                <!-- turn into form later -->
                <?php if (isset($_SESSION['user_id']) && $username != $_SESSION['username']): ?>
                <form method ='POST' action='includes/sendMessageRequest.inc.php'>
                    <button type='submit'>MESSAGE</button>
                    <input type='hidden' name='target_id' value = <?=htmlspecialchars($basic_info['id'])?>>
                    <input type='hidden' name='target_username' value = <?=htmlspecialchars($username)?>>
                </form>
                <?php endif;?>
                <a href = 'stats.php?username=<?=$username?>'>
                    <button>STATISTICS</button>
                </a>
            </div>
        </div>
        <div class ='profile-oap-posts'>
            <p class='profile-oap-posts-header'><?=$username . "'s  OAP posts"?></p>
            <?php if ($oap_posts): ?>
                <?php foreach ($oap_posts as $oap_post): ?>
                    <div class = 'post-box'>
                        <div class='post-card-header'>
                            <div class = 'post-card-poster-info'>
                                <p class='post-card-sender'><a href= 'profile.php?username=<?=$oap_post ['poster_username']?>'><?=$oap_post ['poster_username']?></a></p>
                                <p class='post-card-sent-at'><?=$oap_post['posted_at']?> </p>
                            </div>
                            <!-- use if to check if the post belongs to the user, as only the user who wrote it should be allowed to delete their post -->
                            <?php if (isset($_SESSION['user_id']) && $oap_post['poster_id'] == $_SESSION['user_id']):?>
                                <form class = 'delete-post-form' action='includes/oap_post_delete.inc.php' method = 'POST'>
                                    <button class = 'delete-post-button'>delete post</button>
                                    <input type='hidden' name = 'post_id' value = <?=$oap_post['post_id']?>>
                                </form>
                            <?php endif; ?>
                        </div>
                        <div class="post-card-sub-header">
                            <h6><?= htmlspecialchars($oap_post['post_title']) ?></h6>
                        </div>
                        <p class="post-card-content"><?= htmlspecialchars($oap_post['post']) ?></p>
                    </div>
                <?php endforeach;?>
            <?php else: ?>
                <p class='sad-profile-message:('> this user hasn't made any posts on oap yet. they might not appreciate overtonight:( </p>
            <?php endif; ?>
        </div>
        <script src = "rockPetting.js"></script>
    </body>
</html>

<?php /*if (isset($_SESSION["user_id"]) && $username === $_SESSION['username']) {
                echo "Welcome back, " . $username . "!";
                }else {
                echo "username: " . $username; }; */ ?>