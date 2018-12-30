<?php
    /**
     * Called using AJAX
     */
    require_once("../db/autoloader.php");
    session_start();
    if (isset($_SESSION["user"])) {
        $userLogin = $_SESSION["user"];
        $account = Account::getAccountByLogin($userLogin);
        if ($account->isAdminAccount()) {
            $queryID = $_POST["queryID"];
            $query = Query::getQueryByID($queryID);

            if ($query !== false) {
                $title = $_POST["title"];
                $weight = $_POST["weight"];
                $price = $_POST["price"];
                $hasLights = $_POST["hasLights"];
                $hasGears = $_POST["hasGears"];
                $gearTypeID = $_POST["gearTypeID"];
                $nbOfGears = $_POST["nbOfGears"];
                $wheelSize = $_POST["wheelSize"];
                $brakeTypeID = $_POST["brakeTypeID"];
                $userID = $_POST["userID"];
                // will escape all the necessary properties > save to use!
                $query->setProperties($title, $weight, $price, $hasLights, $hasGears, $gearTypeID, $nbOfGears, $wheelSize, $brakeTypeID, $userID);
                $queryUpdateSuccess = $query->saveQueryInDB();
            }


        } else echo "You are not an admin, sorry!";
    } else echo "session cookie 'user' not set!";