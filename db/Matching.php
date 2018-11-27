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

        public static function getMatchings() {
            $matchings = array();
            $res = DB::doQuery("SELECT * FROM matchings;");
            if (!$res) return null;
            while ($matching = $res->fetch_object(get_class()))
                $matchings[] = $matching;
            return $matchings;
        }

        public static function getMatchingByID($id) {
            $ADD_STATEMENT = "SELECT * FROM matchings WHERE matchings.id = ?";
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

    }