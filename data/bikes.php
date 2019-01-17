<?php
    /**
     * Created by PhpStorm.
     * User: yann
     * Date: 12.10.18
     * Time: 10:30
     */

// TODO: NICE-TO-HAVE: create a function to sort by different keys

    function listBicycles($lang) {
        $bikesToSell = Bicycle::getBicycles();
        usort($bikesToSell, function ($bike1, $bike2) {
            return $bike1->price <=> $bike2->price;
        });
        echo '<div class="items">';
        foreach ($bikesToSell as $bike) {
            listBike($bike, $lang);
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
        if ($bikesToSell == null) echo '<h4>'. translate("not-selling-bicycle") .'<a href="index.php?lang=' . getLang() . '&id=7">' . translate("sell-bicycle") .'?</a></h4>';
        else {
            usort($bikesToSell, function ($bike1, $bike2) {
                return $bike1->price <=> $bike2->price;
            });
            foreach ($bikesToSell as $bike) {
                listEditableBike($bike);
            }
        }
    }

    function listBike($bike, $lang) {
        $language = $lang;
        $item = '<div class="item wrapper">
            <div class="title">
                <h3>' . $bike->title . '</h3>
                <p class="price">' . $bike->price . '.-</p>
            </div>
            <div class="image">
                <img src="../../img/uploads/' . $bike->imageName . '">
            </div>
            <div class="specs">
                <p>' . $bike->description . '</p>
                <p><desc>' . translate("gear-type") . ': </desc>' . translate($bike->getGearTypeName()) . '</p>
                <p><desc>' . translate("speeds") . ': </desc>' . $bike->nbOfGears . '</p>
                <p><desc>' . translate("brake-type") . ': </desc>' . translate($bike->getBrakeTypeName()) . '</p>
                <p><desc>' . translate("wheel-size") . ': </desc>' . $bike->wheelSize . '"</p>
                <p><desc>' . translate("has-lights") . ': </desc>' . ($bike->hasLights ? translate("yes") : translate("no")) . '</p>
                <p><desc>' . translate("has-gears") . ': </desc>' . ($bike->hasGears ? translate("yes") : translate("no")) . '</p>
                <p class="weight"><desc>' . translate("weight") . ': </desc>' . $bike->weight . ' kg</p>
                <p><desc>' . translate("owner") . ': </desc>' . $bike->getOwnerName() . '</p>
            </div>';
        if (isset($_SESSION["user"])) {
            $item .= '<div class="buy">
                        <button type="button" name="buyBike" onclick="buyBike(this);" value="' . $bike->id . '">' . translate("buy") . '</button>
                    </div>';
        }
        $item .= '</div>';
        echo $item;
    }

    function listEditableBike($bike) {
        $language = $_GET["lang"];
        $item = '<div class="item wrapper">
            <div class="title">
                <h3>' . $bike->title . '</h3>
                <p class="price">' . $bike->price . '.-</p>
            </div>
            <div class="image">
                <img src="../../img/uploads/' . $bike->imageName . '">
            </div>
            <div class="specs">
                <p>' . $bike->description . '</p>
                <p><desc>' . translate("gear-type") . ': </desc>' . translate($bike->getGearTypeName()) . '</p>
                <p><desc>' . translate("speeds") . ': </desc>' . $bike->nbOfGears . '</p>
                <p><desc>' . translate("brake-type") . ': </desc>' . translate($bike->getBrakeTypeName()) . '</p>
                <p><desc>' . translate("wheel-size") . ': </desc>' . $bike->wheelSize . '"</p>
                <p><desc>' . translate("has-lights") . ': </desc>' . ($bike->hasLights ? translate("yes") : translate("no")) . '</p>
                <p><desc>' . translate("has-gears") . ': </desc>' . ($bike->hasGears ? translate("yes") : translate("no")) . '</p>
                <p class="weight"><desc>' . translate("weight") . ': </desc>' . $bike->weight . ' kg</p>
                <p><desc>' . translate("owner") . ': </desc>' . $bike->getOwnerName() . '</p>
            </div>
            <div class="edit">
                <form action="" method="post" >
                <input type="hidden" name="bikeID" value="' . $bike->id . '" required><br>
                <button type="submit" name="action" value="deleteBike">' . translate("delete") . '</button>
                <button type="submit" name="action" value="editBike">' . translate("edit") . '</button>
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

    function listMatchingBicyclesByLogin($userLogin, $lang) {
        $userID = User::getUserIDByLogin($userLogin);
        $queries = Query::getQueriesByUserID($userID);
        if ($queries == null) echo '<h4>' . translate("no-query-defined") . '<a href="index.php?lang=' . getLang() . '&id=8">' . translate("add-query") . '?</a></h4>';
        else {
            foreach ($queries as $query) {
                $matchingBikes = Matching::getMatchingBikesByQuery($query);
                echo "<div class='query'><h4>" . translate("query") .": '$query->title'</h4>";
                if ($matchingBikes == null) {
                    echo "<div class='no-match'>" . translate("no-matching-bike-found") ."</div></div>";
                } else {
                    echo "</div><!--END query-->";
                    echo '<div class="items">';
                    foreach ($matchingBikes as $bike) {
                        listBike($bike, $lang);
                    }
                    echo "</div><!--END items-->";
                }
            }
        }

    }
