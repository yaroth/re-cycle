<form action="welcome.php" method="post" name="p-data" onsubmit="return validateLogin();">
    <fieldset>
        <legend>Login information:</legend>
        Name: <br><input type="text" name="name" value="" placeholder="Name" autofocus required><br>
        E-mail: <br><input type="text" name="email" value="" placeholder="Email" required><br>
        <input type="submit">
    </fieldset>
</form>
