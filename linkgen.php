<?php
include_once('includes/connect.php');

//cards/enemy/general/basic/barbarian_warrior.png

$query = mysql_query("SELECT * FROM cards");
while ($row = mysql_fetch_array($query)) {
    $id = $row['id'];
    $category = $row['category'];
    $class = $row['class'];
    $rarity = str_replace(' ', '_', $row['rarity']);
    $name = str_replace(' ', '_', $row['name']);
    $link = "cards/".$category."/".$class."/".$rarity."/".$name.".png";
    
    mysql_query("UPDATE cards SET link = '$link' WHERE id = '$id'");
}
?>
