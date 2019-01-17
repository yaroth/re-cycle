<?php
    $success = true;
    $login = $pw = '';
    if ($_POST) {
        $userArray = userArrayFromPost();
        echo '<div class="account">';
        if ($userArray !== false) {
            $account = new Account();
            $login = $_POST["login"];
            $pw = $_POST["pw"];
            $account->setProperties($login, $pw, 0);
            if (empty($account->login)) $addedAccountToDB = false;
            else $addedAccountToDB = Account::addAccountToDB($account);
            if ($addedAccountToDB) {
                $user = User::withParams($userArray);
                $addedUserToDB = USER::addUserToDB($user);
                if ($addedUserToDB) {
                    echo '<h3>' . translate("success") . '</h3>';
                    echo '<h3>' . translate("welcome") . " " . $user->fname . " " . $user->lname . '!</h3>';
                    include_once "authentication.inc.php";
                    echo '<p> Do you want to <a href="logout.php?lang=' . getLang() . '">logout?</a>';
                } else {
                    echo '<h3>' . translate("error") . '</h3>';
                    echo "<p>Could NOT add user to DB!</p>";
                }
            } else {
                echo '<h3>' . translate("error") . '</h3>';
                echo "<p>Either 'login' is empty or login $login already exists. Please choose another login!</p>";
                include 'createAccountForm.php';
            }
        } else {
            echo '<h3>' . translate("error") . '</h3>';
            echo '<h3>' . translate("sorry") . " " . $user->fname . " " . $user->lname . '!</h3>';
            echo "<p>Could not add $user->fname $user->lname to DB! </p>";
        }
        echo '</div>';
    } elseif (isset($_SESSION["user"])) {
        $login = $_SESSION["user"];
        $user = User::getUserByLogin($login);
        echo '<div class="account">';
        echo '<h3>' . translate("sorry") . '</h3>';
        echo '<p>Dear' . " " . $user->fname . " " . $user->lname . ',</p>';
        echo '<p> You cannot create an account if logged in. Please <a href="logout.php?lang=' . getLang() . '">logout</a>!</p>';
        echo '</div>';
    } else
        include 'createAccountForm.php';

