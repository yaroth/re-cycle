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
<form action="welcome.php" method="post" name="p-data" onsubmit="return validateForm();">
  <fieldset>
   <legend>Login information:</legend>
Name: <br><input type="text" name="name" value="Name" placeholder="Name" autofocus required><br>
E-mail: <br><input type="text" name="email" value="Email" placeholder="email" required><br>
<input type="submit">
</fieldset>
</form>

</body>
</html>
