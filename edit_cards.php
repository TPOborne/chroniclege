<?php
include_once('includes/connect.php');
include_once('includes/session.php');

if(isset($_POST['submit'])){
    $cardId = $_POST['cardId'];
    $attack = $_POST['attack'];
    $health = $_POST['health'];
    echo $attack.$health." ".$cardId;
    mysql_query("UPDATE cards SET attack='$attack', health='$health' WHERE id='$cardId'");
}
?>
<!doctype html>
<html>
    <head>
        <title>ChronicleGE</title>
        <link rel='stylesheet' href='css/reset.css' type='text/css'/>
        <link rel='stylesheet' href='css/main.css' type='text/css'/>
        <link rel='stylesheet' href='https://fonts.googleapis.com/css?family=Crimson+Text' type='text/css'/>
        <script src="lib/jquery-1.11.3.js"></script>
        <script src="lib/jquery-ui.min.js"></script>
        <script src="lib/jquery.ui.touch-punch.min.js"></script>
    </head>
    <body>
        <div class="mainContainer">
            <div class="backgroundContainer">
                <h2>Let's Start</h2>
                <?php
                    $query = mysql_query("SELECT link, id FROM cards WHERE attack=0");
                    $row = mysql_fetch_array($query);
                    $cardId = $row['id'];
                    $link = $row['link'];
                    echo "<img src='images/".$link."' />"
                ?>
                <form action="" method="POST">
                    <input type="hidden" name="cardId" value="<?php echo $cardId ?>"/>
                    <input type="text" name="attack"/>
                    <input type="text" name="health"/>
                    <input type="submit" value="sumbit" name="submit"/>
                </form>
            </div>
    </body>
</html>
    
    