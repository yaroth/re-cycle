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
    <form action="welcome.php" method="post" name="p-data" onsubmit="return validateForm();">
        <fieldset>
            <legend><?php echo translate("personal-info") ?> :</legend>
            Name : <br><input type="text" name="name" placeholder="name" autofocus required><br>
            Surname :<br> <input type="text" name="surname" placeholder="surname" required><br>
            Username:<br> <input type="text" name="username" placeholder="username" required><br>
            Password:<br> <input type="password" name="password" placeholder="password" required><br>
            E-mail : <br><input type="text" name="email" placeholder="email" required><br>
            Gender :<br>
            <input type="radio" name="gender" value="male" checked> Male<br>
            <input type="radio" name="gender" value="female"> Female<br>
            <input type="radio" name="gender" value="other"> Other<br>

            Birthday:<br> <input type="date" name="bday" required>
            <input type="submit">
        </fieldset>
    </form>

</div>
<div class="footer">footer</div>
</body>
</html>
