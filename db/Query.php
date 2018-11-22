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
        public $ownerID;
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

        public function __toString() {
            return sprintf("query %d: '%s' owned by: %s", $this->id, $this->title, $this->ownerID);
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
            $ADD_STATEMENT = "SELECT * FROM queries WHERE queries.ownerID = ?";
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
                echo "Prepare failed";
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

    }