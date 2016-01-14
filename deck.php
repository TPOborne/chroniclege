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
                
               
                <h2>Browse Decks</h2>
                <h4>Sort By views, popularity, etc...</h4>
                
                <?php
                
                $query = mysql_query("SELECT cards.name FROM cards, decks, deck_cards WHERE deck_cards.deck_id = decks.id AND deck_cards.card_id = cards.id AND decks.id = 1");
                
                while ($row = mysql_fetch_array($query)) {
                    echo $row['name'].'<br>';
                }

                ?>
                

            </div>
        </div>
    </body>
</html>
    
    