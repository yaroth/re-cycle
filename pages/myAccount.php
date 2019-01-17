<div class="editAccount">
    <?php
        if (isset($_SESSION["user"])) {
            $login = $_SESSION["user"];
            if (isset($_POST["userID"])) {
                $userID = $_POST["userID"];
                $userArray = userArrayFromPost();
                // checks that user array returns a correct value!
                if ($userArray !== false) {
                    // id and login need to be added manually!
                    $userArray["id"] = $userID;
                    $userArray["login"] = $login; //thus, login is NOT changed!
                    $pw = strip_tags($_POST["pw"]);
                    $updatedUserInDB = false;
                    if (Account::checklogin($login, $pw)) {
                        $updatedUserInDB = User::updateUserInDB($userArray);
                    }
                    // TODO: update account login too (if needed!)
                    if ($updatedUserInDB) {
                        echo '<h3>' . translate("success") . '</h3>';
                        echo "<p>Successfully updated your personal data.</p>";
                    } else {
                        echo '<h3><error>' . translate("error") . '</error></h3>';
                        echo "<p><error>Could NOT update your personal data! Check your login and password!</error></p>";
                        include 'createAccountForm.php';
                    }
                } else {
                    echo '<h3>' . translate("error") . '</h3>';
                    // TODO: Fix error handling!
                    echo "<p>Could NOT update your personal data! (userArray is false)</p>";
                    include 'createAccountForm.php';
                }
            } else {
                $user = User::getUserByLogin($login);
                $user->setCookiesForUser();
                include 'createAccountForm.php';
            }
        } else {
            $lang = getLang();
            echo '<h3>' . translate("error") . '</h3>';
            echo '<p>' . translate("sorry") . ', to view your account data you first need to <a href="index.php?lang=' . $lang . '&id=2">login</a>!</p>';
        }
    ?>
</div>
