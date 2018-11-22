<?php
    $success = true;
    $login = $pw = '';
    if ($_POST) {
        $bikeArray = bikeArrayFromPost();
        $success = ($bikeArray !== false);
        echo '<div class="add-bike">';
        if (!$success) {
            echo '<h2>' . translate("error") . '</h2>';
            echo '<h3>' . translate("sorry") . '!</h3>';
            echo "<p>Something went wrong!</p>";
            exit;
        }
        if ($success) {
            $user = User::getUserByLogin($_SESSION["user"]);
            $bikeArray["ownerID"] = $user->id;
            $bicycle = Bicycle::withParams($bikeArray);
            $addedBikeToDB = Bicycle::addBikeToDB($bicycle);
            if ($addedBikeToDB) {
                echo '<h2>' . translate("success") . '</h2>';
                echo "<h3>Successfully added $bicycle to DB.</h3>";
            } else {
                echo '<h2>' . translate("error") . '</h2>';
                echo "<h3>Could NOT add bicycle to DB!</h3>";
            }
        }
        echo '</div>';
    } elseif (isset($_SESSION["user"])) {
        include 'bikeForm.php';
    } else {
        echo '<div class="add-bike">';
        echo '<h2>' . translate("sorry") . '</h2>';
        echo '<p>To add a bike you first need to <a href="index.php?lang=' . getLang() . '&id=2">login</a>!</p>';
        echo '</div>';
    }

