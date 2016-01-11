<?php
include_once('includes/connect.php');
include_once('includes/session.php');
include_once('includes/login.php');
?>
<!doctype html>
<html>
    <head>
        <title>Forum - ChronicleGE</title>
        <link rel='stylesheet' href='css/reset.css' type='text/css'/>
        <link rel='stylesheet' href='css/main.css' type='text/css'/>
        <link rel='stylesheet' href='css/header.css' type='text/css'/>
        <link rel='stylesheet' href='css/forum.css' type='text/css'/>
        <link rel='stylesheet' href='https://fonts.googleapis.com/css?family=Crimson+Text' type='text/css'/>
        
    </head>
    <body>
        <?php include_once("includes/header.php") ?>
        <div class="mainContainer">
            <?php include_once('includes/nav.php'); ?> 
            <div class="forumContainer">
                <h2>Chronicle General</h2>
                <div class="forumGroup" id="header">
                    <div class="fBox1">
                        Forum
                    </div>
                    <div class="fBox2">
                        Last Post
                    </div>
                    <div class="fBox3">
                        Threads
                    </div>
                    <div class="fBox4">
                        Posts
                    </div>
                </div>
                <?php 
                    $query = mysql_query("SELECT * FROM sections");
                    while ($row = mysql_fetch_array($query)){
                ?>        
                <div class="forumGroup">
                    <div class="fBox1">
                        <?php echo "<a href='section.php?id=".$row['id']."'>".$row['name']."</a>"; ?>
                        <div class="subRow">
                            <?php echo $row['description']; ?>
                        </div>
                    </div>
                    <div class="fBox2">
                        <?php
                            $query2 = mysql_query('
                                    SELECT u.username, p.date
                                    FROM posts AS p
                                    INNER JOIN users AS u ON p.user_id = u.id
                                    WHERE p.thread_id = 2
                                    ORDER BY p.id asc
                                    ');
                            while($row2 = mysql_fetch_array($query2)) {
                                $lastPostBy = $row2['username'];
                                $lastPostDate = $row2['date'];
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
                            by <a href="#"><?php echo $lastPostBy; ?></a>
                            <br>
                            <span style="float: right; margin-top: 10px;">
                                <?php echo $timeString; ?>
                            </span>
                        </div>
                    </div>
                    <div class="fBox3" id="lowerBy10">
                        <?php
                            $threadQuery = mysql_query("SELECT COUNT(id) AS count FROM threads WHERE section_id = ".$row['id']);
                            $result = mysql_fetch_array($threadQuery);
                            echo $result['count'];
                        ?>
                    </div>
                    <div class="fBox4" id="lowerBy10">
                        0
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