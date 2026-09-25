<?php

require_once 'includes/config_session.inc.php';

$redirect = $_GET['redirect']

?>

<!DOCTYPE html>
<html lang = "en">
    <head>
        <meta charset="UTF-8">
        <title> ARRG | Sign up </title>
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
        <form class = "loginForm" action="includes/signup.inc.php" method='POST'>
            <h2 class = "loginHeader"> SIGNUP:D </h2>
            <input type="text" name="username" placeholder="awesomerockcollector" id="usernameInput" class = "loginInput">
            <input type="password" name="pwd" placeholder="password" id="passwordInput" class = "loginInput">
            <input type='hidden' name='redirect' value = '<?=htmlspecialchars($redirect)?>'>
            <p id="errorMessage" class="error-message"></p>
            <button id="signUpButton" class = 'loginButton'>LET'S GO!</button>
        </form>
        <script src="signup.js" defer></script> <!--defer tells the browser to 
        load the script after the HTML is parsed, so that the script can access
        the DOM elements. DOM is literally just the elements in this page.
        wouldnt worry too hard about defer, it's just a safety precaution at most.-->
    </body>
</html>