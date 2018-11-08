<?php
    /**
     * Created by PhpStorm.
     * User: yann
     * Date: 08.11.18
     * Time: 21:27
     */


    class Sex {

        public $id;
        public $name;

        function __construct() {
        }

        public function __toString(){
            return sprintf("id = %d, name = %s", $this->id, $this->name);
        }
    }