<html>
<head>
  <script>
  function validateForm() {
  var form = document.forms["p-data"];
  var name = form["name"].value;
  if (!name) {
  alert("No valid name!");
  return false;
  }


  var surname = form["surname"].value;
  if (!surname) {
  alert("No valid surname!");
  return false;
  }

  var username = form["username"].value;
  if (!username) {
  alert("No valid username!");
  return false;
  }

  var password = form["password"].value;
  if (!password) {
  alert("No valid password!");
  return false;
  }


  var email = form["email"].value;
  var regex = /\S+@\S+\.\S+/;
  if (!regex.test(email)) {
  alert("No valid e-mail address!");
  return false;
  }
  return true;
  }

  </script>
</head>
<body>
  <style>
  input:focus {
      background-color: yellow;
  }
  </style>
<form action="welcome.php" method="post" name="p-data"
onsubmit="return validateForm();">
  <fieldset>
   <legend>Personal information:</legend>
Name : <br><input type="text" name="name" placeholder="name" autofocus required><br>
Surname :<br> <input type="text" name="surname" placeholder="surname" required><br>
Username:<br> <input type="text" name="username" placeholder="username" required><br>
Password:<br> <input type="password" name="password" placeholder="password" required><br>
E-mail  : <br><input type="text" name="email" placeholder="email" required><br>
Gender  :<br>
<input type="radio" name="gender" value="male" checked> Male<br>
 <input type="radio" name="gender" value="female"> Female<br>
 <input type="radio" name="gender" value="other"> Other<br>

Birthday:<br>  <input type="date" name="bday" required>
<input type="submit">
</fieldset>
</form>

</body>
</html>
