<?php
    /**
     * Created by PhpStorm.
     * User: yann
     * Date: 11.11.18
     * Time: 12:57
     */
    if (isset($_POST["login"]) && isset($_POST["pw"])) {
        $login = strip_tags($_POST["login"]);
        $pw = strip_tags($_POST["pw"]);
        if (checklogin($login, $pw))
            $_SESSION["user"] = $login;
    }
    if (!isset($_SESSION["user"])) {
        $lang = getLang();
        echo '<a href="index.php?lang=' . $lang . '&id=2">Log in</a>.';
        exit;
    }