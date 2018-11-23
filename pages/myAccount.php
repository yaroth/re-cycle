<h2><?php echo translate("editAccount"); ?></h2>
<div class="items">
    <?php
        if (isset($_SESSION["user"])) {
            $login = $_SESSION["user"];
            /*if (isset($_POST["userID"]) || isset($_GET["userID"])) {
                if (isset($_POST["userID"])) $userID = $_POST["userID"];
                elseif ((isset($_GET["userID"]))) $userID = $_GET["userID"];
                listUserByID($userID);

            } else*/
            if (isset($_POST["userID"])) {
                $userID = $_POST["userID"];
                $userArray = userArrayFromPost();
                // check that user array returns a correct value!
                if ($userArray !== false) {
                    $userArray["id"] = $userID;
                    $updatedUserInDB = User::updateUserInDB($userArray);
                    if ($updatedUserInDB) {
                        echo '<h2>' . translate("success") . '</h2>';
                        echo "<h3>Successfully updated your personal data.</h3>";
                    } else {
                        echo '<h2>' . translate("error") . '</h2>';
                        echo "<h3>Could NOT update your personal data!</h3>";
                        include 'createAccountForm.php';
                    }
                } else {
                    echo '<h2>' . translate("error") . '</h2>';
                    // TODO: Fix error handling!
                    echo "<h3>Could NOT update your personal data! (userArray is false)</h3>";
                    include 'createAccountForm.php';
                }
            } else {
                $user = User::getUserByLogin($login);
                $user->setCookiesForUser();
                include 'createAccountForm.php';
            }
        } else {
            $lang = getLang();
            echo '<h2>' . translate("error") . '</h2>';
            echo '<h3>' . translate("sorry") . ', to view your account data you first need to <a href="index.php?lang=' . $lang . '&id=2">login</a>!</h3>';
        }
    ?>
</div>
