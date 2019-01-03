<header class="header">
    <div class="logo"><a href="index.php"><img src="../img/logo.png"></a></div>
    <div class="page title">
        <h1>Re-cycle</h1>
        <h2><?php
                /*$language is used in 'translate(key)'*/
                $language = getLang();
                $id = getId();
                echo translate("welcome") . $id;
            ?>
        </h2>
    </div>
    <?php
        session_start();
        if (isset($_POST["login"]) && isset($_POST["pw"])) {
            $login = strip_tags($_POST["login"]);
            $pw = strip_tags($_POST["pw"]);
            if (Account::checklogin($login, $pw)) {
                $_SESSION["user"] = $login;
            }
        }
        include 'langUser.php';
        include 'navMobile.php';
    ?>

</header>