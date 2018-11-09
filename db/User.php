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
        private static $ADD_STATEMENT = "INSERT INTO `users` (`id`, `fname`, `lname`, `dob`, `email`, `sexID`) VALUES (?,?,?,?,?,?)";

        function __construct() {
        }

        public function __toString() {
            return sprintf("%d) %s, %s of sex: %s", $this->id, $this->fname, $this->lname, $this->sexString);
        }

        public function setSexString($sexArray) {
            $this->sexString = $sexArray[$this->sexID];
        }

        static public function getUsers() {
            $users = array();
            $res = DB::doQuery(
                "SELECT * FROM users;"
            );
            if (!$res) return null;
            while ($user = $res->fetch_object(get_class()))
                $users[] = $user;
            return $users;
        }

        public function addProperties($id, $fname, $lname, $dob, $email, $sexID){
            $this->$id = $id;
            $this->$fname = $fname;
            $this->$lname = $lname;
            $this->$dob = $dob;
            $this->$email = $email;
            $this->$sexID = $sexID;
            echo $this->__toString();
        }

        public static function addUserToDB($user) {
            $dbInstance = DB::getInstance();
            $stmt = $dbInstance->prepare(USER::$ADD_STATEMENT);
            $date = date($user->dob);
            $stmt->bind_param('issssi', $user->id, $user->fname, $user->lname, $date, $user->email, $user->sexID);
            $stmt->execute();
            $result = $stmt->get_result();
            return $result;
        }
    }