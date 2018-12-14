<?php
    require_once ("../data/bikes.php");
    require_once ("functions.php");
    require_once("../db/autoloader.php");
    echo '<div class="matchesList">';
    foreach (Matching::getMatchings() as $matching){
        echo $matching . '<br>';
    }
    echo '</div>';
?>