<?php
if (!isset($_GET['id'])) {
    echo "Page does not exist";
    exit();
}
$cardId = $_GET['id'];
include_once('includes/connect.php');
include_once('includes/session.php');
include_once('includes/login.php');

if (isset($_SESSION['userId'])) {
    $userId = $_SESSION['userId'];
}

$query = mysql_query("SELECT * FROM cards WHERE id = $cardId") or die(mysql_error());
$row = mysql_fetch_array($query);
$cardName = $row['name'];
$cardLink = $row['link'];
$cardEffect = $row['effect'];
$cardRarity = $row['rarity'];
$cardType = $row['type'];
$cardCategory = $row['category'];
$cardClass = $row['class'];
?>
<!doctype html>
<html>
    <head>
        <title>
            <?php echo $cardName; ?>
        </title>
        <link rel='stylesheet' href='css/reset.css' type='text/css'/>
        <link rel='stylesheet' href='css/main.css?id=1' type='text/css'/>
        <link rel='stylesheet' href='css/header.css' type='text/css'/>
        <link rel='stylesheet' href='https://fonts.googleapis.com/css?family=Crimson+Text' type='text/css'/>
    </head>
    <body>
        <?php include_once('includes/header.php'); ?>
        <div class="mainContainer">
            <?php include_once('includes/nav.php'); ?> 
            <div class="backgroundContainer">
                <?php
                    echo "<h2>".$cardName."</h2>";
                
                    echo "<img src='images/".$cardLink."' />";
                
                    echo "<p>".$cardEffect."</p>";
                
                    echo "<p>".$cardRarity."</p>";
                
                    echo "<p>".$cardCategory."</p>";
                
                    echo "<p>".$cardClass."</p>";
                
                    echo "<p>".$cardType."</p>";
                ?>
            </div>
        </div>
    </body>
</html>