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
        echo '<div class="query-wrapper">
                <div class="query id">ID</div>
                <div class="query title">Title</div>
                <div class="query price">Max. price [CHF]</div>
                <div class="query weight">Max. weight [kg]</div>
                <div class="query edit"></div>
            </div>';
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
        $userName = $user->getUserFullName();
        $item = '<div class="query-wrapper">
            <div class="query id">' . $query->id . '</div>
            <div class="query title">' . $query->title . '</div>
            <div class="query price">' . $query->price . '.- CHF</div>
            <div class="query weight">' . $query->weight . ' kg</div>
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
            include '../pages/queryForm.php';
        }
    }


