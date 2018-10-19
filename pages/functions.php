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
        for ($i = 0; $i <= 5; $i++) {
            $url = add_param($urlbase, "id", $i);
            $class = $pageId == $i ? 'active' : 'inactive';
            echo '<li class="nav-item"><a class="' . $class . '" href="' . $url . '">' . translate('nav-title') . "</a></li>";
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
            'personal-info' => array(
                'de' => 'Angaben ',
                'fr' => 'Données ',
                'en' => 'Personal information ')
        );
        return $texts[$key][$language] ?? "[$key][$language]";
    }

    function navtitles($key) {
        global $language;
        $titles = array(
            'page' => array(
                'de' => array("Start", "register", "Login"),
                'fr' => 'Page',
                'en' => 'Page')
        );
        return $titles[$key][$language] ?? "[$key][$language]";
    }

    function getLang(){
        if (!isset($_GET["lang"]))
            $language = 'de';
        else $language = $_GET["lang"];
        return $language;
    }
    function getId(){
        if (!isset($_GET["id"]))
            $id = 0;
        else $id = $_GET["id"];
        return $id;
    }