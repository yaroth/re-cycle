<?php
    /**
     * Created by PhpStorm.
     * User: yann
     * Date: 08.11.18
     * Time: 21:27
     */


    class Account {

        public $id;
        public $login;
        public $pw_hash;
        public $admin;

        function __construct() {
        }

        public function __toString() {
            return sprintf("Account :: ID: %d, login: %s, pw_hash: %s, isAdmin: %s", $this->id, $this->login, $this->pw_hash, $this->admin ? "Yes" : "No");
        }

        static public function getAccounts() {
            $accounts = array();
            $res = DB::doQuery("SELECT * FROM accounts;");
            if (!$res) return null;
            while ($account = $res->fetch_object(get_class()))
                $accounts[] = $account;
            return $accounts;
        }

        public function setProperties($login, $pw, $admin) {
            $db = DB::getInstance();
            $this->login = $db->escape_string($login);
            $temp = $db->escape_string($pw);
            $this->pw_hash = password_hash($temp, PASSWORD_BCRYPT);
            $this->admin = $db->escape_string($admin);
        }

        public static function addAccountToDB($account) {
            $db = DB::getInstance();
            $login = $account->login;
            if (self::getAccountByLogin($login) !== null){
                return null;
            }
            $ADD_STATEMENT = "INSERT INTO accounts (id, login, pw_hash, admin) VALUE (?, ?, ?, ?)";
            $stmt = $db->prepare($ADD_STATEMENT);
            if (!$stmt) {
                echo "Prepare failed with error: $db->error ";
                exit;
            }
            $accountID = NULL;
            $pw = $account->pw_hash;
            $admin = $account->admin;
            $stmt->bind_param('issi', $accountID, $login, $pw, $admin);
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

        public static function deleteAccountByID($accountID) {
            $ADD_STATEMENT = "DELETE FROM accounts WHERE accounts.id = ?";
            $dbInstance = DB::getInstance();
            $stmt = $dbInstance->prepare($ADD_STATEMENT);
            if (!$stmt) {
                echo "Prepare failed";
                exit;
            }
            $stmt->bind_param('i', $accountID);
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

        public static function deleteAccountByLogin($login) {
            $ADD_STATEMENT = "DELETE FROM accounts WHERE accounts.login = ?";
            $dbInstance = DB::getInstance();
            $stmt = $dbInstance->prepare($ADD_STATEMENT);
            if (!$stmt) {
                echo "Prepare failed";
                exit;
            }
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
            return $result;
        }

        public static function getAccountByLogin($login){
            $ADD_STATEMENT = "SELECT * FROM accounts WHERE accounts.login = ?";
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

        public static function getAccountByID($id){
            $ADD_STATEMENT = "SELECT * FROM accounts WHERE accounts.id = ?";
            $stmt = DB::getInstance()->prepare($ADD_STATEMENT);
            if (!$stmt) {
                echo "Prepare failed";
                exit;
            }
            $id = (int)DB::getInstance()->escape_string($id);
            $stmt->bind_param('i', $id);
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

        public function setAccount($account){
            $db = DB::getInstance();
            $this->id = (int)$account->id;
            $this->login = $db->escape_string($account->login);
            $this->pw_hash = $db->escape_string($account->pw_hash);
            $this->admin = $db->escape_string($account->admin);
        }

        public function updateAccountInDB($account, $hasNewPassword){
            if ($hasNewPassword) $ADD_STATEMENT = "UPDATE accounts SET login=?, pw_hash=?, admin=? WHERE accounts.id = ?;";
            elseif (!$hasNewPassword) $ADD_STATEMENT = "UPDATE accounts SET login=?, admin=? WHERE accounts.id = ?;";
            $db = DB::getInstance();
            $stmt = $db->prepare($ADD_STATEMENT);
            if (!$stmt) {
                echo "Prepare failed";
                exit;
            }
            $this->setAccount($account);
            if ($hasNewPassword) $stmt->bind_param('ssii', $this->login, $this->pw_hash, $this->admin, $this->id);
            elseif (!$hasNewPassword) $stmt->bind_param('sii', $this->login, $this->admin, $this->id);
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

        public static function checklogin($login, $password) {
            // db error checking omitted...
            $db = DB::getInstance();
            $stmt = $db->prepare("SELECT * FROM accounts WHERE login=?");
            $stmt->bind_param('s', $login);
            $stmt->execute();
            $result = $stmt->get_result();
            if (!$result || $result->num_rows !== 1)
                return false;
            $row = $result->fetch_assoc();
            return password_verify($password, $row["pw_hash"]);
        }

        public function isAdminAccount(){
            return $this->admin;
        }

        public static function isAdminByLogin($login){
            $account = self::getAccountByLogin($login);
            return $account->isAdminAccount();
        }
    }