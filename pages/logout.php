<?php
    /**
     * Created by PhpStorm.
     * User: yann
     * Date: 11.11.18
     * Time: 12:58
     */
    include_once "functions.php";
    session_start();
    $_SESSION = [];
    // set cookie to null after 1 second := logout!
    setcookie(session_name(), '', 1);
    $redirect = "location:index.php?lang=" . getLang() . "&id=0";
    header($redirect);