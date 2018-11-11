<?php
    $success = true;
    $fname = $lname = '';
    if ($_POST) {
        echo '<div class="account">';
        echo '<h2>' . translate("success") . '</h2>';
        if (empty(strip_tags($_POST['fname']))) {
            $success = false;
        } else $fname = strip_tags($_POST['fname']);

        if (empty(strip_tags($_POST['lname']))) {
            $success = false;
        } else $lname = strip_tags($_POST['lname']);
        if (!$success) {
            echo "<p>Something went wrong!</p>";
            exit;
        }
        echo '<h3>' . translate("welcome") . " " . $fname . " " . $lname . '!</h3>';

        $user = new User();
        $user->addProperties($fname, $lname, "1968-12-04", "test@user.ch", 2);
        $addedToDB = USER::addUserToDB($user);
        if ($addedToDB) echo "<p> Successfully added $user->fname $user->lname to DB! </p>";
        else echo "<p> Could not add $user->fname $user->lname to DB! </p>";

        echo '</div>';
    } else include 'createAccountForm.php';

