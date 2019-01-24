<?php
require 'model/connectDb.php';
class Etudiant extends connectDB
{

    private $id_etu;
    private $id_promo;
    private $id_grpe;
    private $genre;
    private $nom;
    private $prenom;
    private $email;
    private $login_etu;
    private $pass_etu;
    private $matricule;
    private $date_etu;
    private $urlPhoto;
    private $bConnect;

    public static function getAllEtudiants()
    {
        $db = connectDb::dbConnect();
        $etudiants = $db->prepare('SELECT * FROM `etudiant`');
        $etudiants->execute();

        return $etudiants;
    }
}