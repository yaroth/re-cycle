<?php

function get_param($name, $default)
{
    if (!isset($_GET[$name]))
        return $default;
    return urldecode($_GET[$name]);
}

function add_param($url, $name, $value)
{
    if (strpos($url, '?') !== false)
        $sep = '&';
    else
        $sep = '?';
    return $url . $sep . $name . "=" . urlencode($value);
}

function navigation($language, $pageId)
{
    $urlbase = add_param($_SERVER['PHP_SELF'], "lang", $language);
    for ($i = 0; $i <= 5; $i++) {
        $url = add_param($urlbase, "id", $i);
        $class = $pageId == $i ? 'active' : 'inactive';
        echo '<a class="' . $class . '" href="' . $url . '">' . t('page') . " $i</a>";
    }
}

function languages($language, $pageId)
{
    $languages = ['de', 'fr', 'en'];
    $urlbase = add_param($_SERVER['PHP_SELF'], 'id', $pageId);
    foreach ($languages as $l) {
        $class = $language == $l ? 'active' : 'inactive';
        echo '<a class="' . $class . '" href="';
        echo add_param($urlbase, 'lang', $l) . '">';
        echo strtoupper($l) . '</a>';
    }
}

function content($pageId) {
    echo t('content') . " $pageId";
}

function t($key) {
    global $language;
    $texts = array(
        'page' => array(
            'de'=>'Seite',
            'fr'=>'Page',
            'en'=>'Page' ),
        'content' => array(
            'de'=>'Willkommen auf der Seite ', 'fr'=>'Bienvenue `a la page ', 'en'=>'Welcome to the page '));
    return $texts[$key][$language] ?? "[$key]";
}