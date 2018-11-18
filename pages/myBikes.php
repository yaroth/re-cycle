<h2><?php echo translate("myBikes"); ?></h2>
<?php include '../data/bikes.php'; ?>
<div class="items">
    <?php
        if (isset($_SESSION["user"])) {
            $login = $_SESSION["user"];
            $user = User::getUserByLogin($login);

            if (isset($_POST["bikeID"])){
                listBikeByID();
            } else listBikesByUser($user);
        }
        else {
            $lang = getLang();
            echo '<h2>' . translate("error") . '</h2>';
            echo '<h3>' . translate("sorry") . ', to view your bicycles you first need to <a href="index.php?lang=' . $lang . '&id=2">login</a>!</h3>';
        }
        ?>
</div>
