<?php
    /**
     * Created by PhpStorm.
     * User: yann
     * Date: 08.11.18
     * Time: 21:27
     */

    class YannTestClass {
        function __construct($myattr) {
            $this->myattr = $myattr;
        }

        function mymethod() {
            echo "Ha $this->myattr!";
        }

//        call it using YannTestClass::yannStaticFunction($someVariable)
        public static function yannStaticFunction($v){
            echo "Hello $v! How are you?";
        }
    }