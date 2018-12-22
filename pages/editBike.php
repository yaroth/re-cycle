<?php
    /**
     * Called using AJAX
     */
    require_once("../db/autoloader.php");
    require_once("functions.php");
    session_start();
    if (isset($_SESSION["user"])) {
        $login = $_SESSION["user"];
        $account = Account::getAccountByLogin($login);
        if ($account->isAdminAccount()) {
            $bikeID = $_GET["bikeToEditID"];
            $bike = Bicycle::getBicycleByID($bikeID);
            $bike->setCookiesForBike();
            $language = getLang();
            include "editBikeForm.php";

        } else echo "You are not an admin, sorry!";
    } else echo "session cookie 'user' not set!";