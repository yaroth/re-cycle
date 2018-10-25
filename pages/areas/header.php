<div class="header">
<!--    TODO: function to get pictures in img folder-->
    <div class="logo"><a href="index.php"><img src="../../img/logo.png"></a></div>
    <div class="page title">
        <h1>Re-cycle</h1>
        <h2><?php
                $language = getLang();
                $id = getId();
                echo translate("welcome");
                echo $id; ?>
        </h2>
    </div>
    <?php include 'navigation/nav.php' ?>
</div>