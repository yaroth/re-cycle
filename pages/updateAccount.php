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
            /*TODO: ???*/
            if (isset($_POST["accountID"]) && isset($_POST["login"]) && isset($_POST["pw"]) && isset($_POST["admin"])) {
                $oldAccountID = $_POST["accountID"];
                $newLogin = $_POST["login"];
                $newPw = $_POST["pw"];
                $newAdmin = $_POST["admin"];
                $newAccount = Account::getAccountByID($oldAccountID);
                $userLoginToUpdate = $newAccount->login;
                $newAccount->setProperties($newLogin, $newPw, $newAdmin);
                if (!empty($newPw))$accountUpdateSuccess = $newAccount->updateAccountInDB($newAccount, true);
                elseif (empty($newPw))$accountUpdateSuccess = $newAccount->updateAccountInDB($newAccount, false);
                if ($accountUpdateSuccess) {
                    $userID = User::getUserIDByLogin($userLoginToUpdate);
                    $userLoginUpdated = User::updateUserLoginByIDInDB($newLogin, $userID);
                    echo "Success. Updated account with ID '$oldAccountID'";
                } else echo "ERROR. Could not update account with ID '$oldAccountID'";
            }
        } else echo "You are not an admin, sorry!";
    } else echo "session cookie 'user' not set!";