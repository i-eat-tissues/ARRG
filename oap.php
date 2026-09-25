<?php

require_once 'includes/config_session.inc.php';
require_once 'includes/dbh.inc.php';

$stmt = $pdo->prepare('
    SELECT * FROM oap_posts
    ORDER BY posted_at DESC
');
$stmt->execute();
$oap_posts = $stmt->fetchAll(PDO::FETCH_ASSOC);
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
        <div class='oap-page-contents'>
            <p class= 'oap-welcome'>WELCOME TO THE OVERTONIGHT APPRECIATION PAGE (OAP)</p>
            <p class='oap-desc'>a forum where you can discuss how much you appreciate the artist Overtonight</p>
            <p class='oap-desc-link'><a href = 'https://open.spotify.com/artist/3WUqGdcFJJquJgCPkEzCfs?si=j5GWd3JqQcWZshI3NUKkOQ' target = '_blank'>a link to his spotify:D</a></p>
            <p class='oap-desc'>------------------------------------------------------------------------------------------------------------------</p>
            <?php if (isset($_SESSION['user_id'])): ?>
                <form class = "oap-post-form" action="includes/oapPost.inc.php" method='POST' id = 'oapPostForm'>
                    <div class = 'post-box-wrapper'>
                        <h2 class = 'post-to-oap'>POST TO OAP</h2>
                        <input type="text" name="title" maxlength = '255' placeholder="i love overtonight!" id="titleInput" class = "title-input" autocomplete="off">
                        <div class='textarea-wrapper'>
                            <textarea class='post-textarea' maxlength = '2000' rows="6" cols="50" type="text" name="post_content" oninput='increaseCounter()' id = 'textInput' placeholder="his music is the best i love 'comfort song 4 u'"></textarea>
                            <p class = 'oap-post-char-counter' id = 'charCounter'>0</p>
                        </div>
                        <div class = 'post-footer'>
                            <p id = 'errorMessage' class= 'post-error-message'>max post length is 2000 characters</p>
                            <button id="postButton" class = 'post-button'>LET'S GO!</button>
                        </div>
                    </div>
                </form>
            <?php elseif (!isset($_SESSION['user_id'])): ?>
                <p class= 'login-or-signup'><a href="login.php?redirect=oap">log in</a> or <a href="signup.php?redirect=oap">sign up</a> to post on oap.</p>
            <?php endif;?>
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
            <?php endforeach; ?>
            <div class = 'creds-to-my-fav-person:D'>
                <p>massive creds to <a class='my-fav-person:D' href = 'profile.php?username=re35n'>re35n</a> im stealing so much html from her website which btw is <a class='my-fav-site:D' href = 'https://vietty.site.je' target = '_blank'> here </a> :D</p>
            </div>
        </div>
        <script src = 'oap.js'></script>
        <script src = 'oapDelete.js'></script>
        <script src = 'oapTextBoxCounter.js'></script>
    </body>
</html>