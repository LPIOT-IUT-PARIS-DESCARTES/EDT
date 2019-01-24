<?php
require 'model/connectDb.php';
class Prof extends connectDb {

    private $id_prof;
    private $genre;
    private $nom;
    private $prenom;
    private $email;
    private $label;
    private $login_prof;
    private $pass_prof;
    private $date_prof;
    private $urlPhoto;
    private $couleur;
    private $bConnect;

    public static function getAllProfs()
    {
        $db = connectDb::dbConnect();
        $profs = $db->prepare('SELECT * FROM `prof`');
        $profs->execute();

        return $profs;
    }
}