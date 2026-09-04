<?php

require_once 'includes/config_session.inc.php';

?>


<!DOCTYPE html>
<html lang = "en">
    <head>
        <meta charset="UTF-8">
        <title> ARRG | Log in </title>
        <link rel = "stylesheet" href = "style.css">
    </head>
    <body class = "bodyDarkMode">
        <header class= "headerDarkMode">
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
        <form action="includes/login.inc.php" method='POST'>
            <h2> LOGIN:D </h2>
            <input type = "text" name = "username" placeholder="awesomerockcollector" id = "usernameInput" autocomplete="on">
            <input type = "password" name = "pwd" placeholder = "password" id = "pwdInput" autocomplete= "on">
            <p id="errorMessage" class="error-message"></p>
            <button id = "logInButton">LET'S GO!</button> 
        </form>
        <script src = "login.js" defer></script>
    </body>
</html>