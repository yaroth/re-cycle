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
            if (isset($_POST["userID"]) && isset($_POST["fname"]) &&
                isset($_POST["lname"]) && isset($_POST["email"]) &&
                isset($_POST["dob"]) && isset($_POST["genderID"])) {
                $userID = $_POST["userID"];
                $user = User::getUserByID($userID);
                $fname = $_POST["fname"];
                $lname = $_POST["lname"];
                $email = $_POST["email"];
                $dob = $_POST["dob"];
                $genderID = $_POST["genderID"];
                // will escape all the necessary properties > save!
                $user->setProperties($fname, $lname, $user->login, $dob, $email, $genderID);
                $userUpdatedSuccess = $user->saveUserInDB();
                if ($userUpdatedSuccess) {
                    $userName = $user->getUserFullName();
                    echo "Successfully updated user '$userName'";
                } else echo "ERROR! Could not update user with ID '$userID'";
            }
        } else echo "ERROR! You are not an admin, sorry!";
    } else echo "session cookie 'user' not set!";