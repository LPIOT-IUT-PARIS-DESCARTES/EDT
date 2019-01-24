<?php 
require("./model/Module.php");
class ModuleController {
  
  //Retourne tous les modules
  public function index(){
    $modules = Module::getAllModules();
    $array_json = array();
    while ($module = $modules->fetch()){
      $obj_json = array('id' => utf8_encode($module['id_uemod']),
      'nom' => utf8_encode($module['nom']));
      array_push($array_json,$obj_json);
    }
    echo json_encode($array_json);
  }
}
?>