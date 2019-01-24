<?php
/**
 * Created by PhpStorm.
 * User: nicolas
 * Date: 24/10/2018
 * Time: 20:13
 */

class EtudiantController extends Etudiant {

    public function index(){
        $etudiants = Etudiant::getAllEtudiants();
        $array_json = array();

        while ($etudiant = $etudiants->fetch()){
            $obj_json = array('id' => utf8_encode($etudiant['id_etu']),
            'promo' => utf8_encode($etudiant['id_promo']),
            'groupe' => utf8_encode($etudiant['id_grpe']),
            'nom' => utf8_encode($etudiant['nom']),
            'prenom' => utf8_encode($etudiant['prenom']),
            'e-mail' => utf8_encode($etudiant['email']),
            'login' => utf8_encode($etudiant['login_etu']),
            'pass' => utf8_encode($etudiant['pass_etu']),
            'matricule' => utf8_encode($etudiant['matricule']),       
        );
        array_push($array_json,$obj_json);
        }
        echo  json_encode($array_json);
    }
}