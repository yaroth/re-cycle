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
            $adminUser = User::getUserByLogin($login);
            /*TODO: check if admin wants to delete his/her own account/user -> not allowed!*/
            if (isset($_POST["deleteUserID"])) {
                $deleteUserID = $_POST["deleteUserID"];
                $userToDelete = User::getUserByID($deleteUserID);
                $userName = $userToDelete->getUserFullName();
                if ($adminUser->id !== $userToDelete->id) {
                    Account::deleteAccountByLogin($userToDelete->login);
                    User::deleteUserByID($deleteUserID);
                    echo "Successfully deleted user '$userName'";
                } else echo "ERROR! You cannot delete yourself!";
            }
        } else echo "<h4><error>You are not an admin, sorry!</error></h4>";
    } else echo "<h4><error>session cookie 'user' not set!</error></h4>";