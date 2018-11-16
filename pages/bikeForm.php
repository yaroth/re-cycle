<?php
    $targetURL = add_param($_SERVER['PHP_SELF'], "lang", getLang());
    $targetURL = add_param($targetURL, "id", getId());
?>
<h2><?php echo translate("add-bicycle"); ?></h2>
<form action="<?php echo $targetURL ?>" method="post" name="add-bicycle" onsubmit="return validateAddBicycle();">
    <fieldset>
        <legend><?php echo translate("bike-info") ?> :</legend>
        Title : <br>
        <input type="text" name="title" placeholder="lightweight racing bike" value="<?php echo $_COOKIE["title"] ?? "";?>" autofocus required><br>
        Description: <br> <textarea name="description" placeholder="Selling my blue & red men's racing bicycle..." rows="5" value="<?php echo $_COOKIE["description"] ?? "";?>"></textarea><br>
        Weight :<br>
        <input type="number" step="0.1" name="weight" placeholder="9.750" value="<?php echo $_COOKIE["weight"] ?? "";?>" required><br>
        Price :<br>
        <input type="number" name="price" placeholder="1540" value="<?php echo $_COOKIE["price"] ?? "";?>" required><br>
        Has lights? :<br>
        <input type="radio" name="hasLights" value="1" checked="checked" required>YES<br>
        <input type="radio" name="hasLights" value="0" >NO<br>
        Has gears? :<br>
        <input type="radio" name="hasGears" value="1" checked="checked" required>YES<br>
        <input type="radio" name="hasGears" value="0" >NO, single speed<br>
        Gear Type:<br>
        <input type="radio" name="gearType" value="1" required>Nabenschaltung<br>
        <input type="radio" name="gearType" value="2" checked="checked">Kettenschaltung<br>
        <input type="radio" name="gearType" value="3" required>Rücktritt<br>
        <input type="radio" name="gearType" value="4" >Andere<br>
        Number of gears: <br>
        <input type="number" name="nbOfGears" placeholder="14" value="<?php echo $_COOKIE["nbOfGears"] ?? "";?>" required><br>
        Wheel size :<br>
        <input type="number" name="wheelSize" placeholder="28" value="<?php echo $_COOKIE["wheelSize"] ?? "";?>" required><br>
        Brake Type :<br>
        <input type="radio" name="brakeType" value="1" checked="checked" required>Felgenbremsen<br>
        <input type="radio" name="brakeType" value="2" >Trommelbremsen<br>
        <input type="radio" name="brakeType" value="3>" >Scheibenbremsen<br>
        <input type="radio" name="brakeType" value="4" >Rücktritt<br>
        <input type="radio" name="brakeType" value="5" >Andere<br>
        <input type="submit">
    </fieldset>
</form>