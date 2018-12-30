
<form name="editQuery" method="post" enctype="multipart/form-data">
    <fieldset>
        Title : <br>
        <input type="text" name="title" placeholder="lightweight racing bike" value="<?php echo $_COOKIE["title"] ?? ""; ?>" autofocus required><br>

        Max. weight :<br>
        <input type="number" step="0.1" name="weight" placeholder="9.750" value="<?php echo $_COOKIE["weight"] ?? ""; ?>"><br>

        Max. price :<br>
        <input type="number" name="price" placeholder="1540" value="<?php echo $_COOKIE["price"] ?? ""; ?>"><br>

       Lights required? <br>
        <input type="radio" name="hasLights" value="1" <?php echo getChecked("hasLights", "1") ?> >YES<br>
        <input type="radio" name="hasLights" value="no" <?php echo getChecked("hasLights", "0") ?> >NO<br>

        Gears required? <br>
        <input type="radio" name="hasGears" value="1" <?php echo getChecked("hasGears", "1") ?> >YES<br>
        <input type="radio" name="hasGears" value="no" <?php echo getChecked("hasGears", "0") ?> >NO, single speed<br>

        What gear type?<br>
        <select name="gearTypeID">
            <option value="1" <?php echo getSelected("gearTypeID", "1") ?> >Nabenschaltung</option>
            <option value="2" <?php echo getSelected("gearTypeID", "2") ?> >Kettenschaltung</option>
            <option value="3" <?php echo getSelected("gearTypeID", "3") ?> >Rücktritt</option>
            <option value="4" <?php echo getSelected("gearTypeID", "4") ?> >Andere</option>
        </select><br>

        How many gears? <br>
        <input type="number" name="nbOfGears" placeholder="14" value="<?php echo $_COOKIE["nbOfGears"] ?? ""; ?>" ><br>

        What wheel size?<br>
        <input type="number" name="wheelSize" placeholder="28" value="<?php echo $_COOKIE["wheelSize"] ?? ""; ?>" ><br>

        What brake type?<br>
        <select name="brakeTypeID">
            <option value="1" <?php echo getSelected("brakeTypeID", "1") ?> >Felgenbremsen</option>
            <option value="2" <?php echo getSelected("brakeTypeID", "2") ?> >Trommelbremsen</option>
            <option value="3" <?php echo getSelected("brakeTypeID", "3") ?> >Scheibenbremsen</option>
            <option value="4" <?php echo getSelected("brakeTypeID", "4") ?> >Rücktritt</option>
            <option value="5" <?php echo getSelected("brakeTypeID", "5") ?> >Andere</option>
        </select><br>

        <input type="hidden" name="userID" value="<?php echo $_COOKIE["userID"] ?? ""; ?>" required>
        <?php $queryID = $_COOKIE["id"]; ?>
        <button type="submit" onclick="saveQuery(this)" value="<?php echo $queryID ?>">Save</button>
    </fieldset>
</form>