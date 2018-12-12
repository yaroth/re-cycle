<?php
    /**
     * Called using AJAX
     */
    require_once("../db/autoloader.php");
    session_start();
    if (isset($_SESSION["user"])) {
        $login = $_SESSION["user"];
        $account = Account::getAccountByLogin($login);
        if ($account->isAdminAccount()){
            /*TODO: check if admin wants to delete his/her own account/user -> not allowed!*/
            if (isset($_POST["deleteUser"])){
                $deleteUserID = $_POST["deleteUser"];
                $userToDelete = User::getUserByID($deleteUserID);
                Account::deleteAccountByLogin($userToDelete->login);
                User::deleteUserByID($deleteUserID);
            }
        }
        else echo "You are not an admin, sorry!";
    }
    else echo "session cookie 'user' not set!";