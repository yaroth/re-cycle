<h2><?php echo translate("login"); ?></h2>
<form action="form/welcome.php" method="post" name="login" onsubmit="return validateLogin();">
    <fieldset>
        <legend>Login information:</legend>
        User name: <br><input type="text" name="username" value="" placeholder="User name" autofocus required><br>
        Password: <br><input type="password" name="password" value="" placeholder="Password" required><br>
        <input type="submit">
    </fieldset>
</form>
