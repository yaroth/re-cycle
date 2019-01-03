<?php
    echo '<nav id="mobile" class="nav">';
    echo '<ul>';
    $language = getLang();
    $id = getId();
    navigation($language, $id);
    echo '</ul>';
    include 'langUser.php';
    echo '</nav>';

