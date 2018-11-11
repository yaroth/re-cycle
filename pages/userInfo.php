<?php
    include "../data/users.php";
    $user = $users[1];
?>
<div class="userInfo">
    <p><?php echo $user['fname'] . " " . $user['lname'] . " (ID: " . $user['userId'] . ")" ?></p>
    <p><?php echo date("d.m.Y", strtotime($user['dob'])); ?></p>
    <p><a href="logout.php">Logout</a></p>
    <p><a href="cart.php">Cart: 2</a></p>
</div>