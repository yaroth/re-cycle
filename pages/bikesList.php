<?php
    require_once ("../data/bikes.php");
    require_once ("functions.php");
    require_once("../db/autoloader.php");
    $bikes = Bicycle::getBicycles();
    echo '<h4>Bicycles list</h4>';
    echo '<div class="bikesList">';
    echo '<div class="bike-wrapper">
                <div class="bike id">ID</div>
                <div class="bike title">Title</div>
                <div class="bike description">Description</div>
                <div class="bike weight">Weight</div>
                <div class="bike lights">Has lights</div>
                <div class="bike price">Price</div>
                <div class="bike gearType">Gear type</div>
                <div class="bike nbGears">#gears</div>
                <div class="bike brakeType">Brake type</div>
                <div class="bike wheelSize">Wheel size</div>
                <div class="bike owner">Owner ID</div>
                <div class="buttonPlaceholder"></div>
                <div class="buttonPlaceholder"></div>
            </div>';
    foreach ($bikes as $bike) {
        // TODO: add image!
        echo
            '<div class="bike-wrapper">
                <div class="bike id">' . $bike->id . '</div>
                <div class="bike title">' . $bike->title . '</div>
                <div class="bike description">' . $bike->description . '</div>
                <div class="bike weight">' . $bike->weight . '</div>
                <div class="bike lights">' . ($bike->hasLights ? "yes" : "no") . '</div>
                <div class="bike price">' . $bike->price . '.-</div>
                <div class="bike gearType">' . $bike->getGearTypeName() . '</div>
                <div class="bike nbGears">' . $bike->nbOfGears . '</div>
                <div class="bike brakeType">' . $bike->getBrakeTypeName() . '</div>
                <div class="bike wheelSize">' . $bike->wheelSize . '</div>
                <div class="bike owner">' . $bike->ownerID . '</div>
                <button onclick="deleteBike(this);" name="deleteBike" type="button" value="' . $bike->id . '">Delete</button>
                <button onclick="editBike(this);" name="editBike" type="button" value="' . $bike->id . '">Edit</button>
            </div><!-- END bike-wrapper-->';
    }
    echo '</div>';
