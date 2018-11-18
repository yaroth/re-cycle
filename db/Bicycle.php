<?php
    /**
     * Created by PhpStorm.
     * User: yann
     * Date: 08.11.18
     * Time: 21:27
     */


    class Bicycle {

        public $id;
        public $title;
        public $weight;
        public $price;
        public $hasLights;
        public $hasGears;
        public $wheelSize;
        public $brakeTypeID;
        public $nbOfGears;
        public $gearTypeID;
        public $ownerID;

        function __construct() {
        }

        public static function withParams($bikeArray) {
            $instance = new self();
            $db = DB::getInstance();
            foreach ($bikeArray as $key => $value) {
                $instance->$key = $db->escape_string($value);
            }
            return $instance;
        }

        public function __toString() {
            return sprintf("%d) weight: %0.3f kg, wheel size: %d ", $this->id, $this->weight, $this->wheelSize);
        }

        public static function getBicycles() {
            $bicycles = array();
            $res = DB::doQuery("SELECT * FROM bicycles;");
            if (!$res) return null;
            while ($bicycle = $res->fetch_object(get_class()))
                $bicycles[] = $bicycle;
            return $bicycles;
        }

        public static function addBikeToDB($bike) {
            $db = DB::getInstance();
            $ADD_STATEMENT = "INSERT INTO bicycles (id, title, description, weight, price, hasLights, hasGears, wheelSize, brakeTypeID, nbOfGears, gearTypeID, ownerID) VALUE (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
            $stmt = $db->prepare($ADD_STATEMENT);
            if (!$stmt) {
                echo "Prepare failed with error: $db->error ";
                exit;
            }
            $bikeID = NULL;
            $stmt->bind_param('issdiiiiiiii', $bikeID, $bike->title, $bike->description, $bike->weight, $bike->price, $bike->hasLights, $bike->hasGears, $bike->wheelSize, $bike->brakeType, $bike->nbOfGears, $bike->gearType, $bike->ownerID);
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

    }