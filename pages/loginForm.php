<?php
    $targetURL = add_param($_SERVER['PHP_SELF'], "lang", getLang());
    $targetURL = add_param($targetURL, "id", getId());
    $language = getLang();
?>
<form action="<?php echo $targetURL ?>" method="post" name="login" onsubmit="return validateLogin();">
    <fieldset>
        <legend>Login information:</legend>
        Login: <br><input type="text" name="login" placeholder="Login..." autofocus required><br>
        <?php echo translate("pw") ?>: <br><input type="password" name="pw" placeholder="Password..." required><br>
        <input type="submit" value="<?php echo translate("send") ?>">
    </fieldset>
</form>