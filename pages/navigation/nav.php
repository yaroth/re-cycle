<?php
    echo '<div class="nav">';
    echo '<p>main navigation</p>';
    echo '<ul>';
    if (!isset($_GET["lang"]))
        $language = 'de';
    else $language = $_GET["lang"];
    if (!isset($_GET["id"]))
        $id = 0;
    else $id = $_GET["id"];
    navigation($language, $id);
    echo '</ul>';

    echo '<ul>';
    languages($language, $id);
    echo '</ul>';
    echo '</div>';

