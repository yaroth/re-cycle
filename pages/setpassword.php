<?php
    $success = true;
    $login = $pw = '';
    if ($_POST) {
        echo '<div class="account">';

        if (empty(strip_tags($_POST['login']))) {
            $success = false;
        } else $login = strip_tags($_POST['login']);

        if (empty(strip_tags($_POST['pw']))) {
            $success = false;
        } else $pw = strip_tags($_POST['pw']);

        if (!$success) {
            echo '<h2>' . translate("error") . '</h2>';
            echo '<h3>' . translate("sorry") . " " . $fname . " " . $lname . '!</h3>';
            echo "<p>Could not add $user->fname $user->lname to DB! </p>";
            exit;
        }
        if ($success) {
            $user = User::getUserByLogin($login);
            if (isset($user)){
                $account = new Account();
                $account->setProperties($login, password_hash($pw, PASSWORD_BCRYPT), 0);
                $addedAccountToDB = Account::addAccountToDB($account);
                if ($addedAccountToDB){
                    echo "<h3>Successfully added $login to DB.</h3>";
                }
                else echo "<h3>Login $login already exists. Please choose another login!</h3>";
            }
        }

        /*$userToDeleteID = 50;
        $deleteSuccess = User::deleteUserWithID($userToDeleteID);
        if ($deleteSuccess) echo "<p>yes!</p>";
        else echo "<p>no!</p>";
        $userID = 51;
        $someUser = User::getUserByID($userID);
        $someUser->updateUserInDB($someUser);*/

        echo '</div>';
    } else include 'setPasswordForm.php';

