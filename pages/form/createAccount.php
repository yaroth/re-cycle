<html>
<body>

<form action="welcome.php" method="post">
  <fieldset>
   <legend>Personal information:</legend>
Name : <br><input type="text" name="name"><br>
Surname :<br> <input type="text" name="surname"><br>
Username:<br> <input type="text" name="username"><br>
Password:<br> <input type="text" name="password"><br>
E-mail  : <br><input type="text" name="email"><br>
Gender  :<br>
<input type="radio" name="gender" value="male" checked> Male<br>
 <input type="radio" name="gender" value="female"> Female<br>
 <input type="radio" name="gender" value="other"> Other<br>

Birthday:<br>  <input type="date" name="bday">
<input type="submit">
</fieldset>
</form>

</body>
</html>
