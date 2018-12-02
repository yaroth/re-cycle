<?php
    /**
     * Created by PhpStorm.
     * User: yann
     * Date: 08.11.18
     * Time: 21:27
     */
    require_once "../data/conf.php";

    class DB extends mysqli {
        const HOST = "localhost", USER = "recycle", PW = CONF_PW, DB_NAME = "recycle";
        static private $instance;

        function __construct() {
            parent::__construct(self::HOST, self::USER, self::PW, self::DB_NAME);
            self::set_charset("utf8");
        }

        static public function getInstance() {
            if (!self::$instance)
                @self::$instance = new DB(); // error handling ...
            // set charset to utf8: done in __construct.
            return self::$instance;
        }

        static public function doQuery($sql) {
            return self::getInstance()->query($sql);
        }
    }