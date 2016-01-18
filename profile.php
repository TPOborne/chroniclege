<?php
if (!isset($_GET['user'])) {
    echo "Page does not exist";
    exit();
}

include_once('includes/connect.php');
include_once('includes/session.php');
include_once('includes/login.php');

$requestedUser = $_GET['user'];
$requestedUserId = mysql_result(mysql_query("SELECT id FROM users WHERE username = '$requestedUser'"), 0);
    
if (isset($_SESSION['userId'])){
    $userId = $_SESSION['userId'];
    $username = mysql_result(mysql_query("SELECT username FROM users WHERE id = '$userId'"), 0);
    if (strtolower($username) == strtolower($requestedUser)) {
        //same user
    } else {
        //different user
    }
}




?>
<!doctype html>
<html>
    <head>
        <title>ChronicleGE</title>
        <link rel='stylesheet' href='css/reset.css' type='text/css'/>
        <link rel='stylesheet' href='css/main.css' type='text/css'/>
        <link rel='stylesheet' href='css/header.css' type='text/css'/>
        <link rel='stylesheet' href='https://fonts.googleapis.com/css?family=Crimson+Text' type='text/css'/>
    </head>
    <body>
        <?php include_once('includes/header.php'); ?>
        <div class="mainContainer">
             <?php include_once('includes/nav.php'); ?>
            <div class="backgroundContainer">
                
               
                <h2>Profile - <?php echo ucfirst($requestedUser); ?></h2>
                
                
                <h6>Posts</h6>
                <?php
                    $query = mysql_query("SELECT text, rating, threads.name AS thread_name FROM posts, threads WHERE posts.thread_id = threads.id AND user_id = '$requestedUserId'");
                    while ($row = mysql_fetch_array($query)) {
                        echo $row['rating']." : ".$row['text']." - in ".$row['thread_name']."<br>";
                    }
                ?>
                
                <h6>Threads</h6>
                <?php
                    $query = mysql_query("SELECT name, views FROM threads WHERE author_id = '$requestedUserId'");
                    while ($row = mysql_fetch_array($query)) {
                        echo $row['name']." ".$row['views']."<br>";
                    }
                ?>
                
                <h6>Comments</h6>
                <?php
                    $query = mysql_query("SELECT comment, cards.name, cards.id FROM card_comments, cards WHERE card_comments.card_id = cards.id AND user_id = '$requestedUserId'");
                    while ($row = mysql_fetch_array($query)) {
                        echo $row['comment']." in <a href='card.php?id=".$row['id']."'>".$row['name']."</a><br>";
                    }
                ?>
            </div>
        </div>
        
        <script>
            
        </script>
    </body>
</html>
    
    