<?php
    /**
     * Called using AJAX
     */
    require_once("../db/autoloader.php");
    session_start();
    if (isset($_SESSION["user"])) {
        $userLogin = $_SESSION["user"];
        $userID = User::getUserIDByLogin($userLogin);
        $title = $_POST["title"];
        $weight = $_POST["weight"] ?? null;
        $price = $_POST["price"] ?? null;
        $hasLights = $_POST["hasLights"] ?? null;
        $hasGears = $_POST["hasGears"] ?? null;
        $gearTypeID = $_POST["gearTypeID"] ?? null;
        $nbOfGears = $_POST["nbOfGears"] ?? null;
        $wheelSize = $_POST["wheelSize"] ?? null;
        $brakeTypeID = $_POST["brakeTypeID"] ?? null;

        // will escape all the necessary properties > save to use!
        $query = new Query();
        $query->setProperties($title, $weight, $price, $hasLights, $hasGears, $gearTypeID, $nbOfGears, $wheelSize, $brakeTypeID, $userID);
        $addQuerySuccess = Query::addQueryToDB($query);
        if ($addQuerySuccess) echo "Successfully added query!";
        else echo "ERROR. Could not add query!";

    } else echo "session cookie 'user' not set!";