<div class="userInfo">
    <?php
        if (isset($_SESSION["user"])) {
            $login = $_SESSION["user"];
            $user = User::getUserByLogin($login);
            echo '<div class="short">' . strtoupper($user->fname[0]) . strtoupper($user->lname[0]) . '</div>';
            echo '<div class="detail hidden"><p>' . $user->fname . " " . $user->lname . '</p>';
            echo '<p><a href="logout.php?lang='. getLang() .'">Logout</a></p></div>';
        } else {
            $lang = getLang();
            echo '<a href="index.php?lang=' . $lang . '&id=2">Login</a>';
        }
    ?>

</div>