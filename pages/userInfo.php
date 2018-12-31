<div class="userInfo">
    <?php
        if (isset($_SESSION["user"])) {
            $login = $_SESSION["user"];
            $user = User::getUserByLogin($login);
            echo '<p>' . $user->fname . " " . $user->lname . '</p>';
            echo '<p><a href="logout.php?lang='. getLang() .'">Logout</a></p>';
        } else {
            $lang = getLang();
            echo '<a href="index.php?lang=' . $lang . '&id=2">Log in</a>.';
        }
    ?>

</div>