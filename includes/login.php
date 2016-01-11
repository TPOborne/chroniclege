<?php
$usernameError = false;
$passwordError = false;
if (isset($_POST['submit'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $query = mysql_query("SELECT * FROM users WHERE username='$username'") or die (mysql_error());
    if (mysql_num_rows($query) != 0) { //if username exists we need to check the password matches
        $row = mysql_fetch_array($query);
        $_SESSION['user'] = $username;
        if ($password == $row['password']) {
            $_SESSION['userId'] = $row['id'];
        } else { 
            $passwordError = true;
        }
    } else {
        $usernameError = true;
    }
}
