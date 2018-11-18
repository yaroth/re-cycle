<?php
    /**
     * Created by PhpStorm.
     * User: yann
     * Date: 08.11.18
     * Time: 21:27
     */


    class BrakeType {

        public $id;
        public $name;


        function __construct() {
        }

        public function __toString() {
            return sprintf("%d) brake type name: %s", $this->id, $this->name);
        }

        public static function getBrakeTypes() {
            $brakesTypes = array();
            $res = DB::doQuery("SELECT * FROM brakeTypes;");
            if (!$res) return null;
            while ($brakeType = $res->fetch_object(get_class()))
                $brakesTypes[] = $brakeType;
            return $brakesTypes;
        }

        public static function getBrakeTypeByID($id) {
            $ADD_STATEMENT = "SELECT * FROM brakeTypes WHERE brakeTypes.id = ?";
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