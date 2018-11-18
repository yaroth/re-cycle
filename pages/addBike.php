<?php
    $success = true;
    $login = $pw = '';
    if ($_POST) {
        echo '<div class="add-bike">';
        $bikeArray = array();
        if (empty(strip_tags($_POST['title']))) {
            $success = false;
        } else {
            $title = strip_tags($_POST['title']);
            $_COOKIE['title'] = $title;
            $bikeArray['title'] = $title;
        }
        if (empty(strip_tags($_POST['description']))) {
            $success = false;
        } else {
            $description = strip_tags($_POST['description']);
            $_COOKIE['description'] = $description;
            $bikeArray['description'] = $description;
        }
        if (empty(strip_tags($_POST['weight']))) {
            $success = false;
        } else {
            $weight = strip_tags($_POST['weight']);
            $_COOKIE['weight'] = $weight;
            $bikeArray['weight'] = $weight;
        }
        if (empty(strip_tags($_POST['price']))) {
            $success = false;
        } else {
            $price = strip_tags($_POST['price']);
            $_COOKIE['price'] = $price;
            $bikeArray['price'] = $price;
        }
        if (empty(strip_tags($_POST['hasLights']))) {
            $success = false;
        } else {
            $hasLights = strip_tags($_POST['hasLights']== 'no' ? '0':'1');
            $_COOKIE['hasLights'] = $hasLights;
            $bikeArray['hasLights'] = $hasLights;
        }
        if (empty(strip_tags($_POST['hasGears']))) {
            $success = false;
        } else {
            $hasGears = strip_tags($_POST['hasGears']== 'no' ? '0':'1');
            $_COOKIE['hasGears'] = $hasGears;
            $bikeArray['hasGears'] = $hasGears;
        }
        if (empty(strip_tags($_POST['gearType']))) {
            $success = false;
        } else {
            $gearType = strip_tags($_POST['gearType']);
            $_COOKIE['gearType'] = $gearType;
            $bikeArray['gearType'] = $gearType;
        }
        if (empty(strip_tags($_POST['nbOfGears']))) {
            $success = false;
        } else {
            $nbOfGears = strip_tags($_POST['nbOfGears']);
            $_COOKIE['nbOfGears'] = $nbOfGears;
            $bikeArray['nbOfGears'] = $nbOfGears;
        }
        if (empty(strip_tags($_POST['wheelSize']))) {
            $success = false;
        } else {
            $wheelSize = strip_tags($_POST['wheelSize']);
            $_COOKIE['wheelSize'] = $wheelSize;
            $bikeArray['wheelSize'] = $wheelSize;
        }
        if (empty(strip_tags($_POST['brakeType']))) {
            $success = false;
        } else {
            $brakeType = strip_tags($_POST['brakeType']);
            $_COOKIE['brakeType'] = $brakeType;
            $bikeArray['brakeType'] = $brakeType;
        }


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
    } else include 'bikeForm.php';

