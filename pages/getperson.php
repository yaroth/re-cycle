<?php
    $people = array(
        "alice" => array("fname" => "Alice", "lname" => "Won", "age" => "18"),
        "bob" => array("fname" => "Bob", "lname" => "Marley", "age" => "20")
    );
    header('Content-Type: application/json');
    echo json_encode($people[$_POST['nickname']]);

    /*TODO: delete class on end of project*/