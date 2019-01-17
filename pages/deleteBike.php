<?php
    /**
     * Called using AJAX
     */
    require_once("../db/autoloader.php");
    session_start();
    if (isset($_SESSION["user"])) {
        $login = $_SESSION["user"];
        $account = Account::getAccountByLogin($login);
        if ($account->isAdminAccount()) {
            if (isset($_POST["deleteBikeID"])) {
                $deleteBikeID = $_POST["deleteBikeID"];
                $bikeToDelete = Bicycle::getBicycleByID($deleteBikeID);
                if ($bikeToDelete !== false) {
                    $bikeDeletionSuccess = Bicycle::deleteBikeByID($deleteBikeID);
                    if ($bikeDeletionSuccess) echo "Successfully deleted bicycle with '$deleteBikeID'";
                } else echo "ERROR: The bicycle you want to delete does not exist!";
            }
        } else echo "You are not an admin, sorry!";
    } else echo "session cookie 'user' not set!";