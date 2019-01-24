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

    public static function getProfById($id)
    {
        $db = connectDb::dbConnect();
        $prof = $db->prepare("SELECT * FROM `prof` WHERE id_prof ='$id'");
        $prof->execute();

        return $prof;
    }

    public static function getProfLogin($login,$password)
    {
        $db = connectDb::dbConnect();
        $prof = $db->prepare("SELECT id_prof, count(*) as cp  FROM `prof` WHERE login_prof = '$login' AND pass_prof = '$password' GROUP BY id_prof");
        $prof->execute();

        return $prof;

    }
}