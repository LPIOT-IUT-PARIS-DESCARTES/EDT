<?php
require("./model/Groupe.php");

class GroupeController{

  //Retourne tous les groupes
  public function index(){
    $groupes = Periode::getAllGroupes();
    $array_json = array();

    while ($groupe = $groupes->fetch()){
      $obj_json = array('id' => utf8_encode($groupe['id_grpe']),
      'promo' => utf8_encode($groupe['id_promo']), 
      'type groupe' => utf8_encode($groupe['type_grpe']),
      'num groupe' => utf8_encode($groupe['num_grpe'])
    );
      array_push($array_json,$obj_json);
    }
    echo  json_encode($array_json);
  }
}
?>