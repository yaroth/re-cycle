<?php
    include_once "functions.php";
    require_once("../db/autoloader.php");
?>

<!DOCTYPE html>
<html lang="<?php echo getLang() ?>">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../styles/css/styles.css"/>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script type="text/javascript" src="../scripts/main.js"></script>
    <title>Re-cycle</title>
</head>
<body>
<div class="content">
    <?php include 'header.php'; ?>
    <?php include 'navigation.php'; ?>
    <div class="main">
        <?php
            if (getId() == 0) {
                include 'start.php';
            } elseif (getId() == 1) {
                include 'createAccount.php';
            } elseif (getId() == 2) {
                include 'login.php';
            } elseif (getId() == 3) {
                include 'myQueries.php';
            } elseif (getId() == 4) {
                include 'myBikes.php';
            } elseif (getId() == 5) {
                include 'myAccount.php';
            } elseif (getId() == 6) {
                include 'setpassword.php';
            } elseif (getId() == 7) {
                include 'addBike.php';
            } elseif (getId() == 8) {
                include 'addQuery.php';
            } elseif (getId() == 9) {
                include 'admin.php';
            } elseif (getId() == 10) {
                include 'mvc.php';
            }


        ?>


    </div><!--end main-->
    <div class="footer">
        <div class="general">
            <div class="logo"><a href="index.php?id=0&lang=<?php echo getLang() ?>"><img src="../img/logo.png"></a></div>
            <div class="impressum">
                <p>recycle.ch</p>
                <p>Wasserweg 7</p>
                <p>3012 Bern</p>
            </div>
        </div>
    </div>
</div>

</body>
</html>
