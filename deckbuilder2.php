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
        <link rel='stylesheet' href='css/main.css' type='text/css'/>
        <link rel='stylesheet' href='css/header.css' type='text/css'/>
        <link rel='stylesheet' href='css/deckbuilder.css' type='text/css'/>
        <link rel='stylesheet' href='https://fonts.googleapis.com/css?family=Crimson+Text' type='text/css'/>
        <script src="lib/jquery-1.11.3.js"></script>
        <script src="lib/jquery-ui.min.js"></script>
        <script src="lib/jquery.ui.touch-punch.min.js"></script>
    </head>
    <body>
        <?php include_once('includes/header.php'); ?>
        <div class="mainContainer">
            <?php include_once('includes/nav.php'); ?>
            <div class="backgroundContainer">
                <h2>Deckbuilder</h2>
                <div class="cardsContainer">
                    <?php
                    $totalCards = mysql_result(mysql_query("SELECT COUNT(id) FROM cards"),0);
                    $totalPages  = (int)($totalCards / 8) + 1;
                    $query = mysql_query("SELECT link, id, name, rarity FROM cards ORDER BY CASE rarity
                      WHEN 'basic' THEN 1
                      WHEN 'common' THEN 2
                      WHEN 'uncommon' THEN 3
                      WHEN 'rare' THEN 4
                      ELSE 5
                   END, name ASC");
                    $count = 0;
                    $a = 0;
                    while ($row = mysql_fetch_array($query)) {
                        if ($count==0) {
                            $tempCount = $a;
                            echo "<div class='cardGroup' id='section0'>";
                            echo "<div class='pageNumber'><h6>
                            <a id='left' href='#section".$a."'><img src='images/left.svg' width='14px'/></a>
                            ".($tempCount+1)." / ".$totalPages."
                            <a id='right' href='#section".($a+1)."'><img src='images/right.svg' width='14px'/></a>
                            </h6></div>";
                        } elseif ($count%8==0) {
                            $a++;
                            $tempCount = $a;
                            echo "</div>";
                            echo "<div class='cardGroup' id='section".$a."'>";
                            echo "<div class='pageNumber'><h6>
                                <a id='left' href='#section".($a-1)."'><img src='images/left.svg' width='14px'/></a>
                                ".($tempCount+1)." / ".$totalPages."
                                <a id='right' href='#section".($a+1)."'><img src='images/right.svg' width='14px'/></a>
                                </h6></div>";
                        }
                        $link = $row['link'];
                        echo "<div class='card' id='".$row['id']."' name=\"".$row['name']."\" rarity='".$row['rarity']."'>";
                        echo "<img src='images/".$link."' width='100px' id='cardImg'/>";
                        echo "</div>";
                        $count++;
                    }
                    echo "</div>";
                    ?>
                </div>

                <div class="decklist">

                </div>

                <div class="clear"></div>
            </div>
        </div>

        <script type="text/javascript">
            $(document).ready(function() {
                var deck = [];
                $(".card").click(function() {
                    $id = $(this).attr("id");
                    $name = $(this).attr("name");
                    $rarity = $(this).attr("rarity");
                    
                    $count = 0;                    
                    for (var i = 0; i < deck.length; i++) {
                        if (deck[i][0] == $id) {
                            $count++;  
                        }
                    }
                    
                    if ($count == 0) {
                        deck.push(new Array($id, $name, $rarity));
                    }
                    if ($count == 1 && $rarity != "Very rare") {
                        deck.push(new Array($id, $name, $rarity));
                    }
                    if ($count==2) {
                        //do nothing
                    }
                    
                    deck.sort();
                    $(".decklist").empty();
                    for (var i = 0; i < deck.length; i++) { 
                        $card = $("<div class='deckItem' id='" + deck[i][0] + "' name='" + deck[i][1] + "' rarity='" + deck[i][2] + "'>" + deck[i][1] + "</div>");
                        $(".decklist").append($card);
                    }                    
                    
                    
                    var seen = [];
                    $(".deckItem").each(function() {
                        var txt = $(this).text();
                        var id = $(this).id();
                        if (seen[txt]) {
                            $(".deckItem#"+id).remove();
                            //$(this).css("display", "none");
                            
                        } else {
                            seen[txt] = true;
                        }
                    });
                    
                    
                });
            });

            $("img#cardImg").mouseover(function(){
                $(this).css("opacity", "1");
            });
            $("img#cardImg").mouseleave(function(){
                $(this).css("opacity", "0.8");
            });
        </script>
    </body>
</html>

