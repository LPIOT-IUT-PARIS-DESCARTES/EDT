<?php
require("./model/Salle.php");

class SalleController{

  //Retourne tous les salles
  public function index(){
    $salles = Periode::getAllSalles();
    $array_json = array();

    while ($salle = $salles->fetch()){
      $obj_json = array('id' => utf8_encode($salle['id_salle']),
      'nom' => utf8_encode($salle['nom']), 
      'label' => utf8_encode($salle['label']),
      'batiment' => utf8_encode($salle['batiment']),
      'type salle' => utf8_encode($salle['type_salle']),
      'nb postes' => utf8_encode($salle['nb_postes']),
    
    );
      array_push($array_json,$obj_json);
    }
    echo  json_encode($array_json);
  }
}
?>