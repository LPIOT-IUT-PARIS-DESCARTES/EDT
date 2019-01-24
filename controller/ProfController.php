<?php
require("./model/Prof.php");

class ProfController{

  //Retourne tous les profs
  public function index(){
    $profs = Periode::getAllProfs();
    $array_json = array();

    while ($prof = $profs->fetch()){
      $obj_json = array('id' => utf8_encode($prof['id_prof']),
      'nom' => utf8_encode($prof['nom']),
      'prenom' => utf8_encode($prof['prenom']), 
      'email' => utf8_encode($prof['email']),
      'label' => utf8_encode($prof['label']),
      'login' => utf8_encode($prof['login_prof']),
      'pass' => utf8_encode($prof['pass_prof']),
      'date' => utf8_encode($prof['date_prof']),
      'photo' => utf8_encode($prof['urlPhoto']),
      'couleur' => utf8_encode($prof['couleur']),
      'bConnect' => utf8_encode($prof['bConnect']),
    );
      array_push($array_json,$obj_json);
    }
    echo  json_encode($array_json);
  }
}
?>