<?php
if (!isset($_GET['id'])) {
    echo "Page does not exist";
    exit();
}
$cardId = $_GET['id'];
include_once('includes/connect.php');
include_once('includes/session.php');
include_once('includes/login.php');

if (isset($_POST['submitComment'])) {
    $userId = $_SESSION['userId'];
    $comment = $_POST['comment_text'];
    $check = mysql_query("SELECT comment FROM card_comments WHERE comment = '$comment'");
    if (mysql_num_rows($check) == 0) {
        mysql_query("INSERT INTO card_comments(card_id, comment, user_id) VALUES ('$cardId', '$comment', '$userId');");
    } else {
        header("Refresh:0");
    }

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
        <link rel='stylesheet' href='css/card.css' type='text/css'/>
        <link rel='stylesheet' href='https://fonts.googleapis.com/css?family=Crimson+Text' type='text/css'/>
    </head>
    <body>
        <?php include_once('includes/header.php'); ?>
        <div class="mainContainer">
            <?php include_once('includes/nav.php'); ?> 
            <div class="backgroundContainer">
                <h2><?php echo $cardName; ?></h2>
                <?php
                    if ($cardClass=='Ozan') {
                        echo '<div class="topContents classOzan">';
                    } elseif ($cardClass=='Raptor') {
                        echo '<div class="topContents classRaptor">';
                    } elseif ($cardClass=='Ariane') {
                        echo '<div class="topContents classAriane">';
                    } elseif ($cardClass=='Linza') {
                        echo '<div class="topContents classLinza">';
                    } else {
                        echo '<div class="topContents">';
                    }
                ?>
                    <div class="left">
                        <?php
                            echo "<img src='images/".$cardLink."' />";
                        ?>
                    </div>

                    <div class="right">
                        <?php                        
                            echo "<p><span id='attribute'>Class: </span>";
                            echo "<img src='images/icons/gold.png' class='smallIcon'/>";
                            echo " ".$cardClass."</p>";

                            echo "<p><span id='attribute'>Category: </span>";
                            if ($cardCategory=='Enemy'){
                                echo "<img src='images/icons/enemy.png' class='smallIcon'/>";
                            } else {
                                echo "<img src='images/icons/support.png' class='smallIcon'/>";
                            }
                            echo " ".$cardCategory."</p>";

                            echo "<p><span id='attribute'>Rarity: </span>";
                            if ($cardRarity!='Basic') {  
                                echo "<img src='images/icons/".str_replace(' ', '_', $cardRarity).".png' class='smallIcon'/>";
                            }
                            echo " ".$cardRarity."</p>";

                            if ($cardType=='') {
                                $cardType = 'None';
                            }
                            echo "<p><span id='attribute'>Type: </span>";
                            echo "<img src='images/icons/red.png' class='smallIcon' />";
                            echo " ".$cardType."</p>";

                            echo "<p><span id='attribute'>Text: </span>";
                            echo "<img src='images/icons/scroll.png' class='smallIcon'/>";
                            echo " ".$cardEffect."</p>";

                        ?>

                    </div>
                </div>
                
                <div class="comments">
                    <h2>Comments</h2>
                    <div class="bottomContents">
                        <?php
                            $getComments = mysql_query("SELECT comment, users.username FROM card_comments, users WHERE card_id='$cardId' AND card_comments.user_id = users.id ORDER BY date DESC LIMIT 5");
                            while ($row = mysql_fetch_array($getComments)) {
                                echo "<div class='comment'>";
                                    echo "<div class='details' id='padding10side'>".$row['username']."</div>";
                                    echo "<div class='gap'>&nbsp;</div>";
                                    echo "<div class='commentText'>";
                                        echo "<p>".$row['comment']."</p>";
                                    echo "</div>";
                                echo "</div>";
                            }
                        ?>
                        
                        <?php                   
                            if (isset($_SESSION['userId'])) {
                        ?>
                        <form action="" method="POST">
                            <textarea name="comment_text" placeholder="Reply..."></textarea>
                            <br>
                            <input type="submit" value="Send" name="submitComment" class="send"/>
                        </form>
                        <?php
                            } else {
                                echo "You must be logged in to post.";
                            }
                        ?>
                    </div>
                </div>
                
                <div class="clear"></div>
            </div>
        </div>
    </body>
</html>