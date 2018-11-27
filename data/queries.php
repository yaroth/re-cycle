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
        $targetURL = add_param($targetURL, "queryID", $query->id);
        $user = USER::getUserByID($query->userID);
        $userName = $user->getUserFullName();
        $item = '<div class="query wrapper">
            <div class="item title">' . $query->title . '</div>
            <div class="item price">' . $query->price . '.-</div>
            <div class="item weight">Weight: ' . $query->weight . ' kg</div>
            <div class="item user">Owner: ' . $userName . '</div>
            <div class="item edit">
                <form action="' . $targetURL . '" method="post" name="editQuery" >
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


