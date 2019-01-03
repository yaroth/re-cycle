<h2><?php echo translate("myBikes"); ?></h2>
<?php include '../data/bikes.php'; ?>
    <?php
        if (isset($_SESSION["user"])) {
            $login = $_SESSION["user"];
            $user = User::getUserByLogin($login);
            // checking on submitted data
            if (isset($_POST["saveBikeID"])) {
                $bikeID = $_POST["saveBikeID"];
                // creates an array AND updates COOKIES
                $bikeArray = bikeArrayFromPost();
                // check that bike array returns a correct value!
                if ($bikeArray !== false) {
                    $bikeArray["id"] = $bikeID;
                    $bikeArray["ownerID"] = User::getUserIDByLogin($login);
                    $updatedBikeInDB = Bicycle::updateBikeInDB($bikeArray);
                    if ($updatedBikeInDB) {
                        echo '<h2>' . translate("success") . '</h2>';
                        echo "<h3>Successfully updated your bicycle data.</h3>";
                        echo '<div class="items">';
                        listBikesByUser($user);
                    } // TODO: should show POST data! Why????
                    else {
                        echo '<h2>' . translate("error") . '</h2>';
                        echo "<h3>Could NOT update bicycle data!</h3>";
                        echo '<div class="items">';
                        include 'bikeForm.php';
                    }
                } // TODO: should show POST data!
                else {
                    echo '<h2>' . translate("error") . '</h2>';
                    // TODO: Fix error handling! write to log file!
                    echo "<h3>Could NOT update bicycle data! </h3>";
                    echo '<div class="items">';
                    include 'bikeForm.php';
                }

            } else if (isset($_POST["bikeID"])) {
                $bikeID = $_POST["bikeID"];
                $action = $_POST['action'];
                if ($action == 'editBike') {
                    echo '<div class="editBike">';
                    listBikeByID($bikeID);
                } elseif ($action == 'deleteBike') {
                    //TODO: check if bikeByID exists!
                    $deleteBikeSuccess = Bicycle::deleteBikeByID($bikeID);
                    if ($deleteBikeSuccess) {
                        echo 'Successfully deleted your bicycle!';
                    } else {
                        echo '<error>Error, could not delete your bicycle.</error>';
                    }
                    echo '<div class="items">';
                    listBikesByUser($user);
                }

            } else {
                echo '<div class="items">';
                listBikesByUser($user);
            }
        } else {
            $lang = getLang();
            echo '<h2>' . translate("error") . '</h2>';
            echo '<h3>' . translate("sorry") . ', to view your bicycles you first need to <a href="index.php?lang=' . $lang . '&id=2">login</a>!</h3>';
            echo '<div class="items">';
        }
    ?>
</div>
