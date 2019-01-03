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
        echo '<div class="items">';
        foreach ($bikesToSell as $bike) {
            listBike($bike);
        }
        echo '</div>';
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
        if ($bikesToSell == null) echo 'You have no bicycle of your own defined, so: &nbsp<a href="index.php?lang=' . getLang() . '&id=7">add a new bicycle</a>';
        else {
            usort($bikesToSell, function ($bike1, $bike2) {
                return $bike1->price <=> $bike2->price;
            });
            foreach ($bikesToSell as $bike) {
                listEditableBike($bike);
            }
        }
    }

    function listBike($bike) {
        $item = '<div class="item wrapper">
            <div class="title">
            <h3>' . $bike->title . '</h3>
                <p>' . $bike->description . '</p>
                <p class="price">' . $bike->price . '.-</p>
            </div>
            <div class="image">
                <img src="../../img/uploads/' . $bike->imageName . '">
            </div>
            <div class="specs">
                <p>Gear type: ' . translate($bike->getGearTypeName()) . '</p>
                <p>Speeds: ' . $bike->nbOfGears . '</p>
                <p>Brakes: ' . translate($bike->getBrakeTypeName()) . '</p>
                <p>Wheel size: ' . $bike->wheelSize . '"</p>
                <p>Has lights: ' . ($bike->hasLights ? "yes" : "no") . '</p>
                <p>Has gears: ' . ($bike->hasGears ? "yes" : "no") . '</p>
                <p class="weight">Weight: ' . $bike->weight . ' kg</p>
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
            <p class="weight"><desc>Weight: </desc>' . $bike->weight . ' kg</p>
            </div>
            <div class="image">
                <img src="../../img/uploads/' . $bike->imageName . '">
            </div>
            <div class="specs">
                <p>' . $bike->description . '</p>
                <p><desc>Gear type: </desc>' . translate($bike->getGearTypeName()) . '</p>
                <p><desc>Speeds: </desc>' . $bike->nbOfGears . '</p>
                <p><desc>Brakes: </desc>' . translate($bike->getBrakeTypeName()) . '</p>
                <p><desc>Wheel size: </desc>' . $bike->wheelSize . '"</p>
                <p><desc>Owner: </desc>' . $bike->getOwnerName() . '</p>
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
        if ($queries == null) echo 'You have no query defined, so: <a href="index.php?lang=' . getLang() . '&id=8">add a new query</a>';
        else {
            foreach ($queries as $query) {
                $matchingBikes = Matching::getMatchingBikesByQuery($query);
                echo "<div class='query'><h4>Query: '$query->title'</h4>";
                if ($matchingBikes == null) {
                    echo "<div>Sorry, no matching bicycles found!</div></div>";
                } else {
                    echo "</div>";
                    echo '<div class="items">';
                    foreach ($matchingBikes as $bike) {
                        listBike($bike);
                    }
                    echo "</div><!--END class='items'-->";
                }
            }
        }

    }
