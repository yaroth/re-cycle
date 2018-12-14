<?php
    require_once ("../data/bikes.php");
    require_once ("functions.php");
    require_once("../db/autoloader.php");
    echo '<h4>Bicycles list</h4>';
    echo '<div class="bikesList">';
    listEditableBicycles();
    echo '</div>';
?>