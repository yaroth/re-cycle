<h2><?php echo translate("results"); ?></h2>
<?php include '../data/bikes.php'; ?>
<div class="items">
    <?php
        if (isset($_SESSION["user"])) echo "Startpage: list of query matching bicycles!";
        else listBicycles();
    ?>
</div>
