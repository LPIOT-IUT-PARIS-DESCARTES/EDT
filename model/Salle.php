<?php
require_once('connectBD.php');

class Salle extends connectDb{
    private $id_Salle;
    private $nom;
    private $label;
    private $batiment;
    private $type_salle;
    private $nb_postes;

    public static function getAllSalles()
    {
        $db = connectDb::dbConnect();
        $salles = $db->prepare('SELECT * FROM `salle`');
        $salles->execute();

        return $salles;
    }

}

