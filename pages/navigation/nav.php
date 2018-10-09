<?php
$array = array("home", "contacts", "about");
echo '<ul>';
foreach ($array as $key => $value) {
    echo '<li><a href="' . $value . '.php">' . $value . '</a></li>';
}
echo '</ul>';
?>
