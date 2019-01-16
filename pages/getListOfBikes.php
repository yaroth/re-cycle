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
            $language = "";
            if (isset($_POST["language"])) $language = $_POST["language"];
            if ($allOrMatchingBikes == "all") listBicycles($language);
            elseif ($allOrMatchingBikes == "matching") listMatchingBicyclesByLogin($login, $language);

        } else echo "You are not an admin, sorry!";
    } else echo "session cookie 'user' not set!";