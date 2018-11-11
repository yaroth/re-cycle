<?php
    $targetURL = add_param($_SERVER['PHP_SELF'], "lang", getLang());
    $targetURL = add_param($targetURL, "id", getId());
?>

    <h2><?php echo translate("login"); ?></h2>
<?php
    if ($_POST) {
        $success = true;
        $fname = $lname = $login = $pw = '';
        echo '<div class="login">';

        if (empty(strip_tags($_POST['login']))) {
            $success = false;
        } else $login = strip_tags($_POST['login']);

        if (empty(strip_tags($_POST['pw']))) {
            $success = false;
        } else $pw = strip_tags($_POST['pw']);

        // add form 'isAdmin'

        if (!$success) {
            echo "<p>Something went wrong!</p>";
            exit;
        }
        if ($success) {
            include_once "authentication.inc.php";
            }
        } else {
            echo '<h2>' . translate("error") . '</h2>';
            echo '<h3>' . translate("sorry") . " " . $fname . " " . $lname . '!</h3>';
            echo "<p>Could not add $user->fname $user->lname to DB! </p>";
        }

        echo '</div>';
    } else include "loginForm.php";

