<?php
    /**
     * Created by PhpStorm.
     * User: yann
     * Date: 08.11.18
     * Time: 21:27
     */


    class Gender {

        public $id;
        public $name;

        function __construct() {
        }

        public function __toString(){
            return sprintf("id = %d, name = %s", $this->id, $this->name);
        }

        public static function getGenderByID($genderID){
            $ADD_STATEMENT = "SELECT * FROM genders WHERE genders.id = ?";
            $stmt = DB::getInstance()->prepare($ADD_STATEMENT);
            if (!$stmt) {
                echo "Prepare failed";
                exit;
            }
            $genderID = (int)$genderID;
            $stmt->bind_param('i', $genderID);
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