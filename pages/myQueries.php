<!--Will first list all user specific queries, then make it possible to edit a single query-->
<h2><?php echo translate("myQueries"); ?></h2>
<?php include '../data/queries.php'; ?>
<div class="query items">
    <?php
        if (isset($_SESSION["user"])) {
            $login = $_SESSION["user"];
            $userID = User::getUserIDByLogin($login);
            // TODO: get language navigation to work when editing ONE query
            if (isset($_POST["queryID"])) {
                $queryID = $_POST["queryID"];
                $action = $_POST['action'];
                if ($action == 'deleteQuery') {
                    $deletionSuccess = Query::deleteQueryByID($queryID);
                    if ($deletionSuccess) echo 'Query successfully deleted!';
                    else echo 'Sorry, could not delete query!';
                    listQueriesByUserID($userID);
                } else if ($action == 'editQuery') {
                    listQueryByID($queryID);
                }
            }
            // checking on submitted data
            elseif (isset($_POST["saveQueryID"])) {
                $queryID = $_POST["saveQueryID"];
                // creates an array AND updates COOKIES
                $queryArray = queryArrayFromPost();
                // check that query array returns a correct value!
                if ($queryArray !== false) {
                    $queryObj = Query::withParams($queryArray);
                    $queryObj->id = $queryID;
                    $queryObj->userID = $userID;
                    $updatedQueryInDB = Query::updateQueryInDB($queryObj);
                    if ($updatedQueryInDB) {
                        echo '<h2>' . translate("success") . '</h2>';
                        echo "<h3>Successfully updated your query data.</h3>";
                        listQueriesByUserID($userID);
                    }
                    else {
                        echo '<h2>' . translate("error") . '</h2>';
                        echo "<h3>Could NOT update query data!</h3>";
                        include 'queryForm.php';
                    }
                } // TODO: should show POST data!
                else {
                    echo '<h2>' . translate("error") . '</h2>';
                    // TODO: Fix error handling! write to log file!
                    echo "<h3>Could NOT update query data! (queryArray is false)</h3>";
                    include 'queryForm.php';
                }
            } // No POST > list all queries by userID
            else {
                listQueriesByUserID($userID);
            }
        } else {
            $lang = getLang();
            echo '<h2>' . translate("error") . '</h2>';
            echo '<h3>' . translate("sorry") . ', to view your queries you first need to <a href="index.php?lang=' . $lang . '&id=2">login</a>!</h3>';
        }
    ?>
</div>
