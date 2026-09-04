<?php

require_once 'includes/config_session.inc.php';

?>


<!DOCTYPE html>
<html lang = "en">
    <head>
        <meta charset="UTF-8">
        <title> ARRG | Logout </title>
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
        <form action="logoutFunction.inc.php" method="POST"> <!--runs the logoutFunction.php script when the user clicks the log out button, which logs the user out and redirects them to the homepage. -->
            <button type="submit">Log out</button> 
        </form>
    </body>
</html>