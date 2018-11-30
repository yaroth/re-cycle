<?php
    require_once("../db/autoloader.php");
    $users = User::getUsers();
    echo '<div class="usersList">';
    foreach ($users as $user) {
        $userName = $user->getUserFullName();
        echo '<div class="user-wrapper">';
        echo '<div class="user id">' . $user->id . '</div>';
        echo '<div class="user name">' . $userName . '</div>';
        echo '<div class="user login">' . $user->login . '</div>';
        echo '<div class="user dob">' . $user->dob . '</div>';
        echo '<div class="user email">' . $user->email . '</div>';
        echo '<div class="user gender">' . $user->getGenderName() . '</div>';
        echo '<div class="user edit">
                <button onclick="deleteUser(this);" name="deleteUser" type="button" value="' . $user->id . '">Delete</button>
                <button onclick="editUser(this);" name="editUser" type="button" value="' . $user->id . '">Edit</button>
            </div>';
        echo '</div><!-- END user-wrapper-->';
    }
    echo '</div>';
?>