<?php
require 'model/connectDb.php';
class Formation extends connectDb {

    private $id_form;
    private $nom;
    private $label;

    public static function getAllFormations()
    {
        $db = connectDb::dbConnect();
        $formations = $db->prepare('SELECT * FROM `formation`');
        $formations->execute();

        return $formations;
    }
}