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
        public $description;
        public $imageName;
        public $weight;
        public $price;
        public $hasLights;
        public $hasGears;
        public $gearTypeID; //referencing to the gear type table
        public $nbOfGears;
        public $wheelSize;
        public $brakeTypeID; //referencing to the brake type table
        public $ownerID;

        function __construct() {
        }

        public static function withParams($bikeArray) {
            $bicycle = new self();
            $db = DB::getInstance();
            foreach ($bikeArray as $key => $value) {
                $bicycle->$key = $db->escape_string($value);
            }
            return $bicycle;
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

        public static function getBicyclesByUser($user) {
            $ownerID = $user->id;
            $bicycles = array();
            $res = DB::doQuery("SELECT * FROM bicycles WHERE bicycles.ownerID = $ownerID;");
            if (!$res) return null;
            while ($bicycle = $res->fetch_object(get_class()))
                $bicycles[] = $bicycle;
            return $bicycles;
        }

        // Should return one bicycle ONLY!
        public static function getBicycleByID($id) {
            $res = DB::doQuery("SELECT * FROM bicycles WHERE bicycles.id = $id;");
            if (!$res || $res->num_rows !== 1) return false;
            return $res->fetch_object(get_class());
        }

        public static function addBikeToDB($bike) {
            $db = DB::getInstance();
            $ADD_STATEMENT = "INSERT INTO bicycles (id, title, description, imageName, weight, price, hasLights, hasGears, wheelSize, brakeTypeID, nbOfGears, gearTypeID, ownerID) VALUE (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
            $stmt = $db->prepare($ADD_STATEMENT);
            if (!$stmt) {
                echo "Prepare failed with error: $db->error ";
                exit;
            }
            $bikeID = NULL;
            $stmt->bind_param('isssdiiiiiiii', $bikeID, $bike->title, $bike->description, $bike->imageName, $bike->weight, $bike->price, $bike->hasLights, $bike->hasGears, $bike->wheelSize, $bike->brakeType, $bike->nbOfGears, $bike->gearType, $bike->ownerID);
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

        public static function updateBikeInDB($bikeArray) {
            $ADD_STATEMENT = "UPDATE bicycles SET title=?, description=?, imageName=?, weight=?, price=?, hasLights=?, hasGears=?, wheelSize=?, brakeTypeID=?, nbOfGears=?, gearTypeID=?, ownerID=? WHERE bicycles.id = ?;";
            $db = DB::getInstance();
            $stmt = $db->prepare($ADD_STATEMENT);
            if (!$stmt) {
                echo "Prepare failed";
                exit;
            }
            $bike = Bicycle::withParams($bikeArray);
            $stmt->bind_param('sssdiiiiiiiii', $bike->title, $bike->description, $bike->imageName, $bike->weight, $bike->price, $bike->hasLights, $bike->hasGears, $bike->wheelSize, $bike->brakeTypeID, $bike->nbOfGears, $bike->gearTypeID, $bike->ownerID, $bike->id);
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

        public function getOwnerName() {
            $owner = User::getUserByID($this->ownerID);
            return $owner->fname . ' ' . $owner->lname;
        }

        public function getBrakeTypeName() {
            $brakeType = BrakeType::getBrakeTypeByID($this->brakeTypeID);
            return $brakeType->name;
        }

        public function getGearTypeName() {
            $gearType = GearType::getGearTypeByID($this->gearTypeID);
            return $gearType->name;
        }

        public function setCookiesForBike() {
            foreach ($this as $key => $value) {
                $_COOKIE[$key] = $value;
            }
        }
    }