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
        <link rel='stylesheet' href='css/main.css?' type='text/css'/>
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
                
                <?php
                //Get 5 latest posts
                
                $query = mysql_query("SELECT name FROM threads WHERE id = 2");
                
                while ($row = mysql_fetch_array($query)) {
                    echo $row['name'];   
                }
                ?>
            </div>
        </div>
    </body>
</html>
    
    