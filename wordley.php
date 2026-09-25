<?php

require_once 'includes/config_session.inc.php';

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
        </header>
        <p class='wordley-header-welcome'>WELCOME TO WORDLEY!</p>
        <p class='wordley-header-desc'>this is a very similar game to the NYT wordle, however there is six letters instead of five.</p>
        <div class='wordley-header-desc'>
            <p>a full list of all possible words can be found <a href='wordley_words.php'>here</a>.</p>
        </div>
        <p class='wordley-header-desc'>------------------------------------------------------------------------------------------------------------------</p>
        <?php if (!isset($_SESSION['user_id'])): ?>
            <div class='wordley-login-or-signup'>
                <p>you are not logged in, therefore your wins will not be saved. <a href="login.php?redirect=wordley">log in</a> or <a href="signup.php?redirect=wordley">sign up</a> to save your wins.</p>
            </div>
        <?php endif;?>
        <div class='letters' id = 'letters'>
            <!-- &#8203; is a blank whitespace character, it looks like nothing but it makes it so the page doesnt have to change layout as the guesses come in -->
            <table>
                <!-- row 1-->
                <tr>
                    <td id='1,1'>&#8203;</td>
                    <td id='2,1'>&#8203;</td>
                    <td id='3,1'>&#8203;</td>
                    <td id='4,1'>&#8203;</td>
                    <td id='5,1'>&#8203;</td>
                    <td id='6,1'>&#8203;</td>
                </tr>
                <!-- row 2-->
                <tr>
                    <td id='1,2'>&#8203;</td>
                    <td id='2,2'>&#8203;</td>
                    <td id='3,2'>&#8203;</td>
                    <td id='4,2'>&#8203;</td>
                    <td id='5,2'>&#8203;</td>
                    <td id='6,2'>&#8203;</td>
                </tr>
                <!-- row 3-->
                <tr>
                    <td id='1,3'>&#8203;</td>
                    <td id='2,3'>&#8203;</td>
                    <td id='3,3'>&#8203;</td>
                    <td id='4,3'>&#8203;</td>
                    <td id='5,3'>&#8203;</td>
                    <td id='6,3'>&#8203;</td>
                </tr>
                <!-- row 4-->
                <tr>
                    <td id='1,4'>&#8203;</td>
                    <td id='2,4'>&#8203;</td>
                    <td id='3,4'>&#8203;</td>
                    <td id='4,4'>&#8203;</td>
                    <td id='5,4'>&#8203;</td>
                    <td id='6,4'>&#8203;</td>
                </tr>
                <!-- row 5-->
                <tr>
                    <td id='1,5'>&#8203;</td>
                    <td id='2,5'>&#8203;</td>
                    <td id='3,5'>&#8203;</td>
                    <td id='4,5'>&#8203;</td>
                    <td id='5,5'>&#8203;</td>
                    <td id='6,5'>&#8203;</td>
                </tr>
                <!-- row 6-->
                <tr>
                    <td id='1,6'>&#8203;</td>
                    <td id='2,6'>&#8203;</td>
                    <td id='3,6'>&#8203;</td>
                    <td id='4,6'>&#8203;</td>
                    <td id='5,6'>&#8203;</td>
                    <td id='6,6'>&#8203;</td>
                </tr>
            </table>         
        </div>
        <div class='guess-area'>
            <p id = 'guessErrorMessage' class= 'guess-error-message'>take your first guess!<a id = 'guessErrorMessageAnchor'></a></p>
            <form class = "guess-form" id = 'guessForm' autocomplete="off" method='GET'>
                <input type = "text" name = "guess" placeholder="poopoo peepee" id = "guessInput" class = "guess-input">
            </form>
        </div>
        <script src = 'wordley.js''></script>
    </body>
</html>