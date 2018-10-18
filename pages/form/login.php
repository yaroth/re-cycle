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

<<<<<<< HEAD
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
=======
<form action="welcome.php" method="post">
    <fieldset>
        <legend>Login information:</legend>
        Name: <br><input type="text" name="name" value="Name"><br>
        E-mail: <br><input type="text" name="email" value="Email"><br>
        <input type="submit">
    </fieldset>
>>>>>>> b2ac21301203f574a8d5478bef9d24a9dede432f
</form>

</body>
</html>
