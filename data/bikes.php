<?php
    /**
     * Created by PhpStorm.
     * User: yann
     * Date: 12.10.18
     * Time: 10:30
     */


// TODO: NICE-TO-HAVE: create a function to sort by different keys

    function listBicycles() {
        $bikesToSell = Bicycle::getBicycles();
        usort($bikesToSell, function ($bike1, $bike2) {
            return $bike1->price <=> $bike2->price;
        });
        foreach ($bikesToSell as $bike) {
            listBike($bike);
        }
    }

    function listEditableBicycles() {
        $bikesToSell = Bicycle::getBicycles();
        usort($bikesToSell, function ($bike1, $bike2) {
            return $bike1->price <=> $bike2->price;
        });
        foreach ($bikesToSell as $bike) {
            listEditableBike($bike);
        }
    }

    function listBikesByUser($user) {
        $bikesToSell = Bicycle::getBicyclesByUser($user);
        usort($bikesToSell, function ($bike1, $bike2) {
            return $bike1->price <=> $bike2->price;
        });
        foreach ($bikesToSell as $bike) {
            listEditableBike($bike);
        }
    }

    // TODO: make sure 'buy' button will only call buyBike if user is logged in, elsewise inform user to log in or create account
    function listBike($bike) {
        $item = '<div class="item wrapper">
            <div class="title">
            <h3>' . $bike->title . '</h3>
            <p class="price">' . $bike->price . '.-</p>
            <p class="weight">Weight: ' . $bike->weight . ' kg</p>
            </div>
            <div class="image">
                <img src="../../img/uploads/' . $bike->imageName . '">
            </div>
            <div class="specs">
                <p>' . $bike->description . '</p>
                <p>Gear type: ' . translate($bike->getGearTypeName()) . '</p>
                <p>Speeds: ' . $bike->nbOfGears . '</p>
                <p>Brakes: ' . translate($bike->getBrakeTypeName()) . '</p>
                <p>Wheel size: ' . $bike->wheelSize . '"</p>
                <p>Has lights: ' . ($bike->hasLights ? "yes" : "no") . '"</p>
                <p>Has gears: ' . ($bike->hasGears ? "yes" : "no") . '"</p>
                <p>Owner: ' . $bike->getOwnerName() . '</p>
            </div>';
        if (isset($_SESSION["user"])) {
            $item .= '<div class="buy">
                <input type="hidden" name="title" value="' . $bike->title . '">
                <input type="hidden" name="price" value="' . $bike->price . '">
                <button type="button" name="buyBike" onclick="buyBike(this);" value="' . $bike->id . '">Buy!</button>
            </div>';
        }
        $item .= '</div>';
        echo $item;
    }

    function listEditableBike($bike) {
        $targetURL = add_param($_SERVER['PHP_SELF'], "lang", getLang());
        $targetURL = add_param($targetURL, "id", getId());
        // TODO: check if GET is needed here!
//        $targetURL = add_param($targetURL, "bikeID", $bike->id);
        // TODO: why is there a link in the image here???
        $item = '<div class="item wrapper">
            <div class="title">
            <h3>' . $bike->title . '</h3>
            <p class="price">' . $bike->price . '.-</p>
            <p class="weight">Weight: ' . $bike->weight . ' kg</p>
            </div>
            <div class="image">
                <img src="../../img/uploads/' . $bike->imageName . '">
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
                <form action="' . $targetURL . '" method="post" >
                <input type="hidden" name="bikeID" value="' . $bike->id . '" required><br>
                <button type="submit" name="action" value="editBike">Edit</button>
                <button type="submit" name="action" value="deleteBike">Delete</button>
                </form>
            </div>
        </div>';
        echo $item;
    }

    function listBikeByID($bikeID) {
        $bike = Bicycle::getBicycleByID($bikeID);
        if ($bike !== null) {
            $bike->setCookiesForBike();
            include '../pages/bikeForm.php';
        }
    }

    function listMatchingBicyclesByLogin($userLogin) {
        $userID = User::getUserIDByLogin($userLogin);
        $queries = Query::getQueriesByUserID($userID);
        foreach ($queries as $query) {
            $matchingBikes = Matching::getMatchingBikesByQuery($query);
            echo "<div><h4>Your query: </h4></div>";
            echo "<div>" . $query . '</div>';
            if ($matchingBikes == null) {
                echo "<div>Sorry, no matching bicycles found!";
            } else {
                foreach ($matchingBikes as $bike) {
                    listBike($bike);
                }
            }
        }

    }
