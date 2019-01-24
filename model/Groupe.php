<?php
require 'model/connectDb.php';
class Groupe extends connectDb {

    private $id_grpe;
    private $id_promo;
    private $type_grpe;
    private $num_grpe;

    public static function getAllGroupes()
    {
        $db = connectDb::dbConnect();
        $groupes = $db->prepare('SELECT * FROM `groupe`');
        $groupes->execute();

        return $groupes;
    }
}
