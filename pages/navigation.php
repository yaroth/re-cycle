<?php
    echo '<nav id="desktop" class="nav">';
        echo '<ul>';
            $language = getLang();
            $id = getId();
            navigation($language, $id);
        echo '</ul>';
    echo '</nav>';

