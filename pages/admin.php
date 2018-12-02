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
        $user = User::getUserByLogin($login);
        $userFullName = $user->getUserFullName();
        if ($account->isAdminAccount()){
            echo "<h3>Welcome $userFullName!</h3>";
            include "adminChoice.php";
            echo "<div id=admin-content></div>";
        }
        else echo "You are not an admin, sorry!";
    } else {
        $lang = getLang();
        echo 'You are not logged in, please do first <a href="index.php?lang=' . $lang . '&id=2">login</a>!';
    }