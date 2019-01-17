<?php
    require_once ("../data/bikes.php");
    require_once ("functions.php");
    require_once("../db/autoloader.php");
    $bikes = Bicycle::getBicycles();
    $language = $_GET["language"];
    echo '<h4>'. translate("bicycles") .'</h4>';
    echo '<div class="bikesList">';
    foreach ($bikes as $bike) {
        echo
            '<div class="bike-wrapper">
                <div class="bike title"><desc>' . translate("title") . ': </desc><p>' . $bike->title . '</p></div>
                <div class="bike img"><img src="../img/uploads/' . $bike->imageName . '"></div>
                <div class="bike description"><desc>' . translate("description") . ': </desc><p>' . $bike->description . '</p></div>
                <div class="bike weight"><desc>' . translate("weight") . ': </desc>' . $bike->weight . '</div>
                <div class="bike lights"><desc>' . translate("has-lights") . ' : </desc>' . ($bike->hasLights ? translate("yes") : translate("no")) . '</div>
                <div class="bike gears"><desc>' . translate("has-gears") . ' : </desc>' . ($bike->hasGears ? translate("yes") : translate("no")) . '</div>
                <div class="bike price"><desc>' . translate("price") . ': </desc>' . $bike->price . '.-</div>
                <div class="bike gearType"><desc>' . translate("gear-type") . ': </desc>' . $bike->getGearTypeName() . '</div>
                <div class="bike nbGears"><desc>' . translate("speeds") . ': </desc>' . $bike->nbOfGears . '</div>
                <div class="bike brakeType"><desc>' . translate("brake-type") . ': </desc>' . $bike->getBrakeTypeName() . '</div>
                <div class="bike wheelSize"><desc>' . translate("wheel-size") . ': </desc>' . $bike->wheelSize . '</div>
                <div class="bike owner"><desc>' . translate("owner") . ': </desc>' . $bike->ownerID . '</div>
                <div class="bike id"><desc>ID: </desc>' . $bike->id . '</div>
                <button onclick="deleteBike(this);" name="deleteBike" type="button" value="' . $bike->id . '">' . translate("delete") . '</button>
                <button onclick="editBike(this);" name="editBike" type="button" value="' . $bike->id . '">' . translate("edit") . '</button>
            </div><!-- END bike-wrapper-->';
    }
    echo '</div>';
