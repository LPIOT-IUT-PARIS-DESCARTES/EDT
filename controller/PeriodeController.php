<?php
require("./model/Periode.php");
class PeriodeController{

  //Retourne toutes les périodes
  public function index(){
    $periodes = Periode::getAllPeriodes();
    $array_json = array();
    while($periode = $periodes -> fetch()){
      $obj_json = array('id' => $periode['id_period'], 'periode' => date("M",$periode['tDeb']).' - '.date("M",$periode['tFin']), 'diff' => $periode['diff']);
      array_push($array_json,$obj_json);
    }
    echo json_encode($array_json);
  }
}
?>