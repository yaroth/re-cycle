<?php
    echo '<div class="nav">';
    echo '<p>main navigation</p>';
    echo '<ul>';
    $language = getLang();
    $id = getId();
    navigation($language, $id);
    echo '</ul>';

    echo '<ul>';
    languages($language, $id);
    echo '</ul>';
    echo '</div>';

