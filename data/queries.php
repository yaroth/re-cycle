<?php
    /**
     * Created by PhpStorm.
     * User: yann
     * Date: 12.10.18
     * Time: 10:30
     */


// TODO: NICE-TO-HAVE: create a function to sort by different keys

    function listQueries() {
        $queries = Query::getQueries();
        foreach ($queries as $query) {
            listQuery($query);
        }
    }

    function listQueriesByUserID($userID) {
        $userQueries = Query::getQueriesByUserID($userID);
        foreach ($userQueries as $query) {
            listEditableQuery($query);
        }
    }

    function listQuery($query) {
        $item = '<div class="query wrapper">
            <div class="title">
            <h3>' . $query->title . '</h3>
            <p class="price">' . $query->price . '.-</p>
            <p class="weight">Weight: ' . $query->weight . ' kg</p>
            </div>
            <div class="specs">
                <p>Gear type: ' . translate($query->getGearTypeName()) . '</p>
                <p>Speeds: ' . $query->nbOfGears . '</p>
                <p>Brakes: ' . translate($query->getBrakeTypeName()) . '</p>
                <p>Wheel size: ' . $query->wheelSize . '"</p>
                <p>Owner: ' . $query->getOwnerName() . '</p>
            </div>
            <div>  <a href="url">Buy Now</a> </div>
        </div>';
        echo $item;
    }

    function listEditableQuery($query) {
        $targetURL = add_param($_SERVER['PHP_SELF'], "lang", getLang());
        $targetURL = add_param($targetURL, "id", getId());
        // TODO: maybe remove the next line? Is GET necessary?
//        $targetURL = add_param($targetURL, "queryID", $query->id);
        $user = USER::getUserByID($query->userID);
        $item = '<div class="query-wrapper">
                    <div class="query title"><p>' . $query->title . '</p></div>
                    <div class="query weight"><desc>Max. weight:</desc> ' . $query->weight . '</div>
                    <div class="query price"><desc>Max. price:</desc> ' . $query->price . '.-</div>
                    <div class="query hasLights"><desc>Has lights?</desc> ' . ($query->hasLights ? "yes" : ($query->hasLights === null ? "N/A" : "no")) . '</div>
                    <div class="query hasGears"><desc>Has gears?</desc> ' . ($query->hasGears ? "yes" : ($query->hasGears === null ? "N/A" : "no")) . '</div>
                    <div class="query gearType"><desc>Required gear type:</desc> ' . $query->getGearTypeName() . '</div>
                    <div class="query nbOfGears"><desc>Min. # gears:</desc> ' . $query->nbOfGears . '</div>
                    <div class="query wheelSize"><desc>Required wheel size:</desc> ' . $query->wheelSize . '</div>
                    <div class="query brakeType"><desc>Required brake type:</desc> ' . $query->getBrakeTypeName() . '</div>
                    <div class="query owner"><desc>Query owner:</desc> ' . $user->getUserFullName() . '</div>
                    <div class="query id"><desc>ID:</desc> ' . $query->id . '</div>
                    <div class="query edit">
                        <form action="' . $targetURL . '" method="post" >
                            <input type="hidden" name="queryID" value="' . $query->id . '" required>
                            <button type="submit" name="action" value="editQuery">Edit</button>
                            <button type="submit" name="action" value="deleteQuery">Delete</button>
                        </form>
                    </div>
                </div>';
        echo $item;

    }

    function listQueryByID($queryID) {
        $query = Query::getQueryByID($queryID);
        if ($query !== null) {
            $query->setCookiesForQuery();
//            include '../pages/adminQueryForm.php';
            include '../pages/queryForm.php';
        }
    }


