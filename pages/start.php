<h2><?php echo translate("results"); ?></h2>
<?php include '../data/bikes.php'; ?>

    <?php
        if (isset($_SESSION["user"])) {
            echo '<button onclick="listBikes(this);" type="button" value="all">List all bikes</button>';
            echo '<button onclick="listBikes(this);" type="button" value="matching">List matching bikes</button>';
            echo '<div id="items-wrapper" class="items">';
        } else {
            // TODO: add explanation that all bikes are listed. If only matching bikes required to be
            // TODO: viewed > login, choose matching bikes
            echo '<div id="items-wrapper" class="items">';
            listBicycles();
        }
    ?>
</div>
