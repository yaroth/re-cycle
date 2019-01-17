<?php
    require_once("../db/autoloader.php");
    require_once("functions.php");
    $users = User::getUsers();
    $language = $_GET["language"];
    echo '<h4>'. translate("users") . '</h4>';
    echo '<div class="usersList">';
    /*echo '<div class="user-wrapper userHeader">
                <div class="user id">ID</div>
                <div class="user name">Name</div>
                <div class="user login">Login</div>
                <div class="user dob">Date of birth</div>
                <div class="user email">Email</div>
                <div class="user gender">Gender</div>
                <div class="buttonPlaceholder"></div>
                <div class="buttonPlaceholder"></div>
            </div>';*/
    $language = $_GET["language"];
    foreach ($users as $user) {
        $user->render($language);
    }
    echo '</div>';
?>