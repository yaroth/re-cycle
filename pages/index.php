<?php
    include "functions.php";
    require_once "../db/db.inc.php";
?>

<!DOCTYPE html>
<html lang="<?php echo getLang() ?>">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../styles/css/styles.css"/>
    <script type="text/javascript" src="../scripts/main.js"></script>
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

        $users = $db->query("SELECT * FROM users;");
        $sexes = $db->query("SELECT * FROM sexes;");
        $sexesArray = array();
        while ($sexItem = $sexes->fetch_assoc()) {
            $sexesArray[$sexItem["id"]] = $sexItem["name"];
        }
        while ($user = $users->fetch_assoc()) {
            $userSexID = $user["sexID"];
            echo $user["firstname"] . " " . $user["lastname"] . " is of sex: " . $sexesArray[$userSexID] . "<br>";
        }

        $users->close();
        $db->close();
    ?>

</div><!--end main-->
<div class="footer">footer</div>
</body>
</html>
