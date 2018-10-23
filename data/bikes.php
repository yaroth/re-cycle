<?php
    /**
     * Created by PhpStorm.
     * User: yann
     * Date: 12.10.18
     * Time: 10:30
     */

    $bikesToSell = array(
        ["title" => "Koga", "price" => 560, "match" => 20, "color" => "red"],
        ["title" => "Velotraum", "price" => 400, "match" => 76, "color" => "blue"],
        ["title" => "Cilo", "price" => 1560, "match" => 50, "color" => "green"],
        ["title" => "MTB", "price" => 2400, "match" => 80, "color" => "yellow"]
    );
    usort($bikesToSell, function ($item1, $item2) {
        return $item2['match'] <=> $item1['match'];
    });


    function listProducts() {
        global $bikesToSell;
        for ($bikeID = 0; $bikeID < count($bikesToSell); $bikeID++) {
            listItem($bikeID);
        }
    }

    function listItem($id) {
        global $bikesToSell;
        $item = '<div class="item wrapper">
            <div class="title">
            <h3>' . $bikesToSell[$id]['title'] . '</h3>
            <p class="price">' . $bikesToSell[$id]['price'] . '.-</p>
            <p class="match">Match: ' . $bikesToSell[$id]['match'] . '%</p>
            </div>
            <div class="image">
                <a href="../functions.php">
                    <img src="../../img/logo.png">
                </a>
            </div>
            <div class="specs">
                <p>Size : 58 cm</p>
                <p>Color: ' . $bikesToSell[$id]['color'] . ' </p>
                <p>Speeds: 7</p>
                <p>Brakes: rims</p>
                <p>Wheels: 28"</p>
            </div>
            <div>  <a href="url">BUy NOv</a> </div>
        </div>';
        echo $item;
    }
