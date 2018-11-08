<?php
    /**
     * Created by PhpStorm.
     * User: yann
     * Date: 08.11.18
     * Time: 21:27
     */


    class User {

        public $id;
        public $fname;
        public $lname;
        public $dob;
        public $email;
        public $sexID;
        public $sexString;

        function __construct() {
        }

        public function __toString(){
            return sprintf("%d) %s, %s of sex: %s", $this->id, $this->fname, $this->lname, $this->sexString);
        }
        public function setSexString($sex){
            $this->sexString = $sex;
        }
    }