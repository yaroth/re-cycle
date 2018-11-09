<?php
    /**
     * Created by PhpStorm.
     * User: yann
     * Date: 08.11.18
     * Time: 21:27
     */


    class Bicycle {

        public $id;
        public $weight;
        public $hasLights;
        public $hasGears;
        public $wheelSize;
        public $brakeTypeID;
        public $nbOfGears;
        public $gearTypeID;
        public $ownerID;

        function __construct() {
        }

        public function __toString(){
            return sprintf("%d) weight: %0.3f kg, wheel size: %d ", $this->id, $this->weight, $this->wheelSize);
        }
        static public function getBicycles() {
            $bicycles = array();
            $res = DB::doQuery(
                "SELECT * FROM bicycles;"
            );
            if (!$res) return null;
            while ($bicycle = $res->fetch_object(get_class()))
                $bicycles[] = $bicycle;
            return $bicycles;
        }

    }