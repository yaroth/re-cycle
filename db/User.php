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

        public function __toString() {
            return sprintf("%d) %s, %s of sex: %s (id: %d)", $this->id, $this->fname, $this->lname, $this->sexString, $this->sexID);
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

        public function addProperties($fname, $lname, $dob, $email, $sexID) {
            $this->fname = $fname;
            $this->lname = $lname;
            $this->dob = $dob;
            $this->email = $email;
            $this->sexID = $sexID;
        }

        public static function addUserToDB($user) {
            $ADD_STATEMENT = "INSERT INTO users (id, fname, lname, dob, email, sexID) VALUE (?, ?, ?, ?, ?, ?)";
            $dbInstance = DB::getInstance();
            $stmt = $dbInstance->prepare($ADD_STATEMENT);
            if (!$stmt) {
                echo "Prepare failed";
                exit;
            }
            $userID = NULL;
            $firstName = $user->fname;
            $lastName = $user->lname;
            $dateOfBirth = date($user->dob);
            $useremail = $user->email;
            $userSexID = $user->sexID;
            $stmt->bind_param('issssi', $userID, $firstName, $lastName, $dateOfBirth, $useremail, $userSexID);
            if (!$stmt) {
                echo "bind_param failed";
                exit;
            }
            $stmt->execute();
            if (!$stmt) {
                echo "execute failed";
                exit;
            }
            return $stmt;
        }

        public static function deleteUserWithIDFromDB($userID) {
            $ADD_STATEMENT = "DELETE FROM users WHERE users.id = ?";
            $dbInstance = DB::getInstance();
            $stmt = $dbInstance->prepare($ADD_STATEMENT);
            if (!$stmt) {
                echo "Prepare failed";
                exit;
            }
            $stmt->bind_param('i', $userID);
            if (!$stmt) {
                echo "bind_param failed";
                exit;
            }
            $stmt->execute();
            if (!$stmt) {
                echo "execute failed";
                exit;
            }
            return $stmt;
        }

        public static function getUserWithID($userID){
            $ADD_STATEMENT = "SELECT * FROM users WHERE users.id = ?";
            $stmt = DB::getInstance()->prepare($ADD_STATEMENT);
            if (!$stmt) {
                echo "Prepare failed";
                exit;
            }
            $stmt->bind_param('i', $userID);
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
            $userObject = $result->fetch_object("User");
            return $userObject;
        }
    }