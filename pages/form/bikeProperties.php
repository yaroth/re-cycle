<h2><?php echo translate("bike-specs"); ?></h2>
<form action="/action_page.php">
    <fieldset>
        <legend>Bike Data</legend>
        <legend>Select Gender</legend>
        <input type="radio" name="gender" value="male"/>Male<br/>
        <input type="radio" name="gender" value="female" checked="checked"/>Female<br/>
        <input type="radio" name="gender" value="child"/>Child<br/>
        <input type="radio" name="gender" value="other"/>Other<br/>
        <br>
        <br>
        <legend>Select wheel size</legend>
        <input type="radio" name="wheelsize" value="12"/>12"<br/>
        <input type="radio" name="wheelsize" value="24" />24"<br/>
        <input type="radio" name="wheelsize" value="26" />26"<br/>
        <input type="radio" name="wheelsize" value="28" checked="checked"/>28"<br/>
        <input type="radio" name="wheelsize" value="29"/>29"<br/>
        <input type="radio" name="wheelsize" value="other"/>Other<br/>
        <!--<br>
        <br>
        <legend>(Multi-) Select Brand</legend>
        <input type="checkbox" name="brand[]" value="BMC">BMC<br/>
        <input type="checkbox" name="brand[]" value="pulse">Pulse<br/>
        <input type="checkbox" name="brand[]" value="gerber">Gerber<br/>
        <input type="checkbox" name="brand[]" value="clio">Cilo<br/>
        <input type="checkbox" name="brand[]" value="mondia">Mondia<br/>
        <input type="checkbox" name="brand[]" value="specialized">Specialized<br/>
        <input type="checkbox" name="brand[]" value="cube">Cube<br/>-->
        <br>
        <br>
        <legend>Checkbox: Select Type</legend>
        <input type="checkbox" name="type[]" value="racing"/>Racing<br/>
        <input type="checkbox" name="type[]" value="touring"/>Touring<br/>
        <input type="checkbox" name="type[]" value="kids"/>Kids<br/>
        <br>
        <legend>SelectionList: one Color:</legend>
        <select name="color">
            <option value="green">Green</option>
            <option value="red">Red</option>
            <option value="black">Black</option>
            <option value="orange">Orange</option>
            <option value="blue" selected>Blue</option>
        </select>
        <br>
        <br>
        <legend>Comment</legend>
        <input type="text"/><br>
        <textarea>Please enter some text...</textarea>
        <br>
        <br>
        <legend>Password?</legend>
        <input type="password"/>
        <br>
        <br>
        <input type="submit" value="Submit">
    </fieldset>
</form>
<form action="/add_bike.php">
    <fieldset>
        <input type="button" value="Add Bicycle..."/>
    </fieldset>
</form>