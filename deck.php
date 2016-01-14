<?php
if (!isset($_GET['id'])) {
    echo "Page does not exist";
    exit();
}
$deckId = $_GET['id'];
include_once('includes/connect.php');
include_once('includes/session.php');
include_once('includes/login.php');

$init_query = mysql_query("SELECT name, description, rating, user_id, users.username FROM decks, users WHERE decks.id = '$deckId' AND decks.user_id = users.id");

if (mysql_num_rows($init_query) == 0) {
    echo "Page does not exist";
    exit();
}

while ($row = mysql_fetch_array($init_query)) {
    $deckName = $row['name'];
    $deckDescription = $row['description'];
    $deckRating = $row['rating'];
    $userId = $row['user_id'];
    $username = $row['username'];
}

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
                
               
                <h2><?php echo $deckName; ?></h2>
                <h4>Made by <?php echo $username; ?></h4>
                
                <?php
                
                echo $deckDescription.'<br>';
                
                $query = mysql_query("SELECT cards.name FROM cards, decks, deck_cards WHERE deck_cards.deck_id = decks.id AND deck_cards.card_id = cards.id AND decks.id = 1");
                
                while ($row = mysql_fetch_array($query)) {
                    echo $row['name'].'<br>';
                }

                ?>
                

            </div>
        </div>
    </body>
</html>
    
    