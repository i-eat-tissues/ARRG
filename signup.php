<?php

require_once 'includes/config_session.inc.php';

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
        <form action="includes/signup.inc.php" method='POST'>
            <h2> SIGNUP:D </h2>
            <input type="text" name="username" placeholder="awesomerockcollector" id="usernameInput">
            <input type="password" name="pwd" placeholder="password" id="passwordInput">
            <p id="errorMessage" class="error-message"></p>
            <button id="signUpButton">LET'S GO!</button>
        </form>
        <script src="signup.js" defer></script> <!--defer tells the browser to 
        load the script after the HTML is parsed, so that the script can access
        the DOM elements. DOM is literally just the elements in this page.
        wouldnt worry too hard about defer, it's just a safety precaution at most.-->
    </body>
</html>