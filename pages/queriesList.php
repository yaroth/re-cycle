<?php
    /**
     * Called using AJAX
     */
    require_once("../data/queries.php");
    require_once("functions.php");
    require_once("../db/autoloader.php");
    echo '<h4>Queries list</h4>';
    echo '<div class="queriesList">';
    $language = $_GET["language"];
    foreach (Query::getQueries() as $query) {
        $user = User::getUserByID($query->userID);
        echo '<div class="query-wrapper">
                <div class="query title"><p>' . $query->title . '</p></div>
                <div class="query weight"><desc>' . translate("max-weight") . ':</desc> ' . $query->weight . '</div>
                <div class="query price"><desc>' . translate("max-price") . ':</desc> ' . $query->price . '.-</div>
                <div class="query hasLights"><desc>' . translate("requires-lights") . '</desc> ' . ($query->hasLights ? "yes" : ($query->hasLights === null ? "N/A" : "no")) . '</div>
                <div class="query hasGears"><desc>' . translate("requires-gears") . '</desc> ' . ($query->hasGears ? "yes" : ($query->hasGears === null ? "N/A" : "no")) . '</div>
                <div class="query gearType"><desc>' . translate("required-gear-type") . ':</desc> ' . $query->getGearTypeName() . '</div>
                <div class="query nbOfGears"><desc>' . translate("min-speeds") . ':</desc> ' . $query->nbOfGears . '</div>
                <div class="query wheelSize"><desc>' . translate("required-wheel-size") . ':</desc> ' . $query->wheelSize . '</div>
                <div class="query brakeType"><desc>' . translate("required-brake-type") . ':</desc> ' . $query->getBrakeTypeName() . '</div>
                <div class="query owner"><desc>' . translate("owner") . ':</desc> ' . $user->getUserFullName() . '</div>
                <div class="query id"><desc>ID:</desc> ' . $query->id . '</div>
                <button onclick="deleteQuery(this);" name="deleteQuery" type="button" value="' . $query->id . '">' . translate("delete") . '</button>
                <button onclick="editQuery(this);" name="editQuery" type="button" value="' . $query->id . '">' . translate("edit") . '</button>
            </div>';
    };
    echo '</div>';
?>