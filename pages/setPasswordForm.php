<?php
    $language = getLang();
?>
<form action="" method="post" name="setNewPassword" onsubmit="return validateNewPassword();">
    <fieldset>
        <legend><?php echo translate("personal-info") ?> :</legend>
        Login:<br> <input type="text" name="login" value="<?php echo $_SESSION["user"] ?? ""; ?>" required><br>
        <?php echo translate("present-pw") ?>: <br> <input type="password" name="pw" placeholder="old password..." required><br>
        <?php echo translate("new-pw") ?>: <br> <input type="password" name="newpw1" placeholder="new password..." required><br>
        <?php echo translate("confirm-pw") ?>:<br> <input type="password" name="newpw2" placeholder="confirm password..." required><br>
        <input type="submit" value="<?php echo translate('save') ?> ">
    </fieldset>
</form>