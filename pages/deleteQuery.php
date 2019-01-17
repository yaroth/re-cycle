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
            if (isset($_POST["deleteQueryID"])) {
                $deleteQueryID = $_POST["deleteQueryID"];
                $queryToDelete = Query::getQueryByID($deleteQueryID);
                if ($queryToDelete !== false) {
                    $queryDeletionSuccess = Query::deleteQueryByID($deleteQueryID);
                    if ($queryDeletionSuccess) echo "SUCCESS! Deleted query with ID '$deleteQueryID'";
                } else echo "ERROR! Could not delete query with ID '$deleteQueryID'. It does not exist!";
            }
        } else echo "You are not an admin, sorry!";
    } else echo "session cookie 'user' not set!";