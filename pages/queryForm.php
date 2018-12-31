<?php
    $targetURL = add_param($_SERVER['PHP_SELF'], "lang", getLang());
    $targetURL = add_param($targetURL, "id", getId());
    $queryID = $_COOKIE["id"];
?>
<form action="<?php echo $targetURL ?>" method="post" enctype="multipart/form-data">
    <fieldset>
        Title : <br>
        <input type="text" name="title" placeholder="lightweight racing bike" value="<?php echo $_COOKIE["title"] ?? ""; ?>" autofocus required><br>
        Max. weight :<br>
        <input type="number" step="0.1" name="weight" placeholder="9.750" value="<?php echo $_COOKIE["weight"] ?? ""; ?>"><br>
        Max. price :<br>
        <input type="number" name="price" placeholder="1540" value="<?php echo $_COOKIE["price"] ?? ""; ?>"><br>
        Does it require lights? <br>
        <input type="radio" name="hasLights" value="1" <?php echo getChecked("hasLights", "1") ?> >YES<br>
        <input type="radio" name="hasLights" value="no" <?php echo getChecked("hasLights", "0") ?> >NO<br>

        Does it require gears? <br>
        <input type="radio" name="hasGears" value="1" <?php echo getChecked("hasGears", "1") ?> >YES<br>
        <input type="radio" name="hasGears" value="no" <?php echo getChecked("hasGears", "0") ?> >NO, single speed<br>

        What gear type?<br>
        <input type="radio" name="gearTypeID" value="1" <?php echo getChecked("gearTypeID", "1") ?> >Nabenschaltung<br>
        <input type="radio" name="gearTypeID" value="2" <?php echo getChecked("gearTypeID", "2") ?> >Kettenschaltung<br>
        <input type="radio" name="gearTypeID" value="3" <?php echo getChecked("gearTypeID", "3") ?> >Rücktritt<br>
        <input type="radio" name="gearTypeID" value="4" <?php echo getChecked("gearTypeID", "4") ?> >Andere<br>

        How many gears? <br>
        <input type="number" name="nbOfGears" placeholder="14" value="<?php echo $_COOKIE["nbOfGears"] ?? ""; ?>"><br>

        What wheel size?<br>
        <input type="number" name="wheelSize" placeholder="28" value="<?php echo $_COOKIE["wheelSize"] ?? ""; ?>"><br>

        What brake type?<br>
        <input type="radio" name="brakeTypeID" value="1" <?php echo getChecked("brakeTypeID", "1") ?> >Felgenbremsen<br>
        <input type="radio" name="brakeTypeID" value="2" <?php echo getChecked("brakeTypeID", "2") ?> >Trommelbremsen<br>
        <input type="radio" name="brakeTypeID" value="3" <?php echo getChecked("brakeTypeID", "3") ?> >Scheibenbremsen<br>
        <input type="radio" name="brakeTypeID" value="4" <?php echo getChecked("brakeTypeID", "4") ?> >Rücktritt<br>
        <input type="radio" name="brakeTypeID" value="5" <?php echo getChecked("brakeTypeID", "5") ?> >Andere<br>

        <input type="hidden" name="saveQueryID" value="<?php echo $queryID ?>" required>
        <button type="submit" name="action" value="saveQuery">Save</button>
    </fieldset>
</form>