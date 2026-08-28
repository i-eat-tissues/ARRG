<?php
    require_once 'includes/config_session.inc.php';
    require_once 'includes/dbh.inc.php';
    // fetch all posts from the database, along with the corresponding usernames
    if (isset($_SESSION["user_id"])) {
        try {
            $stmt = $pdo->prepare("
        SELECT rocks.*, users_rocks.quantity, users_rocks.obtained
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
        <title> ARRG - rock generator </title>
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
                
            <h3><a href = "collection.php">COLLECTION</a></h3>
            <h3><a href = "leaderboard.php">LEADERBOARD</a></h3>
            <h3><a href = "settings.php">SETTINGS</a></h3>
        </header>
        <?php if (!isset($_SESSION["user_id"])): ?>
            <p><a href="login.php">log in</a> or <a href="signup.php">sign up</a> to view your amazing cute collection:D</p>
        <?php elseif ($rocks === []): ?>
            <p>there's nothing here yet:( *cricket noises*</p>
        <?php elseif (isset($_SESSION["user_id"])): ?>
            <?php foreach ($rocks as $rock): ?>
                <p><a href = "rock_info.php?rock=<?php echo htmlspecialchars($rock['rockName']); ?>"> rock: <?php echo htmlspecialchars($rock['rockName']); ?></a></p>
                <figure>
                    <img class = rockImage src="images/<?php echo htmlspecialchars($rock['rockName']) . '.jpg'; ?>" alt="<?php echo htmlspecialchars($rock['rockName']); ?> drawn by me:D" width =  "200">
                    <?php if (htmlspecialchars($rock['rockName'] == 'harvey')): ?>
                        <button class = "hchangeHatHarveyBlue">change hat - > harvey blue hat</button>
                        <button class = "hchangeHatAlbertRed">change hat - > albert red hat</button>
                        <button class = "hchangeHatHarveyRed">change hat - > harvey red hat</button>
                        <button class = "hchangeHatRemoveHat">change hat - > remove hat</button>
                        <script src = "harveyHat.js"></script>
                    <?php elseif (htmlspecialchars($rock['rockName'] == 'albert')): ?>
                        <button class = "achangeHatHarveyBlue">change hat - > harvey blue hat</button>
                        <button class = "achangeHatAlbertRed">change hat - > albert red hat</button>
                        <button class = "achangeHatHarveyRed">change hat - > harvey red hat</button>
                        <button class = "achangeHatRemoveHat">change hat - > remove hat</button>
                        <script src = "albertHat.js"></script>
                    <?php endif; ?>
                </figure>
                <p>quantity: <?php echo htmlspecialchars($rock['quantity']); ?></p>
                <p>date first obtained: <?php echo htmlspecialchars($rock['obtained']); ?></p>
                <p class = "rarityIndicator" >rarity: <?php echo htmlspecialchars($rock['rarity']); ?></p>
            <?php endforeach; ?>
        <?php endif; ?>
        <script src = "collectionScript.js"></script>
        <script src = "rarityScript.js"></script>
    
    </body>
</html>