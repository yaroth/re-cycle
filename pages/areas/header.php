<div class="header">
    <div class="logo"><a href="index.php"><img src="../img/logo.png"></a></div>
    <div class="page title">
        <h1>Re-cycle</h1>
        <h2><?php
                $language = $_GET["lang"];
                echo translate("welcome");
                echo $_GET["id"]; ?></h2>
    </div>
    <?php include 'navigation/nav.php' ?>
</div>