<?php
    /**
     * Created by PhpStorm.
     * User: yann
     * Date: 08.11.18
     * Time: 21:27
     */


    class BikeType {

        public $id;
        public $name;


        function __construct() {
        }

        public function __toString() {
            return sprintf("%d) bicycle type name: %s", $this->id, $this->name);
        }

        public static function getBikeTypes() {
            $bikeTypes = array();
            $res = DB::doQuery("SELECT * FROM bikeTypes;");
            if (!$res) return null;
            while ($bikeType = $res->fetch_object(get_class()))
                $bikeTypes[] = $bikeType;
            return $bikeTypes;
        }

        public static function getBikeTypeByID($id) {
            $ADD_STATEMENT = "SELECT * FROM bikeTypes WHERE bikeTypes.id = ?";
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