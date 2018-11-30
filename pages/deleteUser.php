<?php
    /**
     * Created by PhpStorm.
     * User: yann
     * Date: 11.11.18
     * Time: 12:58
     */
    require_once("../db/autoloader.php");
    session_start();
    if (isset($_SESSION["user"])) {
        $login = $_SESSION["user"];
        $account = Account::getAccountByLogin($login);
        if ($account->isAdminAccount()){
            if (isset($_POST["deleteUser"])){
                $deleteUserID = $_POST["deleteUser"];
                $userToDelete = User::getUserByID($deleteUserID);
                Account::deleteAccountByLogin($userToDelete->login);
                User::deleteUserByID($deleteUserID);
            }
        }
        else echo "You are not an admin, sorry!";
    }
    else echo "session cookie not set!";