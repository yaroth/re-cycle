<?php
echo '<div class="nav">';
echo '<p>main navigation</p>';
echo '<ul>';
$directory = __DIR__;
$parentDirectory = dirname($directory);
$files = scandir($parentDirectory);
$files = glob("*.php");
foreach ($files as $file) {
    if (is_file($file)) {
        echo '<li><a href="' . $file . '">' .basename($file, '.php') . '</a></li>';
    }
}
echo '</ul>';
echo '</div>';
?>

