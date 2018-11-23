<?php

    function get_param($name, $default) {
        if (!isset($_GET[$name]))
            return $default;
        return urldecode($_GET[$name]);
    }

    function add_param($url, $name, $value) {
        if (strpos($url, '?') !== false)
            $sep = '&';
        else
            $sep = '?';
        return $url . $sep . $name . "=" . urlencode($value);
    }

    function navigation($language, $pageId) {
        $urlbase = add_param($_SERVER['PHP_SELF'], "lang", $language);
        for ($i = 0; $i <= 8; $i++) {
            $url = add_param($urlbase, "id", $i);
            $class = $pageId == $i ? 'active' : 'inactive';
            echo '<li class="nav-item"><a class="' . $class . '" href="' . $url . '">' . navtitles('page', $i) . "</a></li>";
        }
    }

    function languages($language, $pageId) {
        $languages = ['de', 'fr', 'en'];
        $urlbase = add_param($_SERVER['PHP_SELF'], 'id', $pageId);
        if (isset($_GET["bikeID"])) {
            $bikeID = $_GET["bikeID"];
            $urlbase = add_param($urlbase, 'bikeID', $bikeID);
        }
        foreach ($languages as $l) {
            $class = $language == $l ? 'active' : 'inactive';
            echo '<li class="lang"><a class="' . $class . '" href="' . add_param($urlbase, 'lang', $l) . '">' . strtoupper($l) . '</a></li>';
        }
    }

    function content($pageId) {
        echo translate('content') . " $pageId";
    }

    function translate($key) {
        global $language;
        $texts = array(
            'page' => array(
                'de' => 'Seite',
                'fr' => 'Page',
                'en' => 'Page'),
            'welcome' => array(
                'de' => 'Willkommen auf der Seite ',
                'fr' => 'Bienvenue à la page ',
                'en' => 'Welcome to the page '),
            'results' => array(
                'de' => 'Resultate ',
                'fr' => 'Résultats ',
                'en' => 'Results '),
            'create-account' => array(
                'de' => 'Konto erstellen ',
                'fr' => 'Créer un compte ',
                'en' => 'Create account '),
            'account created' => array(
                'de' => 'Konto erstellt! ',
                'fr' => 'Compte créé! ',
                'en' => 'Account created! '),
            'success' => array(
                'de' => 'Erfolgreich! ',
                'fr' => 'Succès! ',
                'en' => 'Success! '),
            'welcome' => array(
                'de' => 'Willkommen ',
                'fr' => 'Bienvenu ',
                'en' => 'Welcome '),
            'bike-specs' => array(
                'de' => 'Velo Spezifikationen ',
                'fr' => 'Spécifications vélo ',
                'en' => 'Bike specs '),
            'login' => array(
                'de' => 'Einloggen ',
                'fr' => 'Se loguer ',
                'en' => 'Login '),
            'error' => array(
                'de' => 'Fehler! ',
                'fr' => 'Erreur! ',
                'en' => 'Error! '),
            'sorry' => array(
                'de' => 'Tut uns leid! ',
                'fr' => 'Désolé! ',
                'en' => 'Sorry! '),
            'protected' => array(
                'de' => 'Seite nur mit login zugänglich ',
                'fr' => 'Page protégée! ',
                'en' => 'Protected page! '),
            'personal-info' => array(
                'de' => 'Angaben ',
                'fr' => 'Données ',
                'en' => 'Personal information '),
            'add-bicycle' => array(
                'de' => 'Neues Velo erfassen',
                'fr' => 'Ajouter un nouveau vélo',
                'en' => 'Add a new bicycle'),
            'edit-bicycle' => array(
                'de' => 'Velodaten ändern',
                'fr' => 'Modifier vélo',
                'en' => 'Modify bicycle'),
            'bike-info' => array(
                'de' => 'Velo Daten',
                'fr' => 'Données vélo',
                'en' => 'Bicycle data'),
            'felgen' => array(
                'de' => 'Felgenbremsen',
                'fr' => 'freins de gentes',
                'en' => 'rim brakes'),
            'ketten' => array(
                'de' => 'Kettenschaltung',
                'fr' => 'dérailleur',
                'en' => 'derailleur'),
            'naben' => array(
                'de' => 'Nabenschaltung',
                'fr' => 'pignons de moyeu',
                'en' => 'hub gears'),
            'myBikes' => array(
                'de' => 'Meine Velos',
                'fr' => 'Mes vélos',
                'en' => 'My bikes'),
            'editAccount' => array(
                'de' => 'Meine Kontoangaben ändern',
                'fr' => 'Modifier mes données',
                'en' => 'Modify my data'),
            'set-password' => array(
                'de' => 'Passwort ändern ',
                'fr' => 'Changer le mot de passe ',
                'en' => 'Change password ')
        );
        return $texts[$key][$language] ?? "[?$key?][?$language?]";
    }

    function navtitles($key, $id) {
        global $language;
        $titles = array(
            'page' => array(
                'de' => array("Start", "Konto erstellen", "Login", "Velo", "geheim", "Passwort ändern", "Velo hinzufügen", "Meine Velos", "Mein Konto"),
                'fr' => array("Départ", "S'enregistrer", "Se loguer", "Vélo", "protégé", "Changer mot de passe", "Ajouter vélo", "Mes vélos", "Mon compte"),
                'en' => array("Start", "Create account", "Login EN", "Bike", "login ONLY", "Change password", "Add bike", "My bikes", "My account")
            ));
        return $titles[$key][$language][$id] ?? "[$key][$language][$id]";
    }

    function getLang() {
        if (!isset($_GET["lang"]))
            $language = 'de';
        else $language = $_GET["lang"];
        return $language;
    }

    function getId() {
        if (!isset($_GET["id"]))
            $id = 0;
        else $id = $_GET["id"];
        return $id;
    }

    function getChecked($name, $value) {
        $checked = NULL;
        if (isset($_COOKIE[$name]))
            if ($_COOKIE[$name] == $value) {
                $checked = 'checked="checked"';
                //TODO: this is not valid for all cases -> update!
            } elseif ($value == 1) $checked = 'checked="checked"';
        return $checked;
    }

    function bikeArrayFromPost() {
        $bikeArray = array();
        $success = true;
        if (empty(strip_tags($_POST['title']))) {
            $success = false;
        } else {
            $title = strip_tags($_POST['title']);
            $_COOKIE['title'] = $title;
            $bikeArray['title'] = $title;
        }
        if (empty(strip_tags($_POST['description']))) {
            $success = false;
        } else {
            $description = strip_tags($_POST['description']);
            $_COOKIE['description'] = $description;
            $bikeArray['description'] = $description;
        }
        if (empty(strip_tags($_POST['weight']))) {
            $success = false;
        } else {
            $weight = strip_tags($_POST['weight']);
            $_COOKIE['weight'] = $weight;
            $bikeArray['weight'] = $weight;
        }
        if (empty(strip_tags($_POST['price']))) {
            $success = false;
        } else {
            $price = strip_tags($_POST['price']);
            $_COOKIE['price'] = $price;
            $bikeArray['price'] = $price;
        }
        if (empty(strip_tags($_POST['hasLights']))) {
            $success = false;
        } else {
            $hasLights = strip_tags($_POST['hasLights'] == 'no' ? '0' : '1');
            $_COOKIE['hasLights'] = $hasLights;
            $bikeArray['hasLights'] = $hasLights;
        }
        if (empty(strip_tags($_POST['hasGears']))) {
            $success = false;
        } else {
            $hasGears = strip_tags($_POST['hasGears'] == 'no' ? '0' : '1');
            $_COOKIE['hasGears'] = $hasGears;
            $bikeArray['hasGears'] = $hasGears;
        }
        if (empty(strip_tags($_POST['gearTypeID']))) {
            $success = false;
        } else {
            $gearType = strip_tags($_POST['gearTypeID']);
            $_COOKIE['gearTypeID'] = $gearType;
            $bikeArray['gearTypeID'] = $gearType;
        }
        if (empty(strip_tags($_POST['nbOfGears']))) {
            $success = false;
        } else {
            $nbOfGears = strip_tags($_POST['nbOfGears']);
            $_COOKIE['nbOfGears'] = $nbOfGears;
            $bikeArray['nbOfGears'] = $nbOfGears;
        }
        if (empty(strip_tags($_POST['wheelSize']))) {
            $success = false;
        } else {
            $wheelSize = strip_tags($_POST['wheelSize']);
            $_COOKIE['wheelSize'] = $wheelSize;
            $bikeArray['wheelSize'] = $wheelSize;
        }
        if (empty(strip_tags($_POST['brakeTypeID']))) {
            $success = false;
        } else {
            $brakeType = strip_tags($_POST['brakeTypeID']);
            $_COOKIE['brakeTypeID'] = $brakeType;
            $bikeArray['brakeTypeID'] = $brakeType;
        }
        if (isset($_FILES['upload'])) {
            $file = $_FILES['upload'];
            if ($file['error'] != 0) {
                if (isset($_POST["saveBikeID"])) {
                    $bikeID = $_POST["saveBikeID"];
                    $bike = Bicycle::getBicycleByID($bikeID);
                    $bikeArray['imageName'] = $bike->imageName;
                } else {
                    echo "Error uploading the image, please try again later";
                    $success = false;
                }
            } else {
                // validate the file: type, size, image size...
                //TODO: check if same name file exists, in which case find another name > seems to be done automatically!
                move_uploaded_file($file['tmp_name'], '../img/uploads/' . $file['name']);
                $bikeArray['imageName'] = $file['name'];
            }
        }
        if (!$success) return $success;
        else return $bikeArray;
    }

    function userArrayFromPost() {
        $userArray = array();
        $success = true;
        if (empty(strip_tags($_POST['fname']))) {
            $success = false;
        } else {
            $fname = strip_tags($_POST['fname']);
            $_COOKIE['fname'] = $fname;
            $userArray['fname'] = $fname;
        }
        if (empty(strip_tags($_POST['lname']))) {
            $success = false;
        } else {
            $lname = strip_tags($_POST['lname']);
            $_COOKIE['lname'] = $lname;
            $userArray['lname'] = $lname;
        }
        if (empty(strip_tags($_POST['dob']))) {
            $success = false;
        } else {
            $dob = strip_tags($_POST['dob']);
            $_COOKIE['dob'] = $dob;
            $userArray['dob'] = $dob;
        }
        if (empty(strip_tags($_POST['email']))) {
            $success = false;
        } else {
            $email = strip_tags($_POST['email']);
            $_COOKIE['email'] = $email;
            $userArray['email'] = $email;
        }
        if (empty(strip_tags($_POST['sexID']))) {
            $success = false;
        } else {
            $sexID = strip_tags($_POST['sexID']);
            $_COOKIE['sexID'] = $sexID;
            $userArray['sexID'] = $sexID;
        }
        if (!$success) return $success;
        else return $userArray;
    }