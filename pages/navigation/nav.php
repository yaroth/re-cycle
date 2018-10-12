<?php
echo '<div class="nav">';
echo '<p>main navigation</p>';
echo '<ul>';
$fileNamesArray = glob("*.php");
foreach ($fileNamesArray as $file) {
    if (is_file($file)) {
//        $navName = file($file) -> $pageTitle;
        echo '<li><a href="' . $file . '">' . basename($file, '.php'). '</a></li>';
    }
}
echo '</ul>';
echo '</div>';

