<?php
    echo '<div id="mobNavIcon">
            <div id="open"></div>
            <div id="close"></div>
        </div>';
    echo '<nav id="mobile" class="nav">';
    echo '<ul>';
    $language = getLang();
    $id = getId();
    navigation($language, $id);
    echo '</ul>';
    include 'langUserMobile.php';
    echo '</nav>';

