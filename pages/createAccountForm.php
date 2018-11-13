<?php
    $targetURL = add_param($_SERVER['PHP_SELF'], "lang", getLang());
    $targetURL = add_param($targetURL, "id", getId());
?>
<h2><?php echo translate("create-account"); ?></h2>
<form action="<?php echo $targetURL ?>" method="post" name="create-account" onsubmit="return validateCreateAccount();">
    <fieldset>
        <legend><?php echo translate("personal-info") ?> :</legend>
        First Name : <br><input type="text" name="fname" placeholder="Bob" value="<?php echo $_COOKIE["fname"] ?? "";?>" autofocus required><br>
        Last Name :<br> <input type="text" name="lname" placeholder="Geldof" value="<?php echo $_COOKIE["lname"] ?? "";?>" required><br>
        <!--Address :<br> <input type="text" name="address" placeholder="Wasserweg 23" required><br>
        ZIP :<br> <input type="number" name="zip" placeholder="3006" required><br>
        City :<br> <input type="text" name="city" placeholder="Bern" required><br>
        Country :<br> <input type="text" name="coutry" placeholder="Schweiz" required><br>
        Phone :<br> <input type="tel" name="phone" placeholder="+41 79 123 45 67" required><br>
        E-mail : <br><input type="email" name="email" placeholder="Email" required><br>
        Birthday:<br> <input type="date" name="bday" placeholder="11.10.1989" required>-->
        Login:<br> <input type="text" name="login" placeholder="Enter your login..." required><br>
        Password:<br> <input type="password" name="pw" placeholder="Enter your password..." required><br>
        <input type="submit">
    </fieldset>
</form>