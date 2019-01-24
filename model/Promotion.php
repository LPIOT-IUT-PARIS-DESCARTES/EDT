<?php
require_once('connectBD.php');

class Promotion extends connectDb {
    private $id_promo;
    private $id_form;
    private $num;
    private $label;

    public static function getAllPromotions()
    {
        $db = connectDb::dbConnect();
        $promotions = $db->prepare('SELECT * FROM `promotion`');
        $promotions->execute();

        return $promotions;
    }
}