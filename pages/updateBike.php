<?php
    /**
     * Called using AJAX
     */
    require_once("../db/autoloader.php");
    session_start();
    if (isset($_SESSION["user"])) {
        $userLogin = $_SESSION["user"];
        $account = Account::getAccountByLogin($userLogin);
        if ($account->isAdminAccount()) {
            $bikeID = $_POST["bikeID"];
            $bike = Bicycle::getBicycleByID($bikeID);
            $imageName = $bike->imageName;

            if (isset($_FILES['files'])) {
                $file = $_FILES['files'];
                $imageName = $file['name'];
                // IF there IS an error...
                if ($file['error'] != 0) {
                    echo "Error uploading the image, please try again later";
                } else {
                    // validate the file: type, size, image size...
                    //TODO: check if same name file exists, in which case find another name > seems to be done automatically!
                    move_uploaded_file($file['tmp_name'], '../img/uploads/' . $file['name']);
                }
            }

            if ($bike !== false) {
                $bikeID = $_POST["bikeID"];
                $title = $_POST["title"];
                $description = $_POST["description"];
                $weight = $_POST["weight"];
                $price = $_POST["price"];
                $hasLights = $_POST["hasLights"];
                $hasGears = $_POST["hasGears"];
                $gearTypeID = $_POST["gearTypeID"];
                $nbOfGears = $_POST["nbOfGears"];
                $wheelSize = $_POST["wheelSize"];
                $brakeTypeID = $_POST["brakeTypeID"];
                $ownerID = $_POST["ownerID"];
                // will escape all the necessary properties > save to use!
                $bike->setProperties($title, $description, $imageName, $weight, $price, $hasLights, $hasGears, $gearTypeID, $nbOfGears, $wheelSize, $brakeTypeID, $ownerID);
                $bikeUpdateSuccess = $bike->saveBikeInDB();
                if ($bikeUpdateSuccess) echo "Successfully updated bicycle with ID '$bikeID'";
                else echo "ERROR. Could not save bicycle with ID '$bikeID'";
            } else echo "ERROR. Could not save bicycle with ID '$bikeID'";


        } else echo "ERROR. You are not an admin, sorry!";
    } else echo "session cookie 'user' not set!";