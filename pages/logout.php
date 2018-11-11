<?php
    /**
     * Created by PhpStorm.
     * User: yann
     * Date: 11.11.18
     * Time: 12:58
     */
    session_start();
    $_SESSION = [];
    setcookie(session_name(), '', 1);
    header("location:index.php");