<?php
include_once('includes/connect.php');
include_once('includes/session.php');
include_once('includes/login.php');
?>
<!doctype html>
<html>
    <head>
        <title>ChronicleGE</title>
        <link rel='stylesheet' href='css/reset.css' type='text/css'/>
        <link rel='stylesheet' href='css/main.css' type='text/css'/>
        <link rel='stylesheet' href='css/home.css' type='text/css'/>
        <link rel='stylesheet' href='css/header.css' type='text/css'/>
        <link rel='stylesheet' href='https://fonts.googleapis.com/css?family=Crimson+Text' type='text/css'/>
    </head>
    <body>
        <?php include_once('includes/header.php'); ?>
        <div class="mainContainer">
             <?php include_once('includes/nav.php'); ?>
            <div class="homeContainer">
                
               
                <h2>Welcome to ChronicleGE</h2>
                <h4>Your home of decks, guides and news</h4>
                
                <h2>Latest Posts</h2>
                
                <?php
                //Get 5 latest posts
                
                $query = mysql_query("SELECT threads.name, users.username FROM threads, posts, users WHERE posts.thread_id = threads.id AND posts.user_id = users.id ORDER BY posts.id DESC LIMIT 5");
                
                while ($row = mysql_fetch_array($query)) {
                    echo $row['name'].'<br>';   
                    echo '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;-'.$row['username'].'<br>';
                }
                ?>
            </div>
        </div>
    </body>
</html>
    
    