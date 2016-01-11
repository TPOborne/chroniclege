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
           <div class="header">  
    <div class="headerContainer">
        <div id="icon">
               <span>
                <hr>
                <hr>
                <hr>
            </span>
        </div>
        <div class="logo">
            <a href="index.php">C<span class="logoSmaller">hronicle</span>GE</a>
        </div>
        <div class="login">
            <?php
            if (!isset($_SESSION['userId'])) {
                if (isset($_SESSION['user'])) {
                    $username = $_SESSION['user'];
                } else {
                    $username = "";
                }
                echo '
                <form action="" method="POST">
                    Username ';
                    if ($usernameError==true) {
                        echo '<input type="text" name="username" placeholder="User does not exist" value="'.$username.'" />';
                    } else {
                        echo '<input type="text" name="username" value="'.$username.'" />';
                    }
                echo '
                    &nbsp;
                    Password ';
                    if ($passwordError==true) {
                        echo '<input type="password" name="password" placeholder="Incorrect Password"/>';
                    } else {
                        echo '<input type="password" name="password" />';
                    }
                echo '
                    <input type="submit" name="submit" value="Login" />
                </form>
                ';
            } else {
                echo 'Logged in as '.$_SESSION['user'].' - <a href="logout.php">logout</a>';
            }
            ?>
        </div>
        <div class="clear"></div>
    </div>
</div>
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
        
        <script src="http://code.jquery.com/jquery-2.2.0.min.js"></script>
        
        <script>
            var open = false;
            $(document).ready(function() {
               $("#icon").click(function() {
                  if (open == false) {
                      $(".login").css("display", "block");
                      open = true;
                  } else {
                    $(".login").css("display", ""); 
                      open = false;
                  }
               });
            });
        </script>
        
        
    </body>
</html>