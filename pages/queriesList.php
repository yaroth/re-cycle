<?php
    /**
     * Called using AJAX
     */
    require_once("../data/queries.php");
    require_once("functions.php");
    require_once("../db/autoloader.php");
    $language = $_GET["language"];
    echo '<h4>'. translate("queries") .'</h4>';
    echo '<div class="queriesList">';
    foreach (Query::getQueries() as $query) {
        $user = User::getUserByID($query->userID);
        echo '<div class="query-wrapper">';
        $query->render($language);
        echo '<button onclick="deleteQuery(this);" name="deleteQuery" type="button" value="' . $query->id . '">' . translate("delete") . '</button>
                <button onclick="editQuery(this);" name="editQuery" type="button" value="' . $query->id . '">' . translate("edit") . '</button>';
        echo '</div><!--end query-wrapper-->';
    };
    echo '</div>';
?>