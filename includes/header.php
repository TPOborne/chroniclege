<div class="header">  
    <div class="headerContainer">
        <div class="logo">
            <a href="index.php"><img class="logo" src="images/logo/chroniclege.png"/></a>
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