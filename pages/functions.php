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
        for ($i = 0; $i <= 6; $i++) {
            $url = add_param($urlbase, "id", $i);
            $class = $pageId == $i ? 'active' : 'inactive';
            echo '<li class="nav-item"><a class="' . $class . '" href="' . $url . '">' . navtitles('page', $i) . "</a></li>";
        }
    }

    function languages($language, $pageId) {
        $languages = ['de', 'fr', 'en'];
        $urlbase = add_param($_SERVER['PHP_SELF'], 'id', $pageId);
        foreach ($languages as $l) {
            $class = $language == $l ? 'active' : 'inactive';
            echo '<li class="lang"><a class="' . $class . '" href="';
            echo add_param($urlbase, 'lang', $l) . '">';
            echo strtoupper($l) . '</a></li>';
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
                'fr' => 'protégé! ',
                'en' => 'Protected page! '),
            'personal-info' => array(
                'de' => 'Angaben ',
                'fr' => 'Données ',
                'en' => 'Personal information '),
            'add-bicycle' => array(
                'de' => 'Neues Velo erfassen',
                'fr' => 'Ajouter un nouveau vélo',
                'en' => 'Add a new bicycle'),
            'bike-info' => array(
                'de' => 'Velo Daten',
                'fr' => 'Données vélo',
                'en' => 'Bicycle data'),
            'set-password' => array(
                'de' => 'Passwort setzen ',
                'fr' => 'Définir le mot de passe ',
                'en' => 'Set password ')
        );
        return $texts[$key][$language] ?? "[$key][$language]";
    }

    function navtitles($key, $id) {
        global $language;
        $titles = array(
            'page' => array(
                'de' => array("Start", "Konto erstellen", "Login", "Velo", "geheim", "letzte Seite", "Velo hinzufügen"),
                'fr' => array("Départ", "S'enregistrer", "Se loguer", "Vélo", "protégé", "Dernière page", "Ajouter vélo"),
                'en' => array("Start", "Create account", "Login EN", "Bike", "login ONLY", "Last page", "Add bike")
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

    function checklogin($login, $password) {
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

    function getChecked($name, $value) {
        $checked = NULL;
        if (isset($_COOKIE[$name]))
            if ($_COOKIE[$name] == $value) {
                $checked = 'checked="checked"';

            } elseif ($value == 1) $checked = 'checked="checked"';
        return $checked;
    }