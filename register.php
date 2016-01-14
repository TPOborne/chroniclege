<?php
include_once('includes/connect.php');
include_once('includes/session.php');
include_once('includes/login.php');

if (isset($_POST['register'])) {
    $errors = [];
    $username = $_POST['username'];
    $password = $_POST['password'];
    $password2 = $_POST['passwordConfirm'];
    $email = $_POST['email'];
    date_default_timezone_set('Europe/London');
    $date = new DateTime();
    $currentDate = date_format($date, 'Y-m-d h:i:s');
    if (count($errors)==0) {
        //create user
        mysql_query("INSERT INTO users(username, email, password, join_date) VALUES ('$username', '$email', '$password', '$currentDate')");
        echo "User created.";
    } else {
        //send back with errors
        echo "There were errors. User was not created.";
    }
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
                
               
                <h2>Sign Up</h2>
                <h4>To build decks, engage in the forum and comment on articles.</h4>
                
                <form action="" method="POST">
                    <label>Username</label>
                    <input type="text" name="username" maxlength="26" />
                    <br>
                    <label>Email</label>
                    <input type="email" name="email" />
                    <br>
                    <label>Password</label>
                    <input type="password" name="password" />
                    <br>
                    <label>Confirm Password</label>
                    <input type="password" name="passwordConfirm" />
                    <br>
                    <input type="submit" value="Sign Up" name="register" />
                </form>

            </div>
        </div>
    </body>
</html>
    
    