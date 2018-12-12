<?php
    /**
     * TODO: delete when done with project
     */

    echo '<h2>' . translate("protected") . '</h2>';
    if (isset($_SESSION["user"])) {
        echo '<h3>Welcome ' . $_SESSION["user"] . '!</h3>';
    } else echo "Please log in!";
