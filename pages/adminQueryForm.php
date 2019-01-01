<?php
    /*
     * @var Query $query
     */
    function setChecked($propName, $value) {
        // $query MUST be declared, since it is used IN the function scope!
        global $query;
        $checked = NULL;
        if (isset($query->$propName)) {
            if ($query->$propName == $value) {
                $checked = 'checked="checked"';
                //TODO: this is not valid for all cases -> update!
            } elseif ($value == 1) $checked = 'checked="checked"';
        }
        return $checked;
    }

    function setSelected($propName, $value) {
        global $query;
        $selected = NULL;
        if (isset($query->$propName)){
            if ($query->$propName == $value) {
                $selected = 'selected="selected"';
                //TODO: this is not valid for all cases -> update!
            } elseif ($value == 1) $selected = 'selected="selected"';
        }

        return $selected;
    }
?>
<form name="editQuery" onsubmit="return saveQuery(event)">
    <input type="hidden" name="queryID" value="<?php echo $queryID; ?>">
    <fieldset>
        <legend>Query</legend>
        Title : <br>
        <input type="text" name="title" placeholder="lightweight racing bike" value="<?php echo $query->title ?? ""; ?>"
               autofocus required><br>

        Max. weight :<br>
        <input type="number" step="0.1" name="weight" placeholder="9.750"
               value="<?php echo $query->weight ?? ""; ?>"><br>

        Max. price :<br>
        <input type="number" name="price" placeholder="1540" value="<?php echo $query->price ?? ""; ?>"><br>

        Lights required? <br>
        <input type="radio" name="hasLights" value="1" <?php echo setChecked("hasLights", "1") ?> >YES<br>
        <input type="radio" name="hasLights" value="no" <?php echo setChecked("hasLights", "0") ?> >NO<br>

        Gears required? <br>
        <input type="radio" name="hasGears" value="1" <?php echo setChecked("hasGears", "1") ?> >YES<br>
        <input type="radio" name="hasGears" value="no" <?php echo setChecked("hasGears", "0") ?> >NO, single speed<br>

        What gear type?<br>
        <select name="gearTypeID">
            <option value="1" <?php echo setSelected("gearTypeID", "1") ?> >Nabenschaltung</option>
            <option value="2" <?php echo setSelected("gearTypeID", "2") ?> >Kettenschaltung</option>
            <option value="3" <?php echo setSelected("gearTypeID", "3") ?> >Rücktritt</option>
            <option value="4" <?php echo setSelected("gearTypeID", "4") ?> >Andere</option>
        </select><br>

        How many gears? <br>
        <input type="number" name="nbOfGears" placeholder="14" value="<?php echo $query->nbOfGears ?? ""; ?>"><br>

        What wheel size?<br>
        <input type="number" name="wheelSize" placeholder="28" value="<?php echo $query->wheelSize ?? ""; ?>"><br>

        What brake type?<br>
        <select name="brakeTypeID">
            <option value="1" <?php echo setSelected("brakeTypeID", "1") ?> >Felgenbremsen</option>
            <option value="2" <?php echo setSelected("brakeTypeID", "2") ?> >Trommelbremsen</option>
            <option value="3" <?php echo setSelected("brakeTypeID", "3") ?> >Scheibenbremsen</option>
            <option value="4" <?php echo setSelected("brakeTypeID", "4") ?> >Rücktritt</option>
            <option value="5" <?php echo setSelected("brakeTypeID", "5") ?> >Andere</option>
        </select><br>

        <input type="hidden" name="userID" value="<?php echo $query->userID ?? ""; ?>" required>
        <button type="submit">Save</button>
    </fieldset>
</form>