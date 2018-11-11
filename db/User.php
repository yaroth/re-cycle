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

        public function setProperties($fname, $lname, $dob, $email, $sexID) {
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
                echo "Prepare failed with error: $dbInstance->error ";
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
                echo "bind_param failed: $dbInstance->error ";
                exit;
            }
            $stmt->execute();
            if (!$stmt) {
                echo "execute failed: $dbInstance->error";
                exit;
            }
            return $stmt;
        }

        public static function deleteUserWithID($userID) {
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
            $result = $stmt->get_result();
            return $result;
        }

        public static function getUserWithID($userID){
            $ADD_STATEMENT = "SELECT * FROM users WHERE users.id = ?";
            $stmt = DB::getInstance()->prepare($ADD_STATEMENT);
            if (!$stmt) {
                echo "Prepare failed";
                exit;
            }
            $userID = (int)$userID;
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
            if (!$result) return null;
            return $result->fetch_object(get_class());
        }

        public static function updateUser($user){
            $ADD_STATEMENT = "UPDATE users SET fname=?, lname=?, dob=?, email=?, sexID=? WHERE users.id = ?;";
            $db = DB::getInstance();
            $stmt = $db->prepare($ADD_STATEMENT);
            if (!$stmt) {
                echo "Prepare failed";
                exit;
            }
            $userID = (int)$user->id;
            $fname = $db->escape_string($user->fname);
            $lname = $db->escape_string($user->lname);
            $dob = $db->escape_string($user->dob);
            $email = $db->escape_string($user->email);
            $sexID = (int) $user->sexID;
            $stmt->bind_param('ssssii', $fname, $lname, $dob, $email, $sexID, $userID);
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
            return $result != null;
        }
    }