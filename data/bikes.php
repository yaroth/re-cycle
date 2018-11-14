<?php
    /**
     * Created by PhpStorm.
     * User: yann
     * Date: 12.10.18
     * Time: 10:30
     */

    /*usort($bikesToSell, function ($item1, $item2) {
        return $item2['match'] <=> $item1['match'];
    });*/
// TODO: NICE-TO-HAVE: create a function to sort by different keys

    function listProducts() {
        foreach(Bicycle::getBicycles() as $bike) {
            listItem($bike);
        }
    }

    function listItem($bicycle) {
        $item = '<div class="item wrapper">
            <div class="title">
            <h3>' . $bicycle->title . '</h3>
            <p class="price">' . $bicycle->price . '.-</p>
            <p class="match">Match: ' . "80" . '%</p>
            </div>
            <div class="image">
                <a href="../functions.php">
                    <img src="../../img/logo.png">
                </a>
            </div>
            <div class="specs">
                <p>Frame size : 58 cm</p>
                <p>Color: blue </p>
                <p>Speeds: ' . $bicycle->nbOfGears . '</p>
                <p>Brakes: rims</p>
                <p>Wheel size: '. $bicycle->wheelSize . '"</p>
            </div>
            <div>  <a href="url">Buy Now</a> </div>
        </div>';
        echo $item;
    }
