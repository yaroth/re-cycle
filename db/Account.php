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
        public $pw;
        public $isAdmin;

        function __construct() {
        }

        public function __toString() {
            return sprintf("ID: %d, login: %s, pw_hash: %s, isAdmin: %i)", $this->id, $this->login, $this->pw_hash, $this->isAdmin);
        }

        static public function getAccounts() {
            $accounts = array();
            $res = DB::doQuery("SELECT * FROM accounts;");
            if (!$res) return null;
            while ($account = $res->fetch_object(get_class()))
                $accounts[] = $account;
            return $accounts;
        }

        public function setProperties($login, $pw, $isAdmin) {
            $this->login = $login;
            $this->pw = $pw;
            $this->isAdmin = $isAdmin;
        }

        public static function addAccountToDB($account) {
            //TODO: check if account with this login already exists!
            $db = DB::getInstance();
            $login = $db->escape_string($account->login);
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
            $pw = $db->escape_string($account->pw);
            $isAdmin = $db->escape_string($account->isAdmin);
            $stmt->bind_param('issi', $accountID, $login, $pw, $isAdmin);
            if (!$stmt) {
                echo "bind_param failed: $db->error ";
                exit;
            }
            $stmt->execute();
            if (!$stmt) {
                echo "execute failed: $db->error";
                exit;
            }
            $result = $stmt->get_result();
            return $result != null;
        }

        public static function deleteAccountWithID($accountID) {
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

        public function setAccount($account){
            $db = DB::getInstance();
            $this->id = (int)$account->id;
            $this->login = $db->escape_string($account->login);
            $this->pw = $db->escape_string($account->pw);
            $this->isAdmin = $db->escape_string($account->isAdmin);
        }

        public function updateAccountInDB($account){
            $ADD_STATEMENT = "UPDATE accounts SET login=?, pw=?, isAdmin=? WHERE accounts.id = ?;";
            $db = DB::getInstance();
            $stmt = $db->prepare($ADD_STATEMENT);
            if (!$stmt) {
                echo "Prepare failed";
                exit;
            }
            $this->setAccount($account);
            $stmt->bind_param('ssii', $this->login, $this->pw, $this->isAdmin, $this->id);
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