<h2><?php echo translate("myBikes"); ?></h2>
<?php include '../data/bikes.php'; ?>
<div class="items">
    <?php
        if (isset($_SESSION["user"])) {
            $login = $_SESSION["user"];
            if (isset($_POST["bikeID"])) {
                $bikeID = $_POST["bikeID"];
                listBikeByID($bikeID);
            } elseif (isset($_POST["saveBikeID"])) {
                $bikeID = $_POST["saveBikeID"];
                $bikeArray = bikeArrayFromPost();
                $bikeArray["id"] = $bikeID;
                $bikeArray["ownerID"] = User::getUserIDByLogin($login);
//                $success = ($bikeArray !== false);
                $updatedBikeInDB = Bicycle::updateBikeInDB($bikeArray);
                if ($updatedBikeInDB) {
                    echo '<h2>' . translate("success") . '</h2>';
                    echo "<h3>Successfully updated your bicycle.</h3>";
                } else {
                    echo '<h2>' . translate("error") . '</h2>';
                    echo "<h3>Could NOT update bicycle!</h3>";
                    listBikeByID($bikeID);
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
