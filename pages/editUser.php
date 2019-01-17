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
            $userID = $_GET["userToEditID"];
            $user = User::getUserByID($userID);
            $user->setCookiesForUser();
            $language = $_GET["language"];
            include "editUserForm.php";

        } else echo "You are not an admin, sorry!";
    } else echo "session cookie 'user' not set!";