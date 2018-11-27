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
        public $login;
        public $dob;
        public $email;
        public $genderID;
        public $sexString;


        function __construct() {
        }

        public function __toString() {
            return sprintf("%d) %s, %s of sex: %s (id: %d)", $this->id, $this->fname, $this->lname, $this->sexString, $this->genderID);
        }

        public function setSexString($sexArray) {
            $this->sexString = $sexArray[$this->genderID];
        }

        public static function getUsers() {
            $users = array();
            $res = DB::doQuery("SELECT * FROM users;");
            if (!$res) return null;
            while ($user = $res->fetch_object(get_class()))
                $users[] = $user;
            return $users;
        }

        public function setProperties($fname, $lname, $login, $dob, $email, $genderID) {
            $db = DB::getInstance();
            $this->fname = $db->escape_string($fname);
            $this->lname = $db->escape_string($lname);
            $this->login = $db->escape_string($login);
            $this->dob = date($db->escape_string($dob));
            $this->email = $db->escape_string($email);
            $this->genderID = $db->escape_string($genderID);
        }

        public static function addUserToDB($user) {
            $ADD_STATEMENT = "INSERT INTO users (id, fname, lname, login, dob, email, genderID) VALUE (?, ?, ?, ?, ?, ?, ?)";
            $dbInstance = DB::getInstance();
            $stmt = $dbInstance->prepare($ADD_STATEMENT);
            if (!$stmt) {
                echo "Prepare failed with error: $dbInstance->error ";
                exit;
            }
            $userID = NULL;
            $dateOfBirth = date($user->dob);
            $stmt->bind_param('isssssi', $userID, $user->fname, $user->lname, $user->login, $dateOfBirth, $user->email, $user->genderID);
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

        public static function getUserByID($userID) {
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

        public static function getUserIDByLogin($login){
            $user = User::getUserByLogin($login);
            return $user->id;
        }

        public static function getUserByLogin($login) {
            $ADD_STATEMENT = "SELECT * FROM users WHERE users.login = ?";
            $stmt = DB::getInstance()->prepare($ADD_STATEMENT);
            if (!$stmt) {
                echo "Prepare failed";
                exit;
            }
            $login = DB::getInstance()->escape_string($login);
            $stmt->bind_param('s', $login);
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

        public function setUser($user) {
            $db = DB::getInstance();
            $this->id = (int)$user->id;
            $this->fname = $db->escape_string($user->fname);
            $this->lname = $db->escape_string($user->lname);
            $this->login = $db->escape_string($user->login);
            $this->dob = $db->escape_string($user->dob);
            $this->email = $db->escape_string($user->email);
            $this->genderID = (int)$user->genderID;
        }

        public static function withParams($userArray) {
            $user = new self();
            $db = DB::getInstance();
            foreach ($userArray as $key => $value) {
                $user->$key = $db->escape_string($value);
            }
            return $user;
        }

        public static function updateUserInDB($userArray) {
            $ADD_STATEMENT = "UPDATE users SET fname=?, lname=?, login=?, dob=?, email=?, genderID=? WHERE users.id = ?;";
            $db = DB::getInstance();
            $stmt = $db->prepare($ADD_STATEMENT);
            if (!$stmt) {
                echo "Prepare failed";
                exit;
            }
            $user = User::withParams($userArray);
            $stmt->bind_param('sssssii', $user->fname, $user->lname, $user->login, $user->dob, $user->email, $user->genderID, $user->id);
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

        public function setCookiesForUser() {
            foreach ($this as $key => $value) {
                $_COOKIE[$key] = $value;
            }
        }

        public function getUserFullName(){
            return $this->fname . " " . $this->lname;
        }
    }