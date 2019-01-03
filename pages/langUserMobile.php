<?php
    echo '<hr><div class="meta">';
        echo '<div class="langs">';
            languages($language, $id);
        echo '</div>';
    if (isset($_SESSION["user"])) {
        $login = $_SESSION["user"];
        $user = User::getUserByLogin($login);
        echo '<hr><div class="detail"><p>' . $user->fname . " " . $user->lname . '</p>';
        echo '<p><a href="logout.php?lang='. getLang() .'">Logout</a></p></div>';
    }
    echo '</div>';

