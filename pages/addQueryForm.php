<form name="add-Query" onsubmit="return addQuery(event)">
    <fieldset>
        <legend><?php echo translate("add-query") ?></legend>
        <?php echo translate("title") ?> : <br>
        <input type="text" name="title" placeholder="lightweight racing bike" autofocus required><br>

        <?php echo translate("max-weight") ?> :<br>
        <input type="number" step="0.1" name="weight" placeholder="9.750"><br>

        <?php echo translate("max-price") ?> :<br>
        <input type="number" name="price" placeholder="1540"><br>

        <?php echo translate("requires-lights") ?> <br>
        <input type="radio" name="hasLights" value="1"><?php echo translate("yes") ?><br>
        <input type="radio" name="hasLights" value="no"><?php echo translate("no") ?><br>

        <?php echo translate("requires-gears") ?> <br>
        <input type="radio" name="hasGears" value="1"><?php echo translate("yes") ?><br>
        <input type="radio" name="hasGears" value="no"><?php echo translate("no") ?><br>

        <?php echo translate("required-gear-type") ?><br>
        <select name="gearTypeID">
            <option value="1"><?php echo translate("naben") ?></option>
            <option value="2"><?php echo translate("ketten") ?></option>
            <option value="3"><?php echo translate("rücktritt") ?></option>
            <option value="4" selected="selected"><?php echo translate("other") ?></option>
        </select><br>

        <?php echo translate("min-speeds") ?> <br>
        <input type="number" name="nbOfGears" placeholder="14" ><br>

        <?php echo translate("required-wheel-size") ?><br>
        <input type="number" name="wheelSize" placeholder="28" ><br>

        <?php echo translate("required-brake-type") ?><br>
        <select name="brakeTypeID">
            <option value="1"><?php echo translate("felgen") ?></option>
            <option value="2"><?php echo translate("trommel") ?></option>
            <option value="3"><?php echo translate("scheiben") ?></option>
            <option value="4"><?php echo translate("rücktritt-bremse") ?></option>
            <option value="5" selected="selected"><?php echo translate("other") ?></option>
        </select><br>

        <button type="submit"><?php echo translate("save") ?></button>
    </fieldset>
</form>