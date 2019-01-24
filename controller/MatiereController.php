<?php
require("./model/Matiere.php");

class MatiereController{

  //Retourne tous les matières
  public function index(){
    $matieres = Matiere::getAllMatieres();
    $array_json = array();

    while ($matiere = $matieres->fetch()){
      $obj_json = array('id' => utf8_encode($matiere['id_mat']),
      'ue' => utf8_encode($matiere['id_ue']),
      'module' => utf8_encode($matiere['id_mod']),
      'periode' => utf8_encode($matiere['id_period']),
      'nom' => utf8_encode($matiere['nom']),
      'prenom' => utf8_encode($matiere['label']),
      'nb Heure' => utf8_encode($matiere['nbH']),
      'couleur' => utf8_encode($matiere['couleur']),
      'theme' => utf8_encode($matiere['themes']),
      'type' => utf8_encode($matiere['typeEns']),
      );
      array_push($array_json,$obj_json);
    }
    echo  json_encode($array_json);
  }

  public function showByModule($id){
    $matieres = Matiere::getMatieresByModule($id);
    $array_json = array();
    while($matiere = $matieres-> fetch()){
      $obj_json = array('id' => utf8_encode($matiere['id_mat']),
      'ue' => utf8_encode($matiere['id_ue']),
      'module' => utf8_encode($matiere['id_mod']),
      'periode' => utf8_encode($matiere['id_period']),
      'nom' => utf8_encode($matiere['nom']),
      'label' => utf8_encode($matiere['label']),
      'nbHeure' => utf8_encode($matiere['nbH']),
      'couleur' => utf8_encode($matiere['couleur']),
      'theme' => utf8_encode($matiere['themes']),
      'type' => utf8_encode($matiere['typeEns']),
      );
      array_push($array_json,$obj_json); 
    }
    echo  json_encode($array_json);
  }

  public function show($id){
    $matieres = Matiere::getMatiereById($id);
    while ($matiere = $matieres -> fetch()){
      $obj_json = array('id' => utf8_encode($matiere['id_mat']),
      'ue' => utf8_encode($matiere['id_ue']),
      'module' => utf8_encode($matiere['id_mod']),
      'periode' => utf8_encode($matiere['id_period']),
      'nom' => utf8_encode($matiere['nom']),
      'label' => utf8_encode($matiere['label']),
      'nbHeure' => utf8_encode($matiere['nbH']),
      'couleur' => utf8_encode($matiere['couleur']),
      'theme' => utf8_encode($matiere['themes']),
      'type' => utf8_encode($matiere['typeEns']),
      ); 
    }
    echo  json_encode($obj_json);
  }

  public function showByLabel($label){
    $matieres = Matiere::getMatiereByLabel($label);
    while ($matiere = $matieres -> fetch()){
      $obj_json = array('id' => utf8_encode($matiere['id_mat']),
      'ue' => utf8_encode($matiere['id_ue']),
      'module' => utf8_encode($matiere['id_mod']),
      'periode' => utf8_encode($matiere['id_period']),
      'nom' => utf8_encode($matiere['nom']),
      'label' => utf8_encode($matiere['label']),
      'nbHeure' => utf8_encode($matiere['nbH']),
      'couleur' => utf8_encode($matiere['couleur']),
      'theme' => utf8_encode($matiere['themes']),
      'type' => utf8_encode($matiere['typeEns']),
      ); 
    }
    echo  json_encode($obj_json);
  }
  
}
?>