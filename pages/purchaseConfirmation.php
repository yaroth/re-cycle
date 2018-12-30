<?php
    /**
     * Called using AJAX
     */
    require_once("../db/autoloader.php");
    require_once("functions.php");
    session_start();
    if (isset($_SESSION["user"])) {
        $login = $_SESSION["user"];
        $buyer = User::getUserByLogin($login);
        $buyerID = $buyer->id;
        if (isset($_POST["bikeID"])) {
            $bikeID = $_POST["bikeID"];
            $bike = Bicycle::getBicycleByID($bikeID);
            $sellerID = $bike->ownerID;
            $seller = User::getUserByID($sellerID);
            if ($sellerID != $buyerID) {
                echo "Seller '" . $seller->getUserFullName() . "' sells bicycle '" . $bike->title . "' to buyer '" . $buyer->getUserFullName() . "'.";
            } else echo "You cannot sell your bicycle to yourself! Sorry!";
        } else echo "No bike id set, sorry!";
    } else echo "session cookie 'user' not set!";