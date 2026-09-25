<?php
    require_once 'includes/config_session.inc.php';
    require_once 'includes/dbh.inc.php';
    // fetch all posts from the database, along with the corresponding usernames
    if (isset($_SESSION["user_id"])) {
        try {
            $stmt = $pdo->prepare("
        SELECT rocks.*, rocks.credit, users_rocks.quantity, users_rocks.obtained
        FROM users_rocks
        JOIN rocks ON rocks.rockId = users_rocks.rockId
        WHERE users_rocks.userId = ?
    ");
            $stmt->execute([$_SESSION["user_id"]]);
            $rocks = $stmt->fetchAll(PDO::FETCH_ASSOC);
            $rocks = array_reverse($rocks);

        } catch (PDOException $e) {
            $rocks = [];
            $dbError = $e->getMessage();
        }
    } else {
        $rocks = [];
    }
?>

<!DOCTYPE html>
<html lang = "en">
    <head>
        <title> ARRG | Collection </title>
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
        <p class='collection-header'>COLLECTION</p>
        <?php if (!isset($_SESSION["user_id"])): ?>
            <p class= 'login-or-signup'><a href="login.php?redirect=collection">log in</a> or <a href="signup.php?redirect=collection">sign up</a> to view your amazing cute collection:D</p>
        <?php elseif ($rocks === []): ?>
            <p>there's nothing here yet:( *cricket noises*</p>
        <?php elseif (isset($_SESSION["user_id"])): ?>
            <div class='rocks'>
                <?php foreach ($rocks as $rock): ?>
                    <div class='rock-card'>
                        <div class='rock-card-header'>
                            <p class='rock-card-rock-name'><a href = "rock_info.php?rock=<?php echo $rock['rockName']; ?>"><?php echo $rock['rockName']; ?></a></p>
                            <p class='rock-card-quantity'><?php echo $rock['quantity']; ?></p>
                        </div>
                        <p class = "rock-card-rarity" ><?php echo strtoupper($rock['rarity']); ?></p>
                        <figure>
                            <img class = rockImage src="images/rock_info_images/<?php echo $rock['rockName'] . '.png'; ?>" alt="<?php echo $rock['rockName']; ?> drawn." width =  "200">
                            <?php if ($rock['rockName'] == 'harvey'): ?>
                                <button class = "hchangeHatHarveyBlue">change hat - > harvey blue hat</button>
                                <button class = "hchangeHatAlbertRed">change hat - > albert red hat</button>
                                <button class = "hchangeHatHarveyRed">change hat - > harvey red hat</button>
                                <button class = "hchangeHatRemoveHat">change hat - > remove hat</button>
                                <script src = "harveyHat.js"></script>
                            <?php elseif ($rock['rockName'] == 'albert'): ?>
                                <button class = "achangeHatHarveyBlue">change hat - > harvey blue hat</button>
                                <button class = "achangeHatAlbertRed">change hat - > albert red hat</button>
                                <button class = "achangeHatHarveyRed">change hat - > harvey red hat</button>
                                <button class = "achangeHatRemoveHat">change hat - > remove hat</button>
                                <script src = "albertHat.js"></script>
                            <?php endif; ?>
                            <figcaption class = 'rock-card-figcaption'>credit: <a href='profile.php?username=<?=$rock['credit']?>'><?=$rock['credit']?></a></figcaption>
                        </figure>
                        <p class='rock-card-date-unlocked'>unlocked: <?php echo $rock['obtained']; ?></p>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>
        <script src = "collectionScript.js"></script>
        <script src = "rarityScript.js"></script>
    
    </body>
</html>