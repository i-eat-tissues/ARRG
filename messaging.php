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
        ");
        $stmt->bindParam(":cur_chat_id", $chat, PDO::PARAM_INT);
        $stmt->execute();
        $cur_chat_messages = $stmt->fetchAll(PDO::FETCH_ASSOC);
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

        <!-- conversations sidenav, should be visible no matter what -->
        <?php if (!isset($_SESSION["user_id"])): ?>
            <p><a href="login.php">log in</a> or <a href="signup.php">sign up</a> to chat with your fellow rock collectors.</p>
        <?php elseif (isset($_SESSION['user_id'])): ?>
            <?php foreach ($chat_infos as $chat_info): ?>
                <p>chat id: <?=$chat_info["chat_id"] ?>
                <p><a href = "messaging.php?chat=<?=$chat_info["chat_id"]?>">to: <?php echo $chat_info["username"]?></a></p>
            <?php endforeach; ?>
        <?php endif; ?>

        <!-- determines if a user sees the homepage or a chat, and which chat specifically -->
        <?php if (!isset($_SESSION["user_id"])): ?>
            
        <?php elseif (isset($_SESSION['user_id'])): ?>
            <?php if ($chat === 'home'):?>
                <p>poop (you're on the homepage yay)</p>
            <?php elseif ($chat):?>
                <p> poo you're in a chat, the chat id is <?= $chat?> </p>
                <form action = "includes/sendMessage.inc.php" method = "POST">
                    <input type = "text" placeholder="message <?= $cur_chat_user?>" name = "message">
                    <input type = "hidden" name = "chat_id" value = <?=$chat?>> <!--using hidden to submit chat_id without prompting user to insert -->
                </form>

                <?php foreach ($cur_chat_messages as $cur_chat_message): ?>
                    <div class = "message">
                        <p> id from: <?= $cur_chat_message["sender_id"]?></p>
                        <p>username from: <?= $cur_chat_message['username']?></p>
                        <p>message: <?= $cur_chat_message['message']?> </p>
                    </div>
                <?php endforeach;?>
            <?php else:?>
                <p> something seriously went wrong, i don't even know what. my best, and only guess is that the url you entered is NOT legit.</p>
                <p> if you get this message out of the blue, please click on the "chat" icon on the nav bar again, this should not happen normally.</p>
            <?php endif;?>
        <?php endif;?>
    </body>
</html>