<?php
    /**
     * Created by PhpStorm.
     * User: yann
     * Date: 12.10.18
     * Time: 10:30
     */


// TODO: NICE-TO-HAVE: create a function to sort by different keys

    function listQueriesByUserID($userID) {
        $userQueries = Query::getQueriesByUserID($userID);
        if ($userQueries == null) echo '<h4>' . translate("no-query-defined") . '<a href="index.php?lang=' . getLang() . '&id=8">' . translate("add-query") . '?</a></h4>';
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


