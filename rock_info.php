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

            <h3><a href="profile.php?username=<?php echo $_SESSION["username"]?>">Profile</a></h3>
            <h3><a href="logout.php">Log out</a></h3>

            <?php else: ?>

            <h3><a href="signup.php">Sign up</a></h3>
            <h3><a href="login.php">Log in</a></h3>
            
            <?php endif; ?>
                
            <h3><a href = "messaging.php?chat=home">CHAT</a></h3>
            <h3><a href = "collection.php">COLLECTION</a></h3>
            <h3><a href = "leaderboard.php">LEADERBOARD</a></h3>
            <h3><a href = "settings.php">SETTINGS</a></h3>
        </header>
        <h1 id = "name" >ROCKNAME</h1>
        <h2 id = "rarity" >RARITY</h2>
        <h2 id = "id" >ID</h2>
        <figure>
            <img id = "rockImage" src = "" alt = "rock image" width = "200">
        </figure>
        <p id = "summary" >SUMMARY</p>
        <figure>
            <img id = "rockSpawn" src = "" alt = "ROCKNAMESPAWN" width = "200">
            <figcaption id = "rockSpawnFigCap">ROCKNAMESPAWN</figcaption>
        </figure>
        <p id = "description" >DESCRIPTION</p>
        <figure>
            <img id = "extraRockImage" src = "" alt = "rockimage" width = "200">
            <figcaption id = "extraRockImageFigCap">rockimage</figcaption>
        </figure>
        <h6>SOURCES</h6>
        <p><a id = "source1" href = ""></a></p>
        <p><a id = "source2" href = ""></a></p>
        <p><a id = "source3" href = ""></a></p>
        <p><a id = "source4" href = ""></a></p>
        <p><a id = "source5" href = ""></a></p>
        <script src = "rock_info.js"></script>
    </body>
</html>