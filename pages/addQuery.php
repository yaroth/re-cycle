<?php
    require_once("../db/autoloader.php");
    require_once("functions.php");
    if (isset($_SESSION["user"])) {
        $login = $_SESSION["user"];
        $language = getLang();
        include "adminQueryForm.php";
    } else echo "session cookie 'user' not set!";