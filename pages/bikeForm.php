<?php
    $addOrEditBike = "";
    if (isset($_POST["bikeID"])) $addOrEditBike = "edit-bicycle";
    else $addOrEditBike = "add-bicycle";
?>
<form action="" method="post"
      name="<?php echo $addOrEditBike; ?>"
      enctype="multipart/form-data"
      onsubmit="return validateAddBicycle();">
    <fieldset>
        <legend><?php echo translate("bike-info") ?> :</legend>
        Title : <br>
        <input type="text" name="title" placeholder="lightweight racing bike"
               value="<?php echo $_COOKIE["title"] ?? ""; ?>" autofocus required><br>
        Description: <br> <textarea name="description" placeholder="Selling my blue & red men's racing bicycle..."
                                    rows="5" required><?php echo $_COOKIE["description"] ?? ""; ?></textarea><br>
        Weight :<br>
        <input type="number" step="0.1" name="weight" placeholder="9.750"
               value="<?php echo $_COOKIE["weight"] ?? ""; ?>" required><br>
        Price :<br>
        <input type="number" name="price" placeholder="1540" value="<?php echo $_COOKIE["price"] ?? ""; ?>"
               required><br>
        Has lights? :<br>
        <input type="radio" name="hasLights" value="1" <?php echo getChecked("hasLights", "1") ?> required>YES<br>
        <input type="radio" name="hasLights" value="no" <?php echo getChecked("hasLights", "0") ?> required>NO<br>

        Has gears? :<br>
        <input type="radio" name="hasGears" value="1" <?php echo getChecked("hasGears", "1") ?> required>YES<br>
        <input type="radio" name="hasGears" value="no" <?php echo getChecked("hasGears", "0") ?> required>NO, single
        speed<br>
        Gear Type:<br>
        <input type="radio" name="gearTypeID" value="1" <?php echo getChecked("gearTypeID", "1") ?> required>Nabenschaltung<br>
        <input type="radio" name="gearTypeID" value="2" <?php echo getChecked("gearTypeID", "2") ?>required>Kettenschaltung<br>
        <input type="radio" name="gearTypeID" value="3" <?php echo getChecked("gearTypeID", "3") ?>required>Rücktritt<br>
        <input type="radio" name="gearTypeID" value="4" <?php echo getChecked("gearTypeID", "4") ?>required>Andere<br>
        Number of gears: <br>
        <input type="number" name="nbOfGears" placeholder="14" value="<?php echo $_COOKIE["nbOfGears"] ?? ""; ?>" required><br>
        Wheel size :<br>
        <input type="number" name="wheelSize" placeholder="28" value="<?php echo $_COOKIE["wheelSize"] ?? ""; ?>" required><br>
        Brake Type :<br>
        <input type="radio" name="brakeTypeID" value="1" <?php echo getChecked("brakeTypeID", "1") ?> required>Felgenbremsen<br>
        <input type="radio" name="brakeTypeID" value="2" <?php echo getChecked("brakeTypeID", "2") ?> required>Trommelbremsen<br>
        <input type="radio" name="brakeTypeID" value="3" <?php echo getChecked("brakeTypeID", "3") ?> required>Scheibenbremsen<br>
        <input type="radio" name="brakeTypeID" value="4" <?php echo getChecked("brakeTypeID", "4") ?> required>Rücktritt<br>
        <input type="radio" name="brakeTypeID" value="5" <?php echo getChecked("brakeTypeID", "5") ?> required>Andere<br>
        <?php
            if ($addOrEditBike == "edit-bicycle"){
                $imageName = $_COOKIE['imageName'];
                $bikeID = $_COOKIE["id"];
                echo 'Current image: <br>';
                echo '<div class="current-img"><img src="../img/uploads/' . $imageName . '"></div>';
                echo '<input type="hidden" name="saveBikeID" value="' . $bikeID .'" ><br>';
            }
        ?>
        Image : <br>
        <input type="file" name="upload"/><br>
        <input type="submit" value="<?php echo translate("save")?>">
    </fieldset>
</form>