<<<<<<< HEAD
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
=======
<?php include '../functions.php';
    $language = getLang();
    $id = getId(); ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="../../styles/css/styles.css"/>
    <script type="text/javascript" src="../../scripts/main.js"></script>
    <?php $pageTitle = "homYe" ?>
    <title>Re-cycle</title>
</head>

<body>
<?php include '../areas/header.php'; ?>
<div class="main">
    <form action="welcome.php" method="post">
        <fieldset>
            <legend><?php echo translate("personal-info") ?> :</legend>
            Name : <br><input type="text" name="name"><br>
            Surname :<br> <input type="text" name="surname"><br>
            Username:<br> <input type="text" name="username"><br>
            Password:<br> <input type="text" name="password"><br>
            E-mail : <br><input type="text" name="email"><br>
            Gender :<br>
            <input type="radio" name="gender" value="male" checked> Male<br>
            <input type="radio" name="gender" value="female"> Female<br>
            <input type="radio" name="gender" value="other"> Other<br>

            Birthday:<br> <input type="date" name="bday">
            <input type="submit">
        </fieldset>
    </form>

>>>>>>> b2ac21301203f574a8d5478bef9d24a9dede432f

</div>
<div class="footer">footer</div>
</body>
</html>
