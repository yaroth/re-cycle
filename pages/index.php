<?php
    include "functions.php";
    require_once "../db/db.inc.php";
    require_once("../db/autoloader.php");

?>

<!DOCTYPE html>
<html lang="<?php echo getLang() ?>">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../styles/css/styles.css"/>
    <script type="text/javascript" src="../scripts/main.js"></script>
    <!--TODO: what is that line?-->
    <?php $pageTitle = "homYe" ?>
    <title>Re-cycle</title>
</head>
<body>
<?php include 'header.php'; ?>
<div class="main">
    <?php
        if (getId() == 0) {
            include 'start.php';
        } elseif (getId() == 1) {
            include 'createAccount.php';
        } elseif (getId() == 2) {
            include 'login.php';
        } elseif (getId() == 3) {
            include 'bikeProperties.php';
        }

//        Get sexes in DB, put them in a sexes array
        $sexes = $db->query("SELECT * FROM sexes;");
        $sexesArray = array();
        while ($sexItem = $sexes->fetch_object("Sex")) {
            $sexesArray[$sexItem->id] = $sexItem->name;
        }

        // get users in DB and put them in an array
        $users = $db->query("SELECT * FROM users;");
        $usersArray = array();
        while ($user = $users->fetch_object("User")) {
            $user->setSexString($sexesArray[$user->sexID]);
            $usersArray[] = $user;
        }
        foreach ($usersArray as $u) echo $u . '<br>';

        $sexes->close();
        $users->close();
        $db->close();

    ?>

</div><!--end main-->
<div class="footer">footer</div>
</body>
</html>
