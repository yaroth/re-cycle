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
            if (isset($_POST["deleteQueryID"])){
                $deleteQueryID = $_POST["deleteQueryID"];
                $queryToDelete = Query::getQueryByID($deleteQueryID);
                if ($queryToDelete !== false) return $queryDeletionSuccess = Query::deleteQueryByID($deleteQueryID);
                else return false;
            }
        }
        else echo "You are not an admin, sorry!";
    }
    else echo "session cookie 'user' not set!";