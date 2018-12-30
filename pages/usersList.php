<?php
    require_once("../db/autoloader.php");
    $users = User::getUsers();
    echo '<h4>Users list</h4>';
    echo '<div class="usersList">';
    echo '<div class="user-wrapper">
                <div class="user id">ID</div>
                <div class="user name">Name</div>
                <div class="user login">Login</div>
                <div class="user dob">Date of birth</div>
                <div class="user email">Email</div>
                <div class="user gender">Gender</div>
                <div class="buttonPlaceholder"></div>
                <div class="buttonPlaceholder"></div>
            </div>';
    foreach ($users as $user) {
        $userName = $user->getUserFullName();
        echo '<div class="user-wrapper">';
        echo '<div class="user id">' . $user->id . '</div>';
        echo '<div class="user name">' . $userName . '</div>';
        echo '<div class="user login">' . $user->login . '</div>';
        echo '<div class="user dob">' . $user->dob . '</div>';
        echo '<div class="user email">' . $user->email . '</div>';
        echo '<div class="user gender">' . $user->getGenderName() . '</div>';
        echo '<button onclick="deleteUser(this);" name="deleteUser" type="button" value="' . $user->id . '">Delete</button>
              <button onclick="editUser(this);" name="editUser" type="button" value="' . $user->id . '">Edit</button>';
        echo '</div>';
    }
    echo '</div>';
?>