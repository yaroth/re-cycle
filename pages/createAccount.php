<?php
    $success = true;
    $fname = $lname = $login = $pw = '';
    if ($_POST) {
        echo '<div class="account">';

        if (empty(strip_tags($_POST['fname']))) {
            $success = false;
        } else $fname = strip_tags($_POST['fname']);

        if (empty(strip_tags($_POST['lname']))) {
            $success = false;
        } else $lname = strip_tags($_POST['lname']);

        if (empty(strip_tags($_POST['login']))) {
            $success = false;
        } else $login = strip_tags($_POST['login']);

        if (empty(strip_tags($_POST['pw']))) {
            $success = false;
        } else $pw = strip_tags($_POST['pw']);

        if (!$success) {
            echo "<p>Something went wrong!</p>";
            exit;
        }
        if ($success) {

            $user = new User();
            $user->setProperties($fname, $lname, "1968-12-04", "test@user.ch", 2);
            $addedToDB = USER::addUserToDB($user);
            if ($addedToDB) {
                echo '<h2>' . translate("success") . '</h2>';
                echo '<h3>' . translate("welcome") . " " . $fname . " " . $lname . '!</h3>';
                echo "<p> Successfully added $user->fname $user->lname to DB! </p>";

                $account = new Account();
                $account->setProperties($login, password_hash($pw, PASSWORD_BCRYPT), 0);
                Account::addAccountToDB($account);
            }
        } else {
            echo '<h2>' . translate("error") . '</h2>';
            echo '<h3>' . translate("sorry") . " " . $fname . " " . $lname . '!</h3>';
            echo "<p>Could not add $user->fname $user->lname to DB! </p>";
        }
        /*$userToDeleteID = 50;
        $deleteSuccess = User::deleteUserWithID($userToDeleteID);
        if ($deleteSuccess) echo "<p>yes!</p>";
        else echo "<p>no!</p>";
        $userID = 51;
        $someUser = User::getUserWithID($userID);
        $someUser->updateUserInDB($someUser);*/

        echo '</div>';
    } else include 'createAccountForm.php';

