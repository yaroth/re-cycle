<?php
    $targetURL = add_param($_SERVER['PHP_SELF'], "lang", getLang());
    $targetURL = add_param($targetURL, "id", getId());
?>
<h2><?php echo translate("add-bicycle"); ?></h2>
<form action="<?php echo $targetURL ?>" method="post" name="add-bicycle" onsubmit="return validateAddBicycle();">
    <fieldset>
        <legend><?php echo translate("bike-info") ?> :</legend>
        Title : <br><input type="text" name="title" placeholder="Great cycling bike" value="<?php echo $_COOKIE["title"] ?? "";?>" autofocus required><br>
        Weight :<br> <input type="number" name="weight" placeholder="9.750" value="<?php echo $_COOKIE["weight"] ?? "";?>" required><br>
        Price :<br> <input type="number" name="price" placeholder="1540" value="<?php echo $_COOKIE["price"] ?? "";?>" required><br>
        Has lights? :<br> <input type="radio" name="hasLights" value="1" checked="checked">YES<br>
        <input type="radio" name="hasLights" value="0" >NO<br>
        Has gears? :<br> <input type="radio" name="hasGears" value="1" checked="checked">YES<br>
        <input type="radio" name="hasGears" value="0" >NO<br>
        Gear Type:<br> <input type="radio" name="gearType" value="naben" >Nabenschaltung<br>
        <input type="radio" name="gearType" value="ketten" checked="checked">Kettenschaltung<br>
        Number of gears: <br><input type="number" name="nbOfGears" placeholder="14" value="<?php echo $_COOKIE["nbOfGears"] ?? "";?>" ><br>
        Wheel size :<br> <input type="number" name="wheelSize" placeholder="28" value="<?php echo $_COOKIE["wheelSize"] ?? "";?>" required><br>
        Brake Type :<br> <input type="radio" name="brakeType" value="rim" checked="checked">Felgenbremsen<br>
        <input type="radio" name="brakeType" value="scheiben>" >Scheibenbremsen<br>
        <input type="radio" name="brakeType" value="trommel" >Trommelbremsen<br>
        <input type="submit">
    </fieldset>
</form>