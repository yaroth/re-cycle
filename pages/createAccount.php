<h2><?php echo translate("create-account"); ?></h2>
<?php
    $targetURL = add_param($_SERVER['PHP_SELF'], "lang", getLang());
    $targetURL = add_param($targetURL, "id", "4");
    ?>
<form action="<?php echo $targetURL ?>" method="post" name="create-account" onsubmit="return validateCreateAccount();">
    <fieldset>
        <legend><?php echo translate("personal-info") ?> :</legend>
        First Name : <br><input type="text" name="fname" placeholder="Bob" autofocus required><br>
        Last Name :<br> <input type="text" name="lname" placeholder="Geldof" required><br>
        <!--Address :<br> <input type="text" name="address" placeholder="Wasserweg 23" required><br>
        ZIP :<br> <input type="number" name="zip" placeholder="3006" required><br>
        City :<br> <input type="text" name="city" placeholder="Bern" required><br>
        Country :<br> <input type="text" name="coutry" placeholder="Schweiz" required><br>
        Phone :<br> <input type="tel" name="phone" placeholder="+41 79 123 45 67" required><br>
        E-mail : <br><input type="email" name="email" placeholder="Email" required><br>
        Username:<br> <input type="text" name="username" placeholder="username" required><br>
        Password:<br> <input type="password" name="password" placeholder="password" required><br>
        Birthday:<br> <input type="date" name="bday" placeholder="11.10.1989" required>-->
        <input type="submit">
    </fieldset>
</form>
