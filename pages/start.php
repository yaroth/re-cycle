<h2><?php echo translate("results"); ?></h2>
<?php include '../data/bikes.php'; ?>
<div id="items-wrapper" class="items">
    <?php
        if (isset($_SESSION["user"])) {
            echo "<div>Startpage: list of query matching bicycles!</div>";
            echo '<button onclick="adminSelection(this);" type="button" value="allBikes">List all bikes</button>';
            echo '<button onclick="adminSelection(this);" type="button" value="matchingBikes">List matching bikes</button>';
        } else listBicycles();
    ?>
</div>
