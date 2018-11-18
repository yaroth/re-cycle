<?php
    /**
     * Created by PhpStorm.
     * User: yann
     * Date: 12.10.18
     * Time: 10:30
     */


// TODO: NICE-TO-HAVE: create a function to sort by different keys

    function listProducts() {
        $bikesToSell = Bicycle::getBicycles();
        usort($bikesToSell, function ($bike1, $bike2) {
            return $bike1->price <=> $bike2->price;
        });
        foreach ($bikesToSell as $bike) {
            listItem($bike);
        }
    }

    function listBikesByUser($user) {
        $bikesToSell = Bicycle::getBicyclesOfUser($user);
        usort($bikesToSell, function ($bike1, $bike2) {
            return $bike1->price <=> $bike2->price;
        });
        foreach ($bikesToSell as $bike) {
            listEditableBike($bike);
        }
    }

    function listItem($bike) {
        $item = '<div class="item wrapper">
            <div class="title">
            <h3>' . $bike->title . '</h3>
            <p class="price">' . $bike->price . '.-</p>
            <p class="weight">Weight: ' . $bike->weight . ' kg</p>
            </div>
            <div class="image">
                <a href="../functions.php">
                    <img src="../../img/logo.png">
                </a>
            </div>
            <div class="specs">
                <p>' . $bike->description . '</p>
                <p>Gear type: ' . translate($bike->getGearTypeName()) . '</p>
                <p>Speeds: ' . $bike->nbOfGears . '</p>
                <p>Brakes: ' . translate($bike->getBrakeTypeName()) . '</p>
                <p>Wheel size: ' . $bike->wheelSize . '"</p>
                <p>Owner: ' . $bike->getOwnerName() . '</p>
            </div>
            <div>  <a href="url">Buy Now</a> </div>
        </div>';
        echo $item;
    }

    function listEditableBike($bike) {
        $targetURL = add_param($_SERVER['PHP_SELF'], "lang", getLang());
        $targetURL = add_param($targetURL, "id", getId());
        $item = '<div class="item wrapper">
            <div class="title">
            <h3>' . $bike->title . '</h3>
            <p class="price">' . $bike->price . '.-</p>
            <p class="weight">Weight: ' . $bike->weight . ' kg</p>
            </div>
            <div class="image">
                <a href="../functions.php">
                    <img src="../../img/logo.png">
                </a>
            </div>
            <div class="specs">
                <p>' . $bike->description . '</p>
                <p>Gear type: ' . translate($bike->getGearTypeName()) . '</p>
                <p>Speeds: ' . $bike->nbOfGears . '</p>
                <p>Brakes: ' . translate($bike->getBrakeTypeName()) . '</p>
                <p>Wheel size: ' . $bike->wheelSize . '"</p>
                <p>Owner: ' . $bike->getOwnerName() . '</p>
            </div>
            <div class="edit">
                <form action="' . $targetURL . '" method="post" name="editBike" >
                <input type="hidden" name="bikeID" value="' . $bike->id . '" required><br>
                <input type="submit" value="Edit">
                </form>
            </div>
        </div>';
        echo $item;
    }
