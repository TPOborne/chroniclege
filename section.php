<?php
if(!isset($_GET['id'])) {
    echo "Page does not exist";
    exit();
}
$sectionId = $_GET['id'];
include_once('includes/connect.php');
include_once('includes/session.php');
include_once('includes/login.php');
$query = mysql_query("SELECT * FROM sections WHERE id = $sectionId") or die(mysql_error());
$row = mysql_fetch_array($query);
$sectionName = $row['name'];
?>
<!doctype html>
<html>
    <head>
        <title>
            <?php echo $sectionName; ?>
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
                <h2><?php echo $sectionName; ?></h2>
                <div class="forumGroup" id="header">
                    <div class="fBox1">
                        <a href="forum.php">Forum</a> > Thread
                    </div>
                    <div class="fBox2">
                        Last Post
                    </div>
                    <div class="fBox3">
                        Replies
                    </div>
                    <div class="fBox4">
                        Views
                    </div>
                </div>
                <?php 
                    $query = mysql_query("SELECT * FROM threads WHERE section_id = $sectionId");
                    while ($thread = mysql_fetch_array($query)){
                        $threadId = $thread['id'];
                ?> 
                <div class="forumGroup">
                    <div class="fBox1">
                        <?php echo "<a href='thread.php?id=$threadId'>".$thread['name']."</a>"; ?>
                        <div class="subRow">
                            <?php 
                                    $sql = '
                                        SELECT u.username
                                        FROM threads t
                                        JOIN users u ON t.author_id = u.id
                                        WHERE t.id = ' . (int)$threadId . '
                                    ';
                                    $author = mysql_result(mysql_query($sql), 0);
                            ?>
                            by
                            <a href="#">
                                <?php echo $author; ?>
                            </a>
                        </div>
                    </div>
                    <div class="fBox2">
                        <?php
                            $query2 = mysql_query('
                                    SELECT u.username, p.date
                                    FROM posts AS p
                                    INNER JOIN users AS u ON p.user_id = u.id
                                    WHERE p.thread_id = '.$threadId.'
                                    ORDER BY p.id asc
                                    ');
                            while($row = mysql_fetch_array($query2)) {
                                $lastPostBy = $row['username'];
                                $lastPostDate = $row['date'];
                            }
                            date_default_timezone_set('Europe/London');
                            $currentDate = new DateTime();
                            $postDate = new DateTime($lastPostDate);
                            $interval = $currentDate->diff($postDate);
                        
                            
                            $timeString = $interval->s." seconds ago";
                            if ($interval->m!=null) {
                                $timeString = "Over a month ago";
                            } else {
                                if ($interval->i!=null) {
                                    if ($interval->i == 1){
                                        $timeString = $interval->i." minute ago";
                                    } else {
                                        $timeString = $interval->i." minutes ago";
                                    }
                                }
                                if ($interval->h!=null) {
                                    if ($interval->h == 1){
                                        $timeString = $interval->h." hour ago";
                                    } else {
                                        $timeString = $interval->h." hours ago";
                                    }
                                    
                                }
                                if ($interval->d!=null) {
                                    if ($interval->d == 1){
                                        $timeString = $interval->d." day ago";
                                    } else {
                                        $timeString = $interval->d." days ago";
                                    }
                                }
                            }
                        ?>
                        <div class="subRow">
                            by 
                            <a href="#">
                                <?php echo $lastPostBy; ?>
                            </a>
                            <br>
                            <span style="float: right; margin-top: 10px;">
                                <?php echo $timeString; ?>
                            </span>
                        </div>
                    </div>
                    <div class="fBox3" id="lowerBy10">
                        <?php
                            $result = mysql_fetch_array(mysql_query("SELECT count(id) AS count FROM posts WHERE thread_id = $threadId"));
                            echo $result['count']-1;
                        ?>
                    </div>
                    <div class="fBox4" id="lowerBy10">
                        <?php echo $thread['views']; ?>
                    </div>
                </div>
                <?php
                    }
                ?>
                <div class="clear"></div>
            </div>
        </div>
    </body>
</html>
