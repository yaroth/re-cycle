<?php
    require_once ("functions.php");
    require_once("../db/autoloader.php");
    echo '<div class="accountsList">';
    foreach (Account::getAccounts() as $account) {
        echo $account . '<br>';
    }
    echo '</div>';
?>