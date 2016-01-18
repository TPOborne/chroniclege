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
        <link rel='stylesheet' href='css/home.css?' type='text/css'/>
        <link rel='stylesheet' href='css/header.css' type='text/css'/>
        <link rel='stylesheet' href='https://fonts.googleapis.com/css?family=Crimson+Text' type='text/css'/>
    </head>
    <body>
        <?php include_once('includes/header.php'); ?>
        <div class="mainContainer">
             <?php include_once('includes/nav.php'); ?>
            <div class="homeContainer">               
                <h2>Decks</h2>
                <h4>Some more text</h4>
                <?php
                    $query = mysql_query("SELECT * FROM decks");
                    while ($row = mysql_fetch_array($query)) {
                        $deckName = $row['name'];
                        $deckId = $row['id'];
                        
                ?>
                        
                    <a href="deck.php?id=<?php echo $deckId; ?>" >
                        <div class="deckGroup">
                            <h6><?php echo $deckName; ?></h6>
                        </div>
                    </a>
                        
                <?php
                    }
                ?> 
                <div class="clear"></div>               
              </div>
              
        </div>
    </body>
</html>
    
    