<?php
    if (isset($_FILES['upload'])) {
        $file = $_FILES['upload'];
        if ($file['error'] != 0) {
            echo "there is an error, please try again later";
        } else {
            // validate the file: type, size, image size...
            move_uploaded_file($file['tmp_name'], '/var/www/html/re-cycle/upload/uploads/' . $file['name']);
        }
    }
