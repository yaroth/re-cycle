<h2>Your match!</h2>
<?php include 'components/userInfo.php' ?>
<?php include 'components/breadcrumb.php' ?>

<?php include 'form/loginButton.php'; ?>
<?php include 'form/createAccountButton.php' ?>
<?php include 'form/bikePropertiesButton.php' ?>
<?php include '../upload/uploadFile.php' ?>

<?php include '../data/bikes.php'; ?>
<div class="items">
    <?php listProducts(); ?>
</div>