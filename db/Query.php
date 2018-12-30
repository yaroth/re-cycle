<?php
    /**
     * Created by PhpStorm.
     * User: yann
     * Date: 08.11.18
     * Time: 21:27
     *
     * a Query is a user defined series of bike parameters
     * that must fit to decide whether or not to buy a certain
     * bicycle.
     */


    class Query {

        public $id;
        public $title;
        public $userID;
        public $weight;
        public $price;
        public $hasLights;
        public $hasGears;
        public $wheelSize;
        public $brakeTypeID;
        public $nbOfGears;
        public $gearTypeID;


        function __construct() {
        }

        public static function withParams($queryArray) {
            $query = new self();
            $db = DB::getInstance();
            foreach ($queryArray as $key => $value) {
                $query->$key = $db->escape_string($value);
            }
            return $query;
        }

        public function setProperties($title, $weight, $price, $hasLights, $hasGears, $gearTypeID, $nbOfGears, $wheelSize, $brakeTypeID, $userID) {
            $db = DB::getInstance();
            $this->title = $db->escape_string($title);
            $this->weight = $db->escape_string($weight);
            $this->price = $db->escape_string($price);
            $this->hasLights = $db->escape_string($hasLights);
            $this->hasGears = $db->escape_string($hasGears);
            $this->gearTypeID = $db->escape_string($gearTypeID); //referencing to the gear type table
            $this->nbOfGears = $db->escape_string($nbOfGears);
            $this->wheelSize = $db->escape_string($wheelSize);
            $this->brakeTypeID = $db->escape_string($brakeTypeID); //referencing to the brake type table
            $this->userID = $db->escape_string($userID);
        }

        public function __toString() {
            return sprintf("query %d: '%s' owned by: %s", $this->id, $this->title, $this->userID);
        }

        // returns a queries array
        public static function getQueries() {
            $queries = array();
            $res = DB::doQuery("SELECT * FROM queries;");
            if (!$res) return null;
            while ($query = $res->fetch_object(get_class()))
                $queries[] = $query;
            return $queries;
        }

        // returns all the queries set by an user.
        // TODO: Check if this works!
        public static function getQueriesByUserID($userID) {
            $ADD_STATEMENT = "SELECT * FROM queries WHERE queries.userID = ?";
            $stmt = DB::getInstance()->prepare($ADD_STATEMENT);
            if (!$stmt) {
                echo "Prepare failed";
                exit;
            }
            $id = (int)$userID;
            $stmt->bind_param('i', $id);
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

//        returns ONE query by its id
        public static function getQueryByID($id) {
            $ADD_STATEMENT = "SELECT * FROM queries WHERE queries.id = ?";
            $stmt = DB::getInstance()->prepare($ADD_STATEMENT);
            if (!$stmt) {
                echo "Prepare failed getQueryByID";
                exit;
            }
            $id = (int)$id;
            $stmt->bind_param('i', $id);
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

        public static function addQueryToDB($query) {
            $db = DB::getInstance();
            $ADD_STATEMENT = "INSERT INTO queries (id, title, userID, weight, price, hasLights, hasGears, wheelSize, brakeTypeID, nbOfGears, gearTypeID) VALUE (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
            $stmt = $db->prepare($ADD_STATEMENT);
            if (!$stmt) {
                echo "Prepare failed with error: $db->error ";
                exit;
            }
            $queryID = NULL;
            $stmt->bind_param('isidiiiiiii', $queryID, $query->title, $query->userID, $query->weight, $query->price, $query->hasLights, $query->hasGears, $query->wheelSize, $query->brakeTypeID, $query->nbOfGears, $query->gearTypeID);
            if (!$stmt) {
                echo "bind_param failed: $db->error ";
                exit;
            }
            $stmt->execute();
            if (!$stmt) {
                echo "execute failed: $db->error";
                exit;
            }
            return $stmt;
        }

        public static function updateQueryInDB($query) {
            $ADD_STATEMENT = "UPDATE queries SET title=?, userID=?, weight=?, price=?, hasLights=?, hasGears=?, wheelSize=?, brakeTypeID=?, nbOfGears=?, gearTypeID=? WHERE queries.id = ?;";
            $db = DB::getInstance();
            $stmt = $db->prepare($ADD_STATEMENT);
            if (!$stmt) {
                echo "Prepare failed";
                exit;
            }
            $stmt->bind_param('sidiiiiiiii', $query->title, $query->userID, $query->weight, $query->price, $query->hasLights, $query->hasGears, $query->wheelSize, $query->brakeTypeID, $query->nbOfGears, $query->gearTypeID, $query->id);
            if (!$stmt) {
                echo "bind_param failed";
                exit;
            }
            $stmt->execute();
            if (!$stmt) {
                echo "execute failed";
                exit;
            }
            return $stmt != null;
        }

        public function saveQueryInDB() {
            $ADD_STATEMENT = "UPDATE queries SET title=?, userID=?, weight=?, price=?, hasLights=?, hasGears=?, wheelSize=?, brakeTypeID=?, nbOfGears=?, gearTypeID=? WHERE queries.id = ?;";
            $db = DB::getInstance();
            $stmt = $db->prepare($ADD_STATEMENT);
            if (!$stmt) {
                echo "Prepare failed";
                exit;
            }
            $stmt->bind_param('sidiiiiiiii', $this->title, $this->userID, $this->weight, $this->price, $this->hasLights, $this->hasGears, $this->wheelSize, $this->brakeTypeID, $this->nbOfGears, $this->gearTypeID, $this->id);
            if (!$stmt) {
                echo "bind_param failed";
                exit;
            }
            $stmt->execute();
            if (!$stmt) {
                echo "execute failed";
                exit;
            }
            return $stmt != null;
        }

        public function setCookiesForQuery() {
            foreach ($this as $key => $value) {
                $_COOKIE[$key] = $value;
            }
        }

        public static function deleteQueryByID($queryID) {
            $ADD_STATEMENT = "DELETE FROM queries  WHERE queries.id = ?";
            $dbInstance = DB::getInstance();
            $stmt = $dbInstance->prepare($ADD_STATEMENT);
            if (!$stmt) {
                echo "Prepare failed";
                exit;
            }
            $stmt->bind_param('i', $queryID);
            if (!$stmt) {
                echo "bind_param failed";
                exit;
            }
            $deletionSuccess = $stmt->execute();
            if (!$deletionSuccess) {
                echo "execute failed";
                exit;
            }
            return $deletionSuccess;
        }

        public function getBrakeTypeName() {
            $brakeType = BrakeType::getBrakeTypeByID($this->brakeTypeID);
            return $brakeType->name;
        }

        public function getGearTypeName() {
            $gearType = GearType::getGearTypeByID($this->gearTypeID);
            return $gearType->name;
        }
    }