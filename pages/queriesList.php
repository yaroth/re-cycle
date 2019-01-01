<?php
    require_once ("../data/queries.php");
    require_once ("functions.php");
    require_once("../db/autoloader.php");
    echo '<h4>Queries list</h4>';
    echo '<div class="queriesList">';
    foreach (Query::getQueries() as $query) {
        $user = User::getUserByID($query->userID);
        echo '<div class="query-wrapper">
                <div class="query title"><p>' . $query->title . '</p></div>
                <div class="query weight"><desc>Max. weight:</desc> ' . $query->weight . '</div>
                <div class="query price"><desc>Max. price:</desc> ' . $query->price . '.-</div>
                <div class="query hasLights"><desc>Requires lights?</desc> ' . ($query->hasLights ? "yes" : ($query->hasLights === null ? "N/A" : "no")) . '</div>
                <div class="query hasGears"><desc>Requires gears?</desc> ' . ($query->hasGears ? "yes" : ($query->hasGears === null ? "N/A" : "no")) . '</div>
                <div class="query gearType"><desc>Required gear type:</desc> ' . $query->getGearTypeName() . '</div>
                <div class="query nbOfGears"><desc>Min. # gears:</desc> ' . $query->nbOfGears . '</div>
                <div class="query wheelSize"><desc>Required wheel size:</desc> ' . $query->wheelSize . '</div>
                <div class="query brakeType"><desc>Required brake type:</desc> ' . $query->getBrakeTypeName() . '</div>
                <div class="query owner"><desc>Query owner:</desc> ' . $user->getUserFullName() . '</div>
                <div class="query id"><desc>ID:</desc> ' . $query->id . '</div>
                <button onclick="deleteQuery(this);" name="deleteQuery" type="button" value="' . $query->id . '">Delete</button>
                <button onclick="editQuery(this);" name="editQuery" type="button" value="' . $query->id . '">Edit</button>
            </div>';
    };
    echo '</div>';
?>