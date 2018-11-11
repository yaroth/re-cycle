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

            $account = new Account();
            $account->setProperties($login, password_hash($pw, PASSWORD_BCRYPT), 0);
            $addedAccountToDB = Account::addAccountToDB($account);
            if ($addedAccountToDB) {
                $user = new User();
                $user->setProperties($fname, $lname, $login, "1968-12-04", "test@user.ch", 2);
                $addedToDB = USER::addUserToDB($user);
                if ($addedToDB) {
                    echo '<h2>' . translate("success") . '</h2>';
                    echo '<h3>' . translate("welcome") . " " . $fname . " " . $lname . '!</h3>';
                    echo "<h3>Successfully added $login to DB.</h3>";
                }
            } else echo "<h3>Login $login already exists. Please choose another login!</h3>";


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
        $someUser = User::getUserByID($userID);
        $someUser->updateUserInDB($someUser);*/
        foreach (Account::getAccounts() as $account) echo $account . '<br>';

        echo '</div>';
    } else include 'createAccountForm.php';

