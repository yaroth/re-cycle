<?php
    $model = new Model();
    $controller = new Controller($model);
    $view = new View($model);
    if (isset($_GET['action']))
        $controller->{$_GET['action']}();
    $view->render();
