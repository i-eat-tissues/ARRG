<?php

require_once 'includes/config_session.inc.php';

$redirect = $_GET['redirect']
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
        <form class = "loginForm" action="includes/login.inc.php" method='POST'>
            <h2 class = "loginHeader"> LOGIN:D </h2>
            <input type = "text" name = "username" placeholder="awesomerockcollector" id = "usernameInput" class = "loginInput" autocomplete="on">
            <input type = "password" name = "pwd" placeholder = "password" id = "pwdInput" class = "loginInput" autocomplete= "on">
            <input type = 'hidden' name = 'redirect' value = '<?=htmlspecialchars($redirect)?>'>
            <p id="errorMessage" class="error-message"></p>
            <button id = "logInButton" class = "loginButton">LET'S GO!</button> 
        </form>
        <script src = "login.js" defer></script>
    </body>
</html>