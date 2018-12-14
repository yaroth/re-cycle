<?php
    require_once("functions.php");
    require_once("../db/autoloader.php");
    echo '<h4>Accounts list</h4>';
    echo '<div class="accountsList">';
    echo '<div class="account-wrapper">';
    echo '<div class="account id">ID </div>';
    echo '<div class="account login">Login</div>';
    echo '<div class="account pw">Password</div>';
    echo '<div class="account pw">Password confirm</div>';
    echo '<div class="account admin">Is admin</div>';
    echo '</div>';
    foreach (Account::getAccounts() as $account) {
        echo '<div class="account-wrapper">';
        echo '<form name="account' . $account->id . '" >';
        echo '<div class="account id">'. $account->id . '</div>';
        echo '<div class="account login">';
        echo '<input type="text" name="login" placeholder="new login..." value="' . $account->login . '" required>';
        echo '</div>';
        echo '<div class="account pw">';
        echo '<input type="password" name="pw1" placeholder="new password..." required>';
        echo '</div>';
        echo '<div class="account pw">';
        echo '<input type="password" name="pw2" placeholder="confirm password..." required>';
        echo '</div>';
        $checked = $account->admin ? "checked":"";
        echo '<div class="account admin">';
        echo '<input type="checkbox" name="isAdmin" ' . $checked . ' >admin';
        echo '</div>';
        echo '</form>';
        echo '<button onclick="saveAccount(this);" name="saveAccount" type="button" value="' . $account->id . '">Save</button>';
        echo '</div>';

    }
    echo '</div>';
?>