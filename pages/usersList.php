<?php
    require_once("../db/autoloader.php");
    require_once("functions.php");
    $users = User::getUsers();
    $language = $_GET["language"];
    echo '<h4>'. translate("users") . '</h4>';
    echo '<div class="usersList">';
    $language = $_GET["language"];
    foreach ($users as $user) {
        $user->render($language);
    }
    echo '</div>';
?>