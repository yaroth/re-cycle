<?php

?>
<form name="add-Query" onsubmit="return addQuery(event)">
    <fieldset>
        <legend>Add query</legend>
        Title : <br>
        <input type="text" name="title" placeholder="lightweight racing bike" autofocus required><br>

        Max. weight :<br>
        <input type="number" step="0.1" name="weight" placeholder="9.750"><br>

        Max. price :<br>
        <input type="number" name="price" placeholder="1540"><br>

        Lights required? <br>
        <input type="radio" name="hasLights" value="1">YES<br>
        <input type="radio" name="hasLights" value="no">NO<br>

        Gears required? <br>
        <input type="radio" name="hasGears" value="1">YES<br>
        <input type="radio" name="hasGears" value="no">NO, single speed<br>

        What gear type?<br>
        <select name="gearTypeID">
            <option value="1">Nabenschaltung</option>
            <option value="2">Kettenschaltung</option>
            <option value="3">Rücktritt</option>
            <option value="4" selected="selected">Andere</option>
        </select><br>

        How many gears? <br>
        <input type="number" name="nbOfGears" placeholder="14" ><br>

        What wheel size?<br>
        <input type="number" name="wheelSize" placeholder="28" ><br>

        What brake type?<br>
        <select name="brakeTypeID">
            <option value="1">Felgenbremsen</option>
            <option value="2">Trommelbremsen</option>
            <option value="3">Scheibenbremsen</option>
            <option value="4">Rücktritt</option>
            <option value="5" selected="selected">Andere</option>
        </select><br>

        <button type="submit">Add</button>
    </fieldset>
</form>