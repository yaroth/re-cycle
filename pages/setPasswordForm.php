<?php
    $targetURL = add_param($_SERVER['PHP_SELF'], "lang", getLang());
    $targetURL = add_param($targetURL, "id", getId());
?>
<h2><?php echo translate("set-password"); ?></h2>
<form action="<?php echo $targetURL ?>" method="post" name="create-account" onsubmit="return validateCreateAccount();">
    <fieldset>
        <legend><?php echo translate("personal-info") ?> :</legend>
        Login:<br> <input type="text" name="login" placeholder="Enter your login..." required><br>
        Password:<br> <input type="password" name="pw" placeholder="Enter your password..." required><br>
        <input type="submit">
    </fieldset>
</form>