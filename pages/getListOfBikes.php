<?php
    /**
     * Called using AJAX
     */
    require_once("../db/autoloader.php");
    require_once("../data/bikes.php");
    require_once("functions.php");
    session_start();
    if (isset($_SESSION["user"])) {
        $login = $_SESSION["user"];
        if (isset($_POST["allOrMatching"])) {
            $allOrMatchingBikes = $_POST["allOrMatching"];
            if ($allOrMatchingBikes == "all") listBicycles();
            elseif ($allOrMatchingBikes == "matching") listMatchingBicycles($login);

        } else echo "You are not an admin, sorry!";
    } else echo "session cookie 'user' not set!";