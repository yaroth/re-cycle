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
        $navItemsIndex = 2;
        if (isset($_SESSION["user"])) {
            $navItemsIndex = 8;
            $login = $_SESSION["user"];
            if (Account::isAdminByLogin($login)) $navItemsIndex = 9;
        }
        for ($i = 0; $i <= $navItemsIndex; $i++) {
            if (isset($_SESSION["user"]) && !($i == 1 || $i == 2)) {
                $url = add_param($urlbase, "id", $i);
                $class = $pageId == $i ? 'active' : 'inactive';
                echo '<li class="nav-item"><a class="' . $class . '" href="' . $url . '">' . navtitles('page', $i) . "</a></li>";
            }
            elseif (!isset($_SESSION["user"])) {
                $url = add_param($urlbase, "id", $i);
                $class = $pageId == $i ? 'active' : 'inactive';
                echo '<li class="nav-item"><a class="' . $class . '" href="' . $url . '">' . navtitles('page', $i) . "</a></li>";
            }
        }
    }

    function languages($language, $pageId) {
        echo '<ul>';
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
        echo '</ul>';
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
            'account created' => array(
                'de' => 'Konto erstellt! ',
                'fr' => 'Compte créé! ',
                'en' => 'Account created! '),
            'save' => array(
                'de' => 'Speichern',
                'fr' => 'Sauvegarder',
                'en' => 'Save'),
            'fname' => array(
                'de' => 'Vorname',
                'fr' => 'Prénom',
                'en' => 'First Name'),
            'lname' => array(
                'de' => 'Name',
                'fr' => 'Nom',
                'en' => 'Last Name'),
            'gender' => array(
                'de' => 'Geschlecht',
                'fr' => 'Sexe',
                'en' => 'Gender'),
            'success' => array(
                'de' => 'Erfolgreich! ',
                'fr' => 'Succès! ',
                'en' => 'Success! '),
            'welcome' => array(
                'de' => 'Willkommen ',
                'fr' => 'Bienvenu ',
                'en' => 'Welcome '),
            'no-query-defined' => array(
                'de' => 'Keine Suche erstellt: ',
                'fr' => 'Pas de recherche définie: ',
                'en' => 'No query defined: '),
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
            'sell-bicycle' => array(
                'de' => 'Neues Velo verkaufen',
                'fr' => 'Ajouter un vélo à vendre',
                'en' => 'Add a bicycle to sell'),
            'not-selling-bicycle' => array(
                'de' => 'Sie verkaufen noch kein eigenes Velo. ',
                'fr' => 'Vous ne vendez pas encore de vélo. ',
                'en' => 'Not yet selling your own bicycle. '),
            'add-query' => array(
                'de' => 'Neue Suche erfassen',
                'fr' => 'Ajouter une nouvelle recherche',
                'en' => 'Add a new query'),
            'edit-bicycle' => array(
                'de' => 'Velodaten ändern',
                'fr' => 'Modifier vélo',
                'en' => 'Modify bicycle'),
            'delete-bike-success' => array(
                'de' => 'Velo erfolgreich gelöscht.',
                'fr' => 'Vélo supprimé.',
                'en' => 'Bicycle successfully deleted.'),
            'update-bike-success' => array(
                'de' => 'Veloänderungen erfolgreich gespeichert.',
                'fr' => 'Données sauvegardées.',
                'en' => 'Bicycle successfully updated.'),
            'bike-info' => array(
                'de' => 'Velo Daten',
                'fr' => 'Données vélo',
                'en' => 'Bicycle data'),
            'title' => array(
                'de' => 'Titel',
                'fr' => 'Titre',
                'en' => 'Title'),
            'current-image' => array(
                'de' => 'Aktuelles Bild',
                'fr' => 'Image actuelle',
                'en' => 'Current image'),
            'image' => array(
                'de' => 'Bild',
                'fr' => 'Image',
                'en' => 'Image'),
            'change-image' => array(
                'de' => 'Bild ändern',
                'fr' => 'Changer d\'image',
                'en' => 'Change image'),
            'description' => array(
                'de' => 'Beschreibung',
                'fr' => 'Description',
                'en' => 'Description'),
            'price' => array(
                'de' => 'Preis',
                'fr' => 'Prix',
                'en' => 'Price'),
            'felgen' => array(
                'de' => 'Felgenbremsen',
                'fr' => 'freins de gentes',
                'en' => 'rim brakes'),
            'trommel' => array(
                'de' => 'Trommelbremsen',
                'fr' => 'frein à tambour',
                'en' => 'drum brake'),
            'scheiben' => array(
                'de' => 'Scheibenbremsen',
                'fr' => 'freins de disques',
                'en' => 'disc brakes'),
            'rücktritt-bremse' => array(
                'de' => 'Rücktrittbremsen',
                'fr' => 'frein à rétropédalage',
                'en' => 'coaster brake'),
            'rücktritt' => array(
                'de' => 'Rücktrittschaltung',
                'fr' => 'Vitesses à rétropédalage',
                'en' => 'coaster gears'),
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
            'myQueries' => array(
                'de' => 'Meine Suchen',
                'fr' => 'Mes recherches',
                'en' => 'My queries'),
            'query' => array(
                'de' => 'Suche',
                'fr' => 'Recherche',
                'en' => 'Query'),
            'queries' => array(
                'de' => 'Suchen',
                'fr' => 'Recherches',
                'en' => 'Queries'),
            'bicycles' => array(
                'de' => 'Velos',
                'fr' => 'Vélos',
                'en' => 'Bicycles'),
            'users' => array(
                'de' => 'Benutzer',
                'fr' => 'Utilisateurs',
                'en' => 'Users'),
            'accounts' => array(
                'de' => 'Konten',
                'fr' => 'Comptes',
                'en' => 'Accounts'),
            'no-matching-bike-found' => array(
                'de' => 'Sorry, kein Velo gefunden, das diesen Suchkriterien entspricht.',
                'fr' => 'Désolé, aucun vélo trouvé qui corresponde aux critères de recherche requis.',
                'en' => 'Sorry, no matching bicycle found.'),
            'create-account' => array(
                'de' => 'Konto erstellen ',
                'fr' => 'Créer un compte ',
                'en' => 'Create account '),
            'edit-account' => array(
                'de' => 'Meine Kontoangaben ändern',
                'fr' => 'Modifier mes données',
                'en' => 'Modify my data'),
            'edit' => array(
                'de' => 'Ändern',
                'fr' => 'Modifier',
                'en' => 'Edit'),
            'delete' => array(
                'de' => 'Löschen',
                'fr' => 'Supprimer',
                'en' => 'Delete'),
            'set-password' => array(
                'de' => 'Passwort ändern ',
                'fr' => 'Changer le mot de passe ',
                'en' => 'Change password '),
            'female' => array(
                'de' => 'weiblich',
                'fr' => 'féminin',
                'en' => 'female'),
            'male' => array(
                'de' => 'männlich',
                'fr' => 'mâle',
                'en' => 'male'),
            'dob' => array(
                'de' => 'Geburtsdatum',
                'fr' => 'Date de naissance',
                'en' => 'Date of Birth'),
            'pw' => array(
                'de' => 'Passwort',
                'fr' => 'Mot de passe',
                'en' => 'Password'),
            'send' => array(
                'de' => 'Senden',
                'fr' => 'Envoyer',
                'en' => 'Send'),
            'save-account' => array(
                'de' => 'Konto erstellen',
                'fr' => 'Créer compte',
                'en' => 'Create account'),
            'all-bikes' => array(
                'de' => 'Alle Velos',
                'fr' => 'Tous les vélos',
                'en' => 'All bicycles'),
            'matching-bikes' => array(
                'de' => 'Suchresultate',
                'fr' => 'Résultats',
                'en' => 'Search results'),
            'gear-type' => array(
                'de' => 'Schaltung',
                'fr' => 'Vitesse',
                'en' => 'Gear type'),
            'speeds' => array(
                'de' => 'Gänge',
                'fr' => 'Vitesses',
                'en' => 'Gears'),
            'brake-type' => array(
                'de' => 'Bremsen',
                'fr' => 'Freins',
                'en' => 'Brakes'),
            'wheel-size' => array(
                'de' => 'Radgrösse',
                'fr' => 'Taille roues',
                'en' => 'Wheel size'),
            'has-lights' => array(
                'de' => 'Licht?',
                'fr' => 'Lumières',
                'en' => 'Has lights?'),
            'has-gears' => array(
                'de' => 'Gänge?',
                'fr' => 'Vitesses',
                'en' => 'Has gears?'),
            'weight' => array(
                'de' => 'Gewicht',
                'fr' => 'Poids',
                'en' => 'Weight'),
            'owner' => array(
                'de' => 'Besitzer',
                'fr' => 'Propriétaire',
                'en' => 'Owner'),
            'yes' => array(
                'de' => 'Ja',
                'fr' => 'Oui',
                'en' => 'Yes'),
            'no' => array(
                'de' => 'Nein',
                'fr' => 'Non',
                'en' => 'No'),
            'buy' => array(
                'de' => 'Kaufen!',
                'fr' => 'Acheter!',
                'en' => 'Buy!'),
            'max-weight' => array(
                'de' => 'Max. Gewicht',
                'fr' => 'Poids max.',
                'en' => 'Max. weight'),
            'max-price' => array(
                'de' => 'Max. Preis',
                'fr' => 'Prix max.',
                'en' => 'Max. price'),
            'requires-lights' => array(
                'de' => 'Licht?',
                'fr' => 'Lumières?',
                'en' => 'Lights?'),
            'requires-gears' => array(
                'de' => 'Schaltung?',
                'fr' => 'Vitesses?',
                'en' => 'Gears?'),
            'required-gear-type' => array(
                'de' => 'Schaltung',
                'fr' => 'Vitesses',
                'en' => 'Gears'),
            'required-wheel-size' => array(
                'de' => 'Radgrösse',
                'fr' => 'Taille roues',
                'en' => 'Wheel size'),
            'required-brake-type' => array(
                'de' => 'Bremsen',
                'fr' => 'Freins',
                'en' => 'Brakes'),
            'min-speeds' => array(
                'de' => 'Min. Gänge',
                'fr' => 'Vitesses min.',
                'en' => 'Min. gears'),
            'present-pw' => array(
                'de' => 'Aktuelles Passwort',
                'fr' => 'Mot de passe actuel',
                'en' => 'Present password'),
            'new-pw' => array(
                'de' => 'Neues Passwort',
                'fr' => 'Mot de passe nouveau',
                'en' => 'New password'),
            'confirm-pw' => array(
                'de' => 'Passwort bestätigen',
                'fr' => 'Confirmer mot de passe',
                'en' => 'Confirm password'),
            'seller' => array(
                'de' => 'Verkäufer',
                'fr' => 'Vendeur',
                'en' => 'Seller'),
            'buyer' => array(
                'de' => 'Käufer',
                'fr' => 'Acheteur',
                'en' => 'Buyer'),
            'bike-sold' => array(
                'de' => 'Verkauftes Velo',
                'fr' => 'Vélo vendu',
                'en' => 'Sold bicycle'),
            'other' => array(
                'de' => 'andere',
                'fr' => 'autres',
                'en' => 'other')
        );
        return $texts[$key][$language] ?? "[?$key?][?$language?]";
    }

    function subtitle($id) {
        global $language;
        $subtitles = array(
            0 => array(
                'de' => 'Finde dein neues Secondhand Velo. Hier! Jetzt! Passend!',
                'fr' => "Ici tu trouveras ton vélo d'occase facilement!",
                'en' => 'Easily find your second hand bicycle!'),
            1 => array(
                'de' => 'Erstelle dein Konto',
                'fr' => 'Crées ton compte ',
                'en' => 'Create your account '),
            2 => array(
                'de' => 'Melde dich an. ',
                'fr' => 'Authentifies-toi ',
                'en' => 'Login '),
            3 => array(
                'de' => 'Meine Suchaufträge ',
                'fr' => 'Mes recherches ',
                'en' => 'My queries '),
            4 => array(
                'de' => 'Meine zum Verkauf stehenden Velos ',
                'fr' => 'Mes vélos à vendre ',
                'en' => 'My bicycles to sell '),
            5 => array(
                'de' => 'Meine Kontoangaben anpassen',
                'fr' => 'Changer mes données ',
                'en' => 'Change my account data '),
            6 => array(
                'de' => 'Mein Passwort anpassen ',
                'fr' => 'Changer mon mot de passe ',
                'en' => 'Change my password '),
            7 => array(
                'de' => 'Erfasse ein zu verkaufendes Velo',
                'fr' => 'Saisir un vélo à vendre',
                'en' => 'Add bicycle to sell'),
            8 => array(
                'de' => 'Erfasse eine neue Suche. Du kannst mehrere Suchen erfassen. So kannst du gezielt nach mehreren Velos suchen. ',
                'fr' => 'Saisis une recherche. Tu peux en saisir plusieurs, ainsi il est possible de rechercher plusieurs vélos à la fois.',
                'en' => 'Set your query. It is possible to define several queries, so that you can search for several kinds of bicycles at the same time. '),
            9 => array(
                'de' => 'Administratorbereich. Du kannst hier alle Benutzer, Velos, Suchen und Kontos bearbeiten. ',
                'fr' => 'Zone administrateur. Tu peux modifier tous les utilisateurs, vélo, recherches et comptes. ',
                'en' => 'Admin area. You can modify all users, bicycles, queries and accounts! '),
            10 => array(
                'de' => 'MVC',
                'fr' => 'MVC',
                'en' => 'MVC'),
        );
        return $subtitles[$id][$language] ?? "[?$id?][?$language?]";
    }

    function navtitles($key, $id) {
        global $language;
        $titles = array(
            'page' => array(
                'de' => array("Start", "Konto+", "Login", "Suchen", "Velos", "Konto", "Passwort", "Velo+", "Suche+", "Admin", "MVC"),
                'fr' => array("Départ", "Compte+", "Se loguer", "Recherches", "Vélos", "Compte", "Mot de passe", "Vélo+", "Recherche+", "Admin", "MVC"),
                'en' => array("Start", "Account+", "Login", "Queries", "Bikes", "Account", "Password", "Bike+", "Query+", "Admin", "MVC")
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

    function getSelected($name, $value) {
        $selected = NULL;
        if (isset($_COOKIE[$name]))
            if ($_COOKIE[$name] == $value) {
                $selected = 'selected="selected"';
                //TODO: this is not valid for all cases -> update!
            } elseif ($value == 1) $selected = 'selected="selected"';
        return $selected;
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

    function queryArrayFromPost() {
        $queryArray = array();
        if (!empty(strip_tags($_POST['title']))) {
            $title = strip_tags($_POST['title']);
            $_COOKIE['title'] = $title;
            $queryArray['title'] = $title;
        }
        if (!empty(strip_tags($_POST['weight']))) {
            $weight = strip_tags($_POST['weight']);
            $_COOKIE['weight'] = $weight;
            $queryArray['weight'] = $weight;
        }
        if (!empty(strip_tags($_POST['price']))) {
            $price = strip_tags($_POST['price']);
            $_COOKIE['price'] = $price;
            $queryArray['price'] = $price;
        }
        if (isset($_POST['hasLights']) && !empty(strip_tags($_POST['hasLights']))) {
            $hasLights = strip_tags($_POST['hasLights'] == 'no' ? '0' : '1');
            $_COOKIE['hasLights'] = $hasLights;
            $queryArray['hasLights'] = $hasLights;
        }
        if (isset($_POST['hasGears']) && !empty(strip_tags($_POST['hasGears']))) {
            $hasGears = strip_tags($_POST['hasGears'] == 'no' ? '0' : '1');
            $_COOKIE['hasGears'] = $hasGears;
            $queryArray['hasGears'] = $hasGears;
        }
        if (!empty(strip_tags($_POST['gearTypeID']))) {
            $gearType = strip_tags($_POST['gearTypeID']);
            $_COOKIE['gearTypeID'] = $gearType;
            $queryArray['gearTypeID'] = $gearType;
        }
        if (!empty(strip_tags($_POST['nbOfGears']))) {
            $nbOfGears = strip_tags($_POST['nbOfGears']);
            $_COOKIE['nbOfGears'] = $nbOfGears;
            $queryArray['nbOfGears'] = $nbOfGears;
        }
        if (!empty(strip_tags($_POST['wheelSize']))) {
            $wheelSize = strip_tags($_POST['wheelSize']);
            $_COOKIE['wheelSize'] = $wheelSize;
            $queryArray['wheelSize'] = $wheelSize;
        }
        if (!empty(strip_tags($_POST['brakeTypeID']))) {
            $brakeType = strip_tags($_POST['brakeTypeID']);
            $_COOKIE['brakeTypeID'] = $brakeType;
            $queryArray['brakeTypeID'] = $brakeType;
        }
        return $queryArray;
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
        if (empty(strip_tags($_POST['login']))) {
            $success = false;
        } else {
            $login = strip_tags($_POST['login']);
            $_COOKIE['login'] = $login;
            $userArray['login'] = $login;
        }
        if (empty(strip_tags($_POST['email']))) {
            $success = false;
        } else {
            $email = strip_tags($_POST['email']);
            $_COOKIE['email'] = $email;
            $userArray['email'] = $email;
        }
        if (empty(strip_tags($_POST['genderID']))) {
            $success = false;
        } else {
            $genderID = strip_tags($_POST['genderID']);
            $_COOKIE['genderID'] = $genderID;
            $userArray['genderID'] = $genderID;
        }
        // TODO: update this once all data can be saved in DB!
        // $postVar = ["address", "zip", "city", "country", "phone", ];

        if (!$success) return $success;
        else return $userArray;

    }
