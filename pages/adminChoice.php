<?php
    $language = $_GET["lang"];
?>
<form id="admin-choice">
    <button onclick="adminSelection(this);" type="button" value="users"><?php echo translate("users")?></button>
    <button onclick="adminSelection(this);" type="button" value="bicycles"><?php echo translate("bicycles")?></button>
    <button onclick="adminSelection(this);" type="button" value="queries"><?php echo translate("queries")?></button>
    <button onclick="adminSelection(this);" type="button" value="accounts"><?php echo translate("accounts")?></button>
</form>