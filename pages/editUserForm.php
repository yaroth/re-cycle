<?php
    $targetURL = add_param($_SERVER['PHP_SELF'], "lang", getLang());
    $targetURL = add_param($targetURL, "id", getId());
?>
<form action="<?php echo $targetURL ?>" method="post" name="editUser" onsubmit="return validateEditUser();">
    <fieldset>
        <legend><?php echo translate("personal-info") ?> :</legend>
        First Name : <br><input type="text" name="fname" placeholder="Bob"
                                value="<?php echo $_COOKIE["fname"] ?? ""; ?>" autofocus required><br>
        Last Name :<br> <input type="text" name="lname" placeholder="Geldof"
                               value="<?php echo $_COOKIE["lname"] ?? ""; ?>" required><br>
        Gender :
        <br> <input type="radio" name="genderID" value="1" <?php echo getChecked("genderID", "1") ?> required>female
        <br> <input type="radio" name="genderID" value="2" <?php echo getChecked("genderID", "2") ?> required>male
        <br> <input type="radio" name="genderID" value="3" <?php echo getChecked("genderID", "3") ?> required>other<br>
        <!--TODO: update commented out fields-->
        <!--Address :<br> <input type="text" name="address" placeholder="Wasserweg 23" value="<?php /*echo $_COOKIE["address"] ?? "";*/ ?>" required><br>
        ZIP :<br> <input type="number" name="zip" placeholder="3006" value="<?php /*echo $_COOKIE["zip"] ?? "";*/ ?>" required><br>
        City :<br> <input type="text" name="city" placeholder="Bern" value="<?php /*echo $_COOKIE["city"] ?? "";*/ ?>" required><br>
        Country :<br> <input type="text" name="country" placeholder="Schweiz" value="<?php /*echo $_COOKIE["country"] ?? "";*/ ?>" required><br>
        Phone :<br> <input type="tel" name="phone" placeholder="+41 79 123 45 67" value="<?php /*echo $_COOKIE["phone"] ?? "";*/ ?>" required><br>-->
        E-mail : <br><input type="email" name="email" placeholder="john.bright@gbrake.com"
                            value="<?php echo $_COOKIE["email"] ?? ""; ?>" required><br>
        Birthday:<br> <input type="date" name="dob" placeholder="1974-01-31"
                             value="<?php echo $_COOKIE["dob"] ?? ""; ?>" required><br>

        <?php
            $userID = $_GET["userToEditID"];
        ?>
        <button onclick="saveUser(<?php echo $userID; ?>);" type="button" value="<?php echo $userID; ?>">Save</button>
    </fieldset>
</form>