<?php

require_once 'includes/config_session.inc.php';
require_once 'includes/dbh.inc.php';

if (isset($_SESSION['user_id'])) {

    $cur_user_id = $_SESSION['user_id'];
    $cur_user_username = $_SESSION["username"];
    try {
        $stmt = $pdo->prepare("
            SELECT chats.chat_id, chats.user_id_1, chats.user_id_2, users.username
            FROM chats
            JOIN users ON chats.user_id_1 = users.id OR chats.user_id_2 = users.id
            WHERE (chats.user_id_1 = :cur_user_id OR chats.user_id_2 = :cur_user_id) AND users.username != :cur_user_username;
        ");
        $stmt->bindParam(':cur_user_id', $cur_user_id, PDO::PARAM_INT);
        $stmt->bindParam(':cur_user_username', $cur_user_username, PDO::PARAM_STR);
        $stmt->execute();
        $chat_infos = $stmt->fetchAll(PDO::FETCH_ASSOC);
    }catch (PDOException $e) {
        echo ("error fetching chats from database. error:" . $e->getMessage());
    }

    $chat = $_GET['chat'] ?? 'home';

    //to get user of user we currently are chatting to
    if ($chat != 'home') {
        $stmt = $pdo->prepare("
            SELECT users.username, chats.chat_id
            FROM users
            JOIN chats ON chats.user_id_1 = users.id OR chats.user_id_2 = users.id
            WHERE chat_id = :cur_chat_id AND users.id != :cur_user_id
        ");
        $stmt->bindParam(":cur_chat_id", $chat, PDO::PARAM_INT);
        $stmt->bindParam(":cur_user_id", $cur_user_id, PDO::PARAM_INT);
        $stmt->execute();
        $cur_chat_user = $stmt->fetchColumn();

        $stmt = $pdo->prepare("
            SELECT messages.message, messages.sender_id, messages.sent_at, users.username
            FROM messages
            JOIN users ON messages.sender_id = users.id
            WHERE chat_id = :cur_chat_id
            ORDER BY messages.sent_at ASC
        ");
        $stmt->bindParam(":cur_chat_id", $chat, PDO::PARAM_INT);
        $stmt->execute();
        $cur_chat_messages = $stmt->fetchAll(PDO::FETCH_ASSOC);

        //to get stats

        $stmt= $pdo->prepare("
        SELECT joined_at, country, rock_totals, wordley_wins, oap_posts
        FROM users
        WHERE username = ?");
        $stmt->execute([$cur_chat_user]);
        $cur_chat_user_stats = $stmt->fetch(PDO::FETCH_ASSOC);

        //to get current user country 
        $stmt=$pdo->prepare("
        SELECT country
        FROM users
        WHERE id = ?
        ");
        $stmt->execute([$_SESSION['user_id']]);
        $cur_chat_user_country = $stmt->fetchColumn();
    }

}
?>


<!DOCTYPE html>
<html lang = "en">
    <head>
        <meta charset="UTF-8">
        <title> ARRG | Home </title>
        <link rel = "stylesheet" href = "style.css">
    </head>
    <body class="messaging-page">
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

        <!-- conversations sidenav, should be visible no matter what -->
         <div class="messaging-layout">
            <?php if (!isset($_SESSION["user_id"])): ?>
                <p class= 'login-or-signup'><a href="login.php?redirect=messaging">log in</a> or <a href="signup.php?redirect=messaging">sign up</a> to chat with your fellow rock collectors.</p>
            <?php elseif (isset($_SESSION['user_id'])): ?>
                <div class='chat-sidenav'>
                    <div class="chat-chats">
                        <ul class='chats-list'>
                            <li class='conversations-header'>CONVERSATIONS</li>
                            <?php if (empty($chat_infos)): ?>
                                <p>no conversations yet. click on a user profile to start a conversation!</p>
                            <?php else: ?>
                                <?php foreach ($chat_infos as $chat_info): ?>
                                    <li><a href = "messaging.php?chat=<?=$chat_info["chat_id"]?>"><?php echo $chat_info["username"]?></a></li>
                                <?php endforeach; ?>
                            <?php endif; ?>
                        </ul>
                    </div>
                    <div class ='profile-display'>
                        <p><a href='profile.php?username=<?=$cur_user_username?>'><?=$cur_user_username?></a></p>
                        <figure>
                            <button class='countryRock'>
                                <img src = "images/countries/<?=$cur_chat_user_country?>.png" width = '50'class='countryRockImage'>
                            </button>
                        </figure>
                    </div>
                </div>
            <?php endif; ?>

            <!-- determines if a user sees the homepage or a chat, and which chat specifically -->           
            <?php if (isset($_SESSION['user_id'])): ?>
                <?php if ($chat === 'home'):?>
                    <p class = 'select-chat-message'>select a chat or click on someone's profile to start a chat!</p>
                <?php elseif ($chat):?>
                    <div class="chat-container">
                        <div class="chat-header">
                            <p class='chatting-with-user'><?= htmlspecialchars($cur_chat_user)?> </p>        
                        </div>
                        <div class="chat-messages" id="chatMessages">
                            <?php foreach ($cur_chat_messages as $cur_chat_message): ?>
                                <div class = "message">
                                    <div class="chat-message-header">
                                        <p class = 'chat-username'><?= htmlspecialchars($cur_chat_message['username'])?></p>
                                        <p class="chat-timestamp"><?= htmlspecialchars($cur_chat_message["sent_at"])?> </p>
                                    </div>
                                    <p class="chat-message"><?= htmlspecialchars($cur_chat_message['message'])?> </p>
                                </div>
                            <?php endforeach;?>
                        </div>
                        <form action = "includes/sendMessage.inc.php" method = "POST" class="chat-input" autocomplete="off" id = 'messageInput'>
                            <textarea id = 'textInput' type = "text" placeholder="message <?= $cur_chat_user?>..." oninput='increaseCounter()' name = "message" maxlength='2000'></textarea>
                            <input type = "hidden" name = "chat_id" value = '<?=$chat?>'> <!--using hidden to submit chat_id without prompting user to insert -->
                            <p class = 'messaging-post-char-counter' id = 'charCounter'>0</p>
                        </form>
                    </div>    
                    <div class='cur-user-display'>
                        <p class='cur-user-display-username'><a href = 'profile.php?username=<?=htmlspecialchars($cur_chat_user)?>'><?=htmlspecialchars($cur_chat_user)?></a></p>
                        <div class = 'cur-user-display-stats'>
                            <figure>
                                <button class='countryRock'>
                                    <img src = "images/countries/<?=$cur_chat_user_stats['country']?>.png" width = '100'class='countryRockImage'>
                                </button>
                            </figure>
                            <p>joined at: <?=$cur_chat_user_stats['joined_at']?></p>
                            <p>total rocks owned:<?=$cur_chat_user_stats['rock_totals']?></p>
                            <p>wordley wins:<?=$cur_chat_user_stats['wordley_wins']?></p>
                            <p>oap posts:<?=$cur_chat_user_stats['oap_posts']?></p>
                        </div>
                    </div>
                <?php else:?>
                    <p> something seriously went wrong, i don't even know what. my best, and only guess is that the url you entered is NOT legit.</p>
                    <p> if you get this message out of the blue, please click on the "chat" icon on the nav bar again, this should not happen normally.</p>
                <?php endif;?>
            <?php endif;?>

        </div>
        <script src = "messaging.js" defer></script>
        <script src = 'sendMessage.js' defer></script>
        <script src = 'messagingTextBoxCounter.js' defer></script>
        <script src = 'rockPetting.js' defer></script>
    </body>
</html>