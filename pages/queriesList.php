<?php
    require_once ("../data/bikes.php");
    require_once ("functions.php");
    require_once("../db/autoloader.php");
    echo '<div class="queriesList">';
    foreach (Query::getQueries() as $query) echo $query . '<br>';
    echo '</div>';
?>