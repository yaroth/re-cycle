<h2><?php echo translate("results"); ?></h2>
<?php include '../data/bikes.php'; ?>

    <?php
        if (isset($_SESSION["user"])) {
            echo '<button onclick="listBikes(this);" type="button" value="all">' . translate("all-bikes") . '</button>';
            echo '<button onclick="listBikes(this);" type="button" value="matching">' . translate("matching-bikes") . '</button>';
            echo '<div id="bikes-wrapper" >';
        } else {
            echo '<div id="items-wrapper" class="items">';
            listBicycles(null);
        }
    ?>
</div>
