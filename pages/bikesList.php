<?php
    require_once ("../data/bikes.php");
    require_once ("functions.php");
    require_once("../db/autoloader.php");
    $bikes = Bicycle::getBicycles();
    echo '<h4>Bicycles list</h4>';
    echo '<div class="bikesList">';
    foreach ($bikes as $bike) {
        // TODO: add image!
        echo
            '<div class="bike-wrapper">
                <div class="bike title"><desc>Title: </desc><p>' . $bike->title . '</p></div>
                <div class="bike img"><img src="../img/uploads/' . $bike->imageName . '"></div>
                <div class="bike description"><desc>Description: </desc><p>' . $bike->description . '</p></div>
                <div class="bike weight"><desc>Weight: </desc>' . $bike->weight . '</div>
                <div class="bike lights"><desc>Has lights? : </desc>' . ($bike->hasLights ? "yes" : "no") . '</div>
                <div class="bike gears"><desc>Has gears? : </desc>' . ($bike->hasGears ? "yes" : "no") . '</div>
                <div class="bike price"><desc>Price: </desc>' . $bike->price . '.-</div>
                <div class="bike gearType"><desc>Gear type: </desc>' . $bike->getGearTypeName() . '</div>
                <div class="bike nbGears"><desc># gears: </desc>' . $bike->nbOfGears . '</div>
                <div class="bike brakeType"><desc>Brake type: </desc>' . $bike->getBrakeTypeName() . '</div>
                <div class="bike wheelSize"><desc>Wheel size: </desc>' . $bike->wheelSize . '</div>
                <div class="bike owner"><desc>Owner: </desc>' . $bike->ownerID . '</div>
                <div class="bike id"><desc>ID: </desc>' . $bike->id . '</div>
                <button onclick="deleteBike(this);" name="deleteBike" type="button" value="' . $bike->id . '">Delete</button>
                <button onclick="editBike(this);" name="editBike" type="button" value="' . $bike->id . '">Edit</button>
            </div><!-- END bike-wrapper-->';
    }
    echo '</div>';
