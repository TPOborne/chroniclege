<?php
if (!isset($_GET['id'])) {
    echo "Page does not exist";
    exit();
}
$threadId = $_GET['id'];
include_once('includes/connect.php');
include_once('includes/session.php');
include_once('includes/login.php');
include_once('includes/views.php');

if (isset($_SESSION['userId'])) {
    $userId = $_SESSION['userId'];
    if (isset($_POST['postReply'])) {
        $text = $_POST['comment'];
        mysql_query("INSERT INTO posts (thread_id, user_id, text) VALUES ($threadId, $userId, '$text')") or die (mysql_error());
    }
}
$query = mysql_query("SELECT * FROM threads WHERE id = $threadId") or die(mysql_error());
$row = mysql_fetch_array($query);
$threadName = $row['name'];
$sectionId = $row['section_id'];
$querySection = mysql_query("SELECT name FROM sections WHERE id = $sectionId");
$sectionName = mysql_result(($querySection),0);
?>
<!doctype html>
<html>
    <head>
        <title>
            <?php echo $threadName; ?>
        </title>
        <link rel='stylesheet' href='css/reset.css' type='text/css'/>
        <link rel='stylesheet' href='css/main.css' type='text/css'/>
        <link rel='stylesheet' href='css/header.css' type='text/css'/>
        <link rel='stylesheet' href='css/forum.css' type='text/css'/>
        <link rel='stylesheet' href='https://fonts.googleapis.com/css?family=Crimson+Text' type='text/css'/>
    </head>
    <body>
        <?php include_once('includes/header.php'); ?>
        <div class="mainContainer">
            <?php include_once('includes/nav.php'); ?> 
            <div class="forumContainer">
                <h2><?php echo $threadName; ?></h2>
                <div class="forumGroup" id="header">
                    <div class="fBox1">
                        <a href="forum.php">Forum</a> 
                        > 
                        <a href="section.php?id=<?php echo $sectionId; ?>"><?php echo $sectionName; ?></a>
                        > 
                        <?php echo $threadName; ?>
                    </div>
                </div>
                <?php
                    $postQuery = mysql_query("SELECT * FROM posts WHERE thread_id = $threadId");
                    while ($row = mysql_fetch_array($postQuery)) {
                        $userId = $row['user_id'];
                        $userQuery = mysql_query("SELECT * FROM users WHERE id = $userId");
                        while ($row2 = mysql_fetch_array($userQuery)) {
                            $user = $row2['username'];
                            $joinDate = $row2['join_date'];
                        }
                ?>
                <div class="forumPost">
                    <div class="postHeader">
                        <?php 
                            $postDate = $row['date'];
                            $date = date ("j F Y", strtotime($postDate));
                            echo $date;
                        ?>
                    </div>
                    <div class="postDetails">
                        <?php echo $user."<br>Joined: ".date("j/m/Y", strtotime($joinDate)); ?>
                    </div>
                    <div class="postText">
                        <?php echo $row['text']; ?>
                    </div>
                </div>
                <?php
                    }
                    if (isset($_SESSION['userId'])) {
                ?>
                <div class="forumPost reply">
                    Reply to thread
                    <hr>
                    <form action="" method="POST">
                        <textarea name="comment"></textarea>
                        <input type="submit" name="postReply" value="Send"/>
                    </form>
                </div>
                <?php
                    } else {
                        echo "You must be logged in to post.";
                    }
                ?>
                <div class="clear"></div>
            </div>
        </div>
    </body>
</html>