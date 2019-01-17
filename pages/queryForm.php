<?php
    /*
     * @var Query $query
     */
    function setChecked($query, $propName, $value) {
        // $query MUST be declared, since it is used IN the function scope!
//        global $query;
        $checked = null;
        if (isset($query->$propName)) {
            if ($query->$propName == $value) {
                $checked = 'checked="checked"';
                //TODO: this is not valid for all cases -> update!
            } elseif ($value == 1) $checked = 'checked="checked"';
            return $checked;
        }
    }

    function setSelected($query, $propName, $value) {
        $selected = null;
        if (isset($query->$propName)) {
            if ($query->$propName == $value) {
                $selected = 'selected="selected"';
                //TODO: this is not valid for all cases -> update!
            } elseif ($value == 1) $selected = 'selected="selected"';
        }

        return $selected;
    }

    $language = $_GET["lang"];

?>
<form action="" method="post" enctype="multipart/form-data">
    <input type="hidden" name="saveQueryID" value="<?php echo $query->id ?>" required>
    <fieldset>
        <legend><?php echo translate("query") ?></legend>
        <?php echo translate("title") ?> : <br>
        <input type="text" name="title" placeholder="lightweight racing bike" value="<?php echo $query->title ?? ""; ?>"
               autofocus required><br>
        <?php echo translate("max-weight") ?> :<br>
        <input type="number" step="0.1" name="weight" placeholder="9.750"
               value="<?php echo $query->weight ?? ""; ?>"><br>

        <?php echo translate("max-price") ?> :<br>
        <input type="number" name="price" placeholder="1540" value="<?php echo $query->price ?? ""; ?>"><br>

        <?php echo translate("requires-lights") ?> <br>
        <input type="radio" name="hasLights"
               value="1" <?php echo setChecked($query, "hasLights", "1") ?> ><?php echo translate("yes") ?><br>
        <input type="radio" name="hasLights"
               value="no" <?php echo setChecked($query, "hasLights", "0") ?> ><?php echo translate("no") ?><br>

        <?php echo translate("requires-gears") ?> <br>
        <input type="radio" name="hasGears"
               value="1" <?php echo setChecked($query, "hasGears", "1") ?> ><?php echo translate("yes") ?><br>
        <input type="radio" name="hasGears"
               value="no" <?php echo setChecked($query, "hasGears", "0") ?> ><?php echo translate("no") ?><br>

        <?php echo translate("required-gear-type") ?><br>
        <select name="gearTypeID">
            <option value="1" <?php echo setSelected($query, "gearTypeID", "1") ?> ><?php echo translate("naben") ?></option>
            <option value="2" <?php echo setSelected($query, "gearTypeID", "2") ?> ><?php echo translate("ketten") ?></option>
            <option value="3" <?php echo setSelected($query, "gearTypeID", "3") ?> ><?php echo translate("rücktritt") ?></option>
            <option value="4" <?php echo setSelected($query, "gearTypeID", "4") ?> ><?php echo translate("other") ?></option>
        </select><br>

        <?php echo translate("min-speeds") ?> <br>
        <input type="number" name="nbOfGears" placeholder="14" value="<?php echo $query->nbOfGears ?? ""; ?>"><br>

        <?php echo translate("required-wheel-size") ?><br>
        <input type="number" name="wheelSize" placeholder="28" value="<?php echo $query->wheelSize ?? ""; ?>"><br>

        <?php echo translate("required-brake-type") ?><br>
        <select name="brakeTypeID">
            <option value="1" <?php echo setSelected($query, "brakeTypeID", "1") ?> ><?php echo translate("felgen") ?></option>
            <option value="2" <?php echo setSelected($query, "brakeTypeID", "2") ?> ><?php echo translate("trommel") ?></option>
            <option value="3" <?php echo setSelected($query, "brakeTypeID", "3") ?> ><?php echo translate("scheiben") ?></option>
            <option value="4" <?php echo setSelected($query, "brakeTypeID", "4") ?> ><?php echo translate("rücktritt-bremse") ?></option>
            <option value="5" <?php echo setSelected($query, "brakeTypeID", "5") ?> ><?php echo translate("other") ?></option>
        </select><br>

        <button type="submit" name="action" value="saveQuery"><?php echo translate("save") ?></button>
    </fieldset>
</form>