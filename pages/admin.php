<?php
    /**
     * Created by PhpStorm.
     * User: yann
     * Date: 11.11.18
     * Time: 12:58
     */
    if (isset($_SESSION["user"])) {
        $login = $_SESSION["user"];
        $account = Account::getAccountByLogin($login);
        if ($account->isAdminAccount()){
            echo "<h3>Welcome admin!</h3>";
            echo "<div id=admin-content></div>";
            include "adminChoice.php";
        }
        else echo "You are not an admin, sorry!";
    }