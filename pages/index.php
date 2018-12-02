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
        } elseif (getId() == 4) {
            include 'myQueries.php';
        } elseif (getId() == 5) {
            include 'setpassword.php';
        } elseif (getId() == 6) {
            include 'addBike.php';
        } elseif (getId() == 7) {
            include 'myBikes.php';
        } elseif (getId() == 8) {
            include 'myAccount.php';
        } elseif (getId() == 9) {
            include 'admin.php';
        }


    ?>



</div><!--end main-->
<div class="footer">footer</div>
</body>
</html>
