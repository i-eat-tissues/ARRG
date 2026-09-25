<?php

require_once 'includes/config_session.inc.php';

?>



<!DOCTYPE html>
<html lang = "en">
    <head>
        <title> ARRG | <?= $_GET['rock']?> </title>
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
        <h1 class='rock-info-title' id = "name" >ROCKNAME</h1>
        <h2 class='rock-card-rarity'id = "rarity" >RARITY</h2>
        <div class= 'rock-info-sub-header'>
            <p id = "summary" class='rock-info-summary'></p>
            <figure>
                    <button class='countryRock'>
                        <img class='countryRockImage' id = "rockImage" src = "" alt = "rock image" width = "100">
                    </button>
            </figure>
        </div>
        <div class='rock-info-body'>
            <figure id="rockSpawnFigure">
                <img id = "rockSpawn" src = "" alt = "ROCKNAMESPAWN" width = "450">
                <figcaption id = "rockSpawnFigCap"></figcaption>
            </figure>
            <iframe 
            id='rockSpawniframe'
            src="" 
            width="500" 
            height="275" 
            style="border:0;" 
            allowfullscreen="" 
            loading="lazy" 
            referrerpolicy="strict-origin-when-cross-origin"></iframe>
            <p class='rock-info-description' id = "description" ></p>
        </div>
        <div class='rock-info-footer'>
            <div class='rock-info-sources'>
                <h4 class='rock-info-sources-header'>SOURCES</h6>
                <p><a id = "source1" href = ""></a></p>
                <p><a id = "source2" href = ""></a></p>
                <p><a id = "source3" href = ""></a></p>
                <p><a id = "source4" href = ""></a></p>
                <p><a id = "source5" href = ""></a></p>
            </div>
            <figure>
                <img id = "extraRockImage" src = "" alt = "rockimage" width = "200">
                <figcaption id = "extraRockImageFigCap">rockimage</figcaption>
            </figure>
        </div>
        <script src = "rock_info.js"></script>
        <script src = 'rarityScript.js' defer></script>
        <script src='rockPetting.js' defer></script>
    </body>
</html>