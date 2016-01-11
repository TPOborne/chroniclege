<?php

card {
    $card = [];
    
     function __construct() {
         $query = mysql_query("SELECT * FROM cards")
             $card = mysql_fetch_array($query);
     }
    
    get
    
}