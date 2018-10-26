<div class="account">
    <?php
        $success = true;
        $fname = $lname = '';
        if ($_POST) {
            if (empty($_POST['fname'])) {
                $success = false;
            }
            else $fname = $_POST['fname'];

            if (empty($_POST['lname'])) {
                $success = false;
            }
            else $lname = $_POST['lname'];
            if (!$success) {
                echo "<p>Something went wrong!</p>";
                exit;
            }
        } ?>
    Hello <?php echo $fname . " " . $lname ?>
</div>
