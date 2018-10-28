<?php
    echo '<div class="nav">';
    echo '<ul>';
    $language = getLang();
    $id = getId();
    navigation($language, $id);
    echo '</ul>';

    echo '<ul>';
    languages($language, $id);
    echo '</ul>';
    include 'userInfo.php';
    echo '</div>';

