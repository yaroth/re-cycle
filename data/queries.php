<?php
    /**
     * Created by PhpStorm.
     * User: yann
     * Date: 12.10.18
     * Time: 10:30
     */


// TODO: NICE-TO-HAVE: create a function to sort by different keys

    // TODO: unused???
    /*function listQueries() {
        $queries = Query::getQueries();
        foreach ($queries as $query) {
            listQuery($query);
        }
    }*/

    /*function listQuery($query) {
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
    }*/

    function listQueriesByUserID($userID) {
        $userQueries = Query::getQueriesByUserID($userID);
        if ($userQueries == null) echo 'You have no query defined, so: &nbsp<a href="index.php?lang=' . getLang() . '&id=8">add a new query</a>';
        else {
            foreach ($userQueries as $query) {
                renderEditableQuery($query);
//                $language = getLang();
//                $query->render($language);
            }
        }
    }

    function renderEditableQuery($query) {
        echo '<div class="query-wrapper">';
        $language = getLang();
        $query->render($language);
        echo '<div class="query edit">
                        <form action="" method="post" >
                            <input type="hidden" name="queryID" value="' . $query->id . '" required>
                            <button type="submit" name="action" value="deleteQuery">Delete</button>
                            <button type="submit" name="action" value="editQuery">Edit</button>
                        </form>
                    </div>
                </div><!--end query-wrapper-->';

    }

    function listQueryByID($queryID) {
        $query = Query::getQueryByID($queryID);
        if ($query !== null) {
            include '../pages/queryForm.php';
        }
    }


