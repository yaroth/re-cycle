<!DOCTYPE html>
<html>
<body>
<form action="/action_page.php">
    <fieldset>
        <legend> SelectGender</legend>
        <select name="gender" size="2" multiple>
            <option value="female">Female</option>
            <option value="child">Child</option>
            <option value="male">Male</option>
        </select>
    </fieldset>
    <br>
    <br>
    <fieldset>
        <legend>Select Brand</legend>
        <select name="mark" size="4" multiple>
            <option value="BMC">BMC</option>
            <option value="pulse">Pulse</option>
            <option value="gerber">Gerber</option>
            <option value="clio">Cilo</option>
            <option value="mondia">Mondia</option>
            <option value="specialized">Specialized</option>
            <option value="cube">Cube</option>
        </select>
    </fieldset>
    <br>
    <br>
    <fieldset>
        <legend>Select Type</legend>
        <select name="type" size="1" multiple>
            <option value="race">Race Bike</option>
            <option value="mountain">Mountain Bike</option>
            <option value="touring">Touring Bike</option>
            <option value="classic">Classic Bike</option>

        </select>
    </fieldset>
    <br>
    <br>
    <input type="submit">
</form>
</body>
</html>
