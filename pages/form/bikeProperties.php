<h2><?php echo translate("bike-specs"); ?></h2>
<form action="/action_page.php">
    <fieldset>
        <legend>Bike Data</legend>
        <h4>Select Gender</h4>
        <input type="radio" name="gender" value="male"/>Male<br/>
        <input type="radio" name="gender" value="female" checked="checked"/>Female<br/>
        <input type="radio" name="gender" value="child"/>Child<br/>
        <input type="radio" name="gender" value="other"/>Other<br/>
        <br>
        <br>
        <h4>Select wheel size</h4>
        <input type="radio" name="wheelsize" value="12"/>12"<br/>
        <input type="radio" name="wheelsize" value="24" />24"<br/>
        <input type="radio" name="wheelsize" value="26" />26"<br/>
        <input type="radio" name="wheelsize" value="28" checked="checked"/>28"<br/>
        <input type="radio" name="wheelsize" value="29"/>29"<br/>
        <input type="radio" name="wheelsize" value="other"/>Other<br/>
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
        <?php include '../upload/uploadFile.php' ?>
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