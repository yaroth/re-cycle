<?php
    /**
     * Created by PhpStorm.
     * User: yann
     * Date: 08.11.18
     * Time: 21:27
     */


    class Matching {

        public $id;
        public $userID;
        public $queryID;
        public $bikeID;


        function __construct() {
        }

        public function __toString() {
            return sprintf("Matching: %d, userID: %s, queryID: %s, bikeID: %s", $this->id, $this->userID, $this->queryID, $this->bikeID);
        }

        // get all matchings
        public static function getMatchings() {
            $matchings = array();
            $res = DB::doQuery("SELECT * FROM matchings;");
            if (!$res) return null;
            while ($matching = $res->fetch_object(get_class()))
                $matchings[] = $matching;
            return $matchings;
        }

        // get matching by matchingID
        public static function getMatchingByID($matchingID) {
            $ADD_STATEMENT = "SELECT * FROM matchings WHERE matchings.id = ?";
            $stmt = DB::getInstance()->prepare($ADD_STATEMENT);
            if (!$stmt) {
                echo "Prepare failed";
                exit;
            }
            $matchingID = (int)$matchingID;
            $stmt->bind_param('i', $matchingID);
            if (!$stmt) {
                echo "bind_param failed";
                exit;
            }
            $stmt->execute();
            if (!$stmt) {
                echo "execute failed";
                exit;
            }
            $result = $stmt->get_result();
            if (!$result) return null;
            return $result->fetch_object(get_class());
        }

        // returns all matchings matching a userID
        public static function getMatchingsByUserID($userID) {
            $ADD_STATEMENT = "SELECT * FROM matchings WHERE matchings.userID = ?";
            $stmt = DB::getInstance()->prepare($ADD_STATEMENT);
            if (!$stmt) {
                echo "Prepare failed";
                exit;
            }
            $userID = (int)$userID;
            $stmt->bind_param('i', $userID);
            if (!$stmt) {
                echo "bind_param failed";
                exit;
            }
            $stmt->execute();
            if (!$stmt) {
                echo "execute failed";
                exit;
            }
            $result = $stmt->get_result();
            if (!$result) return null;
            $matchings = array();
            while ($matching = $result->fetch_object(get_class()))
                $matchings[] = $matching;
            return $matchings;
        }

        // returns all the matchings that match a certain queryID
        public static function getMatchingsByQueryID($queryID) {
            $ADD_STATEMENT = "SELECT * FROM matchings WHERE matchings.queryID = ?";
            $stmt = DB::getInstance()->prepare($ADD_STATEMENT);
            if (!$stmt) {
                echo "Prepare failed";
                exit;
            }
            $queryID = (int)$queryID;
            $stmt->bind_param('i', $queryID);
            if (!$stmt) {
                echo "bind_param failed";
                exit;
            }
            $stmt->execute();
            if (!$stmt) {
                echo "execute failed";
                exit;
            }
            $result = $stmt->get_result();
            if (!$result) return null;
            $queries = array();
            while ($query = $result->fetch_object(get_class()))
                $queries[] = $query;
            return $queries;
        }

        // TODO: complete matching conditions
        public static function getMatchingBikesByQuery($query) {
            $bikes = Bicycle::getBicycles();
            $foundBikesArray = Bicycle::getBicycles();
            $weightBikesArray = array();
            $priceBikesArray = array();
            $hasLightsBikesArray = array();
            $hasGearsBikesArray = array();
            $gearTypeBikesArray = array();
            $nbOfGearsBikesArray = array();
            $wheelSizeBikesArray = array();
            $brakeTypeBikesArray = array();
            foreach ($bikes as $bike) {
                // only check on those bicycle NOT belonging to the requesting user!
                if ($bike->ownerID != $query->userID) {
                    if ($query->weight !== 0 && ($bike->weight <= $query->weight)) {
                        $weightBikesArray[] = $bike;
                    }
                    if ($query->price !== 0 && ($bike->price <= $query->price)) {
                        $priceBikesArray[] = $bike;
                    }
                    if (($query->hasLights && $bike->hasLights) || (!$query->hasLights && !$bike->hasLights)) {
                        $hasLightsBikesArray[] = $bike;
                    }
                    if (($query->hasGears && $bike->hasGears) || (!$query->hasGears && !$bike->hasGears)) {
                        $hasGearsBikesArray[] = $bike;
                    }
                    if ($query->gearTypeID !== 4 && ($bike->gearTypeID == $query->gearTypeID)) {
                        $gearTypeBikesArray[] = $bike;
                    }
                    if ($query->nbOfGears !== 0 && ($bike->nbOfGears >= $query->nbOfGears)) {
                        $nbOfGearsBikesArray[] = $bike;
                    }
                    if ($query->wheelSize !== 0 && ($bike->wheelSize == $query->wheelSize)) {
                        $wheelSizeBikesArray[] = $bike;
                    }
                    if ($query->brakeTypeID !== 5 && ($bike->brakeTypeID == $query->brakeTypeID)) {
                        $brakeTypeBikesArray[] = $bike;
                    }
                }

            }
            if ($query->weight !== 0) {
//                foreach ($foundBikesArray as $bike) echo "WEIGHT before: " . $bike . '<br>';
//                echo '<br>';
                $foundBikesArray = array_intersect($foundBikesArray, $weightBikesArray);
            }
            if ($query->price !== 0) {
                $foundBikesArray = array_intersect($foundBikesArray, $priceBikesArray);
            }
            /*// TODO: Fix the hasLights condition
            if (($query->hasLights && $bike->hasLights) || (!$query->hasLights && !$bike->hasLights)) {
                $hasLightsBikesArray[] = $bike;
            }
            // TODO: Fix the hasGears condition
            if (($query->hasGears && $bike->hasGears) || (!$query->hasGears && !$bike->hasGears)) {
                $hasGearsBikesArray[] = $bike;
            }*/
            if ($query->gearTypeID !== 4) {
                $foundBikesArray = array_intersect($foundBikesArray, $gearTypeBikesArray);
            }
            if ($query->nbOfGears !== 0) {
                $foundBikesArray = array_intersect($foundBikesArray, $nbOfGearsBikesArray);
            }
            if ($query->wheelSize !== 0) {
                $foundBikesArray = array_intersect($foundBikesArray, $wheelSizeBikesArray);
            }
            if ($query->brakeTypeID !== 5) {
                $foundBikesArray = array_intersect($foundBikesArray, $brakeTypeBikesArray);
            }

            return $foundBikesArray;

        }

    }