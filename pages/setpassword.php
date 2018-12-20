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

        if (empty(strip_tags($_POST['newpw1']))) {
            $success = false;
        } else $newpw1 = strip_tags($_POST['newpw1']);

        if (empty(strip_tags($_POST['newpw2']))) {
            $success = false;
        } else $newpw2 = strip_tags($_POST['newpw2']);

        if (!$success) {
            echo '<h2>' . translate("error") . '</h2>';
            echo '<h3>' . translate("sorry") . " " . $fname . " " . $lname . '!</h3>';
            echo "<p>Something went wrong! </p>";
            exit;
        } // TODO: check in form if passwords match
        elseif ($success) {
            if ($newpw1 != $newpw2) {
                echo '<h2>' . translate("error") . '</h2>';
                echo '<h3>Passwords do not match!</h3>';
                include 'setPasswordForm.php';
            } elseif (Account::checklogin($login, $pw)) {
                $account = Account::getAccountByLogin($login);
                $account->setProperties($login, $newpw1, $account->admin);
                $updatedAccountInDB = $account->updateAccountInDB($account, true);
                if ($updatedAccountInDB) echo "<h3>Successfully updated password of $login in DB.</h3>";
                else echo "<h3>Could NOT update password of $login. Please try again!</h3>";
            } else {
                echo 'Wrong password! Try again!<br>';
                include 'setPasswordForm.php';
            }
        }
        echo '</div>';
    } else if (isset($_SESSION["user"])) include 'setPasswordForm.php';
    else {
        $lang = getLang();
        echo '<div class="account">';
        echo '<h2>' . translate("error") . '</h2>';
        echo '<h3>' . translate("sorry") . ', to change your password you first need to <a href="index.php?lang=' . $lang . '&id=2">login</a>!</h3>';
        echo '</div>';
    }

