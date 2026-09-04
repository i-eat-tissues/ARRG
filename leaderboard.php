<?php

require_once 'includes/config_session.inc.php';
require_once 'includes/dbh.inc.php';
// fetch all users and their totals from the database

$country = $_GET['country'] ?? ''; // gets the country from the url

$leaderboard_no = 1;

try {
    if (!$country) {
        $stmt = $pdo->prepare("
        SELECT rock_totals, id, username, country
        FROM users
        ORDER BY rock_totals DESC, id ASC
        LIMIT 250
        ");
        $stmt->execute();
        $rock_totals = $stmt->fetchAll(PDO::FETCH_ASSOC); //fetch all data from columns as an associative array
    }else {
        $stmt = $pdo->prepare("
        SELECT rock_totals, id, username, country
        FROM users
        WHERE country = ?
        ORDER BY rock_totals DESC, id ASC
        LIMIT 250
        ");
        $stmt->execute([$country]);
        $rock_totals = $stmt->fetchAll(PDO::FETCH_ASSOC); //fetch all data from columns as an associative array
    }

    
} catch (PDOException $e) {
    $rock_totals = [];
    $dbError = $e->getMessage();
}

try {
    $stmt = $pdo->prepare("
    SELECT DISTINCT country
    FROM users
    ORDER BY country ASC;
    ");
    $stmt->execute();
    $countries = $stmt->fetchAll(PDO::FETCH_ASSOC); //fetch all data from columns as an associative array
  
} catch (PDOException $e) {
    $rock_totals = [];
    $dbError = $e->getMessage();
}
?>

<!DOCTYPE html>
<html lang = "en">
    <head>
        <title> ARRG | <?php if (!$country) {
            echo ("Global");
        }else {
            echo ($country);
        }?> leaderboard </title>
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
        <p>displaying <?php if ($country === ""){
            echo "global";
        } else {
            echo $country;
        } ?> leaderboard</p>
        <form method = "GET" action="leaderboard.php">
            <select name="country" id = "countrySelect">
                <option value = ""> global </option>
                <?php foreach ($countries as $countryOption): ?>
                <option value = "<?php echo $countryOption["country"]?>" <?php if ($country === $countryOption["country"]) echo "selected"; ?>><?php echo $countryOption["country"]?></option>
                <?php endforeach;?>
            </select>
        </form>
        <!-- later on when you get drop downs working and make a button for display more, change the if to if display_more = false &&
         $leaderboard_no <=100 || display_more = true && $leaderboard_no <=250 -->
        <?php if ($leaderboard_no <= 250): ?> 
            <?php foreach ($rock_totals as $rock_total): ?>
                <p>place: <?php echo($leaderboard_no)?>
                <p>total rocks: <?php echo($rock_total['rock_totals'])?></p>
                <p>id: <?php echo($rock_total['id'])?></p>
                <p><a href = "profile.php?username=<?php echo($rock_total['username'])?>">username: <?php echo($rock_total['username'])?></a></p>
                <figure>
                    <button class = "countryRock">
                        <img src = "images/countries/<?php echo($rock_total['country'])?>.png" width = "50" class = "countryRockImage">
                    </button>
                </figure>
                <p>country: <?php echo($rock_total['country'])?></p>
                <?php $leaderboard_no = $leaderboard_no + 1?>
            <?php endforeach; ?>
        <?php endif;?>
        <script src = 'leaderboardCountries.js'></script>
        <script src = "rockPetting.js"></script>
    </body>
</html>