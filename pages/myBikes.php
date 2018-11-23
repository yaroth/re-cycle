<h2><?php echo translate("myBikes"); ?></h2>
<?php include '../data/bikes.php'; ?>
<div class="items">
    <?php
        if (isset($_SESSION["user"])) {
            $login = $_SESSION["user"];
            // calling the one bike to edit -> takes DB data
            if (isset($_POST["bikeID"]) || isset($_GET["bikeID"])) {
                if (isset($_POST["bikeID"])) $bikeID = $_POST["bikeID"];
                elseif ((isset($_GET["bikeID"]))) $bikeID = $_GET["bikeID"];
                listBikeByID($bikeID);
            }
            // checking on submitted data
            elseif (isset($_POST["saveBikeID"])) {
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
                    }
                    // TODO: should show POST data!
                    else {
                        echo '<h2>' . translate("error") . '</h2>';
                        echo "<h3>Could NOT update bicycle data!</h3>";
                        include 'bikeForm.php';
                    }
                }
                // TODO: should show POST data!
                else {
                    echo '<h2>' . translate("error") . '</h2>';
                    // TODO: Fix error handling! write to log file!
                    echo "<h3>Could NOT update bicycle data! (bikeArray is false)</h3>";
                    include 'bikeForm.php';
                }
            } else {
                $user = User::getUserByLogin($login);
                listBikesByUser($user);
            }
        } else {
            $lang = getLang();
            echo '<h2>' . translate("error") . '</h2>';
            echo '<h3>' . translate("sorry") . ', to view your bicycles you first need to <a href="index.php?lang=' . $lang . '&id=2">login</a>!</h3>';
        }
    ?>
</div>
