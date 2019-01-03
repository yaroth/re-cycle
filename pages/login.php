<h2><?php echo translate("login"); ?></h2>
<?php
    echo '<div class="login">';
    if (isset($_SESSION["user"])) {
        $redirect = "location:index.php?lang=" . getLang() . "&id=0";
        header($redirect);
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
                if (!$success) {
                    echo '<p><error>Login failed. Please try again.</error></p>';
                    include "loginForm.php";
                }
            }

        } else include "loginForm.php";
    }
    echo '</div>';

