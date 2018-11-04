<?php
    const HOST = "localhost";
    const USER = "admin";
    // TODO set password in a non git file!
    const PW = "";
    const DB_NAME = "recycle";

    $db = new mysqli(HOST, USER, PW, DB_NAME);
    if ($db->connect_errno > 0)
        die("Unable to connect to database: " . $db->connect_error);
    if (!$db->set_charset("utf8"))
        die("Error loading character set utf8: " . $db->error);