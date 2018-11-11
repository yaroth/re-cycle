<?php
    /**
     * Created by PhpStorm.
     * User: yann
     * Date: 11.11.18
     * Time: 15:21
     */

    echo '<h2>' . translate("protected") . '</h2>';
    if (isset($_SESSION["user"])) {
        echo '<h3>Welcome ' . $_SESSION["user"] . '!</h3>';
    } else echo "Please log in!";
