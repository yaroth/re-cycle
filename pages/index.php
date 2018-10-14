<?php
include "functions.php";
$language = get_param('lang', 'de');
$pageId = get_param('id', 0);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="../styles/css/styles.css"/>
    <script type="text/javascript" src="../scripts/main.js"></script>
    <?php $pageTitle = "homYe" ?>
    <title>Re-cycle</title>
</head>
<body>
<?php include 'areas/header.php';?>




<div class="main">
    <h2>Your match!</h2>
    <?php include 'components/userInfo.php' ?>
    <?php include 'components/breadcrumb.php' ?>

    <?php include 'form/loginButton.php'; ?>
   <?php  include 'form/createAccountButton.php' ?>

    <?php include '../data/bikes.php'; ?>
    <div class="items">
        <?php listProducts(); ?>
    </div>


</div>
<div class="footer">footer

</div>
</body>
</html>
