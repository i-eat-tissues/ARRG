<?php

require_once 'includes/config_session.inc.php';
require_once 'includes/dbh.inc.php';
// fetch all users and their totals from the database

$country = $_GET['country'] ?? ''; // gets the country from the url
$sort_by = $_GET['sortBy'] ?? '';

if ($sort_by == '') {
    $display_sort_by = 'Total rocks';
} elseif ($sort_by == 'oap_posts') {
    $display_sort_by = 'Total OAP posts' ;
}elseif ($sort_by == 'wordley_wins') {
    $display_sort_by = 'Total Wordley Wins';
}else {
    header('Location: ../oap.php'); //if the param is invalid
}

$leaderboard_no = 1;

$allowed_columns = ['rock_totals', 'oap_posts', 'wordley_wins'];
$sort_column = in_array($sort_by, $allowed_columns, true) ? $sort_by : 'rock_totals'; // defines what the leaderboard is displaying, if empty (meaning rock_totals), repleaces as rock totals

$sql = "SELECT $sort_column AS selected_score, id, username, country FROM users";
$params = [];

if ($country) {
    $sql .= " WHERE country = ?"; //if a country is sselected, it adds to the query from before using .= 
    $params[] = $country;
}

$sql .= " ORDER BY $sort_column DESC, id ASC LIMIT 250"; // after country is checked, we also add the final line to our query as order by always has to go last

$stmt = $pdo->prepare($sql); //execute
$stmt->execute($params); //execute with any parameters created with the country.
$lb_totals = $stmt->fetchAll(PDO::FETCH_ASSOC);

try {
    $stmt = $pdo->prepare("
    SELECT DISTINCT country
    FROM users
    ORDER BY country ASC;
    ");
    $stmt->execute();
    $countries = $stmt->fetchAll(PDO::FETCH_ASSOC); //fetch all data from columns as an associative array
  
} catch (PDOException $e) {
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
        <div class='leaderboard-header'>
            <p class="displaying-leaderboard">DISPLAYING: <?php if ($country === ""){
                echo "GLOBAL";
            } else {
                echo strtoupper($country);
            } ?> LEADERBOARD</p>
            <div class='leaderboard-selections'>
                <form method = "GET" action="leaderboard.php" >
                    <select name="sortBy" id = "sortBySelect" class='country-select'>
                        <option value = ''>Total rocks</option>
                        <option value = 'oap_posts'>Total OAP posts</option>
                        <option value = 'wordley_wins'>Total wordley wins</option>
                    </select>
                    <select name="country" id = "countrySelect" class='country-select'>
                        <option value = "">Global</option>
                        <?php foreach ($countries as $countryOption): ?>
                        <option value = "<?php echo $countryOption["country"]?>" <?php if ($country === $countryOption["country"]) echo "selected"; ?>><?php echo $countryOption["country"]?></option>
                        <?php endforeach;?>
                    </select>
                </form>
            </div>
        </div>
        <!-- later on when you get drop downs working and make a button for display more, change the if to if display_more = false &&
         $leaderboard_no <=100 || display_more = true && $leaderboard_no <=250 -->
        <div class = 'leaderboard-column-indicator'>
            <p>Username</p>
            <div class='leaderboard-column-indicator-right'>
                <p><?=$display_sort_by?></p>
                <p>Country</p>
            </div>
        </div>
        <?php if ($leaderboard_no <= 250): ?> 
            <?php foreach ($lb_totals as $lb_total): ?>
                <div class = 'leaderboard-card'>
                    <p class='<?php if ($leaderboard_no == 1) {
                            echo 'first-placement';
                        }else if ($leaderboard_no == 2) {
                            echo 'second-placement';
                        }else if ($leaderboard_no == 3) {
                            echo "third-placement";
                        }else {
                            echo "placement";
                        }
                    ?>'>#<?php echo($leaderboard_no)?><a 
                    class='<?php if ($leaderboard_no == 1) {
                            echo 'first-placement';
                        }else if ($leaderboard_no == 2) {
                            echo 'second-placement';
                        }else if ($leaderboard_no == 3) {
                            echo "third-placement";
                        }else {
                            echo "placement";
                        }?>' 
                    href = "profile.php?username=<?php echo($lb_total['username'])?>"> <?php echo htmlspecialchars(($lb_total['username']))?></a></p>
                    <div class='leaderboard-card-right'>
                        <p class = 'score-text'><?=$lb_total['selected_score']?></p> 
                        <?php $leaderboard_no = $leaderboard_no + 1?>
                        <figure>
                            <button class='countryRock'>
                                <img src = "images/countries/<?php echo($lb_total['country'])?>.png" width = "50" class='countryRockImage'>
                            </button>
                        </figure>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php endif;?>
        <script src = 'leaderboardCountries.js'></script>
        <script src = 'leaderboardSortBy.js'></script>
        <script src = "rockPetting.js"></script>
    </body>
</html>