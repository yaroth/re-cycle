<?php
    $success = true;
    $login = $pw = '';
    if ($_POST) {
        echo '<div class="account">';
        $postVar = ["address", "zip", "city", "country", "phone", "email", "dob", "gender"];
        for ($i = 0; $i < count($postVar); $i++) {
            if (empty(strip_tags($_POST[$postVar[$i]]))) {
                $success = false;
            } else {
                $tempVar = strip_tags($_POST[$postVar[$i]]);
                $_COOKIE[$postVar[$i]] = $tempVar;
            }
        }

        if (empty(strip_tags($_POST['fname']))) {
            $success = false;
        } else {
            $fname = strip_tags($_POST['fname']);
            $_COOKIE['fname'] = $fname;
        }

        if (empty(strip_tags($_POST['lname']))) {
            $success = false;
        } else {
            $lname = strip_tags($_POST['lname']);
            $_COOKIE['lname'] = $lname;
        }

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
            $account->setProperties($login, $pw, 0);
            if (empty($account->login)) $addedAccountToDB = false;
            else $addedAccountToDB = Account::addAccountToDB($account);
            if ($addedAccountToDB) {
                $user->setProperties($fname, $lname, $login, $_COOKIE["dob"], $_COOKIE["email"], $_COOKIE["gender"]);
                $addedUserToDB = USER::addUserToDB($user);
                if ($addedUserToDB) {
                    echo '<h2>' . translate("success") . '</h2>';
                    echo '<h3>' . translate("welcome") . " " . $fname . " " . $lname . '!</h3>';
                    echo "<h3>Successfully added $login to DB.</h3>";
                } else {
                    echo '<h2>' . translate("error") . '</h2>';
                    echo "<h3>Could NOT add user to DB!</h3>";
                }
            } else {
                echo '<h2>' . translate("error") . '</h2>';
                echo "<h3>Login $login already exists. Please choose another login!</h3>";
                include 'createAccountForm.php';
            }


        } else {
            echo '<h2>' . translate("error") . '</h2>';
            echo '<h3>' . translate("sorry") . " " . $fname . " " . $lname . '!</h3>';
            echo "<p>Could not add $user->fname $user->lname to DB! </p>";
        }
        echo '</div>';
    } else include 'createAccountForm.php';

