<?php


$host = '107.180.51.232';
$user = 'chronicledb';
$pass = 'chronicle123';
$db = 'forum_db';

$query = mysql_connect($host, $user, $pass) or die(mysql_error());
mysql_select_db($db) or die(mysql_error());