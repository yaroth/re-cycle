<form action="<?php echo $targetURL ?>" method="post" name="login" onsubmit="return validateLogin();">
    <fieldset>
        <legend>Login information:</legend>
        Login: <br><input type="text" name="login" placeholder="Login..." autofocus required><br>
        Password: <br><input type="password" name="pw" placeholder="Password..." required><br>
        <input type="submit">
    </fieldset>
</form>