<?php
    $success = true;
    $fname = $lname = '';
    if ($_POST) {
        echo '<div class="account">';
        echo '<h2>' . translate("success") . '</h2>';
        if (empty($_POST['fname'])) {
            $success = false;
        } else $fname = $_POST['fname'];

        if (empty($_POST['lname'])) {
            $success = false;
        } else $lname = $_POST['lname'];
        if (!$success) {
            echo "<p>Something went wrong!</p>";
            exit;
        }
        echo '<h3>' . translate("welcome") . " " . $fname . " " . $lname . '!</h3>';
        echo '</div>';
    }
    else include 'createAccountForm.php';

