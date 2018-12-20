<h2><?php echo translate("login"); ?></h2>
<?php
    echo '<div class="login">';
    if (isset($_SESSION["user"])) {
        $login = $_SESSION["user"];
        $user = User::getUserByLogin($login);
        echo "<p>You are already logged in $user->fname $user->lname!</p>";
        echo '<p> Do you want to <a href="logout.php">logout?</a>';
        echo '<p> <a href="index.php?lang=' . getLang() . '&id=0">View my matchings </a>';
    } else {
        if ($_POST) {
            $success = true;
            $login = $pw = '';

            if (empty(strip_tags($_POST['login']))) {
                $success = false;
            } else $login = strip_tags($_POST['login']);

            if (empty(strip_tags($_POST['pw']))) {
                $success = false;
            } else $pw = strip_tags($_POST['pw']);

            // TODO: add form 'isAdmin' ????

            if (!$success) {
                echo "<p>Something went wrong!</p>";
                exit;
            }
            if ($success) {
                include_once "authentication.inc.php";
                echo "<p>Login for '$login' successful!</p>";
                echo '<p> Do you want to <a href="logout.php?lang=' . getLang() . '">logout?</a>';
            }

        } else include "loginForm.php";
    }
    echo '</div>';

