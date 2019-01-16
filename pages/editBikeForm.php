<?php
    $targetURL = add_param($_SERVER['PHP_SELF'], "lang", getLang());
    $targetURL = add_param($targetURL, "id", getId());
?>
<form action="<?php echo $targetURL ?>" method="post" name="editBike" enctype="multipart/form-data" onsubmit="return validateEditBike();">
    <fieldset>
        <legend><?php echo translate("bike-info") ?> :</legend>
        <?php echo translate("title") ?> : <br>
        <input type="text" name="title" placeholder="lightweight racing bike" value="<?php echo $_COOKIE["title"] ?? ""; ?>" autofocus required><br>
        <?php echo translate("description") ?>: <br> <textarea name="description" placeholder="Selling my blue & red men's racing bicycle..." rows="5" required><?php echo $_COOKIE["description"] ?? ""; ?></textarea><br>
        <?php echo translate("weight") ?> :<br>
        <input type="number" step="0.1" name="weight" placeholder="9.750" value="<?php echo $_COOKIE["weight"] ?? ""; ?>" required><br>
        <?php echo translate("price") ?> :<br>
        <input type="number" name="price" placeholder="1540" value="<?php echo $_COOKIE["price"] ?? ""; ?>" required><br>
        <?php echo translate("has-lights") ?> :<br>
        <input type="radio" name="hasLights" value="1" <?php echo getChecked("hasLights", "1") ?> required><?php echo translate("yes") ?><br>
        <input type="radio" name="hasLights" value="no" <?php echo getChecked("hasLights", "0") ?> required><?php echo translate("no") ?><br>

        <?php echo translate("has-gears") ?> :<br>
        <input type="radio" name="hasGears" value="1" <?php echo getChecked("hasGears", "1") ?> required><?php echo translate("yes") ?><br>
        <input type="radio" name="hasGears" value="no" <?php echo getChecked("hasGears", "0") ?> required><?php echo translate("no") ?><br>
        <?php echo translate("gear-type") ?>:<br>
        <input type="radio" name="gearTypeID" value="1" <?php echo getChecked("gearTypeID", "1") ?> required><?php echo translate("naben") ?><br>
        <input type="radio" name="gearTypeID" value="2" <?php echo getChecked("gearTypeID", "2") ?>required><?php echo translate("ketten") ?><br>
        <input type="radio" name="gearTypeID" value="3" <?php echo getChecked("gearTypeID", "3") ?>required><?php echo translate("rücktritt") ?><br>
        <input type="radio" name="gearTypeID" value="4" <?php echo getChecked("gearTypeID", "4") ?>required><?php echo translate("other") ?><br>
        <?php echo translate("speeds") ?>: <br>
        <input type="number" name="nbOfGears" placeholder="14" value="<?php echo $_COOKIE["nbOfGears"] ?? ""; ?>" required><br>
        <?php echo translate("wheel-size") ?> :<br>
        <input type="number" name="wheelSize" placeholder="28" value="<?php echo $_COOKIE["wheelSize"] ?? ""; ?>" required><br>
        <?php echo translate("brake-type") ?> :<br>
        <input type="radio" name="brakeTypeID" value="1" <?php echo getChecked("brakeTypeID", "1") ?> required><?php echo translate("felgen") ?><br>
        <input type="radio" name="brakeTypeID" value="2" <?php echo getChecked("brakeTypeID", "2") ?> required><?php echo translate("trommel") ?><br>
        <input type="radio" name="brakeTypeID" value="3" <?php echo getChecked("brakeTypeID", "3") ?> required><?php echo translate("scheiben") ?><br>
        <input type="radio" name="brakeTypeID" value="4" <?php echo getChecked("brakeTypeID", "4") ?> required><?php echo translate("rücktritt-bremse") ?><br>
        <input type="radio" name="brakeTypeID" value="5" <?php echo getChecked("brakeTypeID", "5") ?> required><?php echo translate("other") ?><br>
        <?php
            $imageName = $_COOKIE['imageName'];
            $ownerID = $_COOKIE["ownerID"];
            $bikeID = $_GET["bikeToEditID"];
            echo translate("current-image") . ':<br>';
            echo '<div class="current-img"><img src="../img/uploads/' . $imageName . '"></div>';
        ?>
        <?php echo translate("change-image") ?> : <br>
        <input type="file" name="upload"/><br>
        <input type="hidden" name="ownerID" value="<?php echo $ownerID ?>" >
        <button onclick="saveBike(<?php echo $bikeID; ?>);" type="button" value="<?php echo $bikeID; ?>"><?php echo translate("save") ?></button>
    </fieldset>
</form>
