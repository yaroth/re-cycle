<?php
    echo '<div class="nav">';
    echo '<ul>';
        $language = getLang();
        $id = getId();
        navigation($language, $id);
    echo '</ul>';

    echo '</div>';

