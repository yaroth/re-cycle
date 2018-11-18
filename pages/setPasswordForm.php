<?php
    $targetURL = add_param($_SERVER['PHP_SELF'], "lang", getLang());
    $targetURL = add_param($targetURL, "id", getId());
?>
<h2><?php echo translate("set-password"); ?></h2>
<form action="<?php echo $targetURL ?>" method="post" name="setNewPassword" onsubmit="return validateNewPassword();">
    <fieldset>
        <legend><?php echo translate("personal-info") ?> :</legend>
        Login:<br> <input type="text" name="login" value="<?php echo $_SESSION["user"] ?? ""; ?>" required><br>
        Present Password:<br> <input type="password" name="pw" placeholder="old password..." required><br>
        New Password:<br> <input type="password" name="newpw1" placeholder="new password..." required><br>
        Confirm Password:<br> <input type="password" name="newpw2" placeholder="confirm password..." required><br>
        <input type="submit">
    </fieldset>
</form>