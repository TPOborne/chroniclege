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
            
            function sortTogether(array1, array2) {
                var merged = [];
                for(var i=0; i<array1.length; i++) { merged.push({'a1': array1[i], 'a2': array2[i]}); }
                merged.sort(function(o1, o2) { return ((o1.a1 < o2.a1) ? -1 : ((o1.a1 == o2.a1) ? 0 : 1)); });
                for(var i=0; i<merged.length; i++) { array1[i] = merged[i].a1; array2[i] = merged[i].a2; }
            }
            
            $(document).ready(function() {
                var deck = [];
                var cardIds = [];
                //var cardRarity = [];
                $(".card").click(function() {
                    $cardName = $(this).attr("name");
                    $cardId = $(this).attr("id");
                    $cardRarity = $(this).attr("rarity");
                    $occurances = 0;
                    for (var i = 0; i < deck.length; i++) {
                      if (deck[i] == $cardName) {
                        $occurances++;
                      }
                    }
                    //if there are less than 2 of this card in deck array
                    if ($cardRarity=="Very rare" && $occurances==1) {
                        $occurances++;
                    }
                    if ($occurances < 2) {
                        //add the card to array
                        deck.push($cardName);
                        cardIds.push($cardId);
                        //cardRarity.push($cardRarity);
                        //deck.sort();
                        sortTogether(deck, cardIds);
                        //empty the decklist div
                        $(".decklist").empty();
                        //go through all the cards in the deck array.
                        //if that card appears once append it else replace it
                        for (var i = 0; i < deck.length; i++) {
                            //count the number of times this card is in the deck array
                            $count = 1;
                            for (var k = i + 1; k < deck.length; k++) {
                                if (deck[k] == deck[i]) {
                                    $count++;
                                    i++; // Skip the item just matched as well
                                }
                            }
                            if ($count == 1) {
                                //this runs once
                                var $toBeAppended = $("<div class='deckItem' id='card" + cardIds[i] + "'><div class='deckItemName'>" + deck[i] + "</div></div>");
                                $(".decklist").append($toBeAppended);
                            } else if ($count == 2) {
                                //this runs twice
                                var $replacement = $("<div class='deckItem' id='card" + cardIds[i] + "'><div class='deckItemName'>" + deck[i] + "</div><div class='deckItemQuantity'>2</div></div>");
                                $(".decklist").remove(".deckItem#" + cardIds[i]);
                                $(".decklist").append($replacement);
                            }
                        }
                    }
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
    
    