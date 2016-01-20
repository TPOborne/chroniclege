<?php
include_once('includes/connect.php');
include_once('includes/session.php');

if(isset($_POST['submit'])){
    $cardId = $_POST['cardId'];
    $attack = $_POST['attack'];
    $health = $_POST['health'];
    mysql_query("UPDATE cards SET attack='$attack', health='$health' WHERE id='$cardId'");
}
?>
<!doctype html>
<html>
    <head>
        <title>ChronicleGE</title>
        <link rel='stylesheet' href='css/reset.css' type='text/css'/>
        <link rel='stylesheet' href='css/main.css' type='text/css'/>
        <link rel='stylesheet' href='css/header.css' type='text/css'/>
        <link rel='stylesheet' href='https://fonts.googleapis.com/css?family=Crimson+Text' type='text/css'/>
        <script src="lib/jquery-1.11.3.js"></script>
        <script src="lib/jquery-ui.min.js"></script>
        <script src="lib/jquery.ui.touch-punch.min.js"></script>
        <style>
            input[type='text'] {
                width: 40px;
                padding: 10px;
                font-size: 20px;
            }
            form {
                float: left;
                width: 100%;
            }
        </style>
    </head>
    <body>
        <div class="mainContainer">
           <?php include_once("includes/header.php"); ?>
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
                    Attack <input type="text" name="attack"/>
                    Health <input type="text" name="health"/>
                    <input type="submit" value="sumbit" name="submit"/>
                </form>
                <div class="clear"></div>
            </div>
    </body>
</html>
    
    