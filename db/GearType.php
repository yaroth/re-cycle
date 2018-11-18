<?php
    /**
     * Created by PhpStorm.
     * User: yann
     * Date: 08.11.18
     * Time: 21:27
     */


    class GearType {

        public $id;
        public $name;


        function __construct() {
        }

        public function __toString() {
            return sprintf("%d) gear type name: %s", $this->id, $this->name);
        }

        public static function getGearTypes() {
            $gearTypes = array();
            $res = DB::doQuery("SELECT * FROM gearTypes;");
            if (!$res) return null;
            while ($gearType = $res->fetch_object(get_class()))
                $gearTypes[] = $gearType;
            return $gearTypes;
        }

        public static function getGearTypeByID($id) {
            $ADD_STATEMENT = "SELECT * FROM gearTypes WHERE gearTypes.id = ?";
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